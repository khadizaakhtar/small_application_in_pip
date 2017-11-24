<?php include('header_12.php'); ?>
<style>
    .col-md-6 img {
        height: 50px;
        width: 50px;
    }
</style>
<section class="s-12 m-8 l-9 right">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Property Sent!</h3>
                <div class="form-group">  
                    <input  type="hidden" id="property_id" value="<?php echo $resultinfo[0][0]; ?>">       
                    <?php
                    foreach ($resultinfo as $v_info) {
                        ?>
                        <div class="input-group">
                            <p><?php echo $v_info[1]; ?></p>
                            <p><?php echo $v_info[8]; ?></p>
                            <p><?php echo $v_info[7]; ?></p>
                        </div> 
                    <?php } ?>
                </div>   
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form id="form" method="POST" action="">
                    <table>

                        <tr>
                            <td>Tenant</td>
                            <td>Use Class</td>
                            <td>Town</td>
                            <td>Floor Area</td>
                            <td>Reminder</td>
                            <td>Interested</td>
                            <td>Offered Received</td>
                            <td>Rejected</td>
                            <td>Comment</td>
                        </tr>
                        <?php
                        foreach ($requirement_info as $v_info) {//echo '<pre>';print_r($v_info);echo '</pre>';die();
                            ?>
                            <tr>
                                <td><?php echo $v_info['tenant_name'] ?></td>
                                <td><?php echo $v_info['use_class'] ?></td>
                                <td><?php echo $v_info['town'] ?></td>
                                <td><?php echo $v_info['floor_area_from'].' - ' .$v_info['floor_area_to'] ?></td>
                                <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php  if($v_info['reminder_status']==1){echo 'checked';}?>  type="checkbox" name="data[requirement_id]" class="reminder" >
                                    <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php  if($v_info['interested_status']==1){echo 'checked';}?> type="checkbox" name="data[requirement_id]" class="interested">
                                    <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php  if($v_info['offered_received_status']==1){echo 'checked';}?> type="checkbox" name="data[requirement_id]" class="offered_received">
                                    <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                  <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php  if($v_info['rejected_status']==1){echo 'checked';}?> type="checkbox" name="data[requirement_id]" class="rejected">
                                    <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                 <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php  if($v_info['comment_status']==1){echo 'checked';}?> type="checkbox" name="data[requirement_id]" class="comment">
                                    <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                            </tr>
                        <?php } ?>
                    </table>
                </form>
                <hr>
            </div>
        </div>
    </div>
</section>
<script>
    function save_data_by_ajax(url, $this) {
         $.ajax({
                    type: "GET",
                    url: url,
                    success: function (data) {

                        if (data == '1add') {
                            $this.prop("checked", true);
                        } else if (data == '1minus') {
                            $this.prop("checked", false);
                        } else {
                            alert("There is something wrong");
                        }

                    }
                });      			
    }
    $(document).ready(function () {
        var baseurl = '<?php echo BASE_URL; ?>';
        $("body").delegate(".reminder", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url = baseurl + "admin_controller/save_reminder_by_ajax/" + requireid + "-" + property_id + "-1";
               
              
		save_data_by_ajax(url, $this);
              } 
              else {
                var url = baseurl + "admin_controller/save_reminder_by_ajax/" + requireid + "-" + property_id + "-0";
              
                save_data_by_ajax(url, $this);
               

            }
        });
        
        
        $("body").delegate(".interested", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url=baseurl+"admin_controller/save_interested_by_ajax/"+requireid+"-"+property_id+"-1";
              
               
		save_data_by_ajax(url, $this);
              } 
              else {
                var url=baseurl+"admin_controller/save_interested_by_ajax/"+requireid+"-"+property_id+"-0";
               
                save_data_by_ajax(url, $this);
               

            }
        });
         $("body").delegate(".offered_received", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url=baseurl+"admin_controller/save_offered_received_by_ajax/"+requireid+"-"+property_id+"-1";
              
               
		save_data_by_ajax(url, $this);
              } 
              else {
                var url=baseurl+"admin_controller/save_offered_received_by_ajax/"+requireid+"-"+property_id+"-0";
               
                save_data_by_ajax(url, $this);
               

            }
        });
         $("body").delegate(".rejected", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url=baseurl+"admin_controller/save_rejected_by_ajax/"+requireid+"-"+property_id+"-1";
              
               
		save_data_by_ajax(url, $this);
              } 
              else {
                var url=baseurl+"admin_controller/save_rejected_by_ajax/"+requireid+"-"+property_id+"-0";
               
                save_data_by_ajax(url, $this);
               

            }
        });
        $("body").delegate(".comment", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url=baseurl+"admin_controller/save_comment_by_ajax/"+requireid+"-"+property_id+"-1";
              
               
		save_data_by_ajax(url, $this);
              } 
              else {
                var url=baseurl+"admin_controller/save_comment_by_ajax/"+requireid+"-"+property_id+"-0";
               
                save_data_by_ajax(url, $this);
               

            }
        });
    });
    
    
</script>
<?php include('footer_12.php'); ?>   