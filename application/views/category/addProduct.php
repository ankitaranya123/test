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
                        <form role="form" action="<?= base_url('index.php/category/addProduct') ?>" method="post" enctype="multipart/form-data">
                            <div class="box-body addProduct">
                                <?php
                                if (!empty($productFields)) {

                                    foreach ($productFields as $productFieldsData) {
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $productFieldsData['name']; ?></label>
                                            <?php if ($productFieldsData['type'] == "Input") { ?>
                                                <input type="text" value="" name="<?php echo $productFieldsData['id']; ?>"  class="form-control" id="exampleInputEmail1" placeholder="<?php echo $productFieldsData['name']; ?>">
                                            <?php } ?>
                                            <?php if ($productFieldsData['type'] == "TextArea") { ?>
                                                <textarea name="<?php echo $productFieldsData['id']; ?>" class="form-control"  placeholder="<?php echo $productFieldsData['name']; ?>"></textarea>
                                            <?php } ?>
                                        </div>
                                    <?php }
                                } ?>
                            </div><!-- /.box-body -->
                                <input type="hidden" name="category_id" value="<?php echo $categoryId; ?>" class="form-control">
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
<div class="form-group fieldsClone" hidden="">
    <label for="exampleInputEmail1"></label>
    <input type="text" name="" value="" class="form-control" id="">
</div>  

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                <div class="form-group">
                    <input type="text" name="" value="" class="form-control" id="fieldsName" placeholder="Fields Name" required="">
                    <input type="hidden" name="category_id" value="<?php echo $categoryId; ?>" class="form-control" id="categoryId">
                    <input type="hidden" name="base_url" value="<?php echo base_url(); ?>" class="form-control" id="base_url">
               </div>
                    <div style="color:red;" id="modalError" class="hide">Please fill the value.</div>
                 </form>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Close</button>
                <button type="button" class="btn btn-primary" id ='saveFields'>Save</button>
            </div>
        </div>

    </div>
</div>
