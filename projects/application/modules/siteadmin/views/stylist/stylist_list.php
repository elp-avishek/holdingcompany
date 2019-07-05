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
                  <h2>Details</h2>
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
                        <th>Email</th>
                        <th>social</th>
                        <th>Status</th>
                        <th>Action</th>              
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($stylist_list)){
                            foreach($stylist_list as $list){
                        ?>
                        <tr>
                            <td style="width:100px; height:100px"><img src="<?php echo asset_url().'/stylist/'.$list['image']?>" width="100px" height="100"></td>
                            <td><?php echo $list['name']?></td>
                            <td><?php echo $list['email']?></td>
                            <td><a target="_blank" href="<?php echo !empty($list['social'][0])?$list['social'][0]:'' ?>"><?php echo !empty($list['social'][0])?'<img src="'. asset_url().'/admin/images/square-facebook-128.png'.'" width="30px" height="30px">':''?> </a>
                            <a target="_blank" href="<?php echo !empty($list['social'][1])?$list['social'][1]:'' ?>"><?php echo !empty($list['social'][1])?'<img src="'. asset_url().'/admin/images/twitter_letter-512.png'.'" width="30px" height="30px">':''?> </a>
                            <a target="_blank" href="<?php echo !empty($list['social'][2])?$list['social'][2]:'' ?>"><?php echo !empty($list['social'][2])?'<img src="'. asset_url().'/admin/images/google-plus.png'.'" width="30px" height="30px">':''?> </a>
                            <a target="_blank" href="<?php echo !empty($list['social'][3])?$list['social'][3]:'' ?>"><?php echo !empty($list['social'][3])?'<img src="'. asset_url().'/admin/images/socialicons_pinterest1.png'.'" width="30px" height="30px">':''?> </a>
                            <a target="_blank" href="<?php echo !empty($list['social'][4])?$list['social'][4]:'' ?>"><?php echo !empty($list['social'][4])?'<img src="'. asset_url().'/admin/images/How-to-Harness-the-Power-of-LinkedIn-–-INFOGRAPHIC1.png'.'" width="30px" height="30px">':''?> </a>
                            <a target="_blank" href="<?php echo !empty($list['social'][5])?$list['social'][5]:'' ?>"><?php echo !empty($list['social'][5])?'<img src="'. asset_url().'/admin/images/YouTube_logo.png'.'" width="30px" height="30px">':''?> </a>
                            <a target="_blank" href="<?php echo !empty($list['social'][6])?$list['social'][6]:'' ?>"><?php echo !empty($list['social'][6])?'<img src="'. asset_url().'/admin/images/Multi-Color_Logo_thumbnail200.png'.'" width="30px" height="30px">':''?> </a>
                      </td>
                      <td><?php echo $list['status']?></td>
                      <td><a href="<?php echo base_url('siteadmin/stylist/stylist_edit/'.$list['id']);?>" class="btn btn-info btn-xs center-block">Edit</a>
                      
                      <a href="<?php echo base_url('siteadmin/payment/payment_detail/'.$list['id']);?>" class="btn btn-dark btn-xs center-block">Payment Details</a>
                      
                      </td>
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
                  