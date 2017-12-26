<div id="header">
    <div class="div1">
        <div class="div2"><img src="" /></div>
        <div class="div3">
            <img src="<?= base_url(); ?>admin_template/image/lock.png" />
            Bạn đăng nhập với tài khoản <span><?php echo $this->session->userdata('username'); ?> | <a href="<?= base_url(); ?>admin/user/logout" style="color:#ffffff; text-decoration:none;">Thoát</a></span>
        </div>
    </div>
    <div id="menu">
        <ul class="left">
            <li id="dashboard"><a href="<?= base_url(); ?>admin/trangchu/home" class="top">Admin page</a></li>
            <li><a href="#" class="top">Hệ thống</a>
                <ul>
                    <li><a href="<?= base_url(); ?>admin/setting-ad/home">Cài đặt chung</a>
                    <li><a href="<?= base_url(); ?>admin/menu-ad/home">Menu</a>
                    <li><a href="<?= base_url(); ?>admin/user-ad/home">Thành viên</a></li>

                </ul>
            </li>
            
            <li><a href="#" class="top">Danh mục </a>
                <ul>
           
                    <li><a href="<?= base_url(); ?>admin/tintuc-ad/home">Tin tức</a></li>
                    <li><a href="<?= base_url(); ?>admin/danhmucdichvu-ad/home">Cảm nhận học viên</a></li>
                    <li><a href="<?= base_url(); ?>admin/hinhanh-ad/home">Hình ảnh học viên</a></li>
                    <li><a href="<?= base_url(); ?>admin/video-ad/home">Video học viên</a></li>
                </ul>
            </li>
            <li><a href="#" class="top">Quản lý</a>
                <ul>

                    <li><a href="<?= base_url(); ?>admin/slide-ad/home">Slide banner</a></li>
                    <li><a href="<?= base_url(); ?>admin/parttent-ad/home">Đối tác</a></li>
                    <li><a href="<?= base_url(); ?>admin/maillienhe-ad/home">Liên hệ</a></li>

                </ul>
            </li>

        </ul>
    </div><!--End menu-->
</div><!--End header-->