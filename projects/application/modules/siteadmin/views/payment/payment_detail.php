<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>Payment Details</h3>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php if (!empty($pay['name'])) echo(strtoupper($pay['name'])) ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>

                    <div class="col-md-12 col-xs-12 col-lg-12">
                        <h1><b><u>RECIEVED</u></b></h1>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <th>Course</th>
                            <th>Fee</th>
                            <th>Payment</th>
                            </thead>
                            <tbody>

                                <tr><td>
                                        <table class="table table-striped"><?php
                                            if (!empty($pay['title'])) {
                                                foreach ($pay['title'] as $ctitle) {
                                                    echo "<tr><td>" . $ctitle . "</td></tr>";
                                                }
                                            }
                                            ?></table> 
                                    </td><td>
                                        <table class="table table-striped">
                                            <?php
                                            if (!empty($pay['price'])) {
                                                foreach ($pay['price'] as $price) {
                                                    echo "<tr><td>$" . $price . "</td></tr>";
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td><td width="30%" >
                                        <table class="">
                                            <?php
                                            $sum = 0;
                                            if (!empty($trancsation)) {
                                                
                                                foreach ($trancsation as $amt) {
                                                    $sum = $sum+ $amt['amount'];
                                                    echo "<tr><td>$" . $amt['amount'] . "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $amt['date'] . "</td></tr>";
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>______________</td>
                                            </tr>
                                            <tr>
                                                <td>TOTAL <?php echo $sum ?></td>
                                            </tr>
                                        </table>
                                    </td></tr>


                            </tbody>
                        </table>

                        <div class="col-md-12 col-xs-12 col-lg-12">
                            <h1 ><b><u>PAID</u></b></h1>
                            <div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th>Service</th>
                                    <th>Price</th>
                   
                                    <th>Amount Paid to Stylist</th>
                                    </thead>
                                    <tbody>
                                        <tr><td>
                                                <table class="table table-striped">
                                                    <?php
                                                    if (!empty($service['name'])) {
                                                        foreach ($service['name'] as $key=>$ser) {
                                                            echo "<tr><td>$".$ser. "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$service['time'][$key].")</tr>";
                                                        }
                                                    }
                                                    ?>
                                                </table>
                                            </td>
                                            <td> <table class="table table-striped">
                                                    <?php
                                                    $total_earn=0;
                                                    if (!empty($service['price'])) {
                                                        
                                                        foreach ($service['price'] as $price) {
                                                            echo "<tr><td>$". $price. "</td></tr>";
                                                            $total_earn=$price+$total_earn;
                                                        }
                                                    }
                                                    ?> <tr><td>_________________________</td></tr>
                                                    <tr><td>Total: <?php echo $total_earn ?></td></tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <?php
                                                     $paid_amount=0;
                                                    if (!empty($paid_transaction)) {
                                                       
                                                        foreach ($paid_transaction as $amount) {
                                                            echo "<tr><td>$".$amount['amount']. "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$amount['date']."</td></tr>";
                                                        
                                                            $paid_amount=$paid_amount+$amount['amount'];
                                                        }
                                                    }
                                                    ?>
                                                    <tr><td>_________________________</td></tr>
                                                    <tr><td id='amt'>Total: <?php echo  $paid_amount ?></td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <?php 
                            echo form_open_multipart(base_url() . "siteadmin/payment/payout/" . $pay['stylish_id'], array("class" => "form-horizontal form-label-left", "name" => "pay_form")) ?>
                            <div class="col-md-offset-4 col-sm-3 col-xs-3 ">
                                <label>Pay Out:</label>
                                <input class="form-control"type="number" name="amount" min='0' step='any' required>
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-3 col-xs-3 ">
                                <label>Note:</label>
                                <textarea class="form-control" type="text"  name="note"  required></textarea>
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-3 col-xs-3 ">
                                <button type="submit" class="btn btn-success" name='pay'>PAY</button>
                            </div>
                            <?php form_close() ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
         <script type="text/javascript">
                  $(document).ready(function() {
                    $('#amt').toggle( "highlight" );
                    $('#amt').toggle( "highlight" );
                });
                </script>   