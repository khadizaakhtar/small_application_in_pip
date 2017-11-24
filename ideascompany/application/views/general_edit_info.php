<!DOCTYPE html>
<html lang="en">
    <?php include('header_12.php');
?>
    <body>
        <div id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                            <li class="active">EDIT REQUIREMENT</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <?php 
                            foreach($result2 as $v_info){
                               $t= $v_info['town'];
                               $town=unserialize($t);
                               if($town!=""){
                                   $new= implode(" ,",$town);
                                   }

                               if(!is_array($town)){
                                   $town = array();
                               }
                            }
                            ?>
                            <h3 class="content-title">EDIT REQUIREMENTS</h3>
                            <form action="<?php echo BASE_URL; ?>/admin_controller/update_general_info" method="post">
                                
                                <div class="form-group full-width">
                                    <label for="tenantName" class="label-1">Tenant Name</label>
                                    <input type="text" name="tenant_name" id="tenantName" value="<?php echo $v_info['tenant_name']; ?>" class="form-control" placeholder=""/>   
                                    <input type="hidden" class="form-control" name="requirement_id" value="<?php echo $v_info['requirement_id']; ?>">
                                   
                                </div>  
                                
                                <div class="form-group full-width">
                                    <label class="label-1">Towns</label>
                                    <div id="tags">
				 <input type="hidden" id="townvalue" name="townvalue" value="<?php echo $new; ?>" class="form-control" placeholder=""/>
                                   
                                        <input type="text" name="town"    id="town" class="text-center" placeholder="Add" />
                                        <button type="button" id="addTag">ADD</button>
										<?php foreach($town as $k=>$v_town){?>
										<span class="tag"><?php echo  $v_town;?></span>
										<?php }?>
                                    </div><br style="clear:both" />
                                </div>
                                
                                <div class="form-group full-width">
                                    <label  class="label-1">Nationwide</label>
                                    <div class="select">
                                        <select name="rccheck" class="selectpicker" data-style="btn-select">
                                            <option value="no"<?php if (($v_info['rccheck'])=='yes') echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group full-width">
                                    <label  class="label-1">Re-site</label>
                                    <div class="select">
                                        <select name="resite"  class="selectpicker" data-style="btn-select">
                                            <option value="yes"<?php if (($v_info['resite'])=='yes') echo 'selected'; ?>>Yes</option>
                                            <option value="no" <?php if (($v_info['resite'])=='no') echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group full-width">
                                    <label  class="label-1">Floor Area</label>
                                    <div class="border-box">
                                        <input type="text" name="floor_area_from" value="<?php echo $v_info['floor_area_from']; ?>" class="form-control"/>
                                        <span>to</span>
                                        <input type="text" name="floor_area_to" value="<?php echo $v_info['floor_area_to']; ?>" class="form-control"/>
                                    </div><br style="clear:both" />
                                </div>
                                
                                 <div class="form-group full-width">
                                    <label class="label-1">Use Class</label>
                                    <div class="select">
                                        <select  name='use_class' class="selectpicker" data-style="btn-select">          
                                            <option value="A1" <?php if (($v_info['use_class'])=='A1') echo 'selected'; ?>>A1</option>
                                            <option value="A2" <?php if (($v_info['use_class'])=='A2') echo 'selected'; ?>>A2</option>
                                            <option value="A3" <?php if (($v_info['use_class'])=='A3') echo 'selected'; ?>>A3</option>
                                        </select>
                                    </div>
                                </div> 
                                
                                
                                <div class="form-group full-width">
                                    <label  class="label-1">Staff Member</label>
                                    <div class="select">
                                        <select name='staff_id'  class="selectpicker" data-style="btn-select">
                                            <?php foreach ($stafflist as $k => $v) { ?>
                                                <option <?php if($v_info['staff_id']==$k) echo 'selected';?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                 <div class="row" id="tabnr" style="display: none;">
                                    <table id="tablenrr" class="table table-hover">
                                        <tr id="tabhead">
                                            <td>Agent Name</td>
                                            <td>Agent Email</td>
                                            <td>Agent Phone</td>
                                            <td>Is Primary</td>
                                        </tr>
                                    </table>   
                                 </div>
                                
                                
                                <div id="agentdt">
                                    
                                          <?php 
                                          foreach($result as $k=>$v_result){
                                          // $agent_name=$v_result['agent_name'];
                                          ?>
										  <div class="agent_container_cls" id="<?php $nn=$k+1; echo 'agent_container_'.$nn; ?>">
                                        <div class="form-group full-width" >
                                            <label class="label-1"><?php if($k==0)echo 'Agent Name';else  echo 'Agent Name'.$nn;?><span class="error" style="color:red">*</span></label>
                                            <input type="text" id="agent_name" name="agent_name[]" value="<?php echo $v_result['agent_name']; ?>"  class="form-control" id="agent_name" placeholder=""/>
                                            <input type="hidden" id="agent_id" name="agent_id[]" value="<?php echo $v_result['agent_id']; ?>" class="form-control"/>                                           
                                        </div> 
                                        
                                        <div class="form-group full-width">
                                            <label class="label-1"><?php if($k==0)echo 'Agent Email';else echo 'Agent Email'.$nn;?><span class="error" style="color:red">*</span></label>
                                            <input type="email" id="agent_email" name="agent_email[]" value="<?php echo $v_result['agent_email']; ?>" id="agent_email" class="form-control" placeholder=""/>
                                        </div> 
                                        
                                        <div class="form-group full-width">
                                            <label class="label-1"><?php if($k==0)echo 'Agent Tel';else echo 'Agent Tel'.$nn;?><span class="error" style="color:red">*</span></label>
                                            <input type="text" name="agent_tel[]" id="agent_tel" value="<?php echo $v_result['agent_phone_number']; ?>" class="form-control" placeholder=""/>

                                        </div>
											</div>
										 <?php } ?>
                                    

                                    <div class="form-group row" >
                                        <button type="button" class="btn btn-success pull-right" onclick="add_new_agent();">Add Another Agent</button>
                                    </div>
                                    <div class="form-group row">
                                        <button type="submit" id="publish"><i class="fa fa-floppy-o"></i> PUBLISH</button>
                                       
                                    </div>

                                </div>
                                
                                
                                
                                <div class="form-group full-width publish">
                                    <button type="submit" id="publish"><i class="fa fa-floppy-o"></i> PUBLISH</button>
                                    <br style="clear:both" />
                               </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script  type="text/javascript">
                     $(function () {
                     var tv=$('#townvalue').val();
					 var res = tv.split(","); 
					 
                     $txtval = [];
					 $.each( res, function( key, value ) {
   $txtval.push(value);
});
					 console.log($txtval);
                     $('#tags input').on('focusout', function () {
                     
                     var txt = this.value;//.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters list
                     
                     $txtval.push(txt);
                     $('#townvalue').val($txtval);
                     console.log($txtval);
                     if (txt)
                     $(this).before('<span class="tag">' + txt + '</span>');
                     this.value = "";
                     //this.focus();
                     }).on('keyup', function (e) {
                     // comma|enter (add more keyCodes delimited with | pipe)
                     if (/(188|13)/.test(e.which))
                     $(this).focusout();
                     });
                     $('#tags').on('click', '.tag', function () {
                     var tt = $(this).html();
                     $txtval.pop(tt);
                     
                     $('#townvalue').val($txtval);
                     console.log($txtval);
                     $(this).remove();
                     });
                     
                     });
                </script>
                
                
                
                <script type="text/javascript">
            var agent_number = $(".agent_container_cls").length;
            function add_new_agent()
            {
                agent_number++;

                var contents = '<div  id="agent_container_' + agent_number + '">'
                        + '<div class="form-group full-width col-md-12 rs_no_padding" >'
                        + '<label class="label-1">Agent  Name ' + agent_number + '</label>'
                        + '<div class="border-box">'
                        + '<input type="text" class="form-control" placeholder="Enter Agent Name" name="agent_name[]">'
                        + '</div>'
                        + '</div>'
                        + '<div class="form-group full-width col-md-12 rs_no_padding" >'
                        + '<label class="label-1">Agent  Email ' + agent_number + '</label>'
                        + '<div class="border-box">'
                        + '<input type="email" class="form-control" placeholder="Enter Agent Email" name="agent_email[]">'
                        + '</div>'
                        + '</div>'
                        + '<div class="form-group full-width col-md-12 rs_no_padding" >'
                        + '<label class="label-1">Agent Tel ' + agent_number + '</label>'
                        + '<div class="border-box">'
                        + '<input type="text" class="form-control" placeholder="Enter Agent Tel" name="agent_tel[]">'
                        + '</div>'
                        + '</div>';

                jQuery('div[id=agent_container_' + (agent_number - 1) + ']').after(contents);

            }
        </script>
        <script>
            $(document).ready(function () {
			//alert();
                var baseurl = '<?php echo BASE_URL; ?>';
                function save_data_by_ajax(url, $this) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {

                            if (data == 'Set') {
                                $this.prop("checked", true);
                            } else if (data == 'Unset') {
                                $this.prop("checked", false);
                            } else {
                                alert("There is something wrong");
                            }

                        }
                    });
                }


                $('.publish').hide();
                $("#publish").click(function (e) {
                    // alert('jdfhd'); 

                    e.preventDefault();
                    //$('#tabnr').show();  
                    var baseurl = '<?php echo BASE_URL; ?>';
                    var url = baseurl + "admin_controller/update_agent_info/"
                    var agent_name = $("#agent_name").val();
                    var agent_email = $("#agent_email").val();
                    var agent_tel = $("#agent_tel").val();
                    var agent_id = $("#agent_id").val();
                    if (agent_name == '' || agent_email == '' || agent_tel == '') {
                        alert('Please Give Agent Name, EMail And Phone ')
                    } else {

                        var dataString = $("#agentdt :input").serialize();//'agent_name='+agent_name+'&agent_email='+agent_email+'&agent_tel='+agent_tel;
                        alert(dataString);
                        $.ajax({
                            // alert('khadiza');
                            type: 'POST',
                            data: dataString,
                            url: url,
                            success: function (data) {
                                //alert(data);
                                $("#tablenrr").append(data);
                                $('#tabnr').show();
                                $('#agentdt').remove();
                                // $("#tabnr").append(data); 
                                $('.publish').show();
                            }
                        });

                    }


                    $("body").delegate(".isprimary", "click", function (e) {
                        e.preventDefault();
                        var agentid = $(this).attr('data-agentid');

                        $this = $(this);
                        if ($(this).is(':checked')) {
                            var url = baseurl + "admin_controller/save_agentisprimary/" + agentid + "-1";
                            save_data_by_ajax(url, $this);
                        }
                        else {
                            var url = baseurl + "admin_controller/save_agentisprimary/" + agentid + "-0";

                            save_data_by_ajax(url, $this);


                        }
                    });




                });
            });
        </script>
        
         <style>
            .rs_no_padding{padding: 0 ;}
        </style>
        
                
                
                
                
                
        <?php include('footer_12.php'); ?>
  
