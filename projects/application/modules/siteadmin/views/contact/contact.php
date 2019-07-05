<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Contact</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List Contact</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date added</th>
                                <th>Detail</th>



                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            if (!empty($contact_list)) {
                                foreach ($contact_list as $page) {
                                    ?>    

                                    <tr>

                                        <td><?php echo $page['email']; ?></td>
                                        <td><?php echo $page['subject']; ?></td>
                                        <td><?php echo $page['date_added']; ?></td>
                                        <td ><a href="<?php echo base_url('siteadmin/Contact/Contact_info/' . $page['id']); ?>" class="btn btn-xs btn-success">click</a></td>



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
    $(document).ready(function () {
        $('#datatable').dataTable();
    });
</script>