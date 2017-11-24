<?php include('header_12.php'); ?>
<style>
    .col-md-6 img {
        height: 50px;
        width: 50px;
    }
    td, th {
        padding: 8px;
    }
    .main-content {
        background-color: #fff;
        border: 1px solid #dde1e6;

        margin-top: 30px;
        padding: 20px 20px 20px 25px;
    }
    #my-dialog{
        background: white none repeat scroll 0 0;
        margin: 40px auto;
        max-width: 500px;
        padding: 20px 30px;
        position: relative;
        text-align: left;
    }	
    table.font-small { font-size: 13px;margin-top: 0;}.paragraph-margin-zero p{margin: 0;}.row-border{ padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #dde1e6;}.row-border:last-child{	border: 0;}.overflow-auto {	widht: 100%;	overflow: auto;}.box-right-one {	max-width: 80%;	margin: 0 auto;	padding: 5px 10px;	color: #fff!important;	font-size: 11px!important;	line-height: 16px;	font-family: Arial;	background-color: #69c5ee;}.box-right-one  table {	width: 100%;	border: 0;}.box-right-one  table tr td{	font-size: 13px!important;	line-height: 16px;	font-family: Arial;	color: #fff!important;	padding: 3px 2px;}
    .border{
        border: 3px solid #dde1e6; 
    }
    .padd{
        padding:10px;
    }
    .send_button {
    background-color: #69c5ee;
    color: white;
    height: 37px !important;
    width: 70px !important;
}
</style>

<div id="main" class="site-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="menu-list">
                    <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                    <li class="active">History</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3>PROPERTY</h3>
                    <?php 
                    if(!empty($result3)){
                    foreach($result3 as $vs_result){
                     $reminder=$vs_result['reminder'];
                     $interested=$vs_result['interested'];
                     $offered_received=$vs_result['offered_received'];
                     $rejected=$vs_result['rejected'];
                     $no_response=$vs_result['no_response'];
                     $accepted=$vs_result['accepted'];
                    }
                     }               
                    ?>
                    <form>
                        <div class="form-group ">    
                                <div class="row row-border">
                                 <?php
                                 foreach ($result as $v_result) { 
                                     $property_id=$v_result['property_id'];
                                       ?>
                                    <div  class="col-sm-2"><div class="input-group">
                                            <p><img height="76" width="106" class="img-responsive" src="<?php echo BASE_URL . 'uploads/' . $v_result['image']; ?>"></p>
                                        </div>
                                    </div>
                                    <div  class="col-sm-6 paragraph-margin-zero"><div class="input-group"><p>Address:<?php echo $v_result['address_line1']; ?></p>
                                            <p>Use Class:<?php echo $v_result['use_class']; ?></p>
                                            <p>Floor Area:<?php echo $v_result['floor_area']; ?></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div  class="col-sm-4">
                                        <div class="box-right-one">
                                            <table>														
                                                <tr>															
                                                    <td>Interested: <?php echo $interested; ?></td>															
                                                    <td>Offer Accepted: <?php echo $accepted; ?></td>														
                                                </tr>														
                                                <tr>															
                                                    <td>Offer Recieved: <?php echo $offered_received; ?></td>															    
                                                    <td>Rejected: <?php echo $rejected; ?></td>														
                                                </tr>													
                                            </table> 
                                        </div>											
                                    </div>
                                    
                                </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3 class="content-title">HISTORY</h3>
                    <form id="form" method="POST" action="">							
                        <div class="overflow-auto">
                            <table class='table table-hover font-small deals-table'>
                                <tr>
                                    <td>Tenant</td>
                                    <td>Use Class</td>
                                    <td>Town</td>
                                    <td>Floor Area</td>
                                    <td>Reminder</td>
                                    <td>Interested</td>
                                    <td>Offered Received</td>
                                    <td>Rejected</td>
                                    <td>No Response</td>
                                    <td>Accepted</td>
                                    <td>Comment</td>
                                </tr>
                              <?php
                            foreach ($result2 as $key => $req) {
                                $requirement_id=$result2[$key]['0']['requirement_id'];
                                $t=$result2[$key]['0']['town'];
                                $town=unserialize($t);
                                 if($town!=""){
                                   $new= implode(" ,",$town);
                                   }

                               if(!is_array($town)){
                                   $town = array();
                                   }
                                   
                                ?>
                                
                                    <tr>
                                        <td><?php echo $result2[$key]['0']['tenant_name']; ?></td>
                                        <td align="center"><?php echo $result2[$key]['0']['use_class']; ?></td>
                                        <td><?php echo $new;?></td>
                                        <td><?php echo $result2[$key]['0']['floor_area_from'] . ' - ' .  $result2[$key]['0']['floor_area_to'] ?></td>
                                        <td align="center">
                                            <a class="popup-with-zoom-anim khadiza" href="#my-dialog" data-attr="<?php echo  $result2[$key]['0']['requirement_id']; ?>" data-tenant="<?php echo $result2[$key]['0']['tenant_name'];?>" data-agent="<?php echo $result2[$key]['0']['agent_name'];?>"><input href="#my-dialog" data-requirementid="<?php echo  $result2[$key]['0']['requirement_id']; ?>"<?php if($result2[$key]['0']['reminder']>=1){echo 'checked'; }?>  type="checkbox" name="data[requirement_id]" class="reminder" >
                                            <input  type="hidden" name="requirement_id" value="<?php echo $result2[$key]['0']['requirement_id']; ?>"></a>
                                        </td>
                                        <td align="center"><input data-requirementid="<?php echo  $result2[$key]['0']['requirement_id']; ?>"<?php if($result2[$key]['0']['interested']>=1){echo 'checked'; }?>  type="checkbox" name="data[requirement_id]" class="interested">
                                            <input  type="hidden" name="requirement_id" value="<?php echo  $result2[$key]['0']['requirement_id']; ?>"></td>
                                        <td align="center"><input data-requirementid="<?php echo  $result2[$key]['0']['requirement_id']; ?>"<?php if($result2[$key]['0']['offered_received']>=1){echo 'checked'; }?>  type="checkbox" name="data[requirement_id]" class="offered_received">
                                            <input  type="hidden" name="requirement_id" value="<?php echo $result2[$key]['0']['requirement_id']; ?>"></td>
                                        <td align="center"><input data-requirementid="<?php echo  $result2[$key]['0']['requirement_id']; ?>"<?php if($result2[$key]['0']['rejected']>=1){echo 'checked'; }?> type="checkbox" name="data[requirement_id]" class="rejected">
                                            <input  type="hidden" name="requirement_id" value="<?php echo  $result2[$key]['0']['requirement_id']; ?>"></td>
                                        <!--<td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>"  type="checkbox" name="data[requirement_id]" class="comment">
                                            <input  type="hidden" name="requirement_id" value="<?php echo  $result2[$key]['0']['requirement_id']; ?>"></td>-->
                                        <td align="center">
                                            <input data-requirementid="<?php echo  $result2[$key]['0']['requirement_id']; ?>"<?php if($result2[$key]['0']['no_response']>=1){echo 'checked'; }?> type="checkbox" name="data[requirement_id]" class="no_response">
                                            <input  type="hidden" name="requirement_id" value="<?php echo $result2[$key]['0']['requirement_id']; ?>">
                                        </td>
                                        <td align="center">
                                            <input data-requirementid="<?php echo  $result2[$key]['0']['requirement_id']; ?>"<?php if($result2[$key]['0']['accepted']>=1){echo 'checked'; }?> type="checkbox" name="data[requirement_id]" class="accepted">
                                            <input  type="hidden" name="requirement_id" value="<?php echo $result2[$key]['0']['requirement_id']; ?>">
                                        </td>
                                        <td>
                                            <div class="comment_form">                                               
                                                <input type="text" name="new_comment" id="new_comment" class="new_comment">
                                                <input  type="hidden" name="requirement_id" id="requirement_id" value="<?php echo  $result2[$key]['0']['requirement_id']; ?>">
                                                <input  type="hidden" name="property_id" id="property_id" value="<?php echo  $property_id ?>">
                                                <input type="submit" name="submit" value="submit" class="submit_info">
                                            </div>
                                        </td>
                                    </tr>                               
                               <?php } ?>
                            </table>
                        </div>
                    </form>
                   <br style="clear:both"/>
                </div>
            </div>
            <div id="my-dialog" class="zoom-anim-dialog  mfp-hide border">
                <div class="border">
                <form action="<?php echo BASE_URL; ?>email_remainder_controller/save_remainder" method="post">
                    <div class="padd">
                     <!-- <span id="tenant"></span> <br/><br/> -->
                     <p id="agent">,</p>
                        <div>We sent you an email about a property we believe  <br/>
                            suits your requirements.<br/><br/>
                            Have you had a moment to review it?<br/><br/>
                            Kind regards<br/><br/> <p id="agent"></p>
                        </div>
                        <div>
                            <div class="form-group full-width">
                                <label  class="label-1">Send in</label>
                                <div class="select">
                                    <input type="hidden" class="r_id" name="requirement_id" value="">
                                    <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
                                    <select name="remainder" class="selectpicker" data-style="btn-select">
                                        <?php
                                        $i=0;
                                        for($i=0; $i<=10; $i++){
                                            $v=$i;
                                         ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?> days</option>
                                         <?php } ?>
                                    </select>                                                                    
                                      <button type="submit" class="send_button">Send</button>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>


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
                var url = baseurl + "admin_controller/save_interested_by_ajax/" + requireid + "-" + property_id + "-1";


                save_data_by_ajax(url, $this);
            }
            else {
                var url = baseurl + "admin_controller/save_interested_by_ajax/" + requireid + "-" + property_id + "-0";

                save_data_by_ajax(url, $this);


            }
        });


        $("body").delegate(".offered_received", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url = baseurl + "admin_controller/save_offered_received_by_ajax_new/" + requireid + "-" + property_id + "-1";
                save_data_by_ajax(url, $this);
            }
            else {
                var url = baseurl + "admin_controller/save_offered_received_by_ajax_new/" + requireid + "-" + property_id + "-0";
                save_data_by_ajax(url, $this);


            }
        });




        $("body").delegate(".rejected", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url = baseurl + "admin_controller/save_rejected_by_ajax_new/" + requireid + "-" + property_id + "-1";
                save_data_by_ajax(url, $this);
            }
            else {
                var url = baseurl + "admin_controller/save_rejected_by_ajax_new/" + requireid + "-" + property_id + "-0";
                save_data_by_ajax(url, $this);
            }
        });




        $("body").delegate(".no_response", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url = baseurl + "admin_controller/save_no_response_by_ajax/" + requireid + "-" + property_id + "-1";
                save_data_by_ajax(url, $this);
            }
            else {
                var url = baseurl + "admin_controller/save_no_response_by_ajax/" + requireid + "-" + property_id + "-0";
                save_data_by_ajax(url, $this);
            }
        });




        $("body").delegate(".accepted", "click", function (e) {
            e.preventDefault();
            var requireid = $(this).attr('data-requirementid');
            var property_id = $("#property_id").val();
            $this = $(this);
            if ($(this).is(':checked')) {
                var url = baseurl + "admin_controller/save_accepted_by_ajax_new/" + requireid + "-" + property_id + "-1";
                save_data_by_ajax(url, $this);
            }
            else {
                var url = baseurl + "admin_controller/save_accepted_by_ajax_new/" + requireid + "-" + property_id + "-0";
                save_data_by_ajax(url, $this);
            }
        });




        $(".submit_info").click(function (e) {
            e.preventDefault();
            $this = $(this);
            var baseurl = '<?php echo BASE_URL; ?>';
            var url = baseurl + "admin_controller/save_comment_new2";
            var new_comment = $(this).parent().children('#new_comment').val();
            var requirement_id = $(this).parent().children("#requirement_id").val();
            var property_id = $(this).parent().children("#property_id").val();
            var dataString = 'new_comment=' + new_comment + '&requirement_id=' + requirement_id + '&property_id=' + property_id;
            //alert(dataString);
            $.ajax({
                type: 'POST',
                data: dataString,
                url: url,
                success: function (data) {

                    $this.parent(".comment_form").html(new_comment);
                    //$this.parent(".comment_form").html(new_comment); 
                }
            });
        });
    });


</script>
<script>
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
    
    $(".khadiza").click(function () {
        var requireid = $(this).attr('data-attr');
        var tenant=$(this).attr('data-tenant');
        var agent=$(this).attr('data-agent');
        $('.r_id').val(requireid);
        $('#tenant').html(tenant);
        $('#agent').html(agent);
               
    });
    
</script>

<?php include('footer_12.php'); ?>  
