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
                            <li class="active">Company Stats</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <form action="<?php echo BASE_URL; ?>/admin_controller/search_tenant/" method="GET" >
                                <div class="form-group full-width-borde">
                                    <input type="text" name="search" class="form-control" placeholder="Company name" />
                                    <button type="submit"  class="search-btn"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <?php
                                    if (isset($result) && !empty($result)) {
										?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <h3 class="content-title">Requirements</h3>
                             <div style="color:green; text-align: center">
                                    <?php
                                      if (isset($errormessage) && !empty($errormessage)) {
                                       echo $errormessage;
                                      }
                                      ?>
                        </div>

                            <ul class="user-list">
                                <?php
                                if (isset($result) && !empty($result)) {
                                   
                                    ?>
                                    <?php
                                    foreach ($result as $require) {///echo '<pre>';print_r($require);echo '</pre>';die();
                                               $t= $require['town'];
                                               $town=unserialize($t);
                                        ?>
                                        <li>
                                            <div class="left-align">
                                                <strong><?php echo $require['tenant_name']; ?></strong>
                                                <span class="address-1"><i class="fa fa-map-marker"></i> <?php foreach($town as $k=>$v_town){ echo $v_town.","; }?> </span>
                                                <span class="address-mark">A1</span>
                                                <span class="floor-area"><?php echo $require['floor_area_from']; ?>sq ft</span>
                                                <p><span class="telephone-no"> Tel: <?php echo $require['agent_phone_number']; ?></span><span class="emalil-address"> Email: <?php echo $require['agent_email']; ?></span></p>
                                                <div class="bg-blue">
									<table>
										<tr><td>Interested: <?php echo $require['interested']; ?></td><td>Offer Accepted: <?php echo $require['accepted']; ?></td><td>Offer Recieved: <?php echo $require['offered_received']; ?></td><td>Rejected: <?php echo $require['rejected']; ?></td><td><a href="#">History</a></td></tr>
										
                                        
                                        
									</table> 
								</div>
                                            </div>
                                            <div class="right-align">
<!--                                                <button class="history-btn" name="history" type="button">History</button>
<a class="history-btn nranchor" href="#">History</a>
</li>-->
                                                
                                                <a class="select-user nranchor" href="<?php echo BASE_URL; ?>admin_controller/edit_info/<?php echo $require['requirement_id']; ?>">Edit</a>
                                                <a class="delete-btn" href="<?php echo BASE_URL; ?>admin_controller/admin_delete_requirement/<?php echo $require['requirement_id']; ?>"></a>


                                                <br style="clear:both"/>
                                            </div>
                                        </li><!-- user list --> 
                                        <?php
                                    }
                                }
                                ?>

                            </ul>


                            <div class="row">
                                <div class="col-sm-10">
                                    <nav>
                                        <?php if (isset($total_pg) && $total_pg > 1) { ?>
                                            <ul class="pagination">
                                                <li>
                                                    <a href="#" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <?php for ($i = 1; $i <= $total_pg; $i++) { ?>
                                                    <li><a href="<?php echo BASE_URL . 'admin_controller/search_requirements/?search=' . $_GET['search'] . '&page=' . $i; ?>"><?php echo $i; ?></a></li>
                                                <?php } ?>
                                                <li>
                                                    <a href="#" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } ?>
                                    </nav>
                                </div>
                                
                            </div>
                            <br style="clear:both"/>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>





        <?php include('footer_12.php'); ?>  
    </body>
</html>