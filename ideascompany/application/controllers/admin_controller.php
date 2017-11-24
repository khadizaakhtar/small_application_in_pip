<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once 'phpmailer/PHPMailerAutoload.php';

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
    

 public function requirements(){
      $model = $this->loadModel('admin_model');
      $result = $model->select_requirements_new_info();
      $template = $this->loadView('requirement_view');
      $template->set('result', $result);
      $template->render();  
  } 

 public function edit_new_requirement($requirement_id){
      $model = $this->loadModel('admin_model');
      $stafflist=$model->stafflist();           
      $result = $model->select_general_info_by_id($requirement_id); 
      $result2 = $model->select_general_info_by_id_for_requirement($requirement_id);
      $template = $this->loadView('edit_new_requirement');
      $template->set('stafflist', $stafflist);
      if(empty($result))
               {
              $msg='Sorry, there are no results.';
              $template = $this->loadView('nosearch_view');
              $template->set('msg',$msg);
              $template->render();
               } 
               else{
      $template->set('result2', $result2);
      $template->set('result', $result);
      $template->render();
               }
             }
public function update_new_requirement_info(){
      $model = $this->loadModel('admin_model'); 
      $this->tenant_name = $_POST['tenant_name'];
      $town = explode(",", $_POST['townvalue']);
      $town2=array_filter($town);
      $new_town = array();      
      foreach($town as $key=>$val){          
         if(strlen(trim($val))>1){
             $new_town[]=$val;
          }
      }
      $this->floor_area_from = $_POST['floor_area_from'];
      $this->floor_area_to = $_POST['floor_area_to'];
      $this->use_class = $_POST['use_class'];
      $this->resite = $_POST['resite'];
      $this->rccheck = $_POST['rccheck'];

      if(count($new_town)>0){
      $this->town = serialize($new_town);
      }
      else{
         $this->town=""; 
      }

      $this->staff_id = $_POST['staff_id'];
      $this->requirement_id = $_POST['requirement_id']; 
      $data = array(
                'tenant_name' =>  $this->tenant_name,
                'town' => $this->town,
                'floor_area_from' => $this->floor_area_from,
                'floor_area_to' => $this->floor_area_to,
                'use_class' => $this->use_class,
                'resite' => $this->resite,  
                'rccheck' => $this->rccheck,
                'staff_id' => $this->staff_id,    
            );
      $requirement_id = $this->requirement_id;
      $result = $model->update_general_info_by_id($requirement_id, $data);
      $this->redirect('admin_controller/requirements');
      
  }


 public function update_new_requirement_info_prv(){
      $model = $this->loadModel('admin_model'); 
      $this->tenant_name = $_POST['tenant_name'];
      $town = explode(",", $_POST['townvalue']);
      $town=array_filter($town);
      $this->floor_area_from = $_POST['floor_area_from'];
      $this->floor_area_to = $_POST['floor_area_to'];
      $this->use_class = $_POST['use_class'];
      $this->resite = $_POST['resite'];
      $this->rccheck = $_POST['rccheck'];
      if(count($town)>0){
      $this->town = serialize($town);
      }
      else{
         $this->town=""; 
      }

      $this->staff_id = $_POST['staff_id'];
      $this->requirement_id = $_POST['requirement_id']; 
      $data = array(
                'tenant_name' =>  $this->tenant_name,
                'town' => $this->town,
                //'town' =>$town,
                'floor_area_from' => $this->floor_area_from,
                'floor_area_to' => $this->floor_area_to,
                'use_class' => $this->use_class,
                'resite' => $this->resite,  
                'rccheck' => $this->rccheck,
                'staff_id' => $this->staff_id,    
            );
      $requirement_id = $this->requirement_id;
      $result = $model->update_general_info_by_id($requirement_id, $data);
      $this->redirect('admin_controller/requirements');
      
  }


 public function  save_accepted_by_ajax_new(){
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
        $data['type'] = 'accepted';
        $result = $model->select_reminder_by_ajax_info($requirementid);
        $accepted = $result[0]['accepted'];
        $requirementid = $parts2[0];

        if ($parts2[2] == 0) {
            $data['status'] = 0;
            $accepted = $result[0]['accepted'] - 1;
            $new_accepted="No";
            $save = $model->save_accepted_by_ajax_info($requirementid, $accepted);
            $insert = $model->save_accepted_property_new($data,$new_accepted);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $accepted = $result[0]['accepted'] + 1;
            $new_accepted="Yes";
            $saveresult = $model->save_accepted_by_ajax_info($requirementid, $accepted);
            $insert = $model->save_accepted_property_new($data,$new_accepted);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }   
       
   }


public function save_comment_new2(){
      $model = $this->loadModel('admin_model');
            $this->new_comment = $_POST['new_comment'];
            $this->requirement_id = $_POST['requirement_id'];
            $requirement_id = $this->requirement_id;
            $data = array(
                    'new_comment' => $this->new_comment,
                );
      $result = $model->update_comment_new2_info($data,$requirement_id);   
    }
public function save_comment_new3(){
      $model = $this->loadModel('admin_model');
            $this->new_comment = $_POST['new_comment'];
            $this->requirement_id = $_POST['requirement_id'];
            $requirement_id = $this->requirement_id;
            $data = array(
                    'new_comment' => $this->new_comment,
                );
      $result = $model->update_comment_new2_info($data,$requirement_id);   
    }


public function delete_new_requirement($requirement_id){
    $model = $this->loadModel('admin_model');
    $res = $model->delete_requirements_new_info_by_id($requirement_id); 
    $this->redirect('admin_controller/requirements');  
  }


 public function save_rejected_by_ajax_new(){   
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
        $rejected = $result[0]['rejected'];
        if ($parts2[2] == 0) {
            $data['status'] = 0;
            $rejected = $result[0]['rejected'] - 1;
            $new_rejected="No";
            $save = $model->save_rejected_by_ajax_info($requirementid, $rejected);           
            $insert = $model->save_rejected_property_new($data,$new_rejected);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
         
            $data['status'] = 1;
            $rejected = $result[0]['rejected'] + 1;
           
            $new_rejected="Yes";
            $saveresult = $model->save_rejected_by_ajax_info($requirementid, $rejected);
            $insert = $model->save_rejected_property_new($data,$new_rejected);            
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }
        
    }



public function save_offered_received_by_ajax_new(){
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
        $offered_received = $result[0]['offered_received'];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            $data['status'] = 0;
            $offered_received = $result[0]['offered_received'] - 1;
            $new_offered_received=date("d/m/Y");
            $save = $model->save_offered_received_by_ajax_info($requirementid, $offered_received);
            $insert = $model->save_offered_received_property_new($data,$new_offered_received);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $offered_received = $result[0]['offered_received'] + 1;
            $new_offered_received=date("Y/m/d");
            $saveresult = $model->save_offered_received_by_ajax_info($requirementid, $offered_received);
            $insert = $model->save_offered_received_property_new($data,$new_offered_received);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }
        
    }

public function history_info_for_requirement($requirement_id){
        $model = $this->loadModel('admin_model');
        $result=$model->select_pdf_history_for_requirement($requirement_id); 
        $result2=$model->select_pdf_history_for_requirement_id($requirement_id);
         if(empty($result))
               {
              $msg='Sorry, there is no pdf history.';
              $template = $this->loadView('nosearch_view');
              $template->set('msg',$msg);
              $template->render();
               } 
               else{
       $template = $this->loadView('history_view_for_requirement');
       $template->set('result',$result);
        $template->set('requirement',$result2);
       $template->render();
               }
   }


public function properties(){
 if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
      $model = $this->loadModel('admin_model');
      $result = $model->select_properties_new_info();
      $template = $this->loadView('property_view');
      $template->set('result', $result);
      $template->render();  
}else{
 $this->redirect('login_controller/');
}    
  }


 public function edit_new_property($property_id){
     $model = $this->loadModel('admin_model');
     $template = $this->loadView('edit_property_new');
     $result = $model->select_new_property_by_id($property_id); 
     if(empty($result))
               {
              $msg='Sorry, there is no result.';
              $template = $this->loadView('nosearch_view');
              $template->set('msg',$msg);
              $template->render();
               } 
               else{
     $template->set('result', $result);
     $template->render(); 
           }   
  }


  public function update_property_new(){
            $model = $this->loadModel('admin_model');
            $this->property_id = $_POST['property_id'];
            $this->address_line1 = $_POST['address_line1'];
            $this->address_line2 = $_POST['address_line2'];
            $this->address_line3 = $_POST['address_line3'];
            $this->town = $_POST['town'];
            $this->country = $_POST['country'];
            $this->postcode = $_POST['postcode'];
            $this->floor_area = $_POST['floor_area'];
            $this->ancillary_area = $_POST['ancillary_area'];
            $this->site_area = $_POST['site_area'];
            $this->use_class = $_POST['use_class'];
            $property_id = $this->property_id;
            
              if ($_FILES){
                if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                     $image = $_FILES['image'];
                     $imgupload = $model->upload_update($image);
                     if ($imgupload['msg'] == 'Success') {
                        $this->image = $imgupload['imagename'];
                        $image= $this->image;
                        $result2=$model->update_property_image_by_id($property_id,$image);
                     } else {
                        $error['image'] = $imgupload['msg'];
                    }
               }
            }

            $data = array(
                'address_line1' => $this->address_line1,
                'address_line2' => $this->address_line2,
                'address_line3' => $this->address_line3,
                'town' => $this->town,
                'country' => $this->country,
                'postcode' => $this->postcode,
                'floor_area' => $this->floor_area,
                'ancillary_area' => $this->ancillary_area,
                'site_area' => $this->site_area,
                'use_class' => $this->use_class,
                //'image' =>$this->image,
            );
            $result = $model->update_property_new_by_id($property_id, $data);
            $this->redirect('admin_controller/properties');
  }


 public function delete_new_property($property_id){
     $model = $this->loadModel('admin_model');
     $res = $model->delete_properties_new_info_by_id($property_id); 
     $this->redirect('admin_controller/properties');
  }






    public function add_requirement() {
           $template = $this->loadView('add_requirement');
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $stafflist=$model->stafflist();//
             $template->set('stafflist', $stafflist);
            if (isset($_POST) && !empty($_POST)) {             
	        $pieces = explode(",", $_POST['townvalue']);
                $new_town = array();      
                 foreach($pieces as $key=>$val){          
                       if(strlen(trim($val))>1){
                         $new_town[]=$val;
                        }
                     }
                //$pieces=array_filter($pieces);   
                $this->tenant_name = $_POST['tenant_name'];
                $this->resite = $_POST['resite'];
                $this->rccheck = $_POST['rccheck'];
                $this->floor_area_to = $_POST['floor_area_to'];
                $this->floor_area_from = $_POST['floor_area_from'];
                $this->use_class = $_POST['use_class'];
                $this->staff_id = $_POST['staff_id'];
                //$this->town = serialize($pieces);
                 if(count($new_town)>0){
                   $this->town = serialize($new_town);
                   }
               else{
                   $this->town=""; 
                    }
             
                $tanent_name = $this->tenant_name;
                $resite= $this->resite ;
                $town = $this->town;
                $error = array();
                if (empty($tanent_name)) {
                    $error['tanent_name'] = 'Tenant Field Can not Be Empty';
                }
                if (empty($town)) {
                    $error['town'] = 'Town Field Can not Be Empty';
                }
                
                if (!preg_match("/^[a-zA-Z ]*$/", $tanent_name)) {
                    $error['tanent_name_error'] = "Invalid Tanent Name!";
                }
                if(!isset($_POST['data']['agent_id']) || empty($_POST['data']['agent_id'])){
				$error['agent_error'] = "Please Add an Agent!";
				}
              
                if (empty($error)) {
                    $agents=array();
                    $agents=$_POST['data']['agent_id'];
                    $data = array(
                        'tenant_name' => $this->tenant_name,
                        'town' => $this->town,
                        'floor_area_to' => $this->floor_area_to,
                        'floor_area_from' => $this->floor_area_from,
                        'use_class' => $this->use_class,
                        'rccheck' => $this->rccheck,
                        'use_class' => $this->use_class,
                       'staff_id' => $this->staff_id,
                      'resite' => $this->resite,
                    );
					
                    $result = $model->add_requirement_data($data);
                    if ($result >0) { 
                        foreach($agents as $k=>$v){
                            $data_2=array(
                            'requirement_id' =>$result,
                            'agent_id' => $v,
                        );
                            $result2 = $model->add_requirement_agent_data($data_2);
                        }
                        
                         $_POST = array();
                         $message="Successfully Saved!";
                         $template = $this->loadView('add_requirement');
                         $template->set('resmsg',$message); 
                         $template->render();
                         die();
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



public function staff_view(){
       if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('staff_view');
            $result = $model->get_staff_info();
            $template->set('result', $result);
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }  
        
    }


public function edit_staff_font($user_id){
      if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('edit_staff_font_view');
            $result = $model->select_staff_by_id($user_id);
            $template->set('result', $result);
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }    
    }




public function update_font_staff(){
      if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
           // $template = $this->loadView('admin_edit_staff_view');
            $this->user_id = $_POST['user_id'];
            $this->user_name = $_POST['user_name'];
            $this->user_email_address = $_POST['user_email_address'];
            $this->user_password = $_POST['user_password'];
            $this->access_label = $_POST['access_label'];
            $data = array(
                'user_name' => $this->user_name,
                'user_email_address' => $this->user_email_address,
                'user_password' => $this->user_password,
                'access_label' => $this->access_label,
            );
            $user_id = $this->user_id;
            $result = $model->update_staff_by_id($user_id, $data);
           // $template->set('result', $result);
            $this->redirect('admin_controller/staff_view/');
        } else {
            $this->redirect('login_controller/admin_login');
        }   
    }


 public function delete_staff_font($user_id){
      if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $result = $model->delete_staff_by_id($user_id);
            $this->redirect('admin_controller/staff_view');
        } else {
            $this->redirect('login_controller/admin_login');
        }   
    }


    public function show_requirements() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('show_req');
            $val = serialize($_POST['data']['requirement_id']);
            $val2 = serialize($_POST['data']['agent_id']);
            $val3=  serialize($_POST['data']['staff_id']); 
            $_SESSION['staff_id'] = $val3;  
            $_SESSION['requirement_id'] = $val;
            $_SESSION['agent_id'] = $val2; 
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
            $template = $this->loadView('add_property');
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function add_property() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {

            $model = $this->loadModel('admin_model');
            $template = $this->loadView('add_property');

            if (isset($_POST) && !empty($_POST)) {
                $this->address_line1 = $_POST['address_line1'];
                $this->address_line2 = $_POST['address_line2'];
                $this->address_line3 = $_POST['address_line3'];
                $this->town = $_POST['town'];
                $this->country = $_POST['county'];
                $this->postcode = $_POST['postcode'];
                $this->floor_area = $_POST['floor_area'];
                $this->ancillary_area = $_POST['ancillary_area'];
                $this->site_area = $_POST['site_area'];
                $this->use_class = $_POST['use_class'];

                $address_line1 = $this->address_line1;
                $town = $this->town;
                $floor_area = $this->floor_area;

                if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                    $image = $_FILES['image'];
                    $imgupload = $model->upload($image);
                    if ($imgupload['msg'] == 'Success') {
                        $this->image = $imgupload['imagename'];
                    } else {
                        $error['image'] = $imgupload['msg'];
                    }
                }
                if (empty($address_line1)) {
                    $error['address_line1'] = 'Address Line1 can not Be Empty';
                } 
                if (empty($town)) {
                    $error['town'] = 'Town can not Be Empty';
                } 
                if (empty($floor_area)) {
                    $error['floor_area'] = 'Floor Area can not Be Empty';
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
                        'ancillary_area' => $this->ancillary_area,
                        'site_area' => $this->site_area,
                        'use_class' => $this->use_class,
                        'image' => $this->image
                    );

                    $result = $model->add_property_info($data);
                    if ($result == true) {
                         $_POST = array();
                        $message="Successfully Saved!";
                        
                        $template->set('resmsg',$message);
                      } else {
                        echo 'error';
                    }
                } else {
                    
                    $template->set('result', $error);
                    
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
                $this->country = $_POST['county'];
                $this->postcode = $_POST['postcode'];
                $this->floor_area = $_POST['floor_area'];
                $this->ancillary_area = $_POST['ancillary_area'];
                $this->site_area = $_POST['site_area'];
                $this->use_class = $_POST['use_class'];
                $this->image = '';
               
                $address_line1 = $this->address_line1;
                $town = $this->town;
                $floor_area = $this->floor_area;

                if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                    
                    $image = $_FILES['image'];
                    $imgupload = $model->upload($image);

                    if ($imgupload['msg'] == 'Success') {
                        $this->image = $imgupload['imagename'];
                    } else {
                        $error['image'] = $imgupload['msg'];
                    }
                }
                
                if (empty($address_line1)) {
                    $error['address_line1'] = 'Address Line1 can not Be Empty';     
                } 
                if(empty($town)){
                     $error['town'] = 'Town can not Be Empty'; 
                }
                 if(empty($floor_area)){
                     $error['floor'] = 'Floor Area can not Be Empty';
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
                        'ancillary_area' => $this->ancillary_area,
                        'site_area' => $this->site_area,
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
               
                background-color:white;
                
                margin:50px;
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
               
            }
            .information ul li{
                list-style:none; 
            }
            img {
    height: 300px;
    margin-top:20px; 
              }
              .nrspan{font-size:20px !important; font-weight:bold !important;}
        </style>
    </head>
    <body class="main">
        <div class="book">  
            <h1  style=" color:#2D3E50;">Property PDF</h1>
            
            <div class="information">
                <div class="container">
                    <h1>Property</h1>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Address Line1:</span><span class="nrspan">' . $data['address_line1'] . '</span></div>
					</div>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Address Line2:</span><span class="nrspan">' . $data['address_line2'] . '</span></div>
					</div>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Address Line3:</span><span class="nrspan">' . $data['address_line3'] . '</span></div>
					</div>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Town:</span><span class="nrspan">' . $data['town'] . '</span></div>
					</div>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Country:</span><span class="nrspan">' . $data['country'] . '</span></div>
					</div>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Postcode:</span><span class="nrspan">' . $data['postcode'] . '</span></div>
					</div>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Use Class:</span><span class="nrspan">' . $data['use_class'] . '</span></div>
					</div>                   
                </div>                
            </div>
        </div>
    </body>
</html>';                    
                    try {
                        $html2pdf = new HTML2PDF('P', 'A4', 'en');
                        $html2pdf->writeHTML($setpdf);
                        $outputfile = rand(1, 99999);

                $path=str_replace('application/controllers/admin_controller.php','',__FILE__).'pdf/';

                        $outputfilemain = $path . $outputfile . '.pdf';

                        $html2pdf->Output($outputfilemain, 'F');
                    } catch (HTML2PDF_exception $e) {
                        echo $e;
                        exit;
                    }
                    $result = $model->add_property_info($data);
                    $requirement_id = unserialize($_SESSION['requirement_id']);
            $emails = array();
            $requirement_info = array();
            foreach ($requirement_id as $k => $reqid) {
                $requirement = $model->getrequirements($reqid);
                $requirement_info[] = $requirement[0];
                    $emails[]=$requirement[0]['agent_email'];
            }
            
$mail = new PHPMailer;
$mail->addAddress('admin@harkalm.ideascompany.co.uk', 'Harkalm Investments');           
foreach($emails as $v_email){
 $mail->addCC($v_email);     
}   

$mail->setFrom('admin@pge3.f-overseas.com', 'Harkalm Investments');
$mail->addReplyTo('admin@pge3.f-overseas.com', 'Harkalm Investments');
$mail->addAttachment($outputfilemain);
$mail->isHTML(true); 
$mail->Subject = "Harkalm Property Alert";

//$mail->Body    = $_POST['data']['emailbody'];
//$mail->AltBody = $_POST['data']['emailbody'];

$mail->Body    = "Property Details Attached";
$mail->AltBody = "Property Details Attached";

if(!$mail->send()) {
    echo 'fail';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
     $result3=$model->save_requirement_property($result,$reqid); 
   $result2 = $model->save_requirement_send_date($reqid,$result);
    $this->redirect('admin_controller/property_sent_for_multiple/' . $result);
}




                  /*  $content = chunk_split(base64_encode(file_get_contents($outputfilemain)));
                    $uid = md5(uniqid(time()));  //unique identifier
//declare multiple kinds of email (plain text + attch)
                    $header .="Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n";
                    $header .="This is a multi-part message in MIME format.\r\n";
                    $file_name = $outputfile . '.pdf';
                    //attch part
                    $header .= "--" . $uid . "\r\n";
                    $header .= "Content-Type: pdf; name=\"" . $file_name . "\"\r\n";
                    $header .= "Content-Transfer-Encoding: base64\r\n";
                    $header .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"\r\n";
                    $header .= $content . "\r\n";  //chucked up 64 encoded attch

                    $subject = "New Properties Alert - Harkalm";
                    //mail($emails, $subject, $txt);


                    if (mail($emails, $subject, "", $header)) {
                        $this->redirect('admin_controller/property_sent_for_multiple/' . $result);
                    } else {
                        echo "fail";
                    }*/
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
            if (empty($user_name)) {
                $error['user_name'] = 'User Name can not Be Empty';
            } 
            if (empty($user_password)) {
                $error['user_password'] = 'Password can not Be Empty';
            }
            if (empty($user_email_address)) {
                $error['user_email_address'] = 'Email can not Be Empty';
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
                    $message="Successfully Saved!";
                    $template = $this->loadView('staff');
                    $template->set('resmsg',$message);
                    $template->render();                   
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
              $pagination = $model->search_requirement_pag_info($search,$start_from, $limit);
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                };
                $limit =5;
                $start_from = ($page - 1) * $limit;
                $result = $model->search_requirements_info_reasult($search, $start_from, $limit);       
                $new=array();
                foreach($result as $key=>$val){
                    $new[$val['requirement_id']][] = $val;
                }               
                if(!count($result)){
                $message="No Records Found!";
                }
                if (count($pagination) > 0) {
                    $pagi['total_pages'] = ceil(count($pagination) / $limit);
                }
            }
            $template->set('errormessage',$message);
             $template->set('result', $new);
            $template->set('total_pg', $pagi['total_pages']);
            $template->render();
        } else {
            $this->redirect('login_controller/');
        }
    }
    
    public function general_search(){
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('general_requirements');
            $message=''; 
            $limit = 0;
            $start_from = 0;
            $pagi['total_pages'] = 0;
            $result = array();                
         if ((isset($_GET['search']) && isset($_GET['order'])) && ((!empty ($_GET['search'])) && (!empty($_GET['order'])))) {
              $this->search = $_GET['search'];
              $this->order = $_GET['order']; 
              $search = $this->search;          
              $order=$this->order;
              $limit = 0;
              $start_from = 0;
              $pagination = $model->show_property_info_for_general($search,$order,$start_from, $limit);
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                };
                $limit = 2;
                $start_from = ($page - 1) * $limit;
                $result = $model->search_requirements_info_reasult_for_general($search,$order, $start_from, $limit);   
                if(!count($result)){
                $message="No Records Found!";
                }
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
            $template = $this->loadView('edit_property');

            if(isset($_POST) && !empty($_POST)){
            $this->property_id = $_POST['property_id'];
            $this->address_line1 = $_POST['address_line1'];
            $this->address_line2 = $_POST['address_line2'];
            $this->address_line3 = $_POST['address_line3'];
            $this->town = $_POST['town'];
            $this->country = $_POST['country'];
            $this->postcode = $_POST['postcode'];
            $this->floor_area = $_POST['floor_area'];
            $this->ancillary_area = $_POST['ancillary_area'];
            $this->site_area = $_POST['site_area'];
            $this->use_class = $_POST['use_class'];
            
            
            if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                    $image = $_FILES['image'];
                    $imgupload = $model->upload($image);
                    if ($imgupload['msg'] == 'Success') {
                        $this->image = $imgupload['imagename'];
                    } else {
                        $error['image'] = $imgupload['msg'];
                    }
                }
            $data = array(
                'address_line1' => $this->address_line1,
                'address_line2' => $this->address_line2,
                'address_line3' => $this->address_line3,
                'town' => $this->town,
                'country' => $this->country,
                'postcode' => $this->postcode,
                'floor_area' => $this->floor_area,
                'ancillary_area' => $this->ancillary_area,
                'site_area' => $this->site_area,
                'use_class' => $this->use_class,
            );
            $property_id = $this->property_id;
            $result = $model->update_property_by_id($property_id, $data);
            $this->redirect('admin_controller/edit_property/'.$property_id);
            }            
            $template->set('result', $result);            
            $template->render();           
        } else {
            $this->redirect('login_controller/');
        }
    }

    public function find_a_property() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('find_a_property');
            $agent_id = unserialize($_SESSION['agent_id']);                  
            $agentid =call_user_func_array('array_merge', $agent_id);
            $agent_info=$model->select_agent_info_by_id($agentid);
            $staff_id=unserialize($_SESSION['staff_id']);
            $staffid=$model->select_staff_info_by_id($staff_id);
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
                $limit = 1;
                $start_from = ($page - 1) * $limit;              
                $tablename = 'property';
                $pagi = array();
                $result = $model->show_property_info($search, $start_from, $limit);
                $pagi['total_records'] = count($pagination);
                $pagi['total_pages'] = ceil(count($pagination) / $limit);
            }
            $template->set('result', $result);
            $template->set('agent_info', $agent_info);
            $template->set('staffid', $staffid);
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
            if(isset($_POST) && !empty($_POST)){
           $model = $this->loadModel('admin_model');
            $property_result = $model->send_pdf_for_individual_property_info($property_id);
            $address=$property_result[0]['address_line1'];
            $town=$property_result[0]['town'];
            $postcode=$property_result[0]['postcode'];
            $image='<img width="80px;" height="80px" src='.BASE_URL.'uploads/'.$property_result[0]['image'].'>';

         $setpdf = '<html>
        <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            .book{                
                background-color:white;               
                margin:50px;
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
               
            }
            .information ul li{
                list-style:none; 
            }
            .nrspan{font-size:20px !important; font-weight:bold !important;}
        </style>
    </head>
    <body class="main">
        <div class="book">  
            <h1  style="text-align:center; color:#2D3E50;">Property PDF</h1>
            
            <div class="information">
                <div class="container">
                    <h1>Property</h1>
                                         <div class="row">
						<div class="col-md-6"><span class="nrspan">Photo:</span><span class="nrspan">'.$image . '</span></div>
  					</div>
					<div class="row">
						 <div class="col-md-6"><span class="nrspan">Address Line1:</span><span class="nrspan">' . $property_result[0][1] . '</span></div>
					</div>
					<div class="row">
						<div class="col-md-6"><span class="nrspan">Address Line2:</span><span class="nrspan">' . $property_result[0][2] . '</span></div>
 					</div>
					  <div class="row">
						<div class="col-md-6"><span class="nrspan">Address Line3:</span><span class="nrspan">' . $property_result[0][3] . '</span></div>
					 </div>
					 <div class="row">
						 <div class="col-md-6"><span class="nrspan">Town:</span><span class="nrspan">' . $property_result[0][4] . '</span></div>
 					</div>
					 <div class="row">
						 <div class="col-md-6"><span class="nrspan">Country:</span><span class="nrspan">' . $property_result[0][5] . '</span></div>
					 </div>
					 <div class="row">
						 <div class="col-md-6"><span class="nrspan">Postcode:</span><span class="nrspan">' . $property_result[0][6] . '</span></div>
					 </div>
					 <div class="row">
						 <div class="col-md-6"><span class="nrspan">Use Class:</span><span class="nrspan">' . $property_result[0][7] . '</span></div>
					  </div>                   
                                     </div>                
                               </div>
                          </div>
              </body>
</html>';
            
            try {                
                $html2pdf = new HTML2PDF('P', 'A4', 'en');
                // $html2pdf->pdf->SetDisplayMode('real');
                $html2pdf->writeHTML($setpdf);
                $outputfile = rand(1, 99999999);
                 $path=str_replace('application/controllers/admin_controller.php','',__FILE__).'pdf/';
                $outputfilemain =$path . $outputfile . '.pdf';
                $html2pdf->Output($outputfilemain, 'F');
            } catch (HTML2PDF_exception $e) {
                echo $e;
                exit;
            }


            $requirement_id = unserialize($_SESSION['requirement_id']);                  
            $emails = array();
            $requirement_info = array();
             $agent=array();
             
            foreach ($requirement_id as $k => $reqid) {
                $requirement = $model->getrequirements($reqid);
                 if(count($requirement)>0){
                $requirement_info[] = $requirement[0];
                $emails[]=$requirement[0]['agent_email'];
                $agent[]=$requirement[0]['agent_name'];
                $tenant[]=$requirement[0]['tenant_name'];
                }
               } 


         
         
         foreach($emails as $k=>$v_email){      
            $mail = new PHPMailer;
            $mail->setFrom('admin@pg8.f-overseas.com', 'Harkalm Investments');
            $mail->addReplyTo('admin@pg8.f-overseas.com', 'Harkalm Investments');
            $mail->addAttachment($outputfilemain);
            $mail->isHTML(true); 
            $mail->addAddress($v_email, $agent[$k]); 
            $mail->Subject =$address.","." ". $town.","." ". $postcode ." ". "-FAO ".$tenant[$k];
            $body=$_POST['data']['emailbody']; 
            $email_body=str_replace('Agent Name', $agent[$k],$body);  
            $mail->Body    =  $email_body;   
            $mail->AltBody =  $email_body;
            $mail->send();
            $mail=null;
        }  
          

    $result=$model->save_requirement_property($property_id,$reqid); 
    $result2 = $model->save_requirement_send_date($reqid,$property_id);
    $this->redirect('admin_controller/property_sent_for_multiple/' . $property_id);

}
        } else {
            $this->redirect('login_controller/');
        }
    }


    
    public function pdf_preview($property_id){
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
              .nrspan{font-size:20px; font-weight:bold;}
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
echo $setpdf;
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
            $result=$model->save_requirement_property($property_id,$reids);  
            $requirement_info = $model->getrequirements_multiple_sendpdf($property_id, $reids);
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
            $data['status'] = 0;
            $reminder = $result[0]['reminder'] - 1;
            $save = $model->save_reminder_by_ajax_info($requirementid, $reminder);
            $insert = $model->save_reminder_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $reminder = $result[0]['reminder'] + 1;
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
        $interested = $result[0]['interested'];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            $data['status'] = 0;
            $interested = $result[0]['interested'] - 1;
            $save = $model->save_interested_by_ajax_info($requirementid, $interested);
            $insert = $model->save_interested_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $interested = $result[0]['interested'] + 1;
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
        $offered_received = $result[0]['offered_received'];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            $data['status'] = 0;
            $offered_received = $result[0]['offered_received'] - 1;
            $save = $model->save_offered_received_by_ajax_info($requirementid, $offered_received);
            $insert = $model->save_offered_received_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $offered_received = $result[0]['offered_received'] + 1;
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
        $rejected = $result[0]['rejected'];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            $data['status'] = 0;
            $rejected = $result[0]['rejected'] - 1;
            $save = $model->save_rejected_by_ajax_info($requirementid, $rejected);
            $insert = $model->save_rejected_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $rejected = $result[0]['rejected'] + 1;
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
        $comment = $result[0]['comment'];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            $data['status'] = 0;
            $comment = $result[0]['comment'] - 1;
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
            if(empty($result))
               {
              echo 'Sorry, there are no results.';
               } else{
            $template->set('result', $result);
            $template->render();
            }
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }
    public function edit_requirement($requirement_id) {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('edit_requirement');
            $result = $model->select_requirement_by_id($requirement_id);
            if(empty($result))
               {
              echo 'Sorry, there are no results.';
               }
             else{
            $template->set('result', $result);
            $template->render();
              }
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }

    public function update_admin_requirements() {
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_edit_requirement');
            $town = explode(",", $_POST['townvalue']);
            $this->requirement_id = $_POST['requirement_id'];
            $this->tenant_name = $_POST['tenant_name'];
            //$this->town = $_POST['town'];
            $this->floor_area_to = $_POST['floor_area_to'];
            $this->floor_area_from = $_POST['floor_area_from'];
            $this->use_class = $_POST['use_class'];
            $this->rccheck = $_POST['rccheck'];
            $this->resite = $_POST['resite'];
            $this->town = serialize($town);
//            print_r( $this->town);
//            exit;

            $data = array(
                'requirement_id' => $this->requirement_id,
                'tenant_name' => $this->tenant_name,
                 'town' => $this->town,
                'floor_area_to' => $this->floor_area_to,
                'floor_area_from' => $this->floor_area_from,
                'use_class' => $this->use_class,
                'rccheck' => $this->rccheck,
                'resite' => $this->resite
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
    
    
    public function manage_staff(){
          if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_manage_staff');
            $result = $model->get_staff_info();
            $template->set('result', $result);
            $template->render();
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }
    
    public function admin_edit_staff($user_id){
       if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $template = $this->loadView('admin_edit_staff_view');
            $result = $model->select_staff_by_id($user_id);
               if(empty($result))
               {
              echo 'Sorry, there are no results.';
               }
             else{
            $template->set('result', $result);
            $template->render();
               }
        } else {
            $this->redirect('login_controller/admin_login');
        }  
    }
    
    
    public function admin_delete_staff($user_id){
         if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
            $result = $model->delete_staff_by_id($user_id);
            $this->redirect('admin_controller/manage_staff');
        } else {
            $this->redirect('login_controller/admin_login');
        }
    }
    
    
    
    public function update_admin_staff(){
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $model = $this->loadModel('admin_model');
           // $template = $this->loadView('admin_edit_staff_view');
            $this->user_id = $_POST['user_id'];
            $this->user_name = $_POST['user_name'];
            $this->user_email_address = $_POST['user_email_address'];
            $this->user_password = $_POST['user_password'];
            $this->access_label = $_POST['access_label'];
            $data = array(
                'user_name' => $this->user_name,
                'user_email_address' => $this->user_email_address,
                'user_password' => $this->user_password,
                'access_label' => $this->access_label,
            );
            $user_id = $this->user_id;
            $result = $model->update_staff_by_id($user_id, $data);
           // $template->set('result', $result);
            $this->redirect('admin_controller/manage_staff/');
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
            if(empty($result))
               {
              echo 'Sorry, there are no results.';
               }
             else{
            $template->set('result', $result);
            $template->render();
               }
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
            $this->ancillary_area = $_POST['ancillary_area'];
            $this->site_area = $_POST['site_area'];
            $this->use_class = $_POST['use_class'];

            $data = array(
                'address_line1' => $this->address_line1,
                'address_line2' => $this->address_line2,
                'address_line3' => $this->address_line3,
                'town' => $this->town,
                'country' => $this->country,
                'postcode' => $this->postcode,
                'floor_area' => $this->floor_area,
                'ancillary_area' => $this->ancillary_area,
                'site_area' => $this->site_area,
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
    
    public function save_agent_info(){
        
         $model = $this->loadModel('admin_model');
		
		 $text='';
		 $dtagent=array();
		 foreach($_POST['agent_name'] as $k=>$v){
		 $dtagent['agent_name']=$v;
		 $dtagent['agent_email']=$_POST['agent_email'][$k];
		 $dtagent['agent_phone_number']=$_POST['agent_tel'][$k];
		 if($k==0)		 $dtagent['is_primary']=1;
		 else $dtagent['is_primary']=0;
		 $result = $model->save_agent_info_by_ajax($dtagent);
		  if($result>0){
             
            
            $text .='<tr><td>'.$dtagent['agent_name'].'</td>';
            $text .='<td>'.$dtagent['agent_email'].'</td>';
            $text .='<td>'.$dtagent['agent_phone_number'].'</td>';
			 if($k==0)	{
            $text .='<td><input checked="checked"  data-agentid='.$result.' type="checkbox" name="data[is_primary]" class="isprimary">'
                    . '<input value='.$result.' type="hidden" name="data[agent_id][]"></td>';
					}else{
	   $text .='<td><input data-agentid='.$result.' type="checkbox" name="data[is_primary]" class="isprimary">'
                    . '<input value='.$result.' type="hidden" name="data[agent_id][]"></td>';
					
					}
            $text .='</tr>';
            
         }
		 }
         echo $text;
        
        exit;
    }

   public function edit_info($requirement_id){
      $model = $this->loadModel('admin_model');
	  $stafflist=$model->stafflist();//
           
      $result = $model->select_general_info_by_id($requirement_id); //agent data 
      $result2 = $model->select_general_info_by_id_for_requirement($requirement_id);
	
      $template = $this->loadView('general_edit_info');
        $template->set('stafflist', $stafflist);
      if(empty($result))
               {
              echo 'Sorry, there are no results.';
               } 
               else{
      $template->set('result2', $result2);
      $template->set('result', $result);
      $template->render();
               }
    }

    
    public function delete_info($requirement_id){
      $model = $this->loadModel('admin_model');
      $result = $model->delete_general_info_by_id($requirement_id);
      $template = $this->loadView('general_requirements');
      $template->render();
    }
    public function save_agentisprimary(){
      
        $model = $this->loadModel('admin_model');
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode("/", $url);
        $properties = end($parts);
        $parts2 = explode("-", $properties);
        $agentid = $parts2[0];
        
        $data = array();
        $data['agent_id'] = $agentid;
        
        if ($parts2[1] == 0) {
            //1 kore kombe
            $data['is_primary'] = 0;
$saveresult = $model->save_agentisprimary($data);
            if ($saveresult ) {
                echo 'Unset';
            } else {
                echo 'error';
            }
        } else {
           $data['is_primary'] = 1;
$saveresult = $model->save_agentisprimary($data);
            if ($saveresult ) {
                echo 'Set';
            } else {
                echo 'error';
            }
            
        }
        
    
    }
     public function deals(){
      $model = $this->loadModel('admin_model');
      $result = $model->select_deals_info();
//      print_r($result);
//      exit;
      $template = $this->loadView('deals_view');
      $template->set('result', $result);
      $template->render(); 
    }
    
    public function deals_view_for_single($deals_id){
       
     $model = $this->loadModel('admin_model');
     $template = $this->loadView('deals_view_for_single');
     $result = $model->select_deals_by_id($deals_id); 
     //print_r($result);
    //exit;
     $template->set('result', $result);
     $template->render();   
      
    }


public function update_general_info(){
      $model = $this->loadModel('admin_model'); 
      $this->tenant_name = $_POST['tenant_name'];
      $town = explode(",", $_POST['townvalue']);

      $town=array_filter($town);

      $this->floor_area_from = $_POST['floor_area_from'];
      $this->floor_area_to = $_POST['floor_area_to'];
      $this->use_class = $_POST['use_class'];
      $this->resite = $_POST['resite'];
      $this->rccheck = $_POST['rccheck'];

      if(count($town)>0){
        $this->town = serialize($town);
      }
      else{
         $this->town=""; 
      }


      $this->staff_id = $_POST['staff_id'];
      $this->requirement_id = $_POST['requirement_id'];
      $data = array(
                'tenant_name' =>  $this->tenant_name,
                'town' => $this->town,
                'floor_area_from' => $this->floor_area_from,
                'floor_area_to' => $this->floor_area_to,
                'use_class' => $this->use_class,
                'resite' => $this->resite,  
                'rccheck' => $this->rccheck,
                'staff_id' => $this->staff_id,    
            );
      $requirement_id = $this->requirement_id;
      $result = $model->update_general_info_by_id($requirement_id, $data);
      $template = $this->loadView('general_requirements');
      $template->render();
    }
    
    public function save_comment_new(){
         $model = $this->loadModel('admin_model');
            $this->new_comment = $_POST['new_comment'];
            $this->requirement_id = $_POST['requirement_id'];
            $requirement_id = $this->requirement_id;
            $data = array(
                    'new_comment' => $this->new_comment,
                );
           $result = $model->update_comment_new_info($data,$requirement_id); 
    }
    public function save_accepted_by_ajax(){
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
        $data['type'] = 'accepted';
        $result = $model->select_reminder_by_ajax_info($requirementid);

        $accepted = $result[0]['accepted'];
        $requirementid = $parts2[0];

        if ($parts2[2] == 0) {
            //1 kore kombe
            $data['status'] = 0;

            $accepted = $result[0]['accepted'] - 1;

            $save = $model->save_accepted_by_ajax_info($requirementid, $accepted);
            $insert = $model->save_accepted_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $no_response = $result[0]['accepted'] + 1;
            $saveresult = $model->save_accepted_by_ajax_info($requirementid, $accepted);
            $insert = $model->save_accepted_property($data);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        } 
    }
     public function save_data(){
            $model = $this->loadModel('admin_model');
            $this->rent = $_POST['rent'];
            $this->lease_length = $_POST['lease_length'];
            $this->rent_free = $_POST['rent_free'];
            $this->fit_out = $_POST['fit_out'];
            $this->requirement_id = $_POST['requirement_id'];
            $this->property_id = $_POST['property_id'];
           $getagent=$model->getagentfromreq($this->requirement_id);

           $this->agent_id = $getagent[0]['agent_id'];
            $data = array(
                    'rent' => $this->rent,
                    'lease_length' =>$this->lease_length,
                    'rent_free' => $this->rent_free,
                    'fit_out' => $this->fit_out,
                    'requirement_id' => $this->requirement_id,
                 'property_id' => $this->property_id,
                 'agent_id' => $this->agent_id,
                );
         
           $result = $model->save_data_info($data);
           $this->redirect('admin_controller/property_sent_for_multiple/'.$this->property_id);
//           $template = $this->loadView('property_sent_for_multiple');
//           $template->render();
          
             
        
    }



 public function update_agent_info(){
                 $model = $this->loadModel('admin_model');	
				 
		 $text='';
		 $dtagent=array();
                 
		 foreach($_POST['agent_name'] as $k=>$v){
		 $dtagent['agent_name']=$v;
		 $dtagent['agent_email']=$_POST['agent_email'][$k];
		 $dtagent['agent_phone_number']=$_POST['agent_tel'][$k];
		 if($k==0)		 $dtagent['is_primary']=1;
		 else $dtagent['is_primary']=0;
		 if(isset($_POST['agent_id'][$k]) && !empty($_POST['agent_id'][$k])){
		        $result = $model->update_agent_info_by_ajax($dtagent,$_POST['agent_id'][$k]);
		 }else{
		        $result = $model->save_agent_info_by_ajax($dtagent);
				
		 }
		 
		  if($result>0){
             
            
            $text .='<tr><td>'.$dtagent['agent_name'].'</td>';
            $text .='<td>'.$dtagent['agent_email'].'</td>';
            $text .='<td>'.$dtagent['agent_phone_number'].'</td>';
			 if($k==0)	{
            $text .='<td><input checked="checked"  data-agentid='.$result.' type="checkbox" name="data[is_primary]" class="isprimary">'
                    . '<input value='.$result.' type="hidden" name="data[agent_id][]"></td>';
					}else{
	   $text .='<td><input data-agentid='.$result.' type="checkbox" name="data[is_primary]" class="isprimary">'
                    . '<input value='.$result.' type="hidden" name="data[agent_id][]"></td>';
					
					}
            $text .='</tr>';
            
         }
		 }
         echo $text;
        
        exit;
    }





     public function save_no_response_by_ajax(){
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
        $data['type'] = 'no response';
        $result = $model->select_reminder_by_ajax_info($requirementid);
        //print_r($result);
        //exit;
        $no_response = $result[0]['no_response'];
        $requirementid = $parts2[0];
        if ($parts2[2] == 0) {
            //1 kore kombe
            $data['status'] = 0;
            $no_response = $result[0]['no_response'] - 1;
            $save = $model->save_no_response_by_ajax_info($requirementid, $no_response);
            $insert = $model->save_no_response_property($data);
            if ($save && $insert) {
                echo '1minus';
            } else {
                echo 'error';
            }
        } else {
            $data['status'] = 1;
            $no_response = $result[0]['no_response'] + 1;
            $saveresult = $model->save_no_response_by_ajax_info($requirementid, $no_response);
            $insert = $model->save_no_response_property($data);
            if ($saveresult && $insert) {
                echo '1add';
            } else {
                echo 'error';
            }
        }  
    }
    
 public function history_info_for_property($property_id){

         $model = $this->loadModel('admin_model');
         $result=$model->select_pdf_history_for_property_info($property_id);
         $result2=$model->select_pdf_history_for_property($property_id);     
         $result3=$model->select_pdf_history_requirement_id($property_id);
        if(!empty($result3)){
           $rsresult= $model->select_reminder_sum($result3);
         }

              foreach($result2 as $key=>$val){
                $new[$val['requirement_id']][]=$val;
               } 
               
         if(empty($result) || empty($result2) || empty($rsresult))
               {
              $msg='Sorry, there is no history.';
              $template = $this->loadView('nosearch_view');
              $template->set('msg',$msg);
              $template->render();
               } 
               else{
        $template = $this->loadView('history_view_for_property');
        $template->set('result',$result);
        $template->set('result2',$new);
        $template->set('result3',$rsresult);
        $template->render();
               }    
                      
          }  
          
          public function message_view(){
              
          }


    
}
