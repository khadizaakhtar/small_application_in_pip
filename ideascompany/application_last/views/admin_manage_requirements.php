<?php include('admin_header.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Icons</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Requirements Tables</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Requirements Table</div>
                <div class="panel-body">

                   <table data-toggle="table" data-url=""  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">		
                        <thead>
                            <tr>
                                <th>Requirement ID</th>
                                <th>Tenant Name</th>
                                <th>Town</th>
                                <th>Nationwide</th>
                                <th>Floor area from</th>
                                <th>Floor area to</th>
                                <th>Use Class</th>
                                <th>Resite</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
//                        print_r($result);
//                        exit;
                        foreach ($result as $require) {
                         $t=$require[2];
                         $town=  unserialize($t);
                        
                          
                            ?>
                            <tr>
                                <td><?php echo $require[0]; ?></td>
                                <td><?php echo $require[1]; ?></td>
                                <td><?php if(count($town)>0){echo implode(',', $town); }else{ echo 'No town is available'; } ?></td>
                                <td><?php echo $require[3]; ?></td>
                                <td><?php echo $require[4]; ?></td>
                                 <td><?php echo $require[8]; ?></td>
                                <td><?php echo $require[5]; ?></td>
                                <td><?php echo $require[12]; ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>admin_controller/admin_edit_requirement/<?php echo $require[0]; ?>">Edit</a>
                                    <a href="<?php echo BASE_URL; ?>admin_controller/admin_delete_requirement/<?php echo $require[0]; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>

                    </table>
                    <script>
                        $(function () {
                            $('#hover, #striped, #condensed').click(function () {
                                var classes = 'table';

                                if ($('#hover').prop('checked')) {
                                    classes += ' table-hover';
                                }
                                if ($('#condensed').prop('checked')) {
                                    classes += ' table-condensed';
                                }
                                $('#table-style').bootstrapTable('destroy')
                                        .bootstrapTable({
                                            classes: classes,
                                            striped: $('#striped').prop('checked')
                                        });
                            });
                        });

                        function rowStyle(row, index) {
                            var classes = ['active', 'success', 'info', 'warning', 'danger'];

                            if (index % 2 === 0 && index / 2 < classes.length) {
                                return {
                                    classes: classes[index / 2]
                                };
                            }
                            return {};
                        }
                    </script>


                </div>
            </div>
        </div>
    </div><!--/.row-->	

    <?php include('admin_footer.php'); ?>