<?php

class Admin_model extends Model {

    public function add_requirement_info($data) {
        $result = $this->execute("INSERT INTO tbl_requirement(tenant_name,floor_area_to,floor_area_from,town,rccheck,use_class,agent_name,agent_email,agent_phone_number,resite) VALUES('$data[tenant_name]','$data[floor_area_to]','$data[floor_area_from]','$data[town]','$data[rccheck]','$data[use_class]','$data[agent_name]','$data[agent_email]','$data[agent_phone_number]','$data[resite]')");
        return true;
    }


 public function select_requirements_new_info(){
      $result = $this->querynr("SELECT * FROM  tbl_requirement ORDER BY requirement_id DESC");
      return $result;
  }

  public function select_agent_info_by_id($agentid){
     $req_agent=  implode(",", $agentid);
     $result = $this->querynr("SELECT * FROM  tbl_agent WHERE agent_id IN ($req_agent) GROUP BY  tbl_agent.agent_id");
     return $result; 
  }

public function select_staff_info_by_id($staff_id){
   $req_staff=  implode(",", $staff_id);   
   $result = $this->querynr("SELECT * FROM  tbl_user WHERE user_id IN ($req_staff) GROUP BY  tbl_user.user_id");
    return $result; 
  }


public function delete_requirements_new_info_by_id($requirement_id){
   $result = $this->execute("DELETE FROM tbl_requirement WHERE requirement_id='$requirement_id'");
   return $result;   
  }




 public function select_properties_new_info(){
       $result = $this->querynr("SELECT * FROM  property ORDER BY property_id DESC");
      return $result;
  }


 public function select_new_property_by_id($property_id){
   $result = $this->querynr("SELECT * FROM property WHERE property_id='$property_id'");
   return $result;   
  }


public function update_property_new_by_id($property_id, $data){
      $result = $this->execute("UPDATE  property SET  address_line1='" . $data['address_line1'] . "' , address_line2='" . $data['address_line2'] . "' , address_line3='" . $data['address_line3'] . "'  , town='" . $data['town'] . "', country='" . $data['country'] . "',postcode='" . $data['postcode'] . "', floor_area=" . $data['floor_area'] . ", use_class='" . $data['use_class'] . "',ancillary_area='" . $data['ancillary_area'] . "',site_area='" . $data['site_area'] . "' WHERE  property_id=" . $property_id . " ");
      return $result; 
  }

 public function update_property_image_by_id($property_id,$image){
     $result2 = $this->execute("UPDATE property SET image='" . $image . "' WHERE property_id=" . $property_id . "");
     return $result2;    
  }

public function upload_update($image){
        $target_dir = "uploads/";
        $imagename = $image['name'];  
        $extension=substr($imagename, strrpos($imagename, '.')+0);
        $file_name=time() . rand(99, 9999) . $extension;
        $target_file = $target_dir . $file_name;       
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $result = array();
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $result['msg'] = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $result['msg'] = "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {

            $result['msg'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($image["size"] > 50000000) {

            $result['msg'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
         $imageFileType =strtolower($imageFileType );
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $result['msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $result['msg'] = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                $result['msg'] = "Success";
                $result['imagename'] = $file_name;
            } else {
                $result['msg'] = "Sorry, there was an error uploading your file.";
            }
        }
        return $result;
       
  }
  




 public function delete_properties_new_info_by_id($property_id){
      $result = $this->execute("DELETE FROM property WHERE property_id='$property_id'");
      return $result;
  }

    public function add_requirement_agent_data($data) {
        $result = $this->execute_propoerty("INSERT INTO  requirement_agent(requirement_id,agent_id) VALUES('$data[requirement_id]','$data[agent_id]')");
        return $result;
    }

public function select_pdf_history_for_property($property_id){   
 $result=$this->query("SELECT tbl_requirement.requirement_id,tbl_requirement.tenant_name,tbl_requirement.town,tbl_requirement.floor_area_from,tbl_requirement.use_class,tbl_requirement.reminder,tbl_requirement.interested,tbl_requirement.floor_area_to,tbl_requirement.offered_received,tbl_requirement.rejected,tbl_requirement.no_response,tbl_requirement.accepted,tbl_requirement.staff_id, property.property_id,tbl_agent.*,requirement_agent.*,tbl_pdf_info.*"
        . " FROM tbl_requirement INNER JOIN tbl_pdf_info ON tbl_requirement.requirement_id=tbl_pdf_info.requirement_id INNER JOIN property ON property.property_id=tbl_pdf_info.property_id"
        . " INNER JOIN requirement_agent ON requirement_agent.requirement_id=tbl_requirement.requirement_id INNER JOIN  tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE property.property_id=" . $property_id);
 return $result;
    
  } 

public function select_pdf_history_for_property_info($property_id){
    $result = $this->query("SELECT * FROM property WHERE property_id=" . $property_id);
    return $result;  
  }

 public function select_pdf_history_requirement_id($property_id){
    $result=$this->querynr("SELECT tbl_requirement.requirement_id"
        . " FROM tbl_requirement INNER JOIN tbl_pdf_info ON tbl_requirement.requirement_id=tbl_pdf_info.requirement_id INNER JOIN property ON property.property_id=tbl_pdf_info.property_id"
        . " INNER JOIN requirement_agent ON requirement_agent.requirement_id=tbl_requirement.requirement_id INNER JOIN  tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE property.property_id=" . $property_id." GROUP BY requirement_id");
    $oneDimensionalArray = array_map('current', $result);
     return $oneDimensionalArray;  
  } 

public function select_reminder_sum($reqid){
    $reqid_arr=  implode(",", $reqid);
    $result = $this->querynr("SELECT sum(reminder) as reminder,sum(interested) as interested,sum(offered_received) as offered_received,sum(rejected) as rejected,sum(no_response) as no_response,sum(accepted) as accepted FROM tbl_requirement WHERE requirement_id IN ($reqid_arr)");
    return $result;   
  }


public function save_requirement_property($property_id,$reids){
       $r= explode(",",$reids);
        foreach ($r as $val){
             $result2=$this->querynr("SELECT * FROM tbl_pdf_info WHERE property_id=" . $property_id . "  AND requirement_id=" . $val . "");
             if(!count($result2)>0){
             $result = $this->execute("INSERT INTO tbl_pdf_info(requirement_id,property_id) VALUES($val,$property_id)");
               }
             else{
               return true;  
             }
        }    
        return true;

    }

   public function save_requirement_send_date($reqid,$property_id){
     $date=date('Y-m-d H:i:s');
     $getresult= $getresult = $this->query("SELECT * FROM tbl_pdf_info WHERE property_id='" . $property_id . "' AND requirement_id='" . $reqid . "' ");
      if (count($getresult) > 0) {
        $result = $this->execute("UPDATE tbl_pdf_info SET pdf_send_date='" . $date . "' WHERE requirement_id='" . $reqid . "' AND property_id='".$property_id."'  ");
        return true;
      }
      else{
          $result = $this->execute("INSERT INTO tbl_pdf_info (property_id,requirement_id,pdf_send_date) VALUES($property_id,$reqid,$date)");      
      }
  }


 

    public function getagentfromreq($reqid) {
$sql="SELECT tbl_requirement.requirement_id, tbl_agent.agent_id FROM tbl_requirement LEFT JOIN requirement_agent ON requirement_agent.requirement_id=tbl_requirement.requirement_id LEFT JOIN tbl_agent ON requirement_agent.agent_id=tbl_agent.agent_id WHERE tbl_requirement.requirement_id=".$reqid." AND tbl_agent.is_primary=1";
        $result = $this->querynr($sql);
//print_r($result);die();
        return $result;
        
    }

 public function select_general_info_by_id_for_requirement($requirement_id){
        $result = $this->query("SELECT * FROM tbl_requirement  WHERE requirement_id=" . $requirement_id);
        return $result;
    }

 public function select_general_info_by_id($requirement_id) {
        $result = $this->query("SELECT tbl_requirement.requirement_id,tbl_agent.*  FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id  WHERE tbl_requirement.requirement_id=" . $requirement_id);
        return $result;
    }


    public function add_requirement_data($data) {
        $result = $this->execute_propoerty("INSERT INTO tbl_requirement(tenant_name,floor_area_to,floor_area_from,town,rccheck,use_class,resite,staff_id) VALUES('$data[tenant_name]','$data[floor_area_to]','$data[floor_area_from]','$data[town]','$data[rccheck]','$data[use_class]','$data[resite]','$data[staff_id]')");
        return $result;
    }

    public function add_property_info($data) {
        $result = $this->execute_propoerty("INSERT INTO property(address_line1,address_line2,address_line3,town,country,postcode,floor_area,ancillary_area,site_area,use_class,image) "
                . "VALUES('$data[address_line1]','$data[address_line2]','$data[address_line3]','$data[town]','$data[country]','$data[postcode]','$data[floor_area]','$data[ancillary_area]','$data[site_area]','$data[use_class]','$data[image]')");
        return $result;
    }

    public function add_staff_info($data) {

        $result = $this->execute("INSERT INTO tbl_user (user_name,user_password,user_email_address) VALUES('$data[user_name]','$data[user_password]','$data[user_email_address]')");
        return true;
    }

    public function search_requirements_info_reasult($search, $start_from, $limit) {
        if ($start_from == 0 && $limit == 0){
            $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.town LIKE '%$search%' OR tbl_requirement.rccheck='yes'";
}
        else{
            $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.town LIKE '%" . $search . "%' OR tbl_requirement.rccheck='yes' LIMIT " . $start_from . " , " . $limit;
}
        $result = $this->querynr($sql);
        return $result;
    }

    public function search_requirements_info_reasult_for_general($search, $order, $start_from, $limit) {
        if ($order == 'requirement') {
            if ($start_from == 0 && $limit == 0) {
                $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.town LIKE '%$search%' OR tbl_requirement.rccheck='yes'";
            } else {
                  $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.town LIKE '%" . $search . "%' OR tbl_requirement.rccheck='yes' LIMIT " . $start_from . " , " . $limit;
            }
        } else if ($order == 'property') {
            if ($start_from == 0 && $limit == 0) {
                $sql = "SELECT * FROM property WHERE town LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM property WHERE town LIKE '%$search%' LIMIT " . $start_from . " , " . $limit;
            }
        } else if ($order == 'tenant_name') {
            if ($start_from == 0 && $limit == 0) {
              $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.town LIKE '%$search%'";
            } else {
                $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.town LIKE '%" . $search . "%' LIMIT " . $start_from . " , " . $limit;
            }
        }
        $result = $this->querynr($sql);
        return $result;
    }

    public function show_property_info($search, $start_from, $limit) {
        if ($start_from == 0 && $limit == 0)
            $sql = "SELECT * FROM property WHERE town ='" . $search . "'";
        else
            $sql = "SELECT * FROM property WHERE town ='" . $search . "' LIMIT " . $start_from . " , " . $limit;
        $result = $this->querynr($sql);
        return $result;
    }

    public function show_property_info_for_general($search, $order, $start_from, $limit) {
        // if ($start_from==0 && $limit==0) $sql="SELECT * FROM property WHERE town ='".$search."'";
        if ($order == 'requirement') {
            if ($start_from == 0 && $limit == 0) {
                $sql = "SELECT * FROM tbl_requirement WHERE town LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM tbl_requirement WHERE town LIKE '%$search%' LIMIT " . $start_from . " , " . $limit;
            }
        } else if ($order == 'property') {
            if ($start_from == 0 && $limit == 0) {
                $sql = "SELECT * FROM property WHERE town LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM property WHERE town LIKE '%$search%' LIMIT " . $start_from . " , " . $limit;
            }
        } else if ($order == 'tenant_name') {
            if ($start_from == 0 && $limit == 0) {
                $sql = "SELECT * FROM tbl_requirement WHERE tenant_name LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM tbl_requirement WHERE tenant_name LIKE '%$search%' LIMIT " . $start_from . " , " . $limit;
            }
        }
        //else { $sql="SELECT * FROM property WHERE town ='".$search."' LIMIT ".$start_from." , ". $limit;}
        $result = $this->querynr($sql);
        return $result;
    }

    public function search_property_info_reasult($search, $start_from, $limit) {
        if ($start_from == 0 && $limit == 0)
            $sql = "SELECT * FROM property WHERE town ='" . $search . "'";
        else
            $sql = "SELECT * FROM property WHERE town ='" . $search . "' LIMIT " . $start_from . " , " . $limit;
        $result = $this->querynr($sql);
        return $result;
        $result = $model->search_tenant($search, $start_from, $limit);
    }

      public function search_tenant($search, $start_from, $limit) {
        if ($start_from == 0 && $limit == 0)
             $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.tenant_name LIKE '%$search%'";
        else
          $sql = "SELECT tbl_requirement.*,tbl_agent.* FROM tbl_requirement LEFT JOIN   requirement_agent ON tbl_requirement.requirement_id=requirement_agent.requirement_id  LEFT JOIN tbl_agent ON tbl_agent.agent_id=requirement_agent.agent_id WHERE tbl_requirement.tenant_name LIKE '%" . $search . "%' LIMIT " . $start_from . " , " . $limit;   
            //$sql = "SELECT * FROM tbl_requirement WHERE tenant_name ='" . $search . "' LIMIT " . $start_from . " , " . $limit;
        $result = $this->querynr($sql);
        return $result;
    }

//    public function delete_category_by_id($category_id) {
//        $this->db->where('category_id', $category_id);
//        $this->db->delete('tbl_category');
//    }
    public function delete_requirement_by_id($requirement_id) {
        $result = $this->execute("DELETE FROM tbl_requirement WHERE requirement_id='$requirement_id'");
        // print_r($result);
        // die();
        return $result;
    }

    public function delete_property_by_id($property_id) {
        $result = $this->execute("DELETE FROM property WHERE property_id='$property_id'");
        // print_r($result);
        // die();
        return $result;
    }

    public function edit_property_by_id($property_id) {
        $result = $this->query("SELECT * FROM property WHERE property_id='$property_id'");
        return $result;
    }

    /* public function getrequirements($requirement_id) {
      $result = $this->query("SELECT * FROM  tbl_requirement WHERE requirement_id=" . $requirement_id);
      return $result;
      } */

public function all_agent_name(){
      $result = $this->querynr("SELECT agent_name FROM  tbl_agent ");
      return $result;
}

    public function getrequirements($requirement_id) {
        $sql = "SELECT tbl_requirement.*,tbl_agent.agent_email, tbl_agent.agent_name,tbl_agent.is_primary  FROM  tbl_requirement LEFT JOIN requirement_agent ON requirement_agent.requirement_id=tbl_requirement.requirement_id LEFT JOIN tbl_agent ON requirement_agent.agent_id=tbl_agent.agent_id  WHERE tbl_requirement.requirement_id=" . $requirement_id . " AND tbl_agent.is_primary=1 GROUP BY tbl_requirement.requirement_id";
        $result = $this->querynr($sql);


        return $result;
    }

    public function upload($image) {
        $target_dir = "uploads/";
        $imagename = $image['name'];  
        $extension=substr($imagename, strrpos($imagename, '.')+0);
        $file_name=time() . rand(99, 9999) . $extension;
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $result = array();
        $check = getimagesize($image["tmp_name"]);
        //echo $image["size"];
        // print_r($check);
        if ($check !== false) {
            $result['msg'] = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {

            $result['msg'] = "File is not an image.";
            $uploadOk = 0;
        }

// Check if file already exists
        if (file_exists($target_file)) {

            $result['msg'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($image["size"] > 50000000) {

            $result['msg'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
$imageFileType =strtolower($imageFileType );
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

            $result['msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        //  echo $uploadOk.'      '.$result['msg'];
// Check if $uploadOk is set to 0 by an error

        if ($uploadOk == 0) {

            $result['msg'] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                $result['msg'] = "Success";
                $result['imagename'] = $file_name;
            } else {
                $result['msg'] = "Sorry, there was an error uploading your file.";
            }
        }
       // print_r($result);
        return $result;
    }

    public function send_pdf_for_individual_property_info($property_id) {
        $result = $this->query("SELECT * FROM property WHERE property_id=" . $property_id);
        return $result;
    }

public function search_requirement_pag_info($search,$start_from, $limit){
if ($start_from==0 && $limit==0) {
//echo "SELECT * FROM tbl_requirement WHERE town  LIKE '%" . $search . "%' OR rccheck='yes' ";
$sql="SELECT * FROM tbl_requirement WHERE town  LIKE '%" . $search . "%' OR rccheck='yes' ";
 }
      else {  
$sql="SELECT * FROM tbl_requirement WHERE town  LIKE '%" . $search . "%' OR rccheck='yes' LIMIT ".$start_from." , ". $limit;
 }
         $result = $this->querynr($sql);
        return $result;
}

    public function getrequirements_info($require_id) {
        $result = $this->query("SELECT * FROM  tbl_requirement WHERE requirement_id=" . $require_id);
        return $result;
    }

    public function select_multiple_property_by_property_id($property_id) {
        $result = $this->query("SELECT * FROM property WHERE property_id=" . $property_id);
        return $result;
    }

    public function select_reminder_by_ajax_info($requirementid) {
        $result = $this->querynr("SELECT * FROM  tbl_requirement WHERE requirement_id=" . $requirementid);
        return $result;
    }

    public function save_reminder_by_ajax_info($requirementid, $reminder) {
        $result = $this->execute("UPDATE tbl_requirement SET reminder=" . $reminder . " WHERE requirement_id=" . $requirementid . "");
        return true;
    }

    public function save_interested_by_ajax_info($requirementid, $interested) {
        $result = $this->execute("UPDATE tbl_requirement SET interested=" . $interested . " WHERE requirement_id=" . $requirementid . "");
        return true;
    }

    public function save_offered_received_by_ajax_info($requirementid, $offered_received) {
        $result = $this->execute("UPDATE tbl_requirement SET offered_received=" . $offered_received . " WHERE requirement_id=" . $requirementid . "");
        return true;
    }

    public function save_rejected_by_ajax_info($requirementid, $rejected) {
        $result = $this->execute("UPDATE tbl_requirement SET rejected=" . $rejected . " WHERE requirement_id=" . $requirementid . "");
        return true;
    }

    public function save_comment_by_ajax_info($requirementid, $comment) {
        $result = $this->execute("UPDATE tbl_requirement SET comment=" . $comment . " WHERE requirement_id=" . $requirementid . "");
        return true;
    }

    public function save_no_response_by_ajax_info($requirementid, $no_response) {
        $result = $this->execute("UPDATE tbl_requirement SET no_response=" . $no_response . " WHERE requirement_id=" . $requirementid . "");
        return true;
    }

    public function save_no_response_property($data) {
        $getresult = $this->query("SELECT * FROM requirement_property WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " AND type='no response'");

        if (count($getresult) > 0) {
            //print_r(count($getresult));die();
            $result = $this->execute("UPDATE requirement_property SET status=" . $data['status'] . " WHERE id=" . $getresult[0][0] . "");
        } else {
            $result = $this->execute("INSERT INTO requirement_property (property_id,requirement_id,type, status) VALUES('$data[property_id]','$data[requirement_id]','$data[type]','$data[status]')");
        }


        return true;
    }

    public function save_accepted_by_ajax_info($requirementid, $accepted) {
        $result = $this->execute("UPDATE tbl_requirement SET accepted=" . $accepted . " WHERE requirement_id=" . $requirementid . "");
        return true;
    }

    public function save_accepted_property($data) {
        $getresult = $this->query("SELECT * FROM requirement_property WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " AND type='accepted'");

        if (count($getresult) > 0) {
            //print_r(count($getresult));die();
            $result = $this->execute("UPDATE requirement_property SET status=" . $data['status'] . " WHERE id=" . $getresult[0][0] . "");
        } else {
            $result = $this->execute("INSERT INTO requirement_property (property_id,requirement_id,type, status) VALUES('$data[property_id]','$data[requirement_id]','$data[type]','$data[status]')");
        }


        return true;
    }

    public function save_reminder_property($data) {
        $getresult = $this->query("SELECT * FROM requirement_property WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " AND type='reminder'");

        if (count($getresult) > 0) {
            //print_r(count($getresult));die();
            $result = $this->execute("UPDATE requirement_property SET status=" . $data['status'] . " WHERE id=" . $getresult[0][0] . "");
        } else {
            $result = $this->execute("INSERT INTO requirement_property (property_id,requirement_id,type, status) VALUES('$data[property_id]','$data[requirement_id]','$data[type]','$data[status]')");
        }


        return true;
    }

    public function save_interested_property($data) {
        $getresult = $this->query("SELECT * FROM requirement_property WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " AND type='interested'");

        if (count($getresult) > 0) {
            //print_r(count($getresult));die();
            $result = $this->execute("UPDATE requirement_property SET status=" . $data['status'] . " WHERE id=" . $getresult[0][0] . "");
        } else {
            $result = $this->execute("INSERT INTO requirement_property (property_id,requirement_id,type, status) VALUES('$data[property_id]','$data[requirement_id]','$data[type]','$data[status]')");
        }


        return true;
    }

    public function save_offered_received_property($data) {
        $getresult = $this->query("SELECT * FROM requirement_property WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " AND type='offered_received'");

        if (count($getresult) > 0) {
            //print_r(count($getresult));die();
            $result = $this->execute("UPDATE requirement_property SET status=" . $data['status'] . " WHERE id=" . $getresult[0][0] . "");
        } else {
            $result = $this->execute("INSERT INTO requirement_property (property_id,requirement_id,type, status) VALUES('$data[property_id]','$data[requirement_id]','$data[type]','$data[status]')");
        }


        return true;
    }

    public function save_rejected_property($data) {
        $getresult = $this->query("SELECT * FROM requirement_property WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " AND type='rejected'");

        if (count($getresult) > 0) {
            //print_r(count($getresult));die();
            $result = $this->execute("UPDATE requirement_property SET status=" . $data['status'] . " WHERE id=" . $getresult[0][0] . "");
        } else {
            $result = $this->execute("INSERT INTO requirement_property (property_id,requirement_id,type, status) VALUES('$data[property_id]','$data[requirement_id]','$data[type]','$data[status]')");
        }


        return true;
    }

    public function save_comment_property($data) {
        $getresult = $this->query("SELECT * FROM requirement_property WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " AND type='comment'");

        if (count($getresult) > 0) {
            //print_r(count($getresult));die();
            $result = $this->execute("UPDATE requirement_property SET status=" . $data['status'] . " WHERE id=" . $getresult[0][0] . "");
        } else {
            $result = $this->execute("INSERT INTO requirement_property (property_id,requirement_id,type, status) VALUES('$data[property_id]','$data[requirement_id]','$data[type]','$data[status]')");
        }


        return true;
    }

    public function getrequirements_multiple_sendpdf($property_id, $requirement_id) {
        $sql1 = "SELECT tbl_requirement.*  FROM  tbl_requirement  WHERE tbl_requirement.requirement_id in(" . $requirement_id . ")";
        $sql2 = "SELECT requirement_property.*  FROM  requirement_property WHERE requirement_property.requirement_id in(" . $requirement_id . ") AND requirement_property.property_id=" . $property_id;

        $result1 = $this->querynr($sql1);
        $result2 = $this->querynr($sql2);
        $result = array();

        foreach ($result1 as $k => $r) {
            $result[$k] = $r;
            $result[$k]['reminder_status'] = 0;
            $result[$k]['interested_status'] = 0;
            $result[$k]['comment_status'] = 0;
            $result[$k]['rejected_status'] = 0;
            $result[$k]['offered_received_status'] = 0;
            $result[$k]['no_response_status'] = 0;
            $result[$k]['accepted_status'] = 0;
            foreach ($result2 as $k1 => $r1) {
                if ($r1['requirement_id'] == $r['requirement_id'] && $r1['type'] == 'reminder') {
                    $result[$k]['reminder_status'] = $r1['status'];
                }if ($r1['requirement_id'] == $r['requirement_id'] && $r1['type'] == 'offered_received') {
                    $result[$k]['offered_received_status'] = $r1['status'];
                }if ($r1['requirement_id'] == $r['requirement_id'] && $r1['type'] == 'rejected') {
                    $result[$k]['rejected_status'] = $r1['status'];
                }if ($r1['requirement_id'] == $r['requirement_id'] && $r1['type'] == 'comment') {
                    $result[$k]['comment_status'] = $r1['status'];
                }if ($r1['requirement_id'] == $r['requirement_id'] && $r1['type'] == 'interested') {
                    $result[$k]['interested_status'] = $r1['status'];
                }
                if ($r1['requirement_id'] == $r['requirement_id'] && $r1['type'] == 'no_response') {
                    $result[$k]['no_response_status'] = $r1['status'];
                }
                if ($r1['requirement_id'] == $r['requirement_id'] && $r1['type'] == 'accepted') {
                    $result[$k]['accepted_status'] = $r1['status'];
                }
            }
        }

        return $result;
    }

    //    --------------------------------------------------------------------
    public function get_requir_info() {
        $result = $this->query("SELECT * FROM  tbl_requirement ORDER BY requirement_id DESC");
        return $result;
    }

    public function get_property_info() {
        $result = $this->query("SELECT * FROM  property ORDER BY property_id DESC");
        return $result;
    }

    public function get_staff_info() {
        $result = $this->query("SELECT * FROM  tbl_user Where user_name != 'khadiza' ORDER BY user_id DESC");
        return $result;
    }

    public function select_requirement_by_id($requirement_id) {
        $result = $this->query("SELECT * FROM tbl_requirement  WHERE requirement_id=" . $requirement_id);
        return $result;
    }

    public function select_property_by_id($property_id) {
        $result = $this->query("SELECT * FROM property  WHERE property_id=" . $property_id);
        return $result;
    }

    public function select_staff_by_id($user_id) {
        $result = $this->query("SELECT * FROM tbl_user  WHERE user_id=" . $user_id);
        return $result;
    }

    public function update_staff_by_id($user_id, $data) {

        $result = $this->execute("UPDATE  tbl_user SET  user_name='" . $data['user_name'] . "' , user_email_address='" . $data['user_email_address'] . "' , user_password='" . $data['user_password'] . "',access_label=" . $data['access_label'] . "   WHERE  user_id=" . $user_id . " ");
        return $result;
    }

    public function save_agentisprimary($data) {

        $result = $this->execute("UPDATE  tbl_agent SET  is_primary=" . $data['is_primary'] . "  WHERE  agent_id=" . $data['agent_id']);
        return $result;
    }

    public function delete_staff_by_id($user_id) {
        $result = $this->execute("DELETE FROM tbl_user WHERE user_id='$user_id'");
        return $result;
    }

    public function update_requirements_by_id($requirement_id, $data) {
//        print_r($data);
//        exit;
//        echo $sql="UPDATE tbl_requirement SET tenant_name='" . $data['tenant_name'] . "' , town='" . $data['town'] . "' , floor_area_to='" . $data['floor_area_to'] . ",floor_area_from=" . $data['floor_area_from'] . ", use_class=" . $data['use_class'] . "', resite='" . $data['resite'] . "'   WHERE  requirement_id=" . $requirement_id . " ";
//        die();
        $result = $this->execute("UPDATE tbl_requirement SET tenant_name='" . $data['tenant_name'] . "' , town='" . $data['town'] . "' , floor_area_to='" . $data['floor_area_to'] . ",floor_area_from=" . $data['floor_area_from'] . ", use_class=" . $data['use_class'] . "', resite='" . $data['resite'] . "',rccheck='" . $data['rccheck'] . "'   WHERE  requirement_id=" . $requirement_id . " ");
        return $result;
    }

    public function update_property_by_id($property_id, $data) {
//           print_r($property_id);
//           die();
        $result = $this->execute("UPDATE  property SET  address_line1='" . $data['address_line1'] . "' , address_line2='" . $data['address_line2'] . "' , address_line3='" . $data['address_line3'] . "'  , town='" . $data['town'] . "', country='" . $data['country'] . "',postcode='" . $data['postcode'] . "', floor_area=" . $data['floor_area'] . ", use_class='" . $data['use_class'] . "',ancillary_area='" . $data['ancillary_area'] . "',site_area='" . $data['site_area'] . "'   WHERE  property_id=" . $property_id . " ");
        return $result;

//return $result;
    }

    public function stafflist() {
//           
        $stafflist = $this->querynr("SELECT * FROM tbl_user");

        $staff = array();
        foreach ($stafflist as $k => $v) {//print_r($v);
            $staff[$v['user_id']] = $v['user_name'];
        }

        return $staff;

//return $result;
    }

    public function save_agent_info_by_ajax($data) {
        $result = $this->execute_propoerty("INSERT INTO  tbl_agent (agent_name,agent_email,agent_phone_number,is_primary) VALUES('$data[agent_name]','$data[agent_email]','$data[agent_phone_number]','$data[is_primary]')");
        return $result;
    }

    public function show_agent_info_by_ajax($reqid) {
        $result = $this->querynr("SELECT agent_name,agent_email,agent_phone_number FROM tbl_requirement WHERE requirement_id=" . $reqid);

        return $result;
    }


    public function delete_general_info_by_id($requirement_id) {
        $result = $this->execute("DELETE FROM tbl_requirement WHERE requirement_id='$requirement_id'");
        return $result;
    }

    public function update_general_info_by_id($requirement_id, $data) {
        $result = $this->execute("UPDATE  tbl_requirement SET  tenant_name='" . $data['tenant_name'] . "' , town='" . $data['town'] . "' , floor_area_from='" . $data['floor_area_from'] . "'  , floor_area_to='" . $data['floor_area_to'] . "', use_class='" . $data['use_class'] . "', rccheck='" . $data['rccheck'] . "', resite='" . $data['resite'] . "'  WHERE  requirement_id=" . $requirement_id . " ");
        return $result;
    }

    public function select_tenant_info_by_id($requirement_id) {
        $result = $this->query("SELECT * FROM tbl_requirement  WHERE requirement_id=" . $requirement_id);
        return $result;
    }

    public function select_deals_info() {
        //$result = $this->query("SELECT * FROM tbl_deals ORDER By date DESC");
        $result = $this->query("SELECT tbl_deals.*,tbl_requirement.tenant_name,tbl_requirement.town,tbl_requirement.requirement_id FROM tbl_deals,tbl_requirement WHERE tbl_deals.requirement_id=tbl_requirement.requirement_id ORDER By date DESC");
        return $result;
    }

    public function save_data_info($data) {
        $result = $this->execute("INSERT INTO tbl_deals(rent,lease_length,rent_free,fit_out,requirement_id,property_id, agent_id) VALUES('$data[rent]','$data[lease_length]','$data[rent_free]','$data[fit_out]','$data[requirement_id]','$data[property_id]','$data[agent_id]')");
        return true;
    }

    public function select_deals_by_id($deals_id) {
       $result = $this->query("SELECT tbl_deals.*,tbl_requirement.tenant_name,tbl_agent.agent_name,tbl_agent.agent_phone_number, tbl_requirement.town,tbl_requirement.requirement_id, tbl_agent.* FROM tbl_deals LEFT JOIN  tbl_requirement ON tbl_requirement.requirement_id=tbl_deals.requirement_id LEFT JOIN tbl_agent ON tbl_agent.agent_id=tbl_deals.agent_id WHERE tbl_deals.deals_id=".$deals_id);
       return $result;
    }

    public function update_comment_new_info($data, $requirement_id) {
        // echo "UPDATE  tbl_requirement SET comment='" . $data['new_comment'] . "'  WHERE  requirement_id=" . $requirement_id . " ";
        $result = $this->execute("UPDATE  tbl_requirement SET comment='" . $data['new_comment'] . "'  WHERE  requirement_id=" . $requirement_id . " ");
        return $result;
    }

    public function update_requirement_by_id($requirement_id, $data) {
        $result = $this->execute("UPDATE  tbl_requirement SET  tenant_name='" . $data['tenant_name'] . "' , town='" . $data['town'] . "' , floor_area_to=" . $data['floor_area_to'] . ",floor_area_from=" . $data['floor_area_from'] . ", use_class=" . $data['use_class'] . ",resite='" . $data['resite'] . "'   WHERE  requirement_id=" . $requirement_id . " ");
        return $result;
    }


public function update_agent_info_by_ajax($data,$agent_id){ 
    $result = $this->execute("UPDATE  tbl_agent SET  agent_name='" . $data['agent_name'] . "' , agent_email='" . $data['agent_email'] . "' , agent_phone_number='" . $data['agent_phone_number'] . "',is_primary='" . $data['is_primary']. "'   WHERE  agent_id=" . $agent_id . " ");
    return $result;  
  }

public function save_accepted_property_new($data,$new_accepted){
     $getresult = $this->query("SELECT * FROM tbl_property_requirement WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " ");  
      if (count($getresult) > 0) {
         $result = $this->execute("UPDATE tbl_property_requirement SET 	accepted='" . $new_accepted . "' WHERE id=" . $getresult[0][0] . ""); 
      } 
      else{
        $result = $this->execute("INSERT INTO tbl_property_requirement (property_id,requirement_id,accepted) VALUES('$data[property_id]','$data[requirement_id]','$new_accepted')");   
      }
      return true;   
      }

public function update_comment_new2_info($data,$requirement_id){
      $result = $this->execute("UPDATE  tbl_property_requirement SET comment='" . $data['new_comment'] . "'  WHERE  requirement_id=" . $requirement_id . " ");
      return $result;  
    }


 public function save_rejected_property_new($data,$new_rejected){
      $getresult = $this->query("SELECT * FROM tbl_property_requirement WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " ");  
      if (count($getresult) > 0) {
         $result = $this->execute("UPDATE tbl_property_requirement SET rejected='" . $new_rejected . "' WHERE id=" . $getresult[0][0] . ""); 
      } 
      else{
        $result = $this->execute("INSERT INTO tbl_property_requirement (property_id,requirement_id,rejected) VALUES('$data[property_id]','$data[requirement_id]','$new_rejected')");   
      }
      return true;
        
    }

public function save_offered_received_property_new($data,$new_offered_received){
        $getresult = $this->query("SELECT * FROM tbl_property_requirement WHERE property_id=" . $data['property_id'] . " AND requirement_id=" . $data['requirement_id'] . " ");  
      if (count($getresult) > 0) {
         $result = $this->execute("UPDATE tbl_property_requirement SET 	offered_on='" .$new_offered_received . "' WHERE id=" . $getresult[0][0] . ""); 
      } 
      else{
        $result = $this->execute("INSERT INTO tbl_property_requirement (property_id,requirement_id,offered_on) VALUES('$data[property_id]','$data[requirement_id]','$new_offered_received')");   
      }
      return true;  
      }

public function select_pdf_history_for_requirement($requirement_id){   
    $result=$this->querynr("SELECT tbl_requirement.requirement_id,tbl_requirement.tenant_name,tbl_requirement.town as rtown,tbl_requirement.use_class as ruse_class,property.*,tbl_property_requirement.*,tbl_pdf_info.requirement_id,tbl_pdf_info.property_id"
        . " FROM tbl_requirement INNER JOIN tbl_pdf_info ON tbl_requirement.requirement_id=tbl_pdf_info.requirement_id INNER JOIN property ON property.property_id=tbl_pdf_info.property_id"
        . " INNER JOIN tbl_property_requirement ON tbl_property_requirement.requirement_id=tbl_requirement.requirement_id  WHERE tbl_requirement.requirement_id=" . $requirement_id);
    return $result;  
  }
 public function select_pdf_history_for_requirement_id($requirement_id){
     $result=$this->querynr("SELECT tbl_requirement.tenant_name"
        . " FROM tbl_requirement INNER JOIN tbl_pdf_info ON tbl_requirement.requirement_id=tbl_pdf_info.requirement_id INNER JOIN property ON property.property_id=tbl_pdf_info.property_id"
        . " INNER JOIN tbl_property_requirement ON tbl_property_requirement.requirement_id=tbl_requirement.requirement_id  WHERE tbl_requirement.requirement_id=" . $requirement_id." GROUP BY tbl_requirement.requirement_id");
    return $result;   
  }

}