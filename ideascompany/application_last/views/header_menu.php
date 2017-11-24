<div class="line">
    <nav>
        <p class="nav-text">Custom menu text</p>
        <div class="top-nav s-12 l-10">
            <ul>
                <li><a href="<?php echo BASE_URL; ?>admin_controller/search_requirements">Search Requirement</a></li>
                <li><a href="<?php echo BASE_URL; ?>admin_controller/search_properties">Search Properties</a> </li>
                <li><a href="<?php echo BASE_URL; ?>admin_controller/">Add Requirements</a> </li>
                <li><a href="<?php echo BASE_URL; ?>admin_controller/add_property_view">Add Properties</a></li>
                <li><a href="<?php echo BASE_URL; ?>admin_controller/add_staff_view">Add Staff</a></li>
                <li><a>Stats</a></li>
            </ul>
        </div>
        <div class="hide-s hide-m l-2">
           <a style="color: #ffffff" href="<?php echo BASE_URL; ?>login_controller/logout">Logout</a>  <i style="margin:0px;padding: 25px;margin-top: 50px;" class="icon-user"> <?php echo $_SESSION['username'] ?></i><br>
           
        </div>
    </nav>
</div>


<!--<div class="btn-group pull-right" >
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="icon-user"></i><span class="hidden-phone"></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><a href="#">Profile</a></li>
        <li class="divider"></li>
        <li><a href="">Logout</a></li>
    </ul>
</div>-->
<!-- user dropdown ends -->