<?php

if (!defined('BASEPATH'))
    exit('Woa...Not find system folder');

/* -----------------------------------------------
  # Rao_vat version 1.0
  # video controller
  # Extends CI_Controller
  # Author: Nguyen Duc Hung - http://tinagroup.net
  # Create date: 02/05/2011
  ------------------------------------------------ */
require_once APPPATH . 'third_party/admin_controller' . EXT;

class Video extends Admin_controller {

    public function __construct() {

        parent:: __construct();

        // Check login
        $this->check_login();

        // Load model
        $this->load->model('video/video_model', 'video');
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));
    }

    public function index() {

        $data = array();
        $data['render_path'] = array('Admin' => base_url() . 'admin/trangchu/home', 'Danh mục Video' => base_url() . 'admin/video-ad/home');
        $data['heading_title'] = 'Quản lý Video';
        $data['url_create'] = base_url() . 'admin/video-ad/add_edit';
        $data['action'] = base_url() . 'admin/video-ad/add_edit';

        $del = $this->input->post('selected');
 
        if ($this->input->post('act_del') == 'act_del') {

            if ($del) {

                if (gettype($del) == 'array' && count($del) > 0) {

                    foreach ($del as $id) {

                        if ($this->video->delete($id)) {
                            $this->session->set_flashdata('warning', 'Xóa danh mục thành công');
                        } else {
                            $this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
                            redirect('admin/video-ad/home');
                        }
                    } //End foreach
                    redirect('admin/video-ad/home');
                } // End if
            } else {
                $this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
                redirect('admin/video-ad/home');
            }
        }



        $article = $this->video->get_video_where(null, array('id' => 'DESC'), null);
        foreach ($article->result() as $result) {
            $data['lists'][] = array(
                'id' => $result->id,
                'name' => $result->name,
                'url' => $result->url,
                'ord' => $result->ord,
                'active' => $result->active,
                'url_edit' => base_url() . 'admin/video-ad/add_edit/' . $result->id,
                'url_del' => base_url() . 'admin/video-ad/delete/' . $result->id
            );
        }


        $this->render($this->load->view('admin/video/index', $data, TRUE));
    }

    public function add_edit() {


        $_id = $this->uri->segment(4);
        $data['render_path'] = array('Admin' => base_url() . 'admin/trangchu/home', 'Danh sách video' => base_url() . 'admin/video-ad/home');
        $data['heading_title'] = 'Tạo - Cập nhật video';
        $data['action'] = base_url() . 'admin/video-ad/add_edit';
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $data['name'] = $this->input->post('name');
        $data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;
        $data['ord'] = $this->input->post('ord');
        $data['url'] = $this->input->post('url');
        $id = (int) $this->input->post('id');
        if ($this->form_validation->run() == TRUE) {

            
            if ($id && $id != '') {

                if ($this->video->update($id, $data)) {
                    $this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
                    redirect('admin/video-ad/add_edit/' . $id);
                } else {
                    $this->session->set_flashdata('warning', 'Có lỗi rồi');
                    redirect('admin/video-ad/add_edit');
                }
            } else {

                if ($this->video->add($data)) {
                    $this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
                    redirect('admin/video-ad/home');
                } else {
                    $this->session->set_flashdata('warning', 'Có lỗi rồi');
                    redirect('admin/video-ad/add_edit');
                }
            }
        }

        if ($_id != '')
            $data['article'] = $this->video->get_by_id($_id);
        //$data['root'] = $this->video->get_root_video(0);

        $this->render($this->load->view('admin/video/video_form', $data, TRUE));
    }

    function delete() {

        //$this->permission_edit_del();

        $id = $this->uri->segment(4);
        /* if($this->video->parent_exists($id)) {
          $this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
          redirect('admin/video');
          } else {
         */
        if ($this->video->delete($id)) {
            $this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
            redirect('admin/video-ad/home');
        } else {
            $this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
            redirect('admin/video-ad/home');
        }
        //}
    }

}

/* End file */
/* Local application/controllers/admin/video.php */