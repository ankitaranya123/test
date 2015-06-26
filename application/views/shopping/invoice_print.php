<div class="content-wrapper" id="print" style="width: 100%;margin: 0px">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <small>#<?= $invoiceid ?></small>
            <a class="btn btn-primary pull-right" href="<?php base_url('index.php/dashboard/sale');?>">Done</a>
            <a class="btn btn-primary pull-right" href="javascript:myfun()">Print</a>
        </h1>

    </section>
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i><?= SHOP_APP_ADMIN ;?>
                    <small class="pull-right">Date: <?= date('m/d/Y',time()) ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br/>
                    Email: info@almasaeedstudio.com
                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col pull-right">
                To
                <address>
                    <?php $detail = $this->customer_model->getdetial($id); ?>
                    <strong><?= $detail[0]['name'] ?></strong><br>
                    <?= $detail[0]['address']; ?><br>
                    Phone: <?= $detail[0]['PhoneNumber']; ?><br/>
                    Mobile: <?= $detail[0]['MobileNumber']; ?><br/>
                    Email: <?= $detail[0]['email'] ?>
                </address>
            </div><!-- /.col -->
            <!--            <div class="col-sm-4 invoice-col">-->
            <!--                <b>Invoice #007612</b><br/>-->
            <!--                <br/>-->
            <!--                <b>Order ID:</b> 4F3S8J<br/>-->
            <!--                <b>Payment Due:</b> 2/22/2014<br/>-->
            <!--                <b>Account:</b> 968-34567-->
            <!--            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <form action="<?= base_url('index.php/shopping/customer'); ?>" method="post" >
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Quantity</th>
                            <th>Name</th>
                            <th>Company Name</th>
                            <th>Color</th>
                            <th>Description</th>

                            <th>Price</th>
                            <th>Item Total</th>

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
                                    <td><?= $productData['quantity']; ?></td>
                                    <td><?php echo $productData['name']; ?></td>
                                    <td><?php echo $detail['Company Name']; ?></td>
                                    <td><?php echo $detail['Color']; ?></td>
                                    <td style="max-width: 200px"><?php echo $detail['Description']; ?></td>


                                    <td><?php echo $productData['price']; ?></td>
                                    <td class="midtotal"><?php echo number_format(+$productData['quantity'] * +str_replace(',', '', $productData['price']), 2); ?></td>


                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                </form>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <form action="<?= base_url('index.php/shopping/done')?>" method="post">
            <input type="hidden" name="sale_by" value="<?php echo $user_id ?>">
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <!--                <p class="lead">Payment Methods:</p>
                                    <img src="../../dist/img/credit/visa.png" alt="Visa"/>
                                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard"/>
                                    <img src="../../dist/img/credit/american-express.png" alt="American Express"/>
                                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal"/>
                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                    </p>-->
                </div><!-- /.col -->
                <div class="col-xs-6">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%"><input type="hidden" name="invoice_no" value="<?= $invoiceid ?>">Subtotal:</th>
                                <td><input type="hidden" name="customer_id" value="<?= $id ;?>"><input type="hidden" name="subtotal" value="<?= $total ;?>"><?= number_format($total,2) ?></td>
                            </tr>
                            <tr>
                                <th>Tax (<?= $tax ?>%)</th>
                                <td><input type="hidden" name="tax" value="<?= ($total * ($tax / 100)) ;?>"> <?= number_format($total * ($tax / 100),2) ?></td>
                            </tr>
                            <tr>
                                <th>Total:<input type="hidden" name="total" value="<?= $total + ($total * ($tax / 100)) ;?>"></th>
                                <td><?= number_format($total + ($total * ($tax / 100)) ,2) ?></td>
                            </tr>
                            <tr>
                                <th>Payed:
                                <td><?= number_format($payed,2); ?></td>
                            </tr>
                                <th>Due:
                                <td><?= number_format((($total + ($total * ($tax / 100)) - $payed)),2); ?></td>
                            </tr>
                        </table>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <!--                <a id="print_btn" href="--><?//= base_url('index.php/shopping/print_invoice') ?><!--" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
                    <!--                <button type="button" id="sub_print" onclick="printDiv()" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>Submit</button>-->
<!--                    <button type="submit" id="sub"  class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>Submit</button>-->
                    <!--                <button onclick="printDiv()" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                </div>
            </div>
        </form>
    </section><!-- /.content -->
    <div class="clearfix"></div>
</div><!-- /.content-wrapper -->
<script>
    function myfun() {
        window.print();
    }
</script>