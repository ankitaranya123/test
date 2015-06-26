<div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Category
                <small>Add Category</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Category</a></li>
                <li class="active">Add Category</li>
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
                            <h3 class="box-title">Add Category</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="<?= base_url('index.php/category/addCategory')?>" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Category Name">
                                    
                                </div>
                            </div><!-- /.box-body -->
                            <?php echo validation_errors();?>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                    <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                   <?php echo $this->session->flashdata('success'); ?>
                  </div>
                    <?php } ?>
            </div>
        </section>
        <div class='control-sidebar-bg'></div>
    </div>
</div>