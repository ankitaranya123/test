<div class="wrapper">

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Customer Detail 
<!--                <small>Item</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Cart</a></li>
                <li class="active">Customer</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Details</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" action="<?= base_url('index.php/shopping/customer') ?>" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <input type="hidden" value="Form" name="form_post">
                                    <div class="form-group <?php form_error('name') != "" ? "has-error" : "" ?>">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" value="<?php echo set_value('name'); ?>" name="name" required="" class="form-control" id="exampleInputEmail1" placeholder="Name">
                                        <?php echo form_error('name'); ?>
                                    </div>
                                    <div class="form-group <?php form_error('email') != "" ? "has-error" : "" ?>">
                                        <label for="exampleInputPassword1">Email address</label>
                                        <input type="email" name="email" value="<?php echo set_value('email'); ?>" required="" class="form-control" id="exampleInputPassword1" placeholder="Email Address">
                                        <?php echo form_error('email'); ?>
                                    </div>
                                    <div class="form-group <?php form_error('PhoneNumber') != "" ? "has-error" : "" ?>">
                                        <label for="exampleInputEmail1">Phone Number</label>
                                        <input type="text" value="<?php echo set_value('PhoneNumber'); ?>" name="PhoneNumber" required="" class="form-control" id="exampleInputEmail1" placeholder="Phone Number">
                                        <?php echo form_error('PhoneNumber'); ?>
                                    </div>
                                  
                                    <div class="form-group <?php form_error('MobileNumber') != "" ? "has-error" : "" ?>">
                                        <label for="exampleInputEmail1">Mobile Number</label>
                                        <input type="text" value="<?php echo set_value('MobileNumber'); ?>" name="MobileNumber" required="" class="form-control" id="exampleInputEmail1" placeholder="Mobile Number">
                                        <?php echo form_error('MobileNumber'); ?>
                                    </div>
                                  
                                    <div class="form-group <?php form_error('address') != "" ? "has-error" : "" ?>">
                                        <label for="exampleInputEmail1">Address</label>
                                        <textarea type="text" value="<?php echo set_value('address'); ?>" name="address" required="" class="form-control" id="exampleInputEmail1" placeholder="Address"></textarea>
                                        <?php echo form_error('address'); ?>
                                    </div>

                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
