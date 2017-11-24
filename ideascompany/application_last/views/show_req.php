

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
                  <li class="active">SELECT</li>
                </ol>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3 class="content-title">PLEASE SELECT</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box-bg">
                                <div class="display-table">
                                    <a  href="<?php echo BASE_URL.'admin_controller/property_pdf_page'; ?>">Add a Property </a>
                                </div>
                            </div>
                        </div>      
                        <div class="col-sm-6">
                            <div class="box-bg">
                                <div class="display-table">
                                    <a href="<?php echo BASE_URL.'admin_controller/find_a_property'; ?>">Find a Property  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br style="clear:both"/>
                </div>
            </div>
            </div>
        </div>
    </div>




<?php include('footer_12.php'); ?>  
</body>
</html>