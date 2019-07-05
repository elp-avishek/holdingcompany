<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>Payment List</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Payment Option</th>
                                <th>Pay Mode</th>
                                
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($payment)) {
                                foreach ($payment as $page) {
                                    ?>    
                                    <tr>
                                        <td><?php echo strtoupper($page['name']); ?></td>
                                        <td><?php echo $page['payment_option']; ?></td>
                                        <td><?php echo $page['pay_mode']; ?></td>
                                        <td><?php echo $page['trn_id']; ?></td>
                                        <td><?php echo $page['amount']; ?></td>
                                        <td><?php echo $page['date']; ?></td>
                                       
                                    </tr>
                                <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
            $('#datatable').dataTable();
        });
</script>   

