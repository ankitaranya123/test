<div class="wrapper">

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Category List
                <small>All Categories</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Category List</a></li>
                <li class="active">All Category</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Category List Table</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    if(!empty($category)){
                                    foreach($category as $categoryData){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $categoryData['name']; ?></td>
                                        <td><a class="btn btn-sm btn-primary" href="<?= base_url('index.php/category/editCategory/'.$categoryData['id'].'') ?>">Edit</a>  <button class="btn btn-sm btn-danger deleteCat" href="#" data-id="<?php echo $categoryData['id']; ?>">Delete</button>  <a class="btn btn-sm btn-success" href="<?= base_url('index.php/category/addProduct/'.$categoryData['id'].'') ?>">Add Product</a> <a class="btn btn-sm btn-info" href="<?= base_url('index.php/category/productList/'.$categoryData['id'].'') ?>">Product List</a></td>
                                 </tr>
                                    <?php $i++; } } ?>
                                </tbody>
                                </table>
                                   <?php if($this->session->flashdata('success')){ ?>
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