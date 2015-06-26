<div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User
                <small>Edit User</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i> User</a></li>
                <li class="active">Edit User</li>
            </ol>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Edit User</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="<?= base_url('index.php/user/edit_user/'.$data['user_id'])?>" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <input type="hidden" value="<?php echo set_value('user_id') == false ? $data['user_id'] : set_value('user_id'); ?>" name="user_id">
                                <div class="form-group <?php form_error('name') !="" ? "has-error" : ""?>">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" value="<?php echo set_value('name') == false ? $data['name'] : set_value('name'); ?>" name="name" required="" class="form-control" id="exampleInputEmail1" placeholder="Name">
                                    <?php echo form_error('name'); ?>
                                </div>
                                <div class="form-group <?php if(form_error('shopname') != "") {echo "has-error"; } else {echo "";}?>">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text"  name="shopname" value="<?php echo set_value('shopname') == false ? $data['shopname'] : set_value('shopname'); ?>" required="" class="form-control"  placeholder="Shopname">
                                    <?php echo form_error('shopname'); ?>
                                </div>
                                <div class="form-group <?php form_error('email') !="" ? "has-error" : ""?>">
                                    <label for="exampleInputPassword1">Email address</label>
                                    <input type="email" name="email" value="<?php echo set_value('email') == false ? $data['email'] : set_value('email'); ?>" required="" class="form-control" id="exampleInputPassword1" placeholder="Email Address">
                                    <?php echo form_error('email'); ?>
                                </div>

                                <div class="form-group <?php if(form_error('username') != "") {echo "has-error"; } else {echo "";}?>">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text"  name="username" value="<?php echo set_value('username') == false ? $data['username'] : set_value('username'); ?>" required="" class="form-control"  placeholder="Username">
                                    <?php echo form_error('username'); ?>
                                </div>
                                <div class="form-group <?php form_error('password') !="" ? "has-error" : ""?>">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" name="password" class="form-control"  placeholder="Password">
                                    <?php echo form_error('password'); ?>
                                </div>
                                <div class="form-group <?php form_error('dob') !="" ? "has-error" : ""?>">
                                    <label for="exampleInputEmail1">Date of birth</label>
                                    <input type="text" name="dob" required="" value="<?php echo set_value('dob') == false ? $data['dob'] : set_value('dob'); ?>" class="mydate form-control" id="date" placeholder="Date of borth">
                                    <?php echo form_error('dob'); ?>
                                </div>
                                <div class="form-group <?php form_error('image') !="" ? "has-error" : ""?>">
                                    <label for="exampleInputFile">User Image</label>
                                    <input type="file"  value="" accept="image/x-png, image/gif, image/jpeg" id="exampleInputFile" name="image">
                                    <?php echo form_error('image'); ?>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.box -->


            </div>
        </section>
        <div class='control-sidebar-bg'></div>
    </div>
</div>
   