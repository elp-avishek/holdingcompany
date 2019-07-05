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
                  <h2>List Magazine</h2>
                   <div class="clearfix"></div>
                </div>
<div class="x_content">
                  <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Magazine business cost</th>
                        <th>Magazine individual cost</th>
                        <th>Date Update</th>
                        <th>Status</th>
                       <th></th>
                       
                      </tr>
                    </thead>


                    <tbody>
                        <?php if(!empty($listpage)){
                            $i=0;
                        foreach($listpage as $page){?>    
                        
                   <tr>
                        <td><?php echo $page['magazine_business_cost'];?></td>
                        <td><?php echo $page['magazine_individual_cost'];?></td>
                         <td><?php echo date("m-d-Y H:i:s",strtotime($page['create_date']));?></td>
                        <td><?php echo $page['magazine_status'];?></td>
                        
                        <td><?php if($i==0){?><a href="<?php echo base_url('siteadmin/magazine/magazineedit/'.$page['magazine_id']);?>" class="btn btn-info btn-xs">Edit</a><?php } ?></td>

                      </tr>
                        <?php
                        $i++;
                        
                        }
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