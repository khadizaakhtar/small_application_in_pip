<?php

class Login_model extends Model {

    public function index() {
        
    }

    public function check_login_info($data) {

        $result = $this->query("SELECT * FROM tbl_user WHERE user_name='$data[user_name]' AND user_password=md5('$data[user_password]')");

        return $result;
    }

    public function create_registration_info($data) {

        $result = $this->execute("INSERT INTO tbl_user (user_name,user_password,user_email_address) VALUES('$data[user_name]',md5('$data[user_password]'),'$data[user_email_address]')");
        return true;
    }

    public function check_validation_for_registration($data) {
        // print_r($data); die(); 
        $result = $this->query("SELECT * FROM tbl_user WHERE user_name='$data[user_name]' AND user_email_address='$data[user_email_address]'");

        return $result;
    }

    //$query= $con->prepare("SELECT * FROM tbl_userinfo WHERE contact_mail ='$_POST[contact_mail]'");
    public function admin_check_login_info($data) {

        $result = $this->query("SELECT * FROM tbl_user WHERE user_name='$data[user_name]' AND user_password=md5('$data[user_password]') AND access_label=1 ");

        return $result;
    }

}

?>