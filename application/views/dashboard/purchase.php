<div class="wrapper">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Purchased Entry
                <small>All Purchased Detail</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Purchased Entry</a></li>
                <li class="active">All Purchased Detail</li>
            </ol>
        </section>
        <div class="modal" id="quantitymodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="<?php base_url('index.php/dashboard/purchase'); ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Purchased Entry Form</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputQuantity">Purchased Items</label>
                            <textarea    required=""  name="purchased_item" class="form-control" placeholder="Purchased Items"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQuantity">Total Prize</label>
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
                            <h3 class="box-title"><a class="btn btn-large btn-primary"  data-toggle="modal" data-target="#quantitymodal" href="#">Create Purchased Entry</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Purchased Items</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                   if(!empty($purchase)){
                                       
                                       foreach($purchase as $purchaseDetails){ ?>
                                    <tr>
                                        <td><?php echo $purchaseDetails['purchased_item']; ?></td>
                                        <td><?php echo $purchaseDetails['total']; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($purchaseDetails['date'])); ?></td>
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