<?php

if (!defined('BASEPATH'))
    exit('Woa...Not find system folder');

/* -----------------------------------------------
  # Rao_vat version 1.0
  # hinhanh controller
  # Extends CI_Controller
  # Author: Nguyen Duc Hung - http://tinagroup.net
  # Create date: 02/05/2011
  ------------------------------------------------ */
require_once APPPATH . 'third_party/admin_controller' . EXT;

class Hinhanh extends Admin_controller {

    public function __construct() {

        parent:: __construct();

        // Check login
        $this->check_login();

        // Load model
        $this->load->model('hinhanh/hinhanh_model', 'hinhanh');
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));
    }

    public function index() {

        $data = array();
        $data['render_path'] = array('Admin' => base_url() . 'admin/trangchu/home', 'Danh mục Hình ảnh' => base_url() . 'admin/hinhanh-ad/home');
        $data['heading_title'] = 'Quản lý Hình ảnh';
        $data['url_create'] = base_url() . 'admin/hinhanh-ad/add_edit';
        $data['action'] = base_url() . 'admin/hinhanh-ad/add_edit';

        $del = $this->input->post('selected');
 
        if ($this->input->post('act_del') == 'act_del') {

            if ($del) {

                if (gettype($del) == 'array' && count($del) > 0) {

                    foreach ($del as $id) {

                        if ($this->hinhanh->delete($id)) {
                            $this->session->set_flashdata('warning', 'Xóa danh mục thành công');
                        } else {
                            $this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
                            redirect('admin/hinhanh-ad/home');
                        }
                    } //End foreach
                    redirect('admin/hinhanh-ad/home');
                } // End if
            } else {
                $this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
                redirect('admin/hinhanh-ad/home');
            }
        }



        $article = $this->hinhanh->get_hinhanh_where(null, array('id' => 'DESC'), null);
        foreach ($article->result() as $result) {
            $data['lists'][] = array(
                'id' => $result->id,
                'name' => $result->name,
                'contents' => $result->contents,
                'img' => $result->img,
                'url' => $result->url,
                'ord' => $result->ord,
                'active' => $result->active,
                'url_edit' => base_url() . 'admin/hinhanh-ad/add_edit/' . $result->id,
                'url_del' => base_url() . 'admin/hinhanh-ad/delete/' . $result->id
            );
        }


        $this->render($this->load->view('admin/hinhanh/index', $data, TRUE));
    }

    public function add_edit() {


        $_id = $this->uri->segment(4);
        $data['render_path'] = array('Admin' => base_url() . 'admin/trangchu/home', 'Danh sách hinhanh' => base_url() . 'admin/hinhanh-ad/home');
        $data['heading_title'] = 'Tạo - Cập nhật hinhanh';
        $data['action'] = base_url() . 'admin/hinhanh-ad/add_edit';
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $data['name'] = $this->input->post('name');
        $data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;
        $data['ord'] = $this->input->post('ord');
        $data['url'] = $this->input->post('url');
        $id = (int) $this->input->post('id');
        $oldImage = $this->input->post('oldImage');
        if ($this->form_validation->run() == TRUE) {

            $config = array(
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => realpath(APPPATH . '../images/hinhanh'),
                'max_size' => 20000000
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $image_data = $this->upload->data();
            //$avatar ='images/tintuc/'.$image_data['file_name'];
            if ($image_data['file_name'] != '') {
                if ($oldImage != '') {
                    $this->deleteFile($oldImage);
                }
                $data['image'] = 'images/hinhanh/' . $image_data['file_name'];
            } else {
                if ($oldImage != '') {
                    $data['image'] = $oldImage;
                } else {
                    $data['image'] = '';
                }
            } // End upload file
            if ($id && $id != '') {

                if ($this->hinhanh->update($id, $data)) {
                    $this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
                    redirect('admin/hinhanh-ad/add_edit/' . $id);
                } else {
                    $this->session->set_flashdata('warning', 'Có lỗi rồi');
                    redirect('admin/hinhanh-ad/add_edit');
                }
            } else {

                if ($this->hinhanh->add($data)) {
                    $this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
                    redirect('admin/hinhanh-ad/home');
                } else {
                    $this->session->set_flashdata('warning', 'Có lỗi rồi');
                    redirect('admin/hinhanh-ad/add_edit');
                }
            }
        }

        if ($_id != '')
            $data['article'] = $this->hinhanh->get_by_id($_id);
        //$data['root'] = $this->hinhanh->get_root_hinhanh(0);

        $this->render($this->load->view('admin/hinhanh/hinhanh_form', $data, TRUE));
    }

    function delete() {

        //$this->permission_edit_del();

        $id = $this->uri->segment(4);
        /* if($this->hinhanh->parent_exists($id)) {
          $this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
          redirect('admin/hinhanh');
          } else {
         */
        if ($this->hinhanh->delete($id)) {
            $this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
            redirect('admin/hinhanh-ad/home');
        } else {
            $this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
            redirect('admin/hinhanh-ad/home');
        }
        //}
    }

}

/* End file */
/* Local application/controllers/admin/hinhanh.php */