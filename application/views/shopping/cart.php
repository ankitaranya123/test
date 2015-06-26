<div class="wrapper">

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Cart
                <small>Item</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Product List</a></li>
                <li class="active">All Product</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Product List Table</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?= base_url('index.php/shopping/customer_list'); ?>" method="post" >

                                <div class="row">&nbsp;</div>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tax %</th>
                                            <th><input type="number" required="" class="tax form-control" name="tax" ></th>
                                        </tr>
                                        <tr>
                                            <th>Product No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $total = 0;
                                        if (!empty($cart)) {
                                            foreach ($cart as $productData) {
                                                $detail = $this->category_model->detail($productData['id']);

                                                $total += (+$productData['quantity'] * +str_replace(',', '', $productData['price']));
                                                ?>
                                                <tr>
                                                    <td><input type="hidden" value="<?php echo $productData['id']; ?>" name="product_id[]"> <?php echo $productData['id']; ?></td>
                                                    <td><?php echo $productData['name']; ?></td>
                                                    <td style="max-width: 200px"><?php echo $detail['Description']; ?></td>
                                                    <td><input class="form-control quantity" name="product[]" default-val="<?= $productData['quantity']; ?>" type="number" data-max="<?= $detail['Quantity'] ?>" value="<?php echo $productData['quantity']; ?>"></td>

                                                    <td><?php echo $productData['price']; ?></td>
                                                    <td class="midtotal"><?php echo number_format(+$productData['quantity'] * +str_replace(',', '', $productData['price']), 2); ?></td>
                                                    <td><a class="btn btn-sm btn-primary" href="#" id="confirm" data-href="<?= base_url('index.php/shopping/removefromcart/' . $productData['id'] . '') ?>">Remove</a></td>

                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="text-align: right" colspan="5">
                                                Total :
                                            </td>
                                            <td class="total">
                                                <?= number_format($total, 2); ?>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-success"href="">Next</button>
                                            </td>
                                        </tr>
<!--                                         <tr>-->
<!--                                            <td style="text-align: right" colspan="5">-->
<!--                                                Pay :-->
<!--                                            </td>-->
<!--                                            <td class="total">-->
<!--                                                <input class="form-control" type="text" value="--><?//= number_format($total, 2); ?><!--" name="payed" required="">-->
<!--                                            </td>-->
<!--                                            <td>-->
<!--                                                <button type="submit" class="btn btn-success"href="">Next</button>-->
<!--                                            </td>-->
<!--                                        </tr>-->
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>