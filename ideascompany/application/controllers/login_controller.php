<?php

class Login_controller extends Controller {

    public function __construct() {
        // $model= $this->loadModel('login_model');
    }

    public function index() {
        $model = $this->loadModel('login_model');
        $template = $this->loadView('login_view');
        $session = $this->loadHelper('session_helper');
//        echo $session->get('username');
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $this->redirect('admin_controller/search_requirements');
        }




        //  print_r($_POST);
        if (isset($_POST['user_name']) && isset($_POST['user_password'])) {

            $this->user_name = $_POST['user_name'];
            $this->user_password = $_POST['user_password'];
            $data = array(
                'user_name' => $this->user_name,
                'user_password' =>$this->user_password
            );
            //print_r($data);
            $result = $model->check_login_info($data);

            if (count($result) > 0) {
                if (!isset($_SESSION)) {
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

    public function login() {
        $this->redirect('login_controller/index');
      }
//    public function login() {
//        $model = $this->loadModel('login_model');
//        $template = $this->loadView('login_view');
//        $session = $this->loadHelper('session_helper');
////        echo $session->get('username');
//        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
//            $this->redirect('admin_controller/search_requirements');
//        }
//
//
//
//
//        //  print_r($_POST);
//        if (isset($_POST['user_name']) && isset($_POST['user_password'])) {
//
//            $this->user_name = $_POST['user_name'];
//            $this->user_password = $_POST['user_password'];
//            $data = array(
//                'user_name' => $this->user_name,
//                'user_password' => $this->user_password
//            );
//            //print_r($data);
//            $result = $model->check_login_info($data);
//
//            if (count($result) > 0) {
//                if (!isset($_SESSION)) {
//                    session_start();
//                }
//
//                $session->set('userid', $result[0][0]);
//                $session->set('username', $result[0][1]);
//                $session->set('useremail', $result[0][3]);
//                // echo $session->get('username'); die();
//                $this->redirect('admin_controller/search_requirements');
//            } else {
//                $error = 'Username Or Password does not matched';
//                $template->set('result', $error);
//            }
//        }
//        $template->render();
//    }

    public function logout() {
        $session = $this->loadHelper('session_helper');
        // $session->destroy();
        session_destroy();
        //echo 'fdvfdrv'; die();
        $template = $this->loadView('login_view');
        $template->render();
    }

    public function regi_form() {
        // $error = 'duplicate user name';
        $template = $this->loadView('registration_page');
        // $template->set('result', $error);
        $template->render();
    }

    public function create_account() {
//        print_r($_POST);die();
        $model = $this->loadModel('login_model');
        $template = $this->loadView('registration_page');
        if (isset($_POST) && !empty($_POST)) {
            $this->user_name = $_POST['user_name'];
            $this->user_email_address = $_POST['user_email_address'];
            $this->user_password = $_POST['user_password'];



            $data = array(
                'user_name' => $this->user_name,
                'user_email_address' => $this->user_email_address,
                'user_password' =>$this->user_password
            );
            // print_r($data);
            //die();
            $validation = $model->check_validation_for_registration($data);
            //   print_r($validation); die();
            if (count($validation) > 0) {
                //echo 123; exit;
                // $this->redirect('login_controller/regi_form');
                $error = 'Your  Name or Email are already exist! Please try Again ';

                $template->set('result', $error);
            } else {
                //  echo 'regia'; exit;
                $result = $model->create_registration_info($data);
                $this->redirect('login_controller/');
            }
        }$template->render();
    }

    // ------------------------------------------------ADMIN--------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------


    public function admin_login() {
        $model = $this->loadModel('login_model');
        $template = $this->loadView('admin_login_view');
        $session = $this->loadHelper('session_helper');
//        echo $session->get('username');
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $this->redirect('admin_controller/admin_dashboard');
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
            $result = $model->admin_check_login_info($data);

            if (count($result) > 0) {
                if (!isset($_SESSION)) {
                    session_start();
                }

                $session->set('userid', $result[0][0]);
                $session->set('username', $result[0][1]);
                $session->set('useremail', $result[0][3]);
                // echo $session->get('username'); die();
                $this->redirect('admin_controller/admin_dashboard');
            } else {
                $error = 'Username Or Password does not matched';
                $template->set('result', $error);
            }
        }
        $template->render();
    }

    public function admin_logout() {

        $session = $this->loadHelper('session_helper');
        // $session->destroy();
        session_destroy();
        //echo 'fdvfdrv'; die();
        $template = $this->loadView('admin_login_view');
        $template->render();
    }

}

?>