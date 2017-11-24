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
        }	table.font-small {font-size: 13px; margin-top: 0;}.paragraph-margin-zero p{margin: 0;}.row-border{ padding-bottom: 10px;margin-bottom: 10px;	border-bottom: 1px solid #dde1e6;}.row-border:last-child{	border: 0;}.overflow-auto {	widht: 100%;	overflow: auto;}.box-right-one {	max-width: 80%;	margin: 0 auto;	padding: 5px 10px;	color: #fff!important;	font-size: 11px!important;	line-height: 16px;	font-family: Arial;	background-color: #69c5ee;}.box-right-one  table {	width: 100%;	border: 0;}.box-right-one  table tr td{	font-size: 13px!important;	line-height: 16px;	font-family: Arial;	color: #fff!important;	padding: 3px 2px;}
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
                            <form>
                                <div class="form-group ">    
                                    <?php
//                                    print_r($result);
//                                    exit;
                                    foreach ($result as $v_info) {
                                         $property_id = $v_info['property_id'];
                                        ?><div class="row row-border">
                                            <div  class="col-sm-6 paragraph-margin-zero">
                                            <div class="input-group">
                                            <h3><?php echo $v_info['tenant_name']; ?></h3>    
                                            <p>Address:<?php echo $v_info['address_line1']; ?></p>
                                            <p>Use Class:<?php echo $v_info['use_class']; ?></p>
                                            <p>Floor Area:<?php echo $v_info['floor_area']; ?> sq ft</p>
                                            </div>
                                            </div>
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
                                <div class="overflow-auto">
                                <table class='table table-hover font-small deals-table'>
                                    <tr>
                                        <td>Photo</td>
                                        <td>Address</td>
                                        <td>Use Class</td>
                                        <td>Site Area</td>
                                        <td>Rejected</td>
                                         <td>Offered On</td>
                                        <td>Accepted</td>
                                        <td>Comment</td>
                                    </tr>
                                    <?php
                                    foreach ($result as $v_info) {
                                        $requirement_id = $v_info['requirement_id'];
                                        $date=$v_info['offered_on'];
                                        $formatted_date = date('m/d/Y', strtotime($date));
                                         $t=$v_info[2];
                                          $town=unserialize($t);
                                             ?>
                                        <tr>
                                            <td><img height="76" width="106" class="img-responsive" src="<?php echo BASE_URL .'uploads/'. $v_info['image'] ?>"></td>
                                             <td><?php foreach($town as $k=>$v_town){ echo $v_town.","; }?></td>
                                             <td align="center"><?php echo $v_info['use_class'] ?></td>
                                            <td align="center">
                                                <?php echo $v_info['site_area']; ?>
                                             </td>
                                                
                                            <td align="center">
                                                 <?php echo $v_info['rejected']; ?>
                                            </td>
                                           
                                            <td align="center">
                                                 <?php echo $formatted_date; ?>
                                            </td>
                                            <td align="center">
                                               <?php echo $v_info['accepted'] ?>
                                            </td>
                                            <td>
                                                <div class="comment_form">
                                                    <input type="text" name="new_comment" id="new_comment" class="new_comment">
                                                    <input  type="hidden" name="requirement_id" id="requirement_id" value="<?php echo $v_info['requirement_id']; ?>">
                                                    <input  type="hidden" name="property_id" id="property_id" value="<?php echo $v_info['property_id'];; ?>">
                                                    <input type="submit" name="submit" value="submit" class="submit_info">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>								</div>
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
                        <label>Rent<span class="error" style="color:red">*</span> </label>						<div class="form-group">
                            <input type="text" class="form-control" name="rent" id="rent">
                            <input type="hidden" class="form-control" name="requirement_id" id="requirement_id" value="<?php echo $requirement_id ?>">
                            <input type="hidden" class="form-control" name="property_id" id="property_id" value="<?php echo $property_id ?>">
                       </div>
                    </div>          
                    <div>
                        <label>Lease Length<span class="error" style="color:red">*</span> </label>
                            <div class="form-group"><input type="text" name="lease_length" class="form-control" id="lease_length"></div>
                       
                    </div>
                    <div>
                        <label>Rent Free </label>						
                        <div class="form-group">
                            <select name="rent_free" id="rent_free" class="form-control">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                       </div>
                    </div>
                    <div>
                        <label>Fit Out  </label>						
                        <div class="form-group">
                            <select name="fit_out" id="fit_out" class="form-control">
                                <option value="tenant_fit_out">Tenant fit out</option>
                                <option value="ll_fit_out">LL fit out</option>
                            </select>
                      </div>
                    </div>
                    <div>
                        <button type="submit" id="deals_submit" class="btn btn-primary deals_submit">Submit</button> 
                    </div>
                </fieldset>
            </form>   

        </div> 
<script>

 $(document).ready(function () {

$(".submit_info").click(function (e) {
                    e.preventDefault();
                    $this=$(this);
                    var baseurl = '<?php echo BASE_URL; ?>';
                    var url = baseurl + "admin_controller/save_comment_new3";
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
                
                
                   
            });
</script>     
        <?php include('footer_12.php'); ?>  
   