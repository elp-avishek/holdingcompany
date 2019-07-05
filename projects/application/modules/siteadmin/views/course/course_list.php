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
                          <th>Image</th>
                          <th>Title</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>              
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($course)){
                            foreach($course as $list){
                        ?>
                        <tr>
                            <td style="width:70px; height:70px"><img src="<?php echo asset_url().'course/'.$list['image'];?>" width="70px" height="70"></td>
                            <td><?php echo $list['title']?></td>
                            <td><?php echo $list['duration'].' '.$list['duration_type']?></td>
                          
                      <td><?php echo $list['price']?></td>
                      <td><?php echo $list['status']?></td>
                      <td><a href="<?php echo base_url('siteadmin/course/course_edit/'.$list['id']);?>" class="btn btn-info btn-xs center-block">Edit</a>
                     
                        </tr>
                     <?php }
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
          $(document).ready(function() {
            $('#datatable').dataTable();
        });
        </script>   
                  