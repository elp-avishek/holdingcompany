<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Services Period Edit</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/service/service_period_process/".$id, array("class" => "form-horizontal form-label-left", "name" => "course_form"));
                    ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <th style="width:100px">Days</th>
                        <th>Time</th>
                        </thead>
                        <tbody>
                            <tr> 
                        <td>
                            <span id='days' onclick='days("monday")' style="cursor:pointer"> Monday </span>
                        </td>
                        <td rowspan="7"><span id='time1'></span>
                        </td>
                            </tr>
                            <tr>
                                <td> <span id='days' onclick='days("tuesday")' style="cursor:pointer" >Tuesday </span></td>
                            </tr>
                            <tr>
                                <td> <span id='days' onclick='days("wednesday")' style="cursor:pointer">Wednesday</span></td>
                            </tr>
                            <tr>
                                <td> <span id='days' onclick='days("thursday")' style="cursor:pointer">Thursday</span></td>
                            </tr>
                            <tr>
                                <td> <span id='days' onclick='days("friday")' style="cursor:pointer">Friday</span></td>
                            </tr>
                            <tr>
                                <td> <span id='days' onclick='days("saturday")' style="cursor:pointer">Saturday</span></td>
                            </tr>
                            <tr>
                                <td> <span id='days' onclick='days("sunday")' style="cursor:pointer">Sunday</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php echo form_close();?>
                </div>
                <button type="button" class="btn btn-warning btn-md center alignright" onclick="history.back();">Back</button>
            </div>
        </div>
    </div>
</div>
<script>
    
   function days(day){
       var day;
       
         $.ajax({url: "<?php echo base_url() . 'siteadmin/service/service_edit_period_process/'.$id; ?>/"+day, 
             success: function(result){
             $("#time1").html(result);
    }
    });
    }
    $(document).ready(function(){
        days('monday');
    });
</script>
    