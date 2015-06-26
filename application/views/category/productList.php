<div class="wrapper">

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Product List
                <small>All Products</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Product List</a></li>
                <li class="active">All Product</li>
            </ol>
        </section>
        <div class="modal" id="quantitymodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Quantiy</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputQuantity">Quantity</label>
                            <input  type="number" min="1" required="" value="1" name="quantity" class="form-control" id="quantity" placeholder="Please enter qunatity">
                            <p style="color: red" class="error_quantity"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" id="addcart" class="btn btn-primary pull-left" >Add to cart</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">

               
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                           <?php if($this->user_detail['access_level'] != 'user') {  if(!empty($categoryId)){ ?>
                            <h3 class="box-title"><a class="btn btn-large btn-primary" href="<?= base_url('index.php/category/addProduct/'.$categoryId.'') ?>">Add Product</a></h3>
                            <?php } } ?>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Product Name</th>
                                        <th>Color</th>
                                        <th>Warranty</th>
                                        <th>Quantity</th>
                                        <th>Sales Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($product)) {
                                        foreach ($product as $productData) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $productData['name']; ?></td>

                                                <td><?php echo $productData['Color']; ?></td>
                                                <td><?php echo $productData['Warranty']; ?></td>
                                                <td><?php echo $productData['Quantity']; ?></td>
                                                <td><?php echo $productData['Sales Price']; ?></td>
                                                <td>
                                                    <?php if($this->user_detail['access_level'] != 'user') {?>
                                                    <a class="btn btn-sm btn-primary" href="<?= base_url('index.php/category/editProduct/' . $productData['id'] . '') ?>">Edit</a>
                                                    <button class="btn btn-sm btn-danger deleteProduct" href="#" data-id="<?php echo $productData['id']; ?>">Delete</button>
                                                    <?php } ?>
                                                    <a class="btn btn-sm btn-info" href="<?= base_url('index.php/category/viewProduct/' . $productData['id'] . '') ?>">View Product</a>
                                                    <a class="btn btn-sm btn-success addtocart" href="#" data-name="<?= $productData['name']; ?>" data-qua="<?= $productData['Quantity'] ?>" data-price="<?= $productData['Sales Price']; ?>" data-id="<?= $productData['id'] ?>">Add To Cart</a></td>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
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
<form id="categoryFilterForm" method="post">
    <input type="hidden" val="" name="category_id" id="cat_id">
</form>
<input type="hidden" val="<?php echo base_url(); ?>" name="base_url" id="base_url">