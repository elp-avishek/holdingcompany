<div class="">
    
      <div class="page-title">
            <div class="title_left">
              <h3>Stylist</h3>
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
                          <th>Profile Picture</th>
                        <th>Name</th>
                        <th>social</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($listpage)){
                        foreach($listpage as $page){?>    
                   <tr>
                       <td style="height: 100px;width:100px"><img src="<?php echo asset_url().'/team/'.$page['image']?>" height="100px" width="100px"></td>
                        <td><?php echo $page['name'];?></td>
                        <td><a target="_blank" href="<?php echo !empty($page['social'][0])?$page['social'][0]:'' ?>"><?php echo !empty($page['social'][0])?'<img src="'. asset_url().'/admin/images/square-facebook-128.png'.'" width="30px" height="30px">':''?> </a>
                      <a target="_blank" href="<?php echo !empty($page['social'][1])?$page['social'][1]:'' ?>"><?php echo !empty($page['social'][1])?'<img src="'. asset_url().'/admin/images/twitter_letter-512.png'.'" width="20px" height="20px">':''?>
                      <a target="_blank" href="<?php echo !empty($page['social'][2])?$page['social'][2]:'' ?>"><?php echo !empty($page['social'][2])?'<img src="'. asset_url().'/admin/images/google-plus.png'.'" width="20px" height="20px">':''?>
                      <a target="_blank" href="<?php echo !empty($page['social'][3])?$page['social'][3]:'' ?>"><?php echo !empty($page['social'][3])?'<img src="'. asset_url().'/admin/images/socialicons_pinterest1.png'.'" width="20px" height="20px">':''?>
                      <a target="_blank" href="<?php echo !empty($page['social'][4])?$page['social'][4]:'' ?>"><?php echo !empty($page['social'][4])?'<img src="'. asset_url().'/admin/images/How-to-Harness-the-Power-of-LinkedIn-–-INFOGRAPHIC1.png'.'" width="20px" height="20px">':''?>
                      <a target="_blank" href="<?php echo !empty($page['social'][5])?$page['social'][5]:'' ?>"><?php echo !empty($page['social'][5])?'<img src="'. asset_url().'/admin/images/YouTube_logo.png'.'" width="20px" height="20px">':''?>
                      <a target="_blank" href="<?php echo !empty($page['social'][6])?$page['social'][6]:'' ?>"><?php echo !empty($page['social'][6])?'<img src="'. asset_url().'/admin/images/Multi-Color_Logo_thumbnail200.png'.'" width="30px" height="30px">':''?>
                        </td>
                        <td><?php echo $page['status'];?></td>
                       <td><a href="<?php echo base_url('siteadmin/Team/team_edit/'.$page['id']);?>" class="btn btn-info btn-xs">Edit</a></td>
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
                  