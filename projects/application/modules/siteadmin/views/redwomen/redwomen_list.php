<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Redwomen</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List Redwomen</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th></th>


                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            if (!empty($listpage)) {
                                foreach ($listpage as $page) {
                                    ?>    

                                    <tr>
                                        <td><img src="<?php echo (!empty($page['red_women_img'])) ? asset_url() . "redwomen/" . $page['red_women_img'] : asset_url() . "redwomen/icon-user-default.png"; ?>" style="width:100px" /></td>
                                        <td><?php echo $page['red_women_name']; ?></td>
                                        <td><?php echo $page['red_women_title']; ?></td>
                                        <td><?php echo $page['red_women_company']; ?></td>
                                        <td><?php echo $page['red_women_email']; ?></td>
                                        <td><?php echo $page['red_women_city'] . "," . $page['red_women_state'] . "," . $page['red_women_country'] . "," . $page['red_women_zip']; ?></td>

                                        <td><?php echo $page['red_women_phone']; ?></td>

                                        <td><?php echo $page['red_women_status']; ?></td>
                                        <td><a href="<?php echo base_url('siteadmin/redwomen/redwomenedit/' . $page['red_women_id']); ?>" class="btn btn-info btn-xs">Edit</a></td>

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