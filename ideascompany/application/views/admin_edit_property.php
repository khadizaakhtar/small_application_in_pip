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
            <h1 class="page-header">Forms</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Property</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" action="<?php echo BASE_URL; ?>/admin_controller/update_admin_property" method="post">

                            <div class="form-group">
                                <label>address_line1</label>
                                <input type="text" class="form-control" name="address_line1" value="<?php echo $result[0][1]; ?>">
                                  <input type="hidden" class="form-control" name="property_id" value="<?php echo $result[0][0]; ?>">*
                            </div>
                            <div class="form-group">
                                <label>address_line2</label>
                                <input type="text" class="form-control"  value="<?php echo $result[0][2]; ?>" name="address_line2" >
                            </div>
                            <div class="form-group">
                                <label>address_line3</label>
                                <input type="text" name="address_line3" value="<?php echo $result[0][3]; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>town</label>
                                <input type="text" name="town" value="<?php echo $result[0][4]; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>country</label>
                                <input type="text" name="country" value="<?php echo $result[0][5]; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>postcode</label>
                                <input type="text" value="<?php echo $result[0][6]; ?>" name="postcode" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>floor_area</label>
                                <input type="text" name="floor_area" value="<?php echo $result[0][7]; ?>" class="form-control">
                            </div>
                             <div class="form-group">
                                <label>ancillary_area</label>
                                <input type="text" name="ancillary_area" value="<?php echo $result[0][10]; ?>" class="form-control">
                            </div>
                             <div class="form-group">
                                <label>site_area</label>
                                <input type="text" name="site_area" value="<?php echo $result[0][11]; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>use_class</label>
                                <input type="text" name="use_class" value="<?php echo $result[0][8]; ?>" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Property</button>

                        </form>

                    </div>


                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->

<?php include('admin_footer.php'); ?>

