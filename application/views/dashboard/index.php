<div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $data['product'] ?></h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $data['user'] ?></h3>
                            <p>Total User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?= $data['customer'] ?></h3>
                            <p>Total Customers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
            <!-- Main row -->
            <?php
            $totalAll1 = 0;
            $totalAllLoss1 = 0;
            $totalAll2 = 0;
            $totalAllLoss2 = 0;
            $totalAll3 = 0;
            $totalAllLoss3 = 0;
            if(!empty($profitLossToday[0]['id'])){

                foreach($profitLossToday as $profitLossTodayDetails){
//                                           if($profitLossTodayDetails['Purchased Price'] != NULL && $profitLossTodayDetails['Sales Price'] != NULL)
                    $totalPurchase = $profitLossTodayDetails['quantity'] * str_replace(",","",$profitLossTodayDetails['Purchased Price']);
                    $totalSale = $profitLossTodayDetails['quantity'] * str_replace(",","",$profitLossTodayDetails['price']);
//                                           echo $totalSale;die;
                    $totalCal = $totalSale - $totalPurchase;
                    $totalAll1 += $totalCal;
                }
                if($totalAll1 < 0){
                    $totalAllLoss1 = -($totalAll1);
                }
            }
            if(!empty($profitLossMonth[0]['id'])){
                foreach($profitLossMonth as $profitLossMonthDetails){
                    $totalPurchase2 = $profitLossMonthDetails['quantity'] * str_replace(",","",$profitLossMonthDetails['Purchased Price']);
                    $totalSale2 =$profitLossMonthDetails['quantity'] * str_replace(",","",$profitLossMonthDetails['price']);
//                                           echo $totalSale;die;
                    $totalCal2 = $totalSale2 - $totalPurchase2;
                    $totalAll2 += $totalCal2;
                }
                if($totalAll2 < 0){

                    $totalAllLoss2 = -($totalAll2);
                }
            }
            if(!empty($profitLossYear[0]['id'])){
                foreach($profitLossYear as $profitLossYearDetails){
                    $totalPurchase3 = $profitLossYearDetails['quantity'] * str_replace(",","",$profitLossYearDetails['Purchased Price']);
                    $totalSale3 =$profitLossYearDetails['quantity'] * str_replace(",","",$profitLossYearDetails['price']);
//                                           echo $totalSale;die;
                    $totalCal3 = $totalSale3 - $totalPurchase3;
                    $totalAll3 += $totalCal3;


                }
                if($totalAll3 < 0){
                    $totalAllLoss3 = -($totalAll3);
                }
            }
            ?>
            <div class="row">



                    <div class="col-md-6">
                        <div class="box box-solid box-primary">

                            <div class="box-header">
                                <h3 class="box-title">Total Profit:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo number_format($totalAll1,2); ?>
                            </div><!-- /.box-body -->

                        </div><!-- /.box -->
                    </div>
                    <div class="col-md-6">
                        <div class="box box-solid box-primary">

                            <div class="box-header">
                                <h3 class="box-title">Total Loss:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo number_format($totalAllLoss1,2); ?>
                            </div><!-- /.box-body -->

                        </div><!-- /.box -->
                    </div>

                </div>

            <div class="row">


                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Last 10 Sale</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabel" class="table table-bordered table-hover">
                                <thead>

                                <tr>
                                    <th>Invoice No</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Total Pay</th>
                                    <th>Due</th>
                                    <th>Sale By</th>
                                    <th>Sale Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($data['sale'])){
                                    foreach($data['sale'] as $val){
                                        ?>
                                        <tr>
                                            <td><?= $val['invoice_no']; ?></td>
                                            <td><?= $val['name']; ?></td>
                                            <td><?= $val['address']; ?></td>
                                            <td><?= $val['email']; ?></td>
                                            <td><?= $val['total']; ?></td>
                                            <td><?= $val['due']; ?></td>
                                            <td><?= $val['sale_by']; ?></td>
                                            <td><?= $val['created']; ?></td>
                                        </tr>
                                <?php
                                    }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class='control-sidebar-menu'>
                    <li>
                        <a href='javascript::;'>
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href='javascript::;'>
                            <i class="menu-icon fa fa-user bg-yellow"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href='javascript::;'>
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href='javascript::;'>
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class='control-sidebar-menu'>
                    <li>
                        <a href='javascript::;'>
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href='javascript::;'>
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href='javascript::;'>
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-waring pull-right">50%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href='javascript::;'>
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                        <p>
                            Other sets of options are available
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div><!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right" />
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->