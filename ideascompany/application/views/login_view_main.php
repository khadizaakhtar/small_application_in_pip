<?php include('header_loginpage.php'); ?>

<body id="login">

    <div class="login-logo">

        <a href="index.html"><img src="<?php echo BASE_URL; ?>/static/images/logo.png" alt=""/></a>

    </div>

    <h2 class="form-heading">login</h2>

    <div class="app-cam">



        <form action="<?php echo BASE_URL; ?>/login_controller/login" method="post">

            <input type="text" class="text" placeholder="user name" name="user_name">

            <input type="password" placeholder="Password" name="user_password">

            <div class="submit"><input type="submit" value="Login"></div>



        </form>

    </div>

    <div class="copy_layout login">

        <p>Copyright &copy; 2016 Harkalm. All Rights Reserved  </p>

    </div>

</body>

<?php include('footer_loginpage.php'); ?>