<div class="">
    
      <div class="page-title">
            <div class="title_left">
              <h3>Appointment</h3>
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
                          <th>Client Id</th>
                        <th>Client Email</th>
                        <th>Client Phone</th>
                        <th>Service Id</th>
                        <th>Stylist Name</th> 
                        <th>Date Added</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($appointment)){
                        foreach($appointment as $page){?>    
                   <tr>
                        <td><?php echo $page['client_id'];?></td>
                        <td><?php echo $page['client_email'];?></td>
                        <td><?php echo $page['client_phone'];?></td>
                        <td><?php echo $page['service'];?></td>
                     
                        <td><?php echo !empty($page['stylist'])?$page['stylist']:'Not Assigned';?></td>
                     
                        <td><?php echo DATE('d/M/Y',strtotime($page['date_added']));?></td>
                        <td style="color:<?php echo $page['status']=='active'?'green':'red' ?>"><?php echo $page['status'];?></td>
                       <td><a href="<?php echo base_url('siteadmin/appointment/appointment_edit/'.$page['id'].'/'.$page['service_id']);?>" class="btn btn-info btn-xs">Edit</a></td>
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
                  
