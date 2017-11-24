<?php include('header_12.php'); ?>

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
                        <h3 align='center' class='active'>Edit Requirement</h3>
                        <form action="<?php echo BASE_URL; ?>/admin_controller/update_admin_requirements" method="post">
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Agent Name</label>
                                <input type="text" name="agent_name" id="agentName" value="<?php echo $result[0][6]; ?>" class="form-control"/> 
                                <input type="hidden" class="form-control" name="requirement_id" value="<?php echo $result[0][0]; ?>">
                            </div> 
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Agent Email</label>
                                <input type="text" name="agent_email" value="<?php echo $result[0][7]; ?>" id="tenantName" class="form-control" placeholder=""/> 
                            </div> 
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Agent Phone Number</label>
                                <input type="text"  name="agent_phone_number" value="<?php echo $result[0][8]; ?>" id="tenantName" class="form-control" placeholder=""/> 
                            </div> 
                            
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Tenant Name</label>
                                <input type="text" name="tenant_name" value="<?php echo $result[0][1]; ?>" class="form-control" placeholder=""/> 
                            </div> 
                            
                             <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Town</label>
                                <input type="text" value="<?php echo $result[0][2]; ?>" name="town" id="tenantName" class="form-control" placeholder=""/> 
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Floor Area From</label>
                                <input type="text" name="floor_area_from" value="<?php echo $result[0][4]; ?>" class="form-control" placeholder=""/> 
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Floor Area To</label>
                                <input type="text" name="floor_area_to" value="<?php echo $result[0][11]; ?>" class="form-control" placeholder=""/> 
                            </div>
                            
                             <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Re-Site</label>
                                <input type="text" name="resite" id="tenantName"  value="<?php echo $result[0][15]; ?>" class="form-control" placeholder=""/> 
                            </div>
                            
                           <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Use Class</label>
                                <input type="text" name="use_class" value="<?php echo $result[0][5]; ?>" class="form-control" placeholder=""/> 
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