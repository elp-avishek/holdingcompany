  <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>News</h3>
            </div>

           
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>List News</h2>
                   <div class="clearfix"></div>
                </div>
<div class="x_content">
                  <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Status</th>
                        <th></th>
                        
                       
                      </tr>
                    </thead>


                    <tbody>
                        <?php if(!empty($listpage)){
                        foreach($listpage as $page){?>    
                        
                   <tr>
                        <td><?php echo $page['news_title'];?></td>
                        <td><?php echo $page['news_author'];?></td>
                        <td><?php echo $page['news_create_date'];?></td>
                        <td><?php echo $page['news_status'];?></td>
                       <td><a href="<?php echo base_url('siteadmin/News/newsedit/'.$page['news_id']);?>" class="btn btn-info btn-xs">Edit</a></td>
                       
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