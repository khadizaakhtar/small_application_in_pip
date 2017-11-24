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
                  <li class="active">ADD STAFF</li>
                </ol>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3 class="content-title">ADD STAFF</h3>
                     <div style="color:green; text-align: center">
                    <?php
                    if (isset($resmsg) && !empty($resmsg)) {
                        echo $resmsg;
                      }
                    ?>
                    </div>
                    
                    <form action="<?php echo BASE_URL; ?>/admin_controller/add_staff" method="post">
                        <div class="form-group full-width">
                            <label for="Name" class="label-1">Name<span class="error" style="color:red">*</span></label>
                            <input type="text" name="user_name" id="tenantName" value="<?php if(isset($_POST['user_name'])) echo $_POST['user_name']; ?>" class="form-control" placeholder=""/>
                           <div class="abc"> <span class="error" style="color:red"><?php
                            if (isset($result['user_name'])) {
                                echo $result['user_name'];
                            }if (isset($result['user_name_error'])) {
                                echo $result['user_name_error'];
                            }
                            ?></span>
                           </div>
                        </div> 
                        
                         <div class="form-group full-width">
                            <label for="user_email_address" class="label-1">Email<span class="error" style="color:red">*</span></label>
                            <input type="email" name="user_email_address" value="<?php if(isset($_POST['user_email_address'])) echo $_POST['user_email_address']; ?>" id="tenantName" class="form-control" placeholder=""/>
                           <div class="abc"> <span class="error" style="color:red"><?php
                            if (isset($result['user_email_address_error'])) {
                                echo $result['user_email_address_error'];
                            } if (isset($result['user_email_address'])) {
                                echo $result['user_email_address'];
                            }
                            ?></span>   
                           </div>
                        </div> 
                        
                        <div class="form-group full-width">
                            <label for="user_email_address" class="label-1">Password<span class="error" style="color:red">*</span></label>
                            <input type="text" name="user_password" id="tenantName" value="<?php if(isset($_POST['user_password'])) echo $_POST['user_password']; ?>" class="form-control" placeholder=""/>
                           <div class="abc"><span class="error" style="color:red"><?php
                            if (isset($result['user_password'])) {
                                echo $result['user_password'];
                            }
                            ?></span>  
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




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
	$('.form-file').change( function() {    
   $(this).next('.ahah-processed').click();
});    



	</script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <?php include('footer_12.php'); ?>  
  </body>
</html>
