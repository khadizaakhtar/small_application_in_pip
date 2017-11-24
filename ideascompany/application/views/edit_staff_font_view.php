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
                  <li class="active">UPDATE STAFF</li>
                </ol>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3 class="content-title">ADD STAFF</h3>
                     <form action="<?php echo BASE_URL; ?>/admin_controller/update_font_staff" method="post">
                        <div class="form-group full-width">
                            <label for="Name" class="label-1">Name</label>
                            <input type="text" name="user_name" id="tenantName" value="<?php echo $result[0][1]; ?>" class="form-control" placeholder=""/>
                            <input type="hidden" class="form-control" name="user_id" value="<?php echo $result[0][0]; ?>">
                        </div> 
                        
                         <div class="form-group full-width">
                            <label for="user_email_address" class="label-1">Email</label>
                            <input type="email" name="user_email_address" value="<?php echo $result[0][3]; ?>" id="tenantName" class="form-control" placeholder=""/>
                        </div> 
                        
                        <div class="form-group full-width">
                            <label for="user_email_address" class="label-1">Password</label>
                            <input type="text" name="user_password" id="tenantName" value="<?php echo $result[0][2]; ?>" class="form-control" placeholder=""/>
                        </div>  
                          <div class="form-group full-width">
                            <label for="user_email_address" class="label-1">Access Level</label>
                            <input type="text" name="access_label" id="tenantName" value="<?php echo $result[0][4]; ?>" class="form-control" placeholder=""/>
                        </div> 
                         <div class="form-group full-width">
                            <button type="submit" id="publish"><i class="fa fa-floppy-o"></i> UPDATE</button>
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
