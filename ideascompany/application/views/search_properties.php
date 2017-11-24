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
                  <li class="active"> SEARCH</li>
                </ol>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <form class="form-inline" method="get" action="<?php echo BASE_URL; ?>admin_controller/search_properties/">
                        <div class="form-group full-width-borde">
                            <input type="text" name="search" class="form-control search-input" placeholder="Search" />
                            <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                            <div class="select">
                            <select id="nationWide" class="selectpicker" data-style="btn-select">
                                <option value="Adam">Location</option>
                                <option value="Adam">Company</option>
                                <option value="Adam">properties</option>
                            </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3 class="content-title">PROPERTY STATS</h3>
                     <div style="color:green; text-align: center">
                    <?php
                    if (isset($errormessage) && !empty($errormessage)) {
                        echo $errormessage;
                      }
                    ?>
                    </div>
                    <ul class="property-list property-stats">
                        <?php
                        if(isset($result) && !empty($result) ){
                            foreach ($result as $v_result) {
                              // echo '<pre>'; print_r($v_result);echo '</pre>';die();
                                ?>
                        <li>
                            <div class="property-image"><img src="<?php echo BASE_URL; ?>uploads/<?php echo $v_result['image'] ?>" alt="image" /></div>
                            <div class="property-details">
                                <span><i class="fa fa-map-marker"></i><?php echo $v_result['town']; ?>, <?php echo $v_result['country']; ?></span><span><i class="address-mark">A1</i><?php echo $v_result['floor_area']; ?>sq ft</span>
                                <p><?php echo $v_result['address_line1']; ?>, <?php echo $v_result['address_line2']; ?>, <?php echo $v_result['address_line3']; ?></p>
                            </div>
                            <!-- <button type="button" name="history" class="history-btn">Send PDF </button> -->
                           <!--<a class="history-btn"  href="<?php echo BASE_URL; ?>admin_controller/send_pdf_for_individual_property/<?php echo $v_result['property_id']; ?>">Send PDF</a>-->
                        </li>
                            <?php } }?>
                    </ul><br style="clear:both"/>
                    <?php if(isset($total_pg) && $total_pg>1){?>
                    <div class="row">
                        <div class="col-sm-12">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <?php for ($i=1; $i<=$total_pg; $i++) {  ?>
                            <li><a href="<?php echo BASE_URL.'admin_controller/search_properties/?search='.$_GET['search'].'&page='.$i; ?>"><?php echo $i; ?></a></li>
                            
                            <?php } ?>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                        </div>
                    </div>
                    <br style="clear:both"/>
                </div>
                <?php } ?>
            </div>
            </div>
        </div>
    </div>


<?php include('footer_12.php'); ?>  
</body>
</html>