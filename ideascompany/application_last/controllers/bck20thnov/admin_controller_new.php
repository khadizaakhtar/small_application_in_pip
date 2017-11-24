<?php

require_once 'html2pdf.class.php';

class Admin_controller extends Controller {

    public function __construct() {
        // $model= $this->loadModel('login_model');
    }

    public function index() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $template = $this->loadView('dashboard');
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function add_requirement() {
        $template = $this->loadView('add_requirement');
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {

            $model = $this->loadModel('admin_model');
            $stafflist=$model->stafflist();//
             $template->set('stafflist', $stafflist);
            if (isset($_POST) && !empty($_POST)) {//print_r($_POST);die();
                $this->tenant_name = $_POST['tenant_name'];
//        $this->town = $_POST['town'];
                $this->rccheck = $_POST['rccheck'];
                $this->floor_area_to = $_POST['floor_area_to'];
                $this->floor_area_from = $_POST['floor_area_from'];
                $this->use_class = $_POST['use_class'];
                $this->agent_name = $_POST['agent_name'];
                $this->agent_email = $_POST['agent_email'];
                $this->agent_phone_number = $_POST['agent_phone_number'];
                $this->staff_id = $_POST['staff_id'];

                $this->town = $_POST['town'];
                //    $_SESSION[](serialize($_POST['data']['requirement_id']));
                //    die();
                // $townVal = serialize($_POST['data']['town']);
//        --------------------------------------
                //validation start
                $tanent_name = $this->tenant_name;

                $town = $this->town;
                $agent_name = $this->agent_name;
                $agent_email = $this->agent_email;
                $agent_phone_number = $this->agent_phone_number;
                $error = array();
                if (empty($tanent_name)) {
                    $error['tanent_name'] = 'Tenant Field Can,t Be Empty';
                }
                if (empty($town)) {
                    $error['town'] = 'Town Field Can,t Be Empty';
                } 
                if (empty($agent_name)) {
                    $error['agent_name'] = 'Agent name Can,t Be Empty';
                } 
                if (empty($agent_email)) {
                    $error['agent_email'] = 'Email Field Can,t Be Empty';
                } 
                if (empty($agent_phone_number)) {
                    $error['agent_phone_number'] = 'Phone Number Can,t Be Empty';
                } 
                if (!preg_match("/^[a-zA-Z ]*$/", $tanent_name)) {
                    $error['tanent_name_error'] = "Invalid Tanent Name!";
                } /* else if (!preg_match("/^[a-zA-Z ]*$/", $town)) {
                  $error['town_error'] = "Invalid Town Name!";
                  } */ 
                if (!preg_match("/^[a-zA-Z ]*$/", $agent_name)) {
                    $error['agent_name_error'] = "Invalid Agent Name!";
                } 
                if (!preg_match("/^[0-9]*$/", $agent_phone_number)) {
                    $error['contact_error'] = "Invalid contact No!";
                } 
                if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $agent_email)) {
                    $error['agent_email_error'] = "Invalid email!";
                }
                if (empty($error)) {
                    $data = array(
                        'tenant_name' => $this->tenant_name,
                        'town' => $this->town,
                        'floor_area_to' => $this->floor_area_to,
                        'floor_area_from' => $this->floor_area_from,
                        'use_class' => $this->use_class,
                        'rccheck' => $this->rccheck,
                        'use_class' => $this->use_class,
                        'agent_name' => $this->agent_name,
                        'agent_phone_number' => $this->agent_phone_number,
                        'staff_id' => $this->staff_id,
                        'agent_email' => $this->agent_email,
                    );

                    $result = $model->add_requirement_info($data);
                    if ($result == true) {  
                         $_POST = array();
                         $message="You Are Successfully Saved!";
                         $template = $this->loadView('add_requirement');
                         $template->set('resmsg',$message); 
                         $template->render();
                         die();
                        
                        //$this->redirect('admin_controller/add_requirement');
                    } else {
                        echo 'error';
                    }
                } else {
                    $template->set('result', $error);
                   

                }
            }


            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function show_requirements() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('show_req');
            $val = serialize($_POST['data']['requirement_id']);
            //print_r($val);die();
            $_SESSION['requirement_id'] = $val;
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function delete_requirement($requirement_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $result = $model->delete_requirement_by_id($requirement_id);
            $this->redirect('admin_controller/suirements');
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function add_property_view() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $template = $this->loadView('property');
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function add_property() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {

            $model = $this->loadModel('admin_model');
            

            if (isset($_POST) && !empty($_POST)) {
                $this->address_line1 = $_POST['address_line1'];
                $this->address_line2 = $_POST['address_line2'];
                $this->address_line3 = $_POST['address_line3'];
                $this->town = $_POST['town'];
                $this->country = $_POST['county'];
                $this->postcode = $_POST['postcode'];
                $this->floor_area = $_POST['floor_area'];
                $this->use_class = $_POST['use_class'];

                $address_line1 = $this->address_line1;
                $town = $this->town;
                $floor_area = $this->floor_area;

                if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                   // echo $_FILES['image']['name'];

                    $image = $_FILES['image'];
                    $imgupload = $model->upload($image);

                    if ($imgupload['msg'] == 'Success') {
                        $this->image = $imgupload['imagename'];
                    } else {
                        $error['image'] = $imgupload['msg'];
                    }
                }
                if (empty($address_line1)) {
                    $error['address_line1'] = 'Address Line1 Can,t Be Empty';
                } 
                if (empty($town)) {
                    $error['town'] = 'Town Can,t Be Empty';
                } 
                if (empty($floor_area)) {
                    $error['floor_area'] = 'Floor Area Can,t Be Empty';
                } 
                if (!preg_match("/^[a-zA-Z ]*$/", $town)) {
                    $error['town_name_error'] = "Invalid Town Name!";
                }
                if (empty($error)) {
                    $data = array(
                        'address_line1' => $this->address_line1,
                        'address_line2' => $this->address_line2,
                        'address_line3' => $this->address_line3,
                        'town' => $this->town,
                        'country' => $this->country,
                        'postcode' => $this->postcode,
                        'floor_area' => $this->floor_area,
                        'use_class' => $this->use_class,
                        'image' => $this->image
                    );

                    $result = $model->add_property_info($data);
                    if ($result == true) {
                         $_POST = array();
                        $message="You Are Successfully Saved!";
                        $template = $this->loadView('property');
                        $template->set('resmsg',$message);
                       
                         
                       //  die();
                       // $this->redirect('admin_controller/add_property_view');
                    } else {
                        echo 'error';
                    }
                } else {
                    $template = $this->loadView('property');
                    $template->set('result', $error);
                    //$template->render();
                }
                $template->render();
            } else {
                $this->redirect('login_controller/');
            }
        }
    }

    public function property_pdf_page() {
        $template = $this->loadView('property_pdf_page');
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {

            $model = $this->loadModel('admin_model');
            if (isset($_POST) && !empty($_POST)) {

                $this->address_line1 = $_POST['address_line1'];
                $this->address_line2 = $_POST['address_line2'];
                $this->address_line3 = $_POST['address_line3'];
                $this->town = $_POST['town'];
                $this->country = $_POST['country'];
                $this->postcode = $_POST['postcode'];
                $this->floor_area = $_POST['floor_area']; 
                /// $this->floor_area_from = $_POST['floor_area_from'];
                $this->image = '';
                $this->use_class = $_POST['use_class'];

                $address_line1 = $this->address_line1;
                $town = $this->town;
                $floor_area = $this->floor_area;

                if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                    //echo $_FILES['image']['name'];

                    $image = $_FILES['image'];
                    $imgupload = $model->upload($image);

                    if ($imgupload['msg'] == 'Success') {
                        $this->image = $imgupload['imagename'];
                    } else {
                        $error['image'] = $imgupload['msg'];
                    }
                }
                
                if (empty($address_line1)) {
                    $error['address_line1'] = 'Address Line1 Can,t Be Empty';     
                } 
                if(empty($town)){
                     $error['town'] = 'Town Can,t Be Empty'; 
                }
                 if(empty($floor_area)){
                     $error['floor'] = 'Floor Area Can,t Be Empty';
                }
                
                if (!preg_match("/^[a-zA-Z ]*$/", $town)) {
                    $error['town_name_error'] = "Invalid Town Name!";
                }
                
                if (empty($error)) {
                    $data = array(
                        'address_line1' => $this->address_line1,
                        'address_line2' => $this->address_line2,
                        'address_line3' => $this->address_line3,
                        'town' => $this->town,
                        'country' => $this->country,
                        'postcode' => $this->postcode,
                        'floor_area' => $this->floor_area,
                        'use_class' => $this->use_class,
                        'image' => $this->image
                    );


                    $setpdf = '<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            .book{
                height:500px;
                background-color:white;
                padding:100px;
                margin:100px;
                box-shadow: 10px 10px 5px #888888;
            }
            .main{
                background-color:#E8E8E8;
                padding: 20px;
            }
            .logo{
              float:left;  
            }
            .information{
                float:left;
                color:#2D3E50;
                margin-left:150px;
            }
            .information ul li{
                list-style:none; 
            }
            img {
    height: 300px;
    margin-top:20px; 
              }
        </style>
    </head>
    <body class="main">
        <div class="book">  
            <h1  style="text-align:center; color:#2D3E50;">HEADING HERE</h1>
            
            <div class="information">
                <div >
                    <h1>Property</h1>
                    <ul>
                        <li>Address Line1:' . $data['address_line1'] . '</li>
                        <li>Address Line2:' . $data['address_line2'] . '</li>
                        <li>Address Line3:' . $data['address_line3'] . '</li>
                        <li>Town:' . $data['town'] . '</li>
                        <li>Country:' . $data['country'] . '</li>
                        <li>Postcode:' . $data['postcode'] . '</li>
                        <li>Use Class:' . $data['use_class'] . '</li>
                        
                    </ul>
                </div>

                
            </div>
        </div>
    </body>
</html>';


                    // print_r($data);die();
                    /* $setpdf = "<table>";
                      $setpdf .="<tr><td>Address Line1  </td> <td>" . $data['address_line1'] . "</td></tr>";
                      $setpdf .="<tr><td>Address Line2  </td> <td>" . $data['address_line2'] . "</td></tr>";
                      $setpdf .="<tr><td>Address Line3  </td> <td>" . $data['address_line3'] . "</td></tr>";
                      $setpdf .="<tr><td>Town   </td> <td>" . $data['town'] . "</td></tr>";
                      $setpdf .="<tr><td>Country </td> <td>" . $data['country'] . "</td></tr>";
                      $setpdf .="<tr><td>Postcode </td> <td>" . $data['postcode'] . "</td></tr>";
                      // $setpdf .="<tr><td>Floor Area  </td> <td>" . $data['floor_area'] . "</td></tr>";
                      $setpdf .="<tr><td>Use Class </td> <td>" . $data['use_class'] . "</td></tr>";

                      $setpdf .="</table>";
                     */
                    try {
                        //echo 'gvhgvhg';die();
                        $html2pdf = new HTML2PDF('P', 'A4', 'en');
                        // $html2pdf->pdf->SetDisplayMode('real');
                        $html2pdf->writeHTML($setpdf);
                        $outputfile = rand(1, 99999);
                        $outputfilemain = '/home2/pge3fov/public_html/pip_application/pdf/' . $outputfile . '.pdf';
                        // $outputfilemain = 'E:/xampp/htdocs/pip_khadiza/pdf/' . $outputfile . '.pdf';
                        $html2pdf->Output($outputfilemain, 'F');
                    } catch (HTML2PDF_exception $e) {
                        echo $e;
                        exit;
                    }

                    $result = $model->add_property_info($data);

                    $requirement_id = unserialize($_SESSION['requirement_id']);
                    $emails = '';
                    $requirement_info = array();
                    foreach ($requirement_id as $k => $reqid) {
                        $requirement = $model->getrequirements($reqid);
                        $requirement_info[] = $requirement[0];
                        if ($k == 0) {
                            $emails .=$requirement[0][7];
                        } else {
                            $emails .=', ' . $requirement[0][7];
                        }
                    }
                    $content = chunk_split(base64_encode(file_get_contents($outputfilemain)));
                    $uid = md5(uniqid(time()));  //unique identifier
//declare multiple kinds of email (plain text + attch)
                    $header .="Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
                    $header .="This is a multi-part message in MIME format.\r\n";
                    $file_name = $outputfile . '.pdf';
                    //attch part
                    $header .= "--" . $uid . "\r\n";
                    $header .= "Content-Type: pdf; name=\"" . $file_name . "\"\r\n";
                    $header .= "Content-Transfer-Encoding: base64\r\n";
                    $header .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"\r\n\r\n";
                    $header .= $content . "\r\n\r\n";  //chucked up 64 encoded attch

                    $subject = "Pdf Sent to agent";
                    mail($emails, $subject, $txt);


                    if (mail($emails, $subject, "", $header)) {
                        $this->redirect('admin_controller/property_sent_for_multiple/' . $result);
                    } else {
                        echo "fail";
                    }
                } else {

                    $template->set('result', $error);
                    // $template->render();
                }
            }

            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function add_staff_view() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $template = $this->loadView('staff');
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function add_staff() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $this->user_name = $_POST['user_name'];
            $this->user_password = $_POST['user_password'];
            $this->user_email_address = $_POST['user_email_address'];
            $user_name = $this->user_name;
            $user_password = $this->user_password;
            $user_email_address = $this->user_email_address;
            $error = array();
//            if (empty($user_name) || empty($user_password) || empty($user_email_address)) {
//                $error['user_name'] = 'User Name Can,t Be Empty';
//                $error['user_password'] = 'Password Can,t Be Empty';
//                $error['user_email_address'] = 'Email Can,t Be Empty';
//            } 
            if (empty($user_name)) {
                $error['user_name'] = 'User Name Can,t Be Empty';
            } 
            if (empty($user_password)) {
                $error['user_password'] = 'Password Can,t Be Empty';
            }
            if (empty($user_email_address)) {
                $error['user_email_address'] = 'Email Can,t Be Empty';
            } 
            if (!preg_match("/^[a-zA-Z ]*$/", $user_name)) {
                $error['user_name_error'] = "Invalid User Name!";
            } 
            if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $user_email_address)) {
                $error['user_email_address_error'] = "Invalid email Address!";
            }
            if (empty($error)) {
                $data = array(
                    'user_name' => $this->user_name,
                    'user_password' =>md5($this->user_password),
                    'user_email_address' => $this->user_email_address,
                );
                $result = $model->add_staff_info($data);
                if ($result == true) {
                     $_POST = array();
                    $message="You Are Successfully Saved!";
                    $template = $this->loadView('staff');
                    $template->set('resmsg',$message);
                    $template->render();
                    //$this->redirect('admin_controller/add_staff_view');
                   
                } else {
                    echo 'error';
                }
            } else {
                $template = $this->loadView('staff');
                $template->set('result', $error);
                $template->render();
            }
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function property_page() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $template = $this->loadView('property_page');
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function search_requirements() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('search_requirements');
            $message=''; 
            $limit = 0;
            $start_from = 0;
            $pagi['total_pages'] = 0;
            $result = array();
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $this->search = $_GET['search'];
                $search = $this->search;
                $limit = 0;
                $start_from = 0;
                $pagination = $model->show_property_info($search, $start_from, $limit);
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                };
                $limit = 2;
                $start_from = ($page - 1) * $limit;
                $result = $model->search_requirements_info_reasult($search, $start_from, $limit);
                //me
                if(!count($result)){
                $message="No Records Found!";
                }
                //me
                if (count($pagination) > 0) {
                    $pagi['total_pages'] = ceil(count($pagination) / $limit);
                }
            }
            $template->set('errormessage',$message);
            $template->set('result', $result);
            $template->set('total_pg', $pagi['total_pages']);
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function search_tenant() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('search_tenant');
            $limit = 0;
            $message=''; 
            $start_from = 0;
            $pagi['total_pages'] = 0;
            $result = array();
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $this->search = $_GET['search'];
                $search = $this->search;
                $limit = 0;
                $start_from = 0;
                $pagination = $model->search_tenant($search, $start_from, $limit);
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                };
                $limit = 2;
                $start_from = ($page - 1) * $limit;
                $result = $model->search_tenant($search, $start_from, $limit);
                if(!count($result)){
                $message="No Records Found!";
                }
                if (count($pagination) > 0) {
                    $pagi['total_pages'] = ceil(count($pagination) / $limit);
                }
            }
            $template->set('errormessage', $message);
            $template->set('result', $result);
            $template->set('total_pg', $pagi['total_pages']);
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function search_properties() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('search_properties');
            $result = array();
            $message='';
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $this->search = $_GET['search'];
                $search = $this->search;
                $limit = 0;
                $start_from = 0;
                $pagination = $model->search_property_info_reasult($search, $start_from, $limit);
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                };
                $limit = 10;
                $start_from = ($page - 1) * $limit;
                $result = $model->search_property_info_reasult($search, $start_from, $limit);
                 if(!count($result)){ 
                $message="No Records Found!";
                }
                if (count($pagination) > 0) {
                    $pagi['total_pages'] = ceil(count($pagination) / $limit);
                }
            }
             $template->set('errormessage', $message);
            $template->set('result', $result);
            $template->set('total_pg', $pagi['total_pages']);
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function delete_property($property_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $result = $model->delete_property_by_id($property_id);
            $this->redirect('admin_controller/search_properties');
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function edit_property($property_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $result = $model->edit_property_by_id($property_id);
            print_r($result);
            exit();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function find_a_property() {


        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('find_a_property');
            $result = array();
            $pagi['total_pages'] = 0;
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $this->search = $_GET['search'];
                $search = $this->search;
                $limit = 0;
                $start_from = 0;
                $pagination = $model->show_property_info($search, $start_from, $limit);

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                };
                $limit = 10;
                $start_from = ($page - 1) * $limit;
                //echo $start_from; die();

                $tablename = 'property';
                $pagi = array();

                $result = $model->show_property_info($search, $start_from, $limit);
                $pagi['total_records'] = count($pagination);
                $pagi['total_pages'] = ceil(count($pagination) / $limit);
            }
            $template->set('result', $result);
            $template->set('total_pg', $pagi['total_pages']);
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function property_pdf() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $this->address_line1 = $_POST['address_line1'];
            $this->address_line2 = $_POST['address_line2'];
            $this->address_line3 = $_POST['address_line3'];
            $this->town = $_POST['town'];
            $this->country = $_POST['country'];
            $this->postcode = $_POST['postcode'];
            $this->floor_area = $_POST['floor_area'];
            $this->use_class = $_POST['use_class'];


            $data = array(
                'address_line1' => $this->address_line1,
                'address_line2' => $this->address_line2,
                'address_line3' => $this->address_line3,
                'town' => $this->town,
                'country' => $this->country,
                'postcode' => $this->postcode,
                'floor_area' => $this->floor_area,
                'use_class' => $this->use_class,
                'image' => $this->image
            );


            $template = $this->loadView('property_pdf_page');
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function send_pdf_for_individual_property($property_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $property_result = $model->send_pdf_for_individual_property_info($property_id);
            $setpdf = '<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            .book{
                height:500px;
                background-color:white;
                padding:100px;
                margin:100px;
                box-shadow: 10px 10px 5px #888888;
            }
            .main{
                background-color:#E8E8E8;
                padding: 20px;
            }
            .logo{
              float:left;  
            }
            .information{
                float:left;
                color:#2D3E50;
                margin-left:150px;
            }
            .information ul li{
                list-style:none; 
            }
            img {
    height: 300px;
    margin-top:20px; 
              }
        </style>
    </head>
    <body class="main">
        <div class="book">  
            <h1  style="text-align:center; color:#2D3E50;">HEADING HERE</h1>
            
            <div class="information">
                <div >
                    <h1>Property</h1>
                    <ul>
                        <li>Address Line1:' . $property_result[0][1] . '</li>
                        <li>Address Line2:' . $property_result[0][2] . '</li>
                        <li>Address Line3:' . $property_result[0][3] . '</li>
                        <li>Town:' . $property_result[0][4] . '</li>
                        <li>Country:' . $property_result[0][5] . '</li>
                        <li>Postcode:' . $property_result[0][6] . '</li>
                        <li>Use Class:' . $property_result[0][7] . '</li>
                        
                    </ul>
                </div>

                
            </div>
        </div>
    </body>
</html>';






//$property_id=$property_result[0];
            // print_r($property_result);
            //  exit();
            /* $setpdf = "<table>";
              $setpdf .="<tr><td>Image</td> <td>" . $property_result[0][9] . "</td></tr>";
              $setpdf .="<tr><td>Town</td> <td>" . $property_result[0][4] . "</td></tr>";
              $setpdf .="<tr><td>Use Class</td> <td>" . $property_result[0][8] . "</td></tr>";
              $setpdf .="<tr><td>Floor Area</td> <td>" . $property_result[0][7] . "</td></tr>";


              $setpdf .="</table>";
             */
            try {
                //echo 'gvhgvhg';die();
                $html2pdf = new HTML2PDF('P', 'A4', 'en');
                // $html2pdf->pdf->SetDisplayMode('real');
                $html2pdf->writeHTML($setpdf);
                $outputfile = rand(1, 99999);
                $outputfilemain = '/home2/pge3fov/public_html/pip_application/pdf/' . $outputfile . '.pdf';
                //$outputfilemain = 'D:/xampp/htdocs/pip_application/pdf/' . $outputfile . '.pdf';
                $html2pdf->Output($outputfilemain, 'F');
            } catch (HTML2PDF_exception $e) {
                echo $e;
                exit;
            }


            $requirement_id = unserialize($_SESSION['requirement_id']);
            //   echo $_SESSION['requirement_id'];
            $emails = '';
            $requirement_info = array();
            foreach ($requirement_id as $k => $reqid) {
                $requirement = $model->getrequirements($reqid);
                $requirement_info[] = $requirement[0];
                if ($k == 0) {
                    $emails .=$requirement[0][7];
                } else {
                    $emails .=', ' . $requirement[0][7];
                }
            }
            $content = chunk_split(base64_encode(file_get_contents($outputfilemain)));
            $uid = md5(uniqid(time()));  //unique identifier
//declare multiple kinds of email (plain text + attch)
            $header .="Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
            $header .="This is a multi-part message in MIME format.\r\n";
            $file_name = $outputfile . '.pdf';
            //attch part
            $header .= "--" . $uid . "\r\n";
            $header .= "Content-Type: pdf; name=\"" . $file_name . "\"\r\n";
            $header .= "Content-Transfer-Encoding: base64\r\n";
            $header .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"\r\n\r\n";
            $header .= $content . "\r\n\r\n";  //chucked up 64 encoded attch

            $subject = "Pdf Sent to agent";
            $txt = '';
            mail($emails, $subject, $txt);
            if (mail($emails, $subject, "", $header)) {
                $this->redirect('admin_controller/property_sent_for_multiple/' . $property_id);
            } else {
                echo "fail";
            }
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function property_sent_for_multiple() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = explode("/", $url);

            $property_id = end($parts);


            $model = $this->loadModel('admin_model');
            $resultinfo = $model->select_multiple_property_by_property_id($property_id);
            $requirement_id = unserialize($_SESSION['requirement_id']);

            $requirement_info = array();
            $reids = '';
            foreach ($requirement_id as $k => $reqid) {
                if ($k == 0)
                    $reids = $reqid;
                else
                    $reids .=',' . $reqid;
            }


            $requirement_info = $model->getrequirements_multiple_sendpdf($property_id, $reids);
//
            //$requirement_info[] = $requirement[0];

            $template = $this->loadView('property_sent_for_multiple');
            $template->set('resultinfo', $resultinfo);
            $template->set('requirement_info', $requirement_info);
            $template->render();
        }
        else {
            $this->redirect('login_controller/');
        }
    }

    public function save_reminder_by_ajax() {

        $model = $this->loadModel('admin_model');
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode("/", $url);
        $properties = end($parts);
        $parts2 = explode("-", $properties);
        $propertyid = $parts2[1];
        $requirementid = $parts2[0];
        $data = array();
        $data['property_id'] = $propertyid;
        $data['requirement_id'] = $requirementid;
        $data['type'] = 'reminder';

        $result = $model->select_reminder_by_ajax_info($requirementid);
        if ($parts2[2] == 0) {
            //1 kore kombe
            $data['status'] = 0;
            $reminder = $result[0][9] - 1;
            $save = $model->save_reminder_by_ajax_info($requirementid, $reminder);
            $insert = $model->save_reminder_property($data);

            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $reminder = $result[0][9] + 1;
            $data['status'] = 1;
            $saveresult = $model->save_reminder_by_ajax_info($requirementid, $reminder);
            $insert = $model->save_reminder_property($data);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }
    }

    public function save_interested_by_ajax() {
        $model = $this->loadModel('admin_model');
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode("/", $url);
        $properties = end($parts);
        $parts2 = explode("-", $properties);
        $propertyid = $parts2[1];
        $requirementid = $parts2[0];
        $data = array();
        $data['property_id'] = $propertyid;
        $data['requirement_id'] = $requirementid;
        $data['type'] = 'interested';
        $result = $model->select_reminder_by_ajax_info($requirementid);
        $interested = $result[0][10];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            //1 kore kombe
            $data['status'] = 0;
            $interested = $result[0][10] - 1;
            $save = $model->save_interested_by_ajax_info($requirementid, $interested);
            $insert = $model->save_interested_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $interested = $result[0][10] + 1;
            $saveresult = $model->save_interested_by_ajax_info($requirementid, $interested);
            $insert = $model->save_interested_property($data);
            ;
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }
        die();
    }

    public function save_offered_received_by_ajax() {
        $model = $this->loadModel('admin_model');
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode("/", $url);
        $properties = end($parts);
        $parts2 = explode("-", $properties);
        $propertyid = $parts2[1];
        $requirementid = $parts2[0];
        $data = array();
        $data['property_id'] = $propertyid;
        $data['requirement_id'] = $requirementid;
        $data['type'] = 'offered_received';
        $result = $model->select_reminder_by_ajax_info($requirementid);
        $offered_received = $result[0][12];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            //1 kore kombe
            $data['status'] = 0;
            $offered_received = $result[0][12] - 1;
            $save = $model->save_offered_received_by_ajax_info($requirementid, $offered_received);
            $insert = $model->save_offered_received_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $offered_received = $result[0][12] + 1;
            $saveresult = $model->save_offered_received_by_ajax_info($requirementid, $offered_received);
            $insert = $model->save_offered_received_property($data);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }
    }

    public function save_rejected_by_ajax() {
        $model = $this->loadModel('admin_model');
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode("/", $url);
        $properties = end($parts);
        $parts2 = explode("-", $properties);
        $propertyid = $parts2[1];
        $requirementid = $parts2[0];
        $data = array();
        $data['property_id'] = $propertyid;
        $data['requirement_id'] = $requirementid;
        $data['type'] = 'rejected';
        $result = $model->select_reminder_by_ajax_info($requirementid);
        $rejected = $result[0][13];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            //1 kore kombe
            $data['status'] = 0;
            $rejected = $result[0][13] - 1;
            $save = $model->save_rejected_by_ajax_info($requirementid, $rejected);
            $insert = $model->save_rejected_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $rejected = $result[0][13] + 1;
            $saveresult = $model->save_rejected_by_ajax_info($requirementid, $rejected);
            $insert = $model->save_rejected_property($data);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }
    }

    public function save_comment_by_ajax() {
        $model = $this->loadModel('admin_model');
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode("/", $url);
        $properties = end($parts);
        $parts2 = explode("-", $properties);
        $propertyid = $parts2[1];
        $requirementid = $parts2[0];
        $data = array();
        $data['property_id'] = $propertyid;
        $data['requirement_id'] = $requirementid;
        $data['type'] = 'comment';
        $result = $model->select_reminder_by_ajax_info($requirementid);
        $comment = $result[0][14];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            //1 kore kombe
            $data['status'] = 0;
            $comment = $result[0][14] - 1;
            $save = $model->save_comment_by_ajax_info($requirementid, $comment);
            $insert = $model->save_comment_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $comment = $result[0][14] + 1;
            $saveresult = $model->save_comment_by_ajax_info($requirementid, $comment);
            $insert = $model->save_comment_property($data);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }
    }

    // --------------------------------------------------------------------------------------------------------
    // ---------------------------------------------***ADMIN PANEL***-----------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------
    public function admin_dashboard() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $template = $this->loadView('admin_dashboard_view');
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function main_page() {

        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {

            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_dashboard_view');
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function manage_requirements() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_manage_requirements');
            $result = $model->get_requir_info();
            $template->set('result', $result);
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function admin_delete_requirement($requirement_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $result = $model->delete_requirement_by_id($requirement_id);
            $this->redirect('admin_controller/manage_requirements');
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function admin_edit_requirement($requirement_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_edit_requirement');
            $result = $model->select_requirement_by_id($requirement_id);
            $template->set('result', $result);
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function update_admin_requirements() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_edit_requirement');
            $this->requirement_id = $_POST['requirement_id'];
            $this->tenant_name = $_POST['tenant_name'];
            $this->town = $_POST['town'];
            $this->floor_area_to = $_POST['floor_area_to'];
            $this->floor_area_from = $_POST['floor_area_from'];
            $this->use_class = $_POST['use_class'];
            $this->agent_name = $_POST['agent_name'];
            $this->agent_email = $_POST['agent_email'];
            $this->agent_phone_number = $_POST['agent_phone_number'];

            $data = array(
                'requirement_id' => $this->requirement_id,
                'tenant_name' => $this->tenant_name,
                'town' => $this->town,
                'floor_area_to' => $this->floor_area_to,
                'floor_area_from' => $this->floor_area_from,
                'use_class' => $this->use_class,
                'use_class' => $this->use_class,
                'agent_name' => $this->agent_name,
                'agent_email' => $this->agent_email,
                'agent_phone_number' => $this->agent_phone_number
            );
            $requirement_id = $this->requirement_id;
            $result = $model->update_requirements_by_id($requirement_id, $data);
            $template->set('result', $result);
            $this->redirect('admin_controller/manage_requirements/' . $requirement_id);
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

//    --------------------------------property------------------------------------

    public function manage_property() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_manage_property');
            $result = $model->get_property_info();
            $template->set('result', $result);
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function admin_delete_property($property_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $result = $model->delete_property_by_id($property_id);
            $this->redirect('admin_controller/manage_property');
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function admin_edit_property($property_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_edit_property');
            $result = $model->select_property_by_id($property_id);
            $template->set('result', $result);
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function update_admin_property() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_edit_property');
            $this->property_id = $_POST['property_id'];
            $this->address_line1 = $_POST['address_line1'];
            $this->address_line2 = $_POST['address_line2'];
            $this->address_line3 = $_POST['address_line3'];
            $this->town = $_POST['town'];
            $this->country = $_POST['country'];
            $this->postcode = $_POST['postcode'];
            $this->floor_area = $_POST['floor_area'];
            $this->use_class = $_POST['use_class'];

            $data = array(
                'address_line1' => $this->address_line1,
                'address_line2' => $this->address_line2,
                'address_line3' => $this->address_line3,
                'town' => $this->town,
                'country' => $this->country,
                'postcode' => $this->postcode,
                'floor_area' => $this->floor_area,
                'use_class' => $this->use_class,
            );
            $property_id = $this->property_id;
            $result = $model->update_property_by_id($property_id, $data);
            $template->set('result', $result);
            $this->redirect('admin_controller/manage_property/' . $property_id);
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

}
