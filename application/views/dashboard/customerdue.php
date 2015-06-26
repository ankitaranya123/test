<div class="wrapper">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sale Detail
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Invoice List</a></li>
            </ol>
        </section>

        <div class="modal" id="duemodal">
            <div class="modal-dialog">
                <form action="<?= base_url('index.php/dashboard/paydue')?>" method="post" name="due_form">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Pay Due Amount</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputQuantity">Amount</label>
                            <input type="hidden" id="invoice_no" name="invoice_no" value="">
                            <input  type="text" required="" value="" name="due" class="form-control" id="due" placeholder="Please enter due amount.">
                            <p style="color: red" class="error_due"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" id="addcart" class="btn btn-primary pull-left" >Pay</button>
                        <button type="submit" id="duesub" class="btn btn-primary pull-left hide" >Pay</button>
                    </div>
                </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
        <?php $val =  $this->session->flashdata('done');
            if($val != '')
            {
        ?>
                            <div class="alert alert-info" role="alert"><?= $this->session->flashdata('done') ?></div>
<?php } ?>
                            <h3 class="box-title">All Sales</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="due_tabel" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Invoice No</th>
                                    <th>Customer Name</th>
                                    <th>Mobile Number</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Due Amount</th>
                                    <th>Sale By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

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
