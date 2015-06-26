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
                            <h3 class="box-title">All Customers</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
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
