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
    </style>
    <body>
        <div id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                            <li class="active">Search Requirements</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <!--                    <div class="col-sm-12">
                                            <div class="main-content">
                                                <form action="<?php //echo BASE_URL;  ?>/admin_controller/search_requirements/" method="GET" >
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
                            <h3 class="content-title">REQUIREMENTS</h3>
                            <form method="post" >
                                <ul class="user-list">
                                    <li>
                                        <div data-example-id="contextual-table" class="bs-example">
					   <div class="table-body">
					   <table id="example" class="table deals-table" >
                                               <thead>
                                                <tr class="thead">
                                                <td>Tenant</td>
                                                <td>Town</td>
                                                <td>Floor Area</td>
                                                <td>Use Class</td>
                                                <td>Action</td>
                                               </tr>
                                               </thead>
                                               <tbody>
                                                <?php
                                                foreach ($result as $v_info) {
                                                     $t=$v_info['town']; 
                                                     $town=unserialize($t);
                                                     if($town!=""){
                                                        $new_town= implode(" ,",$town);
                                                     }else{
                                                         $new_town='';
                                                     }

                                                     ?>                                                  
                                                   <tr>
                                                    <td><?php echo $v_info['tenant_name'] ?></td>
                                                    <td><?php echo $new_town;?></td>
                                                    <td><?php echo $v_info['floor_area_from'] ?> - <?php echo $v_info['floor_area_to'] ?></td>                       
                                                     <td><?php echo $v_info['use_class'] ?></td>
                                                    <td><a href="<?php echo BASE_URL; ?>admin_controller/edit_new_requirement/<?php echo $v_info['requirement_id']; ?>">Edit</a> | 
                                                        <a href="<?php echo BASE_URL; ?>admin_controller/delete_new_requirement/<?php echo $v_info['requirement_id']; ?>">Delete</a> |
                                                       <a href="<?php echo BASE_URL; ?>admin_controller/history_info_for_requirement/<?php echo $v_info['requirement_id']; ?>">History</a>
                                                    </td>
                                                     </tr>
                                                   
                                                <?php } ?>
                                             </tbody>
                                            </table> 
												</div>
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
                                          <script>
                                        $('#example').dataTable({
                  
                                        "paging": true,
                                       "lengthMenu": [[100, 1000, 10000], [100, 1000, 10000]]
                                              });

                                      </script>
                                      <?php include('footer_12.php'); ?>  
                                        </body>
                                        </html>
