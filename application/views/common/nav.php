<header class="main-header">
    <!-- Logo -->
    <li style="display: none" class="clone-message"><!-- start message -->
        <a href="#">
            <div class="pull-left">
                <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
                <h5></h5>
            </div>
            <h4>

            </h4>
            <p>Why not buy a new awesome theme?</p>
        </a>
    </li><!-- end message -->

    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b><?= SHOP_APP_ADMIN; ?></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= SHOP_APP_ADMIN; ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Tasks: style can be found in dropdown.less -->
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span class="label label-success number-cart"><?php if (is_array($this->session->userdata('cart'))) echo count($this->session->userdata('cart')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?php if (is_array($this->session->userdata('cart'))) echo count($this->session->userdata('cart')); ?> items in cart.</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu cart-li">
                                <li class="clone-message"><!-- start message -->
                                    <?php if(is_array($this->session->userdata('cart'))) foreach ($this->session->userdata('cart') as $val) { ?>
                                 </li>
                                    <li class="" id="cart_<?= $val['id'] ?>"><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
                                                <h5><?= $val['quantity'] ?></h5>
                                            </div>  
                                            <h4><?= $val['name'] ?><small data-id="<?= $val['id'] ?>" class="removecart"><i class="glyphicon glyphicon-remove"></i>Remove</small></h4>
                                            <p><?= $val['price'] ?></p>
                                        </a>

                                        <!--</li>-->
                                    </li><!-- end message -->
                                <?php } ?>
                        
                    </ul>
                </li>
                <li class="footer"><a href="<?= base_url('index.php/shopping/cart');?>">See All Item</a></li>
            </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url() ?>assets/userimage/<?= $user_data['profile_pic']; ?>" class="user-image" alt="User Image"/>
                    <span class="hidden-xs"><?= ucfirst($user_data['name']); ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?= base_url() ?>assets/userimage/<?= $user_data['profile_pic']; ?>" class="img-circle" alt="User Image"/>

                        <p>
                            <?= $user_data['shopname'] . ' - ' . $user_data['access_level']; ?>
                            <!--<small>Member since Nov. 2012</small>-->
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Lock Screen</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?= base_url('index.php/login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <!--                <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>-->
            </ul>
        </div>
    </nav>
</header>