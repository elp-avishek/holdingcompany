<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Appointment</h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Appointment</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                        <?php
                    echo form_open(base_url() . "siteadmin/appointment/appointment_fix/" . $update_info['id'], array("class" => "form-horizontal form-label-left", "name" => "appointment_update_form", ));
                    ?>  

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div>
                            <label class="control-label col-md-5 col-sm-5 col-xs-6">Client Name:</label>
                            <label class="control-label "><?php echo strtoupper($update_info['client_name']); ?></label>
                        </div>
                        <div>
                            <label class="control-label col-md-5 col-sm-5 col-xs-6">Client Email:</label>
                            <label class="control-label "><?php echo $update_info['client_email']; ?></label>
                        </div>
                        <div>
                            <label class="control-label col-md-5 col-sm-5 col-xs-6">Client Phone No:</label>
                            <label class="control-label "><?php echo $update_info['client_phone']; ?></label>
                        </div>
                        <div>
                            <label class="control-label col-md-5 col-sm-5 col-xs-6">Service :</label>
                            <label class="control-label "><?php echo strtoupper($update_info['service_name']); ?></label>
                        </div>
                        <div>
                            <label class="control-label col-md-5 col-sm-5 col-xs-6">Price :</label>
                            <label class="control-label "><?php echo $update_info['price']; ?></label>
                        </div>
                        <div>
                            <label class="control-label col-md-5 col-sm-5 col-xs-6">Time :</label>
                            <label class="control-label "><?php echo DATE('d/M/Y h:i:s A',  strtotime($update_info['time'])); ?></label>
                        </div>
                        <div>
                            <label class="control-label col-md-5 col-sm-5 col-xs-6">Stylist Assign :</label>
                            <label class="control-label "><?php echo strtoupper($update_info['stylist']); ?></label>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-6 col-sm-6 col-xs-6">Stylist :</label>
                        <label class="control-label col-md-6 col-sm-6 ">

                            <select class="col-md-12 col-sm-12" name="stylist">
                                <?php
                                foreach ($stylist as $val) {

                                    echo "<option value='" . $val['id'] . "'>" . strtoupper($val['name']) . "</option>";
                                }
                                ?>
                            </select>
                        </label><br>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" id="fix" class="btn btn-success ">Fix Appointment</button>
                                <?php echo form_close(); ?>
                            <a type="button" id='cancel' class="btn btn-danger" href="<?php echo base_url('siteadmin/appointment/appointment_cancel/'.$update_info['id']); ?>">Cancel Appointment</a>
                        </div>
                    </div>
                
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        
         
//        $("#fix").click(function(event){
//            if(!alertbox());
//              event.preventDefault();
//        });
        
        
        
   
    
    
});
//function alertbox(){
//            $.alert.open('confirm', 'Do you want to continue?', function(button) {
//                event.preventDefault();
//    if (button == 'yes')
//    {
// 
////        alert('yes');
//
//    }
//    else if(button == 'no')
//    {
//         event.preventDefault();
////         alert('no');
//
//    }   
//});}
//
//     $("#fix").click(function(){
//         alertbox();
//           
//    });
     $("#fix").click(function(event) {
        if( !confirm('Do you want to fix appointment?') ) 
            event.preventDefault();
      
    });
    
     $("#cancel").click(function(event) {
        if( !confirm('Do you want to Cancel appointment?') ) 
            event.preventDefault();
        
      
    });


    </script>