<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lumino - Dashboard</title>

        <link href="<?php echo BASE_URL; ?>/static/admin_assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>/static/admin_assets/css/datepicker3.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>/static/admin_assets/css/styles.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>/static/admin_assets/css/bootstrap-table.css" rel="stylesheet">
       

        <!--Icons-->
        <script src="<?php echo BASE_URL; ?>/static/admin_assets/js/lumino.glyphs.js"></script>
        <script src="<?php echo BASE_URL; ?>/static/admin_assets/js/bootstrap-table.js"></script>

        <!--[if lt IE 9]>
        <script src="<?php echo BASE_URL; ?>/static/admin_assets/js/html5shiv.js"></script>
        <script src="<?php echo BASE_URL; ?>/static/admin_assets/js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $_SESSION['username'] ?><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                                <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
                                <li><a href="<?php echo BASE_URL; ?>login_controller/admin_logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <form role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
            <ul class="nav menu">
                <li class="active"><a href="<?php echo BASE_URL; ?>admin_controller/admin_dashboard"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>

                <li class="parent ">
                    <a href="<?php echo BASE_URL; ?>admin_controller/manage_requirements">
                        <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Requirements 
                    </a>
                    
                </li>


                <li class="parent ">
                    <a href="<?php echo BASE_URL; ?>admin_controller/manage_property">
                        <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Property 
                    </a>
                    
                </li>
                
                <li class="parent ">
                    <a href="<?php echo BASE_URL; ?>admin_controller/manage_staff">
                        <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Manage Staff
                    </a>
                    
                </li>
                
                <li role="presentation" class="divider"></li>
                <li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $_SESSION['username'] ?></a></li>
            </ul>

        </div><!--/.sidebar-->