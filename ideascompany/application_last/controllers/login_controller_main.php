<?php

class Login_controller extends Controller {

    public function __construct() {
        // $model= $this->loadModel('login_model');
    }

//    public function index() {
//        $template = $this->loadView('login_view');
//        $template->render();
//    }
//
//    public function check_login() {
//        $model = $this->loadModel('login_model');
//        $this->user_name = $_POST['user_name'];
//        $this->user_password = $_POST['user_password'];
//        $data = array(
//            'user_name' => $this->user_name,
//            'user_password' => $this->user_password
//        );
//
//        $result = $model->check_login_info($data);
//
//        if (count($result) > 0) {
//            $this->redirect('admin_controller');
//            $template = $this->loadView('dashboard');
//            $template->render();
//        } else {
//            $this->redirect('login_controller');
//        }
//    }
    public function login() {
        $model = $this->loadModel('login_model');
        $template = $this->loadView('login_view');
        $session = $this->loadHelper('session_helper');
//        echo $session->get('username');
        if ( isset($_SESSION['username']) && $_SESSION['username']!='') {
            $this->redirect('admin_controller/search_requirements');
        }
        
        
        
        
        //  print_r($_POST);
        if (isset($_POST['user_name']) && isset($_POST['user_password'])) {

            $this->user_name = $_POST['user_name'];
            $this->user_password = $_POST['user_password'];
            $data = array(
                'user_name' => $this->user_name,
                'user_password' => $this->user_password
            );
            //print_r($data);
            $result = $model->check_login_info($data);

            if (count($result) > 0) {
                if(!isset($_SESSION)){
                     session_start();
                }
               
                $session->set('userid', $result[0][0]);
                $session->set('username', $result[0][1]);
                $session->set('useremail', $result[0][3]);
               // echo $session->get('username'); die();
                $this->redirect('admin_controller/search_requirements');
            } else {
                $error = 'Username Or Password does not matched';
                $template->set('result', $error);
            }
        }

        




        $template->render();
    }

    public function logout() {
        $session = $this->loadHelper('session_helper');
       // $session->destroy();
        session_destroy();
        //echo 'fdvfdrv'; die();
        $template = $this->loadView('login_view');
        $template->render();
    }

}

?>