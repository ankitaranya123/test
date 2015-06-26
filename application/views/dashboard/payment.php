<div class="wrapper">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Payment List
                <small>All Payment</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Payment List</a></li>
                <li class="active">All Payment</li>
            </ol>
        </section>
        <div class="modal" id="quantitymodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="<?php base_url('index.php/dashboard/payment'); ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Payment Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputQuantity">Person Name</label>
                            <input  type="text"  required="" value="" name="person_name" class="form-control" placeholder="Person Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Email</label>
                            <input  type="text"  required="" value="" name="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Address</label>
                            <input  type="text"  required="" value="" name="address" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Contact Number</label>
                            <input  type="text"  required="" value="" name="contact" class="form-control" placeholder="Contact Number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Total Paid</label>
                            <input  type="text"  required="" value="" name="total_paid" class="form-control" placeholder="Total Paid">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Total Due</label>
                            <input  type="text"  required="" value="" name="total_due" class="form-control" placeholder="Total Due">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Date</label>
                            <input  type="text"  required="" value="" name="date" class="datepicker form-control" placeholder="mm/dd/yy">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="addcart" class="btn btn-primary pull-left" >Submit</button>
                    </div>
                        </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">

               
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><a class="btn btn-large btn-primary"  data-toggle="modal" data-target="#quantitymodal" href="#">Add Payment Details</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Person Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Total Paid</th>
                                        <th>Total Due</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                   if(!empty($payment)){
                                       
                                       foreach($payment as $paymentDetails){ ?>
                                    <tr>
                                        <td><?php echo $paymentDetails['person_name']; ?></td>
                                        <td><?php echo $paymentDetails['email']; ?></td>
                                        <td><?php echo $paymentDetails['address']; ?></td>
                                        <td><?php echo $paymentDetails['contact']; ?></td>
                                        <td><?php echo number_format($paymentDetails['total_paid'],2); ?></td>
                                        <td><?php echo number_format($paymentDetails['total_due'],2); ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($paymentDetails['date'])); ?></td>
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
<input type="hidden" val="<?php echo base_url(); ?>" name="base_url" id="base_url">