<?php include('header_loginpage.php'); ?>
<body id="login">
    <div class="login-logo">
        <!--<a href="index.html"><img src="<?php echo BASE_URL; ?>/static/images/logo.png" alt=""/></a>-->
    </div>
    <h2 class="form-heading">login</h2>
    <div class="app-cam" id="app-cam-login">
		<div id="form-box">
			<strong>Please login</strong>
        <form action="<?php echo BASE_URL; ?>/login_controller/" method="post">
            <div class="form-group user">
			<input type="text" class="form-control text" placeholder="Username" name="user_name" required />
			</div>
            <div class="form-group password"><input type="password" class="form-control" placeholder="Password" name="user_password" required></div>
            <div class="submit"><input type="submit" value="Login"></div>
        </form>
		</div>
        <div class="center-view"><span><i class="fa fa-user-plus"></i></span><a href="<?php echo BASE_URL; ?>/login_controller/create_account" style="text-align: center">Create a new Account</a></div>
    </div>

    <div class="copy_layout login">
        <p>Copyright &copy; 2016 Harkalm. All Rights Reserved </p>
    </div>
</body>
<?php include('footer_loginpage.php'); ?>