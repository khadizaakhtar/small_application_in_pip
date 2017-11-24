<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">
    <title>Harkalm Investments</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URL; ?>/static/frontend/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URL; ?>/static/frontend/css/font-awesome.css" rel="stylesheet">
 <link href="<?php echo BASE_URL; ?>/static/css/datatables.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/frontend/css/style.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/frontend/css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/static/magnific-popup/all.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/static/magnific-popup/back.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/static/magnific-popup/magnific-popup.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/static/css/jquery.dataTables.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo BASE_URL; ?>/static/frontend/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo BASE_URL; ?>/static/frontend/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo BASE_URL; ?>/static/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="<?php echo BASE_URL; ?>/static/magnific-popup/jquery.magnific-popup.min.js"></script>
<!--    <script src="<?php //echo BASE_URL;            ?>/static/frontend/js/jquery.min.js"></script>-->
    <script src="<?php echo BASE_URL; ?>/static/frontend/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/static/frontend/js/bootstrap-select.js"></script>
    <style>
        .abc{
            text-align:center;
        }
    </style>
</head>

<body>
    <header id="header">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="<?php echo BASE_URL; ?>/static/frontend/images/logo.png" alt="logo" /></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse menu-wrap">
                    <nav class="menu">
                        <ul id="navul" class="clearfix nav navbar-nav navbar-right">
                            <li><a href="<?php echo BASE_URL; ?>admin_controller/search_requirements">Find</a></li>
                                    
                            
                           <li  class='tt'>
                                <a href="#">Add <span class="arrow">&#9660;</span></a>

                                <ul class="sub-menu">
                                    <li><a href="<?php echo BASE_URL; ?>admin_controller/add_requirement">Add Requirements</a></li>
                                    <li ><a href="<?php echo BASE_URL; ?>admin_controller/add_property_view">Add Properties</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>admin_controller/add_staff_view">Add Staff</a></li>
                                </ul>

                            </li>
                            
                         <!--   <li class='tt'>
                                <a href="#">Edit <span class="arrow">&#9660;</span></a>

                                <ul class="sub-menu">
                                    <!--<li><a href="<?php echo BASE_URL; ?>admin_controller/search_requirements">Search Location</a></li>-->
                                   <!-- <li><a href="<?php echo BASE_URL; ?>admin_controller/search_properties">Search Properties</a></li> -->
                          <!--          <li><a href="<?php echo BASE_URL; ?>admin_controller/general_search">Properties</a></li>
                                    
                                </ul>

                            </li>
                            
                            <li><a href="<?php echo BASE_URL; ?>admin_controller/search_tenant">Companies</a></li> -->

                            
                            <li><a href="<?php echo BASE_URL; ?>admin_controller/requirements">Requirements</a></li>
                            <li><a href="<?php echo BASE_URL; ?>admin_controller/properties">Properties</a></li>
                            <li><a href="<?php echo BASE_URL; ?>admin_controller/deals">Deals</a></li>

                            <li><a href="<?php echo BASE_URL; ?>admin_controller/staff_view">Staff</a></li>
                            <?php if(isset($_SESSION['userid'])){?>
                            <li><a href="<?php echo BASE_URL; ?>login_controller/logout">Log Out</a></li>
                            <?php }else{?>
                             <li><a href="<?php echo BASE_URL; ?>login_controller/index">Login</a></li>
                            <?php } ?>


                        </ul>
                    </nav>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
    </header>
  