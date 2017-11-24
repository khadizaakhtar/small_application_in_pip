<!DOCTYPE html>
<html lang="en">
    <?php include('header_12.php'); ?>
    <style>
    .new_name {
    background-color: #fff;
    border: 1px solid #dde1e6;
   // height: 194px;
    margin-top: 30px;
    padding: 20px 20px 20px 25px;
    </style>
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
                                        <select name="rccheck" class="selectpicker" data-style="btn-select">
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>  

                                <div class="form-group full-width">
                                    <label  class="label-1">Re-site</label>
                                    <div class="select">
                                        <select name="resite"  class="selectpicker" data-style="btn-select">
                                            <option value="yes" <?php if (isset($_POST['resite']) && $_POST['resite'] == 'yes') {
                                                echo 'selected';
                                            } ?>>Yes</option>
                                            <option value="no" <?php if (isset($_POST['resite']) && $_POST['resite'] == 'no') {
                                                echo 'selected';
                                            } ?>>No</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group full-width">
                                    <label  class="label-1">Floor Area</label>
                                    <div class="border-box">
                                        <input type="text" name="floor_area_from" value="<?php if (isset($_POST['floor_area_from'])) echo $_POST['floor_area_from']; ?>" class="form-control"/>
                                        <span>to</span>
                                        <input type="text" name="floor_area_to" value="<?php if (isset($_POST['floor_area_to'])) echo $_POST['floor_area_to']; ?>" class="form-control"/>
                                    </div><br style="clear:both" />
                                </div>  
                                <div class="form-group full-width">
                                    <label class="label-1">Use Class</label>
                                    <div class="select">
                                        <select  name='use_class' class="selectpicker" data-style="btn-select">          
                                            <option value="A1" <?php if (isset($_POST['use_class']) && $_POST['use_class'] == 'A1') {
                                                echo 'selected';
                                            } ?>>A1</option>
                                            <option value="A2" <?php if (isset($_POST['use_class']) && $_POST['use_class'] == 'A2') {
                                                echo 'selected';
                                            } ?>>A2</option>
                                            <option value="A3" <?php if (isset($_POST['use_class']) && $_POST['use_class'] == 'A3') {
                                                echo 'selected';
                                            } ?>>A3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label  class="label-1">Staff Member</label>
                                    <div class="select">
                                        <select name='staff_id' class="selectpicker" data-style="btn-select">
                                          <?php foreach ($stafflist as $k => $v) { ?>
                                                <option <?php if (isset($_POST['staff_id']) && $_POST['staff_id'] == $k) {
                                             echo 'selected';
                                              } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="tabnr" style="display: none;">
                                            <table>
<!--                                                <thead>
                                                <td>Agent Name</td>
                                                <td>Agent Email</td>
                                                <td>Agent Phone</td>
                                                 <td>Is Primary</td>
                                                </thead> -->
                                            </table>   
                                </div>
                                <div class="form-group full-width">
                                    <button type="submit" id="publish"><i class="fa fa-floppy-o"></i> PUBLISH</button>
                                    <br style="clear:both" />
                                </div>    
                               
                                 <div id="show_agent" align="center">Add Agent</div>   
                              </form>
                            <form method="POST" action="">
                                <div class="agent_info" id="agent_info">
                                    <div class="form-group full-width">
                                        <label class="label-1">Agent Name<span class="error" style="color:red">*</span></label>
                                        <input type="text" id="agent_name" name="agent_name" value="<?php if (isset($_POST['agent_name'])) echo $_POST['agent_name']; ?>"  class="form-control" placeholder=""/>
                                        <div class="abc"> <span class="error" style="color:red"><?php
                                                if (isset($result['agent_name'])) {
                                                    echo $result['agent_name'];
                                                }if (isset($result['agent_name_error'])) {
                                                    echo $result['agent_name_error'];
                                                }
                                                ?></span></div>
                                    </div>  
                                    <div class="form-group full-width">
                                        <label class="label-1">Agent Email<span class="error" style="color:red">*</span></label>
                                        <input type="email" id="agent_email" name="agent_email" value="<?php if (isset($_POST['agent_email'])) echo $_POST['agent_email']; ?>" class="form-control" placeholder=""/>
                                        <div class="abc"><span class="error" style="color:red"><?php
                                                if (isset($result['agent_email'])) {
                                                    echo $result['agent_email'];
                                                }if (isset($result['agent_email_error'])) {
                                                  echo $result['agent_email_error'];
                                                }
                                                ?></span></div>
                                       </div>  
                                    <div class="form-group full-width">
                                        <label class="label-1">Agent Tel<span class="error" style="color:red">*</span></label>
                                        <input type="text" id="agent_phone_number" name="agent_phone_number" value="<?php if (isset($_POST['agent_phone_number'])) echo $_POST['agent_phone_number']; ?>" class="form-control" placeholder=""/>
                                           <div class="abc"><span class="error" style="color:red"><?php
                                                if (isset($result['agent_phone_number'])) {
                                                   echo $result['agent_phone_number'];
                                                }if (isset($result['contact_error'])) {
                                                    echo $result['contact_error'];
                                                }
                                                ?></span></div>
                                    </div>
                                    <div class="form-group full-width">
                                         <button type="submit" id="submit_info"><i class="fa fa-floppy-o"></i> PUBLISH</button>
                                         <br style="clear:both" />
                                     </div>
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

            var txt = this.value.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters list

            $txtval.push(txt);
            $('#town').val('$txtval');
            console.log($txtval);
            if (txt)
                $(this).before('<span class="tag">' + txt + '</span>');
            this.value = "";
            this.focus();
        }).on('keyup', function (e) {
            // comma|enter (add more keyCodes delimited with | pipe)
            if (/(188|13)/.test(e.which))
                $(this).focusout();
        });
        $('#tags').on('click', '.tag', function () {
            var tt = $(this).html();
            $txtval.pop(tt);

            $('#town').val('$txtval');
            console.log($txtval);
            $(this).remove();
        });

    });
 </script>
 
    <script>
        $( document ).ready(function() {
            $('#agent_info').hide();
             $("#show_agent").click(function(){
                 $("#agent_info").show();
               });
               
        $("#submit_info").click(function(e) {
           e.preventDefault();
            $('#tabnr').show();  
           var baseurl = '<?php echo BASE_URL; ?>';
           var url= baseurl + "admin_controller/save_agent_info/"
           var agent_name = $("#agent_name").val(); 
           var agent_email = $("#agent_email").val();
           var agent_phone_number = $("#agent_phone_number").val();
           var dataString = 'agent_name='+agent_name+'&agent_email='+agent_email+'&agent_phone_number='+agent_phone_number;
             alert(dataString);
          $.ajax({
             // alert('khadiza');
             type:'POST',
             data:dataString,
             url:url,
              success:function(data) {       
               alert(data);
               $("#tabnr").append(data); 
       }
  });
});

 //$('#tabnr').hide();
   
           });
    </script>
<?php include('footer_12.php'); ?>
  