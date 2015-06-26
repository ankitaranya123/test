<div class="wrapper">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Customer List
                <small>All Customers</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Customers List</a></li>
                <li class="active">All Customers</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">

               
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Select allready existed Customers or add new.</h3>
                            <a class="btn btn-primary right pull-right" href="<?=base_url('index.php/shopping/customer')?>"><i class="fa fa-plus"></i>Add New</a>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                   if(!empty($customer)){
                                       
                                       foreach($customer as $customerDetails){ ?>
                                    <tr>
                                        <td><a href="<?= base_url('index.php/shopping/invoice/'.$customerDetails['id'])?>">Select</a></td>
                                        <td><?php echo $customerDetails['name']; ?></td>
                                        <td><?php echo $customerDetails['address']; ?></td>
                                        <td><?php echo $customerDetails['email']; ?></td>
                                        <td><?php echo $customerDetails['MobileNumber']; ?></td>
                                    </tr>     
                                           
                                 <?php      }
                                   }
                                   ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class='control-sidebar-bg'></div>
    </div>
</div>
