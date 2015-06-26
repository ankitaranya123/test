<body class="wrapper login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b><?= SHOP_APP_ADMIN; ?></b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to access <?= SHOP_APP_ADMIN; ?></p>

            <form action="<?=base_url('index.php/login/index'); ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" required=""/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div>
                    <?php echo validation_errors();?>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <a href="#">I forgot my password</a><br>
<!--            <a href="register.html" class="text-center">Register a new membership</a>-->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
