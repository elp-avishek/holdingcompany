<div class="">
    
      <div class="page-title">
            <div class="title_left">
              <h3>Service</h3>
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
                          <th>Image</th>
                          <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>              
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($service)){
                            foreach($service as $list){
                        ?>
                        <tr>
                            <td style="width:70px; height:70px"><img src="<?php echo asset_url().'/service/'.$list['image']?>" width="70px" height="70"></td>
                            <td><?php echo $list['name']?></td>
                      <td><?php echo $list['price']?></td>
                      <td><?php echo $list['status']?></td>
                      <td style="width:70px; height:70px"><a href="<?php echo base_url('siteadmin/service/service_edit/'.$list['id']);?>" class="btn btn-info btn-md center">Edit</a>
                     <a href="<?php echo base_url('siteadmin/service/service_tag/'.$list['id']);?>" class="btn btn-success btn-md center">Tag Stylist</a>
                     <a href="<?php echo base_url('siteadmin/service/closedate/'.$list['id']);?>" class="btn btn-danger btn-md center">Service Close</a>
                     <a href="<?php echo base_url('siteadmin/service/service_edit_period/'.$list['id']);?>" class="btn btn-warning btn-md center">Service Period</a>
                      </td>
                        </tr>
                     <?php }
                        }
                        ?>
                        
                    </tbody>
                  </table>
                  
                  <div class="clearfix"></div>
               </div>
              </div>
            </div>
    </div>
</div>
<script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
        });
        </script>