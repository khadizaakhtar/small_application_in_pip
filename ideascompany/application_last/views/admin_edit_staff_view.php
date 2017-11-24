<?php include('admin_header1.php'); ?>
<?php include('admin_header.php'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                        </ol>
                    </div>
                </div>
            <div class="row">
                <div class="panel-heading"></div>
                <div class="col-sm-12">
                    <div class="main-content">
                        <h3 align='center' class='active'>Edit Staff</h3>
                        <form action="<?php echo BASE_URL; ?>/admin_controller/update_admin_staff" method="post">
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Staff Name</label>
                                <input type="text" name="user_name" id="agentName" value="<?php echo $result[0][1]; ?>" class="form-control"/> 
                                <input type="hidden" class="form-control" name="user_id" value="<?php echo $result[0][0]; ?>">
                            </div> 
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Staff Email</label>
                                <input type="text" name="user_email_address" value="<?php echo $result[0][3]; ?>" id="tenantName" class="form-control" placeholder=""/> 
                            </div> 
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Staff Password</label>
                                <input type="text"  name="user_password" value="<?php echo $result[0][2]; ?>" id="tenantName" class="form-control" placeholder=""/> 
                            </div> 
                            
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Access Level</label>
                                <input type="text" name="access_label" value="<?php echo $result[0][4]; ?>" class="form-control" placeholder=""/> 
                            </div> 
                            <div class="form-group full-width">
                                <button type="submit" id="publish"><i class="fa fa-floppy-o"></i> Update</button>
                                <br style="clear:both" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
</div>
<?php include('admin_footer.php'); ?>