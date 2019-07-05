<div class="">
    
      <div class="page-title">
            <div class="title_left">
              <h3>Testimonial</h3>
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
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($t_list)){
                        foreach($t_list as $page){?>    
                   <tr>
                        <td><?php echo $page['name'];?></td>
                        <td><?php echo $page['email'];?></td>
                        <td><?php echo $page['status'];?></td>
                       <td><a href="<?php echo base_url('siteadmin/testimonial/testimonial_update/'.$page['id']);?>" class="btn btn-info btn-xs">Edit</a></td>
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
                  