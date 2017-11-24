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
            max-width: 400px;
            padding: 20px 30px;
            position: relative;
            text-align: left;
        }
		table.font-small {
			font-size: 13px;
			margin-top: 0;
		}
		img{
			height: auto;
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
                            <form>
                                <div class="form-group ">
                                    <input  type="hidden" id="property_id" value="<?php echo $resultinfo[0][0]; ?>">       
                                    <?php
                                    foreach ($resultinfo as $v_info) {
                                        $property_id = $v_info[0];
                                        ?>
                                        <div class="input-group">
                                        <p><img height="76px" width="106px" src="<?php echo BASE_URL .'uploads/'. $v_info['image'] ?>"></p>
                                            <p>Address: <?php echo $v_info[1]; ?></p>
                                            <p>Use Class: <?php echo $v_info[8]; ?></p>
                                             <p>Floor Area: <?php echo $v_info['site_area'] ?> sq ft</p>
                                            <!-- <p><?php echo $v_info[7]; ?></p> -->
                                        </div> 
                                    <?php } ?>
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
                                    foreach ($requirement_info as $v_info) {
                                        $requirement_id = $v_info['requirement_id'];
                                        $t=$v_info['town'];
                                         $town=unserialize($t);
                                         if($town!=""){
                                            $new_town= implode(" ,",$town);
                                           }else{
                                                  $new_town='';
                                              }
                                        ?>
                                        <tr>
                                            <td><?php echo $v_info['tenant_name'] ?></td>
                                            <td><?php echo $v_info['use_class'] ?></td>
                                            <td><?php if(isset( $new_town) && !empty($new_town)){ echo $new_town; }?></td>
                                            <td><?php echo $v_info['floor_area_from'] . ' - ' . $v_info['floor_area_to'] ?></td>
                                            <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php
                                                if ($v_info['reminder_status'] == 1) {
                                                    echo 'checked';
                                                }
                                                ?>  type="checkbox" name="data[requirement_id]" class="reminder" >
                                                <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                            <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php
                                                if ($v_info['interested_status'] == 1) {
                                                    echo 'checked';
                                                }
                                                ?> type="checkbox" name="data[requirement_id]" class="interested">
                                                <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                            <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php
                                                if ($v_info['offered_received_status'] == 1) {
                                                    echo 'checked';
                                                }
                                                ?> type="checkbox" name="data[requirement_id]" class="offered_received">
                                                <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                            <td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php
                                                if ($v_info['rejected_status'] == 1) {
                                                    echo 'checked';
                                                }
                                                ?> type="checkbox" name="data[requirement_id]" class="rejected">
                                                <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>
                                            <!--<td><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php
                                                if ($v_info['comment_status'] == 1) {
                                                    echo 'checked';
                                                }
                                                ?> type="checkbox" name="data[requirement_id]" class="comment">
                                                <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>"></td>-->
                                            <td>
                                                <input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php
                                                if ($v_info['no_response_status'] == 1) {
                                                    echo 'checked';
                                                }
                                                ?> type="checkbox" name="data[requirement_id]" class="no_response">
                                                <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>">
                                            </td>
                                            <td>
                                                <a class="popup-with-zoom-anim" href="#my-dialog" <?php //if($v_info['accepted_status'] == 1){echo'href="#my-dialog"'; }           ?> ></a><input data-requirementid="<?php echo $v_info['requirement_id']; ?>" <?php
                                                    if ($v_info['accepted_status'] == 1) {
                                                        echo 'checked';
                                                    }
                                                    ?> type="checkbox" name="data[requirement_id]" class="accepted">
                                                <input  type="hidden" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>">
                                            </td>
                                            <td>
                                                <div class="comment_form">
                                                    <input type="text" name="new_comment" id="new_comment" class="new_comment">
                                                    <input  type="hidden" name="requirement_id" id="requirement_id" value="<?php echo $v_info['requirement_id']; ?>">
                                                    <input  type="hidden" name="property_id" id="property_id" value="<?php echo $property_id; ?>">
                                                    <input type="submit" name="submit" value="submit" class="submit_info">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </form>


                            <br style="clear:both"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="my-dialog" class="zoom-anim-dialog mfp-hide">
            <form id="dealsform" action="<?php echo BASE_URL; ?>admin_controller/save_data/" method="post">
                <h3>Add Deals</h3>
                <fieldset>
                    <div>
                        <label>Rent<span class="error" style="color:red">*</span></label>
						<div class="form-group">
							<input type="text" class="form-control" name="rent" id="rent">
                            <input type="hidden" class="form-control" name="requirement_id" id="requirement_id" value="<?php echo $requirement_id ?>">
                            <input type="hidden" class="form-control" name="property_id" id="property_id" value="<?php echo $property_id ?>">
                        </div>
                    </div>          
                    <div>
                        <label>Lease Length<span class="error" style="color:red">*</span></label>
                           <div class="form-group"><input type="text" class="form-control" name="lease_length" id="lease_length"></div>
                        
                    </div>
                    <div>
                        <label>Rent Free</label>
                           <div class="form-group"> <select name="rent_free" id="rent_free">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select></div>
                        
                    </div>
                    <div>
                        <label>Fit Out</label>
                             <div class="form-group"><select name="fit_out" id="fit_out">
                                <option value="tenant_fit_out">Tenant fit out</option>
                                <option value="ll_fit_out">LL fit out</option>
                            </select></div>
                        
                    </div>
                    <div>
                         <div class="form-group"><button type="submit" id="deals_submit" class="btn btn-primary deals_submit">Submit</button> </div>
                    </div>
                </fieldset>
            </form>

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
                        var url = baseurl + "admin_controller/save_offered_received_by_ajax/" + requireid + "-" + property_id + "-1";


                        save_data_by_ajax(url, $this);
                    }
                    else {
                        var url = baseurl + "admin_controller/save_offered_received_by_ajax/" + requireid + "-" + property_id + "-0";

                        save_data_by_ajax(url, $this);


                    }
                });
                $("body").delegate(".rejected", "click", function (e) {
                    e.preventDefault();
                    var requireid = $(this).attr('data-requirementid');
                    var property_id = $("#property_id").val();
                    $this = $(this);
                    if ($(this).is(':checked')) {
                        var url = baseurl + "admin_controller/save_rejected_by_ajax/" + requireid + "-" + property_id + "-1";


                        save_data_by_ajax(url, $this);
                    }
                    else {
                        var url = baseurl + "admin_controller/save_rejected_by_ajax/" + requireid + "-" + property_id + "-0";

                        save_data_by_ajax(url, $this);


                    }
                });
                $("body").delegate(".comment", "click", function (e) {
                    e.preventDefault();
                    var requireid = $(this).attr('data-requirementid');
                    var property_id = $("#property_id").val();
                    $this = $(this);
                    if ($(this).is(':checked')) {
                        var url = baseurl + "admin_controller/save_comment_by_ajax/" + requireid + "-" + property_id + "-1";


                        save_data_by_ajax(url, $this);
                    }
                    else {
                        var url = baseurl + "admin_controller/save_comment_by_ajax/" + requireid + "-" + property_id + "-0";

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
                        var url = baseurl + "admin_controller/save_accepted_by_ajax/" + requireid + "-" + property_id + "-1";


                        save_data_by_ajax(url, $this);
                       $('.popup-with-zoom-anim').trigger('click');
 
                    }
                    else {
                        var url = baseurl + "admin_controller/save_accepted_by_ajax/" + requireid + "-" + property_id + "-0";

                        save_data_by_ajax(url, $this);


                    }
                      





                });
                $(".submit_info").click(function (e) {
                    e.preventDefault();
                    $this=$(this);
                    var baseurl = '<?php echo BASE_URL; ?>';
                    var url = baseurl + "admin_controller/save_comment_new"
                    var new_comment = $(this).parent().children('#new_comment').val();
                    var requirement_id = $(this).parent().children("#requirement_id").val();
                    var property_id = $(this).parent().children("#property_id").val();
                    var dataString = 'new_comment=' + new_comment + '&requirement_id=' + requirement_id + '&property_id=' + property_id;
                    alert(dataString);
                    $.ajax({
                        // alert('khadiza');
                        type: 'POST',
                        data: dataString,
                        url: url,
                        success: function (data) {
                            
                             $this.parent(".comment_form").html(new_comment); 
                             //$this.parent(".comment_form").html(new_comment); 
                        }
                    });
                });

                    $(".deals_submit").click(function (e) {
                    e.preventDefault();
                    var baseurl = '<?php echo BASE_URL; ?>';
                    var url = baseurl + "admin_controller/save_data"
                    var rent = $("#rent").val();
                    var lease_length = $("#lease_length").val();
                    var rent_free = $("#rent_free").val();
                    var fit_out = $("#fit_out").val();
                    if (rent == '' || lease_length == '' ) {
                                alert('Please Give Rent And Lease_Length')
                            }
                            else{
                                $("#dealsform").submit();
                            }
                  
                    });




            });


        </script>
<script>

            

        </script>
        <?php include('footer_12.php'); ?>  
   