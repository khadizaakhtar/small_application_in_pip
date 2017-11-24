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
                            <li class="active">Search Location</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <form class="form-inline" action="<?php echo BASE_URL; ?>/admin_controller/general_search/" method="get" >
                                <div class="form-group full-width-borde">
                                    <input type="text" name="search" class="form-control search-input" placeholder="Search" />
                                    <button type="submit"  class="search-btn"><i class="fa fa-search"></i></button>
                                 <div class="select">
                                        <select name="order" id="nationWide" class="selectpicker" data-style="btn-select">
                                            <option value="requirement">Location</option>
                                           <!--  <option value="tenant_name">Company</option> -->
                                            <!--  <option value="property">properties</option> -->
                                        </select> 
                                    </div>
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
                            <h3 class="content-title">Locations</h3>
                            <div style="color:green; text-align: center">
                                <?php
                                if (isset($errormessage) && !empty($errormessage)) {
                                    echo $errormessage;
                                }
                                ?>
                            </div>

                            <form >
                                <ul class="user-list">
                                    <?php
                                    if (isset($result) && !empty($result)) {
                                        ?>
                                        <?php
                                        foreach ($result as $require) {
                                            ?>
                                            <li>
                                                <div class="left-align<?php echo $require[0]; ?> left-align">
                                                    <input  type="checkbox" class="rs_tottgle_check" name="data[requirement_id][]" value="<?php echo $require['requirement_id']; ?>">
                                                    <strong><?php echo $require['tenant_name']; ?></strong>
                                                   <span class="address-1"><i class="fa fa-map-marker"></i> <?php $tt=unserialize($require['town']); $comma_separated = implode(" , ", $tt); echo $comma_separated; ?></span>
                                                    <span class="address-mark">A1</span>
                                                    <span class="floor-area"><?php echo $require['floor_area_from']; ?> ft</span>
                                                    <p><span class="address"><?php echo $require['tenant_name']; ?></span> <span class="telephone-no"> Tel: <?php echo $require['agent_phone_number']; ?></span><span class="emalil-address"> Email: <?php echo $require['agent_email']; ?></span></p>
                                                </div>
                                                <div class="right-align">
                                                    <?php if(isset($_GET['order']) && $_GET['order']=='property'){ ?>
                                                    <a style=" text-align:center; text-decoration:none; " class="select-user" href="<?php echo BASE_URL; ?>admin_controller/edit_property/<?php echo $require['requirement_id']; ?>">EDIT</a>
                            <a style=" text-decoration:none; " class="delete-btn" href="<?php echo BASE_URL; ?>admin_controller/delete_info/<?php echo $require['requirement_id']; ?>"></a>
                             <br style="clear:both"/>
                                                    <?php }else{?>
                                                     <a style=" text-align:center; text-decoration:none; " class="select-user" href="<?php echo BASE_URL; ?>admin_controller/edit_info/<?php echo $require['requirement_id']; ?>">EDIT</a>
                            <a style=" text-decoration:none; " class="delete-btn" href="<?php echo BASE_URL; ?>admin_controller/delete_info/<?php echo $require['requirement_id']; ?>"></a>
                             <br style="clear:both"/>
                                                    <?php } ?>
                                                </div>
                                           <!--  </li><!-- user list --> 

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
                                                        <li><a href="<?php echo BASE_URL . 'admin_controller/general_search/?search=' . $_GET['search'] . '&page=' . $i; ?>"><?php echo $i; ?></a></li>
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
                            </form>


                            <br style="clear:both"/>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.rs_tottgle_select').click(function (e) {

                    e.preventDefault();
                    var ele = $(this).parent().parent().find(':checkbox');
                    //alert(ele);
                    if (ele.is(':checked')) {
                        ele.prop('checked', false);
                        $(this).removeClass('admin_checked');
                    } else {
                        ele.prop('checked', true);
                        $(this).addClass('admin_checked');
                    }
                });
            });
        </script>




        <?php include('footer_12.php'); ?>  
    </body>
</html>