<?php
class Email_Remainder_Model extends Model{
    public function select_all_agent_unreceivedfeedback($mdate){ 
        $result = $this->querynr("SELECT tbl_requirement.*,tbl_agent.*,tbl_pdf_info.* FROM tbl_requirement LEFT JOIN requirement_agent ON requirement_agent.requirement_id=tbl_requirement.requirement_id LEFT JOIN tbl_pdf_info ON tbl_requirement.requirement_id=tbl_pdf_info.requirement_id LEFT JOIN tbl_agent ON requirement_agent.agent_id=tbl_agent.agent_id  WHERE tbl_requirement.reminder <= 0 AND tbl_requirement.interested <= 0 AND tbl_requirement.offered_received <= 0 AND tbl_requirement.rejected <= 0 AND tbl_requirement.no_response <= 0 AND tbl_requirement.accepted <= 0 AND tbl_pdf_info.pdf_send_date<= '$mdate' AND tbl_pdf_info.remainder_send_date = 0000-00-00");
        return $result;
  print_r($result); 
exit;
    }
    public function save_remainder_requirement_id($requirement_id){
        $result2 = $this->execute("UPDATE tbl_requirement SET reminder=1 WHERE requirement_id=" . $requirement_id . "");
        return $result2;
    }
    
    public function save_remainder_date($remainder_date,$requirement_id,$property_id){
        $result2 = $this->execute("UPDATE tbl_pdf_info SET remainder_send_date='".$remainder_date."' WHERE requirement_id=" . $requirement_id . " AND property_id=". $property_id. " ");
        return $result2;
    }
    
    public function select_all_remainder_set_agent_info($mdate,$date){
       $result = $this->querynr("SELECT tbl_requirement.*,tbl_agent.*,tbl_pdf_info.* FROM tbl_requirement LEFT JOIN requirement_agent ON requirement_agent.requirement_id=tbl_requirement.requirement_id LEFT JOIN tbl_pdf_info ON tbl_requirement.requirement_id=tbl_pdf_info.requirement_id LEFT JOIN tbl_agent ON requirement_agent.agent_id=tbl_agent.agent_id  WHERE tbl_requirement.reminder <= 0 AND tbl_requirement.interested <= 0 AND tbl_requirement.offered_received <= 0 AND tbl_requirement.rejected <= 0 AND tbl_requirement.no_response <= 0 AND tbl_requirement.accepted <= 0 AND tbl_pdf_info.remainder_send_date='$date' ");
        return $result; 
    }

public function select_staff($staff_id){
   $result = $this->querynr("SELECT user_name FROM tbl_user WHERE user_id='$staff_id'");
   return $result; 
    }
}