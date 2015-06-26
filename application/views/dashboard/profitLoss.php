<div class="wrapper">

    <?php // var_dump($productDetails); die;?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Profit & Loss
                <small>Details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user-plus"></i>Profit & Loss</a></li>
                <li class="active">Details</li>
            </ol>
      </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            

                                 <?php 
                                 $totalAll1 = 0;
                                       $totalAllLoss0 = 0;
                                       $totalAll0 = 0;
                                       $totalAllLoss1 = 0;
                                       $totalAll2 = 0;
                                       $totalAllLoss2 = 0;
                                       $totalAll3 = 0;
                                       $totalAllLoss3 = 0;
                                   if(!empty($profitLossDate[0]['id'])){
                                       foreach($profitLossDate as $profitLossDateDetails){ 
//                                           if($profitLossTodayDetails['Purchased Price'] != NULL && $profitLossTodayDetails['Sales Price'] != NULL)
                                           $totalPurchase = $profitLossDateDetails['quantity'] * str_replace(",","",$profitLossDateDetails['Purchased Price']);
                                           $totalSale = $profitLossDateDetails['quantity'] * str_replace(",","",$profitLossDateDetails['price']);
//                                           echo $totalSale;die;
                                           $totalCal = $totalSale - $totalPurchase; 
                                           $totalAll0 += $totalCal;
     }
                                 if($totalAll0 < 0){
                                     
                                     $totalAllLoss0 = -($totalAll0);
                                     $totalAll0 = 0;
                                 }
                                   }
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
                                      $totalAll1 = 0;
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
                                       $totalAll2 = 0;
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
                                  $totalAll3 = 0;
                              }
                                   }
                                   ?>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="<?php base_url('index.php/dashboard/profitLoss'); ?>">
                        <div class="col-md-4">
                            <input type="text" name="dateFilter" placeholder="Filter By Date" class="form-control mydate">
        </div>
                    <div class="col-md-4"><button class="btn btn-primary">Submit</button></div>
                    </form>
                </div>  
                <div class="col-md-12" style="margin-top:5%;">
                    <div class="col-md-2">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Date:</h3>
                            </div><!-- /.box-header -->
                                                       
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Total Profit:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo number_format($totalAll0,2); ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Total Loss:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo number_format($totalAllLoss0,2); ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Today's:</h3>
                            </div><!-- /.box-header -->
                                                       
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Total Profit:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo number_format($totalAll1,2); ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
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
                <div class="col-md-12">
                    <div class="col-md-2">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Past 3 month's :</h3>
                            </div><!-- /.box-header -->
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Total Profit:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                   <?php echo number_format($totalAll2,2); ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Total Loss:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo number_format($totalAllLoss2,2); ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Current Year:</h3>
                            </div><!-- /.box-header -->
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Total Profit:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                 <?php echo number_format($totalAll3,2); ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                                     <div class="col-md-4">
                        <div class="box box-solid box-primary">
                            
                            <div class="box-header">
                                <h3 class="box-title">Total Loss:</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo number_format($totalAllLoss3,2); ?>
                            </div><!-- /.box-body -->
                           
                        </div><!-- /.box -->
                    </div>
                </div>
                </div>
        </section>
        <div class='control-sidebar-bg'></div>
    </div>
</div>
