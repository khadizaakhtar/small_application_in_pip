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
            height: 500px;
            margin-top: 30px;
            padding: 20px 30px 30px 25px;
        }
    </style>
    <body>
        <div id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                            <li class="active">STAFF</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <h3 class="content-title">STAFF</h3>
                            <form method="post" >
                                <ul class="user-list">
                                    <li>
                                        <div data-example-id="contextual-table" class="bs-example">
                                            <table class="table deals-table">
                                                <tr class="thead">
                                                <td>Staff Name</td>
                                                <td>Staff Email</td>
                                               
                                                <td>Action</td>
                                               </tr>
                                                <?php
//                                                  echo '<pre>';
//                                                  print_r($result);
//                                                  echo '</pre>';
//                                                  exit;
                                                foreach ($result as $v_info) {
                                                    //echo '<pre>';print_r($v_info);echo '</pre>';die();
                                                    ?>
                                                    <tbody>
                                                    <td><?php echo $v_info[1] ?></td>
                                                    <td><?php echo $v_info[3] ?></td>
                                                    
                                                    <td><a href="<?php echo BASE_URL; ?>admin_controller/edit_staff_font/<?php echo $v_info[0]; ?>">Edit</a> | 
                                                        <a href="<?php echo BASE_URL; ?>admin_controller/delete_staff_font/<?php echo $v_info[0]; ?>">Delete</a></td>
                                                    </tbody>
                                                <?php } ?>
                                            </table>      
                                        </div>
                                        
                                        
                                        
                                        <div data-example-id="contextual-table" class="bs-example">
                                            <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                     Modal content
                                                    <div class="modal-content">
                                                        <table class="table">
                                                            <tr class="danger">
                                                                
                                                            </tr>
                                                        </table>

<!--                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>-->
                                                    </div>     
                                                </div>
                                                </div>
                                            </div>
                                        
                                        
                                                </li><!-- user list --> 
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
                                                </form>


                                                <br style="clear:both"/>
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




                                        <?php include('footer_12.php'); ?>  
                                        </body>
                                        </html>
