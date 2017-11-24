<?php include('header_loginpage.php'); ?>
<body id="login">
    <div class="login-logo">
        <!--<a href="index.html"><img src="<?php echo BASE_URL; ?>/static/images/logo.png" alt=""/></a>-->
    </div>
    <h2 class="form-heading">Create an Account</h2>
    <div class="app-cam">
        <div style="color: #ff0033; text-align: center">
            <?php if(isset($result) && !empty($result)){
                echo $result;
            }?>
        </div>
        <form action="<?php echo BASE_URL; ?>/login_controller/create_account" method="post">
            <input style="background-color: #cccccc;color: #ffffff" type="text" name="user_name"  placeholder="user name" >
            <input style="background-color: #cccccc;color: #ffffff" type="text" name="user_email_address" placeholder="user Email" >
            <input style="background-color: #cccccc;color: #ffffff" type="password" name="user_password"  placeholder="user Password" >
            <div class="submit"><input type="submit" value="Registration"></div>

        </form>

    </div>


    <div class="copy_layout login">
        <p>Copyright &copy; 2016 Harkalm. All Rights Reserved </p>
    </div>
</body>
<?php include('footer_loginpage.php'); ?>
