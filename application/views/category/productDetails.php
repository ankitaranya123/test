<div class="wrapper">

    <?php // var_dump($productDetails); die;?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Product
                <small>Product Details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i> Product</a></li>
                <li class="active">Product Details</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
              
                <?php
                            if (!empty($productDetails)) {
                                foreach ($productDetails as $productDetailsData) {
                                    if($productDetailsData['name'] != "Description"){ 
                                    ?>
                    <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title"><?php echo $productDetailsData['name']; ?></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                               <?php echo $productDetailsData['value']; ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                                <?php } } } ?>
                <?php
                            if (!empty($productDetails)) {
                                foreach ($productDetails as $productDetailsData) {
                                    if($productDetailsData['name'] == "Description"){ 
                                    ?>
                    <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title"><?php echo $productDetailsData['name']; ?></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                               <?php echo $productDetailsData['value']; ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                                <?php } } } ?>
                </div>
                </div>
        </section>
        <div class='control-sidebar-bg'></div>
    </div>
</div>
