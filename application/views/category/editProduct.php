<div class="wrapper">

    <?php // var_dump($productFields); die;?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Product
                <small>Add Product</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i> Product</a></li>
                <li class="active">Add Product</li>
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
                            <!--<h3 class="box-title">Add Product</h3>-->
                            <div><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Add Fields</button></div>
                        </div><!-- /.box-header -->

                        <!-- form start -->
                        <form role="form" action="<?= base_url('index.php/category/editProduct') ?>" method="post" enctype="multipart/form-data">
                            <div class="box-body addProduct">
                                <?php
                                if (!empty($productFields)) {

                                    foreach ($productFields as $productFieldsData) {
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $productFieldsData['name']; ?></label>
                                            <?php if ($productFieldsData['type'] == "Input") { ?>
                                                <input type="text" value="<?php echo $productFieldsData['value']; ?>" name="<?php echo $productFieldsData['id']; ?>"  class="form-control" id="exampleInputEmail1" placeholder="<?php echo $productFieldsData['name']; ?>">
                                            <?php } ?>
                                            <?php if ($productFieldsData['type'] == "TextArea") { ?>
                                                <textarea name="<?php echo $productFieldsData['id']; ?>" class="form-control"  placeholder="<?php echo $productFieldsData['name']; ?>"><?php echo $productFieldsData['value']; ?></textarea>
                                            <?php } ?>
                                        </div>
                                    <?php }
                                } ?>
                            </div><!-- /.box-body -->
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>" class="form-control">
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
