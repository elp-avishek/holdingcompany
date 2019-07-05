  <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Magazine</h3>
            </div>

           
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Subscriber list</h2>
                   <div class="clearfix"></div>
                </div>
                  <div class="x_content" style="overflow: auto;">
                  <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>User type</th>
                        <th>Subs type</th>
                        <th>Name</th>
                        <th>Business Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Price</th>
                        <th>Date Subscribe</th>
                        <th>Paid status</th>
                         <th>Txn id</th>
                          <th>Txn Data</th>
                          <th>Payer Id</th>
                       
                       
                      </tr>
                    </thead>


                    <tbody>
                        <?php if(!empty($listpage)){
                        foreach($listpage as $page){?>    
                        
                   <tr>
                        <td><?php echo $page['user_type'];?></td>
                        <td><?php echo $page['subs_type'];?></td>
                         
                        <td><?php echo $page['name'];?></td>
                         <td><?php echo $page['business_name'];?></td>
                        <td><?php echo $page['phone'];?></td>
                       
                        <td><?php echo $page['email'];?></td>
                         <td><?php echo $page['country'].$page['state'].$page['city'].$page['zip'];?></td>
                        <td><?php echo $page['price'];?></td>
                        <td><?php echo date("m-d-Y H:i:s",strtotime($page['date_subscribe']));?></td>
                        
                        <td><?php echo $page['paid_status'];?></td>
                         <td><?php echo $page['txn_id'];?></td>
                          <td><?php echo $page['txn_data'];?></td>
                           <td><?php echo $page['payer_id'];?></td>
                 

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