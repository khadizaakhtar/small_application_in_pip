<!DOCTYPE html>
<html lang="en">
<?php include('header_12.php'); ?>
<body>
<div id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <ol class="menu-list">
                  <li class="home"><a href="<?php echo BASE_URL.'admin_controller/search_requirements'; ?>">Home</a></li>
                  <li class="active">ADD PROPERTY</li>
                </ol>
                </div>
            </div>
           
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3 class="content-title">ADD A PROPERTY</h3>
                     <div style="color:green; text-align: center">
                    <?php
                    if (isset($resmsg) && !empty($resmsg)) {
                        echo $resmsg;
                      }
                    ?>
                    </div>
                   <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group full-width">
                            <label for="addressLine1" class="label-1">Address Line 1<span style="color:red">*</span></label>
                            <input type="text" name="address_line1" id="addressLine1" value="<?php echo $result[0][1]; ?>" class="form-control" placeholder=""/>
                              <input type="hidden" class="form-control" name="property_id" value="<?php echo $result[0][0]; ?>">*
                            <div class="abc"><span class="error" style="color:red" ><?php
                            if (isset($result['address_line1'])) {
                                echo $result['address_line1'];
                            }
                            ?></span></div>
                        </div>  
                        <div class="form-group full-width">
                            <label for="addressLine2" class="label-1">Address Line 2</label>
                            <input type="text" name="address_line2" id="addressLine2" value="<?php echo $result[0][2]; ?>" class="form-control" placeholder=""/>
                        </div>
                        <div class="form-group full-width">
                            <label for="addressLine3" class="label-1">Address Line 3</label>
                            <input type="text" name="address_line3" id="addressLine3" class="form-control" value="<?php echo $result[0][3]; ?>" placeholder=""/>
                        </div>  
                        <div class="form-group full-width">
                            <label for="town" class="label-1">Town<span style="color:red">*</span></label>
                            <input type="text" name="town" id="town" class="form-control" value="<?php echo $result[0][4]; ?>" placeholder=""/>
                            <div class="abc"><span class="error" style="color:red"><?php
                            if (isset($result['town'])) {
                                echo $result['town'];
                            } if (isset($result['town_name_error'])) {
                                echo $result['town_name_error'];
                            }
                            ?></span></div>
                        </div>  
                        <div class="form-group full-width">
                            <label for="county" class="label-1">County</label>
                            <input type="text" name="country" id="county" value="<?php echo $result[0][5]; ?>" class="form-control" placeholder=""/>
                        </div>
                        <div class="form-group full-width">
                            <label for="postCode" class="label-1">Postcode</label>
                            <input type="text" name="postcode" id="postCode" value="<?php echo $result[0][6]; ?>" class="form-control" placeholder=""/>
                        </div>  
                        <div class="form-group full-width">
                            <label for="floorArea" class="label-1">Ground Floor Sales Area<span style="color:red">*</span></label>
                            <input type="text" name="floor_area" id="floorArea" class="form-control" value="<?php echo $result[0][7]; ?>" placeholder=""/>
                           <div class="abc"> <span class="error" style="color:red"><?php
                            if (isset($result['floor_area'])) {
                                echo $result['floor_area'];
                            }
                            ?></span>
                           </div>
                        </div>
                       
                        <div class="form-group full-width">
                            <label for="floorArea" class="label-1">Ancillary area</label>
                            <input type="text" name="ancillary_area" id="floorArea" class="form-control" value="<?php echo $result[0][10]; ?>" placeholder=""/>
                        </div> 
                       
                       <div class="form-group full-width">
                            <label for="floorArea" class="label-1">Site area</label>
                            <input type="text" name="site_area" id="floorArea" class="form-control" value="<?php echo $result[0][11]; ?>" placeholder=""/>
                        </div> 
                       
                        <div class="form-group full-width">
                            <label for="useClass" class="label-1">Use Class</label>
                            <input type="text" name="use_class" id="useClass" value="<?php echo $result[0][8]; ?>" class="form-control" placeholder=""/>
                        </div>

                        <div class="form-group full-width">
                            <label for="useClass" class="label-1">Photo</label>
                            <div class="divRight">
                            <input type="file" id="myFileInput" onchange="readURL(this);" value="<?php if(isset($_POST['image'])) echo $_POST['image']; ?>" name='image' />
                            <button id="select-file" type="button" onclick="document.getElementById('myFileInput').click()"><i class="fa fa-plus-circle"></i> SELECT FILE</button>
                            <span id="message"  style="color:green"></span>
                            </div>
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


        
        </div>
    </div>
<script  type="text/javascript">
$(function(){
          $txtval = []; 
          $('#tags input').on('focusout', function(){ 
          
            var txt= this.value.replace(/[^a-zA-Z0-9\+\-\.\#]/g,''); // allowed characters list
             
            $txtval.push(txt);
            $('#town').val('$txtval');
           console.log($txtval);
            if(txt) $(this).before('<span class="tag">'+ txt +'</span>');
            this.value="";
            this.focus();
          }).on('keyup',function( e ){
            // comma|enter (add more keyCodes delimited with | pipe)
            if(/(188|13)/.test(e.which)) $(this).focusout();
          });         
          $('#tags').on('click','.tag',function(){
            var tt=$(this).html();
            $txtval.pop(tt);

            $('#town').val('$txtval');
             console.log($txtval);
             $(this).remove(); 
          });

        });



</script>
<script type="text/javascript">
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#message').html('File has been selected');
                    },

                    reader.readAsDataURL(input.files[0]);
                    console.log(input.files[0]);
                }
            }

            $("#myFileInput").change(function () {
                readURL(this);
            });
 </script>
<?php include('footer_12.php'); ?>  
</body>
</html>
