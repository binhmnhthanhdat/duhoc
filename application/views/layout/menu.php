<?php
$sql = "select * from setting ";
$setting = $this->db->query($sql);
$kqsetting = $setting->row();
?>
<div class="clearFix"></div>
<div style="background:#0e75b9;" >
    <div class="menuBar" id="ddtopmenubar">
        <a href="<?php echo base_url(); ?>" class="nav-btn">MẠNG LAN - BẢO TRÌ MÁY TÍNH<span></span></a>
        <span class="top-nav-shadow"></span>
        <ul id="ulmenuBar">
           <li class="active"><a  style="padding-top: 10px;"  href="<?php echo base_url(); ?>"  title="Thi công mạng LAN | Bảo trì máy tính" class="upcase fontsize11"><img src="<?php echo base_url(); ?>/images/thi-cong-mang-bao-tri-may-tinh.png" alt='thi-cong-mang-bao-tri-may-tinh' style="padding: 0 10px;"/></a></li>
            <?php
            $sql = "select * from cat_new where active=1 and parent=0 order by ord asc";
            $laymenu = $this->db->query($sql);
            if ($laymenu->num_rows() > 0) {
                foreach ($laymenu->result() as $kqlaymenu) {
                    ?>
                    <li><a  href="<?php
                    if ($kqlaymenu->type == 1) {
                        echo base_url('cong-ty');
                    } else if ($kqlaymenu->type == 2) {
                        echo base_url('du-an');                    
                    }
                    ?>"  title="<?php echo $kqlaymenu->name; ?>" class="upcase fontsize11"><span> <?php echo $kqlaymenu->name; ?></span></a></li>
                            <?php
                        }
                    }
                    ?>
        </ul>
        <div class="shareTop" style="float: left;">
             <script type="text/javascript">
                
                function newPopup(url) {
                    popupWindow = window.open(url, 'popUpWindow', 'height=300,width=600,left=400,top=200,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
                }
                </script> 
            <a href="javascript:thicongnoithat" onclick="newPopup('https://plus.google.com/share?url=<? echo base_url().uri_string();?>')" title="Google" class="padL5" rel="nofollow"><img src=" <?php echo base_url(); ?>images/google.png" width="26" height="26" alt="Google" /></a>
            <a href="javascript:thicongnoithat" onclick="newPopup('https://www.facebook.com/sharer.php?u=<? echo base_url().uri_string();?>')"  title="Facebook" class="padL5" rel="nofollow"><img src=" <?php echo base_url(); ?>images/facebook.png" width="26" height="26" alt="Facebook" /></a>
            <a href="javascript:thicongnoithat" onclick="newPopup('http://twitter.com/home?status=<? echo base_url().uri_string();?>')" title="Twiter"  class="padL5" rel="nofollow"><img src=" <?php echo base_url(); ?>images/twiter.png" width="26" height="26" alt="Twiter" /></a>
        </div>
        <div class="group_tieude">
            <h1 style = " padding-right: 10px;" class="tieude" title="<?php if (isset($title)) {
                        echo $title;
                    } else {
                        echo $kqsetting->site_name;
                    } ?>"><?php if (isset($title)) {
                        echo $title;
                    } else {
                        echo $kqsetting->site_name;
                    } ?></h1>
            <div style="clear:both" >
                <p  style = "display: block; padding-right: 20px;" >Liên hệ thi công mạng | Bảo trì máy tính: 0941111336</p>
            </div>
        </div>
    </div>
</div>