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
            <h1 class="page-header">Property Tables</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Property Table</div>
                <div class="panel-body">

                    <table data-toggle="table" data-url=""  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">		
                        <thead>
                            <tr>
                                <th >property_id</th>
                                <th>address_line1</th>
                                <th >Town</th>
                                <th>country</th>
                                <th>use_class</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        foreach ($result as $require) {
                            ?>
                            <tr>
                                <td><?php echo $require[0]; ?></td>
                                <td><?php echo $require[1]; ?></td>
                                <td><?php echo $require[4]; ?></td>
                                <td><?php echo $require[5]; ?></td>                              
                                <td><?php echo $require[8]; ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>admin_controller/admin_edit_property/<?php echo $require[0]; ?>">Edit</a>
                                    <a href="<?php echo BASE_URL; ?>admin_controller/admin_delete_property/<?php echo $require[0]; ?>">Delete</a></td>
                            </tr>
                        <?php } ?>

                    </table>




                </div>
            </div>
        </div>
    </div><!--/.row-->	



    <?php include('admin_footer.php'); ?>