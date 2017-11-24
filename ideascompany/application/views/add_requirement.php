<!DOCTYPE html>
<html lang="en">
    <?php include('header_12.php'); ?>
    <body>
        <div id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                            <li class="active">ADD PROPERTY</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <h3 class="content-title">ADD REQUIREMENTS</h3>
                            <div style="color:green; text-align: center">
                                <?php
                                if (isset($resmsg) && !empty($resmsg)) {
                                    echo $resmsg;
                                }
                                ?>
                            </div>
                            <form action="#" method="post">
                                <div class="form-group full-width">
                                    <label for="tenantName" class="label-1">Tenant Name<span class="error" style="color:red">*</span></label>
                                    <input type="text" name="tenant_name" id="tenantName" value="<?php if (isset($_POST['tenant_name'])) echo $_POST['tenant_name']; ?>" class="form-control" placeholder=""/>
                                    <input type="hidden" id="townvalue" name="townvalue"  class="form-control" placeholder=""/>
                                    <div class="abc">
                                        <span class="error" style="color:red"><?php
                                            if (isset($result['tanent_name'])) {
                                                echo $result['tanent_name'];
                                            }if (isset($result['tanent_name_error'])) {
                                                echo $result['tanent_name_error'];
                                            }
                                            ?></span></div>
                                </div> 
                                <div class="form-group full-width">
                                    <label class="label-1">Towns<span class="error" style="color:red">*</span></label>
                                    <div id="tags">

                                        <input type="text" name="town"  id="town" class="text-center" placeholder="Add" />
                                        <button type="button" id="addTag">ADD</button>
                                    </div><br style="clear:both" />
                                    <div class="abc"><span class="error" style="color:red"><?php
                                            if (isset($result['town'])) {
                                                echo $result['town'];
                                            }if (isset($result['town_error'])) {
                                                echo $result['town_error'];
                                            }
                                            ?>
                                        </span></div>
                                </div>
                                <div class="form-group full-width">
                                    <label  class="label-1">Nationwide</label>
                                    <div class="select">
                                        <select name="rccheck" value="<?php if (isset($_POST['rccheck'])) echo $_POST['rccheck']; ?>"  class="selectpicker" data-style="btn-select">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group full-width">
                                    <label  class="label-1">Re-site</label>
                                    <div class="select">
                                        <select name="resite"  class="selectpicker" data-style="btn-select">
                                            <option value="yes" <?php
                                            if (isset($_POST['resite']) && $_POST['resite'] == 'yes') {
                                                echo 'selected';
                                            }
                                            ?>>Yes</option>
                                            <option value="no" <?php
                                            if (isset($_POST['resite']) && $_POST['resite'] == 'no') {
                                                echo 'selected';
                                            }
                                            ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group full-width">
                                    <label  class="label-1">Floor Area</label>
                                    <div class="border-box">
                                        <input type="text" name="floor_area_from" value="<?php if (isset($_POST['floor_area_from'])) echo $_POST['floor_area_from']; ?>" class="form-control floor_area_from "/>
                                        <span>to</span>
                                        <input type="text" name="floor_area_to" value="<?php if (isset($_POST['floor_area_to'])) echo $_POST['floor_area_to']; ?>" class="form-control floor_area_to"/>
                                    </div><br style="clear:both" />
                                </div> 
                                <div class="form-group full-width">
                                    <label class="label-1">Use Class</label>
                                    <div class="select">
                                        <select  name='use_class' value="<?php if (isset($_POST['use_class'])) echo $_POST['use_class']; ?>" class="selectpicker" data-style="btn-select">
                                            <option value="A1">A1</option>
                                            <option value="A1/A3">A1/A3</option>
                                            <option value="A2">A2</option>
                                            <option value="A3">A3</option>
                                            <option value="A4">A4</option>
                                            <option value="A5">A5</option>
                                            <option value="B1">B1</option>
                                            <option value="B2">B2</option>
                                            <option value="B8">B8</option>
                                            <option value="C1">C1</option>
                                            <option value="C2">C2</option>
                                            <option value="C3">C3</option>
                                            <option value="C4">C4</option>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="Sui Generis">Sui Generis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group full-width">
                                    <label  class="label-1">Staff Member</label>
                                    <div class="select">
                                        <select name='staff_id' value="<?php if (isset($_POST['staff_id'])) echo $_POST['staff_id']; ?>" class="selectpicker" data-style="btn-select">
                                            <?php foreach ($stafflist as $k => $v) { ?>
                                                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
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
                                <div id="agent_container_1">
								
                                    <div class="form-group full-width" >
                                        <label class="label-1">Agent Name<span class="error" style="color:red">*</span></label>
                                        <input type="text" id="agent_name" name="agent_name[]"  class="form-control" id="agent_name" placeholder=""/>
                                    </div>  
                                    <div class="form-group full-width">
                                        <label class="label-1">Agent Email<span class="error" style="color:red">*</span></label>
                                        <input type="email" id="agent_email" name="agent_email[]" id="agent_email" class="form-control" placeholder=""/>
                                    </div>  
                                    <div class="form-group full-width">
                                        <label class="label-1">Agent Tel<span class="error" style="color:red">*</span></label>
                                        <input type="text" name="agent_tel[]" id="agent_tel"  class="form-control" placeholder=""/>

                                    </div>
                                </div>
							
								<div class="form-group row" >
                                    <button type="button" class="btn btn-success pull-right" onclick="add_new_agent();">Add Another Agent</button>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" id="publish"><i class="fa fa-floppy-o"></i> PUBLISH</button>
                                    
                                </div>
							
							</div>
                                
                                <div class="form-group publish">
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
                $txtval = [];
                $('#tags input').on('focusout', function () {
                 //alert('test');
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
            var agent_number = 1;
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
              $( document ).ready(function() {
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
                     $("#publish").click(function(e) {
                       // alert('jdfhd'); 
                         
              e.preventDefault();
            //$('#tabnr').show(); 

          var letterNumber = /^[0-9,]/;   
          var baseurl = '<?php echo BASE_URL; ?>';
          var url= baseurl + "admin_controller/save_agent_info/"
          var agent_name = $("#agent_name").val(); 
          var agent_email = $("#agent_email").val();
          var agent_tel = $("#agent_tel").val();
          var floor_from= $(".floor_area_from").val();
          var floor = $(".floor_area_to").val();
          if(floor!=""){
              if(!(floor.match(letterNumber))){
                alert('Floor Area To is wrong');
                return false;
              } 
          }
          
          if(floor!=""){
              if(!(floor_from.match(letterNumber))){
                alert('Floor Area From is wrong');
                return false;
              } 
          }



          if (agent_name == '' || agent_email == '' || agent_tel == '') {
               alert('Please Give Agent Name, EMail And Phone ')
                            } else {
                            
          var dataString = $("#agentdt :input").serialize();//'agent_name='+agent_name+'&agent_email='+agent_email+'&agent_tel='+agent_tel;
            alert(dataString);
          $.ajax({
             // alert('khadiza');
             type:'POST',
             data:dataString,
             url:url,
             success:function(data) {       
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