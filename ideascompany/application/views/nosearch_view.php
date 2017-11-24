<!DOCTYPE html>
<html lang="en">
    <?php include('header_12.php'); ?>
    <?php //include('deals_view_for_single.php'); ?>
    <style>
        .col-md-6 img {
            height: 50px;
            width: 50px;
        }
        td, th {
            padding: 8px;
        }
        .main-content {
            background-color: #fff;
            border: 1px solid #dde1e6;
            min-height: 500px;
            margin-top: 30px;
            padding: 20px 30px 30px 25px;
        }
        .border-zero{
            border: 0;
            margin-top: 15px;
        }
    </style>
    <body>
        <div id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                            <li class="active">Search Deals</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <!--                    <div class="col-sm-12">
                                            <div class="main-content">
                                                <form action="<?php //echo BASE_URL;   ?>/admin_controller/search_requirements/" method="GET" >
                                                    <div class="form-group full-width-borde">
                                                        <input type="text" name="search" class="form-control" placeholder="Search" />
                                                        <button type="submit"  class="search-btn"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>-->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <h3 style="text-align:center; color:red;">
                                <?php 
                                if(isset($msg) && !empty($msg)){
                                    echo $msg;
                                }
                                
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
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
        <script>
            $('#example').dataTable({
                "paging": true,
                "lengthMenu": [[100, 1000, 10000], [100, 1000, 10000]]
            });

        </script>





        <?php include('footer_12.php'); ?>  
    </body>
</html>

