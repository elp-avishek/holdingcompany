  <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Vendor & Sponsors</h3>
            </div>

           
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>List Vendor & Sponsors</h2>
                   <div class="clearfix"></div>
                </div>
<div class="x_content">
                 
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                         <th>Date added</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Company name</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                       <th>Zip</th>
                       <th>Events</th>
                      </tr>
                    </thead>


                    <tbody>
                        <?php if(!empty($listpage)){
                        foreach($listpage as $page){?>    
                        
                   <tr>
                        <td><?php echo $page['vendor_date_added'];?></td>
                        <td><?php echo $page['vendor_name'];?></td>
                        <td><?php echo $page['vendor_type'];?></td>
                        <td><?php echo $page['vendor_email'];?></td>
                        <td><?php echo $page['vendor_company_name'];?></td>
                        
                        
                        <td><?php echo $page['vendor_phone'];?></td>
                        <td><?php echo $page['vendor_country'];?></td>
                        <td><?php echo $page['vendor_state'];?></td>
                        <td><?php echo $page['vendor_city'];?></td>
                        <td><?php echo $page['vendor_zip'];?></td>
                        <td>
                            <?php foreach($page['vendor_event_id'] as $events){?>
                            
                            <a href="<?php echo base_url('event/'.strtolower ($events));?>" class="btn btn-xs btn-info" target="_blank">View</a>
                            <?php } ?></td>
                      </tr>
                        <?php }
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