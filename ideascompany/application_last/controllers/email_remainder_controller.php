<?php

require_once 'phpmailer/PHPMailerAutoload.php';
class Email_Remainder_Controller extends Controller{
     public function __construct() {
    }
    
    public function all_agent_unreceivedfeedback(){
       echo'dsfd';
       exit;
        $model = $this->loadModel('email_remainder_model');
        $date = date ( 'Y-m-d' );
        $newdate = strtotime ( '-10 days' , strtotime ( $date ) ) ;
        $mdate = date('Y-m-d', $newdate);
        $result=$model->select_all_agent_unreceivedfeedback($mdate);
        echo '<pre>';
       print_r($result); 
       echo '</pre>';
        exit;
        foreach($result as $v_result){ 
           $requirement_id=$v_result['requirement_id'];
           $emails=$v_result['agent_email'];
           $tenant= $v_result['tenant_name']; 
           $agent_name=$v_result['agent_name']; 
           $html='Hi {'. $tenant.' } We sent you an email about a property we thought 
               you may be interested in.
               Have you had a moment to review it?
                Thanks
              {'. $agent_name .'}';
           $mail = new PHPMailer;
           $mail->addAddress($emails);
           $mail->setFrom('admin@pge3.f-overseas.com', 'Mailer');
           $mail->addReplyTo('admin@pge3.f-overseas.com', 'Mailer');
           $mail->isHTML(true);
           $mail->Subject = "email remainder from admin@pge3.f-overseas.com";
           $mail->Body    = $html;
           $mail->AltBody = $html; 
            if(!($mail->send())) {
                echo 'Mailer Error:'.$mail->ErrorInfo;
            }
            else{
            echo'success';
            exit;
                $result2=$model->save_remainder_requirement_id($requirement_id); 
              }        
         }
    }
    
    public function save_remainder(){        
        $remainderdate=$_POST['remainder'];  
        $property_id=$_POST['property_id'];   
        $requirement_id=$_POST['requirement_id'];
        $date = date ( 'Y-m-d' );
        $newdate = strtotime ( '+'.$remainderdate .'days', strtotime ( $date ) ) ;
        $remainder_date = date('Y-m-d', $newdate);
        $requirement_id=$_POST['requirement_id'];
        $model = $this->loadModel('email_remainder_model');
        $model2 = $this->loadModel('admin_model');
        $result4=$model->save_remainder_date($remainder_date,$requirement_id,$property_id);
          $result3=$model2->select_pdf_history_requirement_id($property_id);
         if(!empty($result3)){
           $rsresult= $model2->select_reminder_sum($result3);
         }
        if(count($result4)){
            $result2=$model2->select_pdf_history_for_property($property_id);
            
             $result=$model2->select_pdf_history_for_property_info($property_id);
             $result2=$model2->select_pdf_history_for_property($property_id);
                if(count(($result2) && ($result)) >0){
                    
                    foreach($result2 as $key=>$val){
                     $new[$val['requirement_id']][]=$val;
                     }
                    
                 $template = $this->loadView('history_view_for_property');
                 $template->set('result',$result);
                 $template->set('result2',$new);
                  $template->set('result3',$rsresult);
                 $template->render();
                }
                else{
                    echo 'there is no data found';
                }    
        }
    }
    
    public function select_all_remainder_set_agent(){
        $date = date ( 'Y-m-d' );
        $newdate = strtotime ( '-10 days' , strtotime ( $date ) ) ;
        $mdate = date('Y-m-d', $newdate);
        $model = $this->loadModel('email_remainder_model');
        $result=$model->select_all_remainder_set_agent_info($mdate,$date);
        echo '<pre>';
       print_r($result);
        echo '</pre>';
        exit;
        if(count($result)>0){
        foreach( $result as $v_result){
             $emails=$v_result['agent_email']; 
             $pdf_send_date=$v_result['pdf_send_date'];
              $tenant= $v_result['tenant_name']; 
           $agent_name=$v_result['agent_name'];
          $requirement_id=$v_result['requirement_id']; 
           $html='Hi {'. $tenant.' } We sent you an email about a property we thought 
               you may be interested in.
               Have you had a moment to review it?
                Thanks
              { '. $agent_name .' }';
 
            $mail = new PHPMailer;
            $mail->addAddress($emails);
            $mail->setFrom('admin@pge3.f-overseas.com', 'Mailer');
            $mail->addReplyTo('admin@pge3.f-overseas.com', 'Mailer');
            $mail->isHTML(true);
            $mail->Subject = "all agent unreceivedfeedback remainder";
            $mail->Body    = $html;
            $mail->AltBody = $html; 
            if(!($mail->send())) {
                echo 'Mailer Error:'.$mail->ErrorInfo;
            }
            else{
                 echo'success';
                 exit;
                $result2=$model->save_remainder_requirement_id($requirement_id); 
                }
              }     
           }
    }
    }
    
}