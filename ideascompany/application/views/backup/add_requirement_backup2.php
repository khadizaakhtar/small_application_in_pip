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

                                        <input type="text" id="town" class="text-center" value="<?php if (isset($_POST['town'])) echo $_POST['town']; ?>" name="town" placeholder="Add" />
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
                                        <select  name='use_class' value="<?php if (isset($_POST['use_class'])) echo $_POST['use_class']; ?>" class="selectpicker" data-style="btn-select">
                                            <option value="A1">A1</option>
                                            <option value="A2">A2</option>
                                            <option value="A3">A3</option>
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

                                <div class="panel-body">
                                    <div class="attach_file_upload">
                                        <div id="additionalimage" class="tab-pane">
                                            <div class="form-group full-width" id="upload_block">
                                                    <div data-provides="fileupload" class="fileupload fileupload-new form-group full-width">
                                                        <label class="label-1">Agent Name</label>
                                                        <input type="text" class="attach-upload form-control" name="agent_name[]"><br/>
                                                         <label class="label-1">Agent Email</label>
                                                        <input class="form-control" name="agent_email[]" id="username" type="text"/><br/>
                                                        <label class="label-1">Agent Phone Number</label>
                                                        <input class="form-control" name="agent_phone_number[]" id="username" type="text"/>
                                                        <input type="checkbox" name="is_primary[]">Is_Primary
                                                    </div>                       
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="addinv">
                                        <a href="#" class="btn upload_more"><i class="fa fa-plus"></i> Add New Agent</a>                   
                                    </div>
                                    <br>
                                    <br>

                                </div>
                                <div class="form-group full-width">
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
            $(function() {
                $txtval = [];
                $('#tags input').on('focusout', function() {

                    var txt = this.value.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters list

                    $txtval.push(txt);
                    $('#town').val('$txtval');
                    console.log($txtval);
                    if (txt)
                        $(this).before('<span class="tag">' + txt + '</span>');
                    this.value = "";
                    this.focus();
                }).on('keyup', function(e) {
                    // comma|enter (add more keyCodes delimited with | pipe)
                    if (/(188|13)/.test(e.which))
                        $(this).focusout();
                });
                $('#tags').on('click', '.tag', function() {
                    var tt = $(this).html();
                    $txtval.pop(tt);

                    $('#town').val('$txtval');
                    console.log($txtval);
                    $(this).remove();
                });

            });



        </script>
        <script>
            $(document).ready(function() {
               // alert('khadiza');
           
                $('body').delegate('.delete_this', 'click', function(e) {
                    e.preventDefault();
                    // alert('moriyum');
                    $(this).parent('.tab-pane').remove();
                });

                $('body').delegate('.clear_upload', 'click', function(e) {
                    e.preventDefault();
                     alert('acia');
                    //$(".attach-upload").val('');
                    $("#additionalimage").find('.attach-upload').val('');
                    //control.replaceWith( control = control.clone( true ) );
                });

                $('body').delegate('.upload_more', 'click', function(e) {
                    e.preventDefault();
                    var new_block = $('#additionalimage').clone();
                    new_block.removeAttr('id');

                    //new_block.find().children('input').val('');
                    new_block.find('input').val('');
                    new_block.find('.upload_more').remove();
                    new_block.find('.clear_upload').remove();
                    //$('.example a#link').replaceWith($('.example a#link').text());

                    new_block.append('<a style="margin-top:2px;margin-left:0px;" href="#" class="btn btn-xs delete_this"><i class="fa fa-trash"></i></a>')


                    //$('#additionalimage').before(new_block);
                    $('.attach_file_upload').append(new_block);
                });
            });
        </script>
        <?php include('footer_12.php'); ?>