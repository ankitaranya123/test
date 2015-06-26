<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url()?>assets/userimage/<?= $user_data['profile_pic']; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $user_data['name']; ?></p>

<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Menu List</li>
            <li class="<?php if($active == 'dashboard') echo 'active'; ?>">
                <a href="<?= base_url('index.php/dashboard')?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
           </li>

            <?php if($this->user_detail['access_level'] != 'user') {?>

            <li class="treeview <?php if($active == 'user') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($activesub == 'useradd') echo 'active'; ?>"><a href="<?= base_url('index.php/user/add')?>"><i class="fa fa-circle-o"></i>Add User</a></li>
                    <li class="<?php if($activesub == 'userlist') echo 'active'; ?>"><a href="<?= base_url('index.php/user/')?>"><i class="fa fa-circle-o"></i>User List</a></li>
               </ul>
            </li>
            <li class="<?php if($activesub == 'addcategory') echo 'active'; ?>"><a href="<?= base_url('index.php/category/addCategory')?>"><i class="fa fa-plus-square-o"></i>Add Category</a></li>
            <li class="<?php if($activesub == 'categorylist') echo 'active'; ?>"><a href="<?= base_url('index.php/category/categoryList')?>"><i class="fa fa-edit"></i>View & Edit Category</a></li>
            <?php } ?>
            <li class="treeview <?php if($activesub == "productList") echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Product Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php  $category = $this->category_model->categoryList(); ?>
                    <?php if(!empty($category)){
                        foreach($category as $categoryDetails){
                        ?>
                    <li class=""><a href="<?= base_url('index.php/category/productList/'.$categoryDetails['id'].'')?>"><i class="fa fa-circle-o"></i><?php echo $categoryDetails['name']; ?></a></li>
                    
                    <?php } }  ?>
                </ul>
            </li>

           <li class="<?php if($active == 'sale') echo 'active'; ?>"><a href="<?= base_url('index.php/dashboard/sale') ?>"><i class="fa fa-sellsy"></i>Sales</a></li>
            <?php if($this->user_detail['access_level'] != 'user') { ?>
            <li class="<?php if($active == 'purchase') echo 'active'; ?>"><a href="<?= base_url('index.php/dashboard/purchase')?>"><i class="fa fa-paper-plane-o"></i>Purchase</a></li>
           <li class="<?php if($active == 'payment') echo 'active'; ?>"><a href="<?= base_url('index.php/dashboard/payment')?>"><i class="fa fa-money"></i>Payments</a></li>
           <li class="<?php if($active == 'expenses') echo 'active'; ?>"><a href="<?= base_url('index.php/dashboard/expenses')?>"><i class="fa fa-expand"></i>Expenses</a></li>
           <?php } ?>
            <li  class="<?php if($active == 'customer') echo 'active'; ?>"><a href="<?= base_url('index.php/dashboard/customerList')?>"><i class="fa fa-user-times"></i>Customer List</a></li>
           <li class="<?php if($active == 'customerdue') echo 'active'; ?>"><a href="<?= base_url('index.php/dashboard/customer_due')?>"><i class="fa fa-user-secret"></i>Customer Dues</a></li>
            <?php if($this->user_detail['access_level'] != 'user') { ?>
           <li class="<?php if($active == 'profitLoss') echo 'active'; ?>"><a href="<?= base_url('index.php/dashboard/profitLoss')?>">><i class="fa fa-bars"></i>Profit and Loss</a></li>
           <li class=""><a href="#"><i class="fa fa-institution"></i>Inventory</a></li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>