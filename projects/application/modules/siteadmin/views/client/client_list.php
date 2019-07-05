<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>Course</h3>
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
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date Added</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($client_list)) {
                                foreach ($client_list as $list) {
                                    ?>
                                    <tr>
                                        <td><?php echo $list['name'] ?></td>
                                        <td><?php echo $list['email'] ?></td>
                                        <td><?php echo $list['phone'] ?></td>
                                        <td><?php echo $list['date_added'] ?></td>
                                        <td><button type="button" class="<?php echo $list['status']=='active'? 'btn btn-success':'btn btn-danger'?>" onclick="statuschange(<?php echo $list['id']?>,'<?php echo strtolower($list['name'])?>','<?php echo $list['status']=='active'?'deactivate':'activate' ?>')"><?php echo strtoupper($list['status']) ?></button></td>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
    });
    function statuschange(id,c,s){
            $.alert.open('confirm', 'Do you want to '+s+' '+c+'?', function(button) {
             
    if (button == 'yes')
    {
 
$.ajax({url:"<?php echo base_url().'siteadmin/client/changestatus'?>/"+id,
            success:function(result){
              window.location.reload();
            }
        });

    }
   
});}
    
    
    
    
//    function statuschange(id){
//        
//    }
</script> 