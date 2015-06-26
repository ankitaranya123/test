<div class="wrapper">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Expenses List
                <small>All Expenses</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Expenses List</a></li>
                <li class="active">All Expenses</li>
            </ol>
        </section>
        <div class="modal" id="quantitymodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="<?php base_url('index.php/dashboard/expenses'); ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Expenses Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputQuantity">Person Name</label>
                            <input  type="text"  required="" value="" name="person_name" class="form-control" placeholder="Person Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Expenses Type</label>
                            <input  type="text"  required="" value="" name="expenses_type" class="form-control" placeholder="Expenses Type">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Day Total</label>
                            <input  type="text"  required="" value="" name="total" class="form-control" placeholder="Total">
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
                            <h3 class="box-title"><a class="btn btn-large btn-primary"  data-toggle="modal" data-target="#quantitymodal" href="#">Add Expenses</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Person Name</th>
                                        <th>Expenses Type</th>
                                        <th>Day Total</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                   if(!empty($expenses)){
                                       
                                       foreach($expenses as $expensesDetails){ ?>
                                    <tr>
                                        <td><?php echo $expensesDetails['person_name']; ?></td>
                                        <td><?php echo $expensesDetails['expenses_type']; ?></td>
                                        <td><?php echo number_format($expensesDetails['total'],2); ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($expensesDetails['date'])); ?></td>
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
                <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
    <?php echo $this->session->flashdata('success'); ?>
                </div>
<?php } ?>
        </section>

        <div class='control-sidebar-bg'></div>
    </div>
</div>
<input type="hidden" val="<?php echo base_url(); ?>" name="base_url" id="base_url">