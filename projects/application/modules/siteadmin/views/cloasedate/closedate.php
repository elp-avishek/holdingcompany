<style>
     .ui-datepicker .ui-datepicker-calendar .ui-state-highlight a {
    background: #743620 none;
    color: white;
}

    
    
</style>
 <?php 

 ?>
<div id="m_date">

</div>
<div>
   
    <?php
    echo form_open_multipart(base_url() . "siteadmin/Service/close_date/" . $service_id, array("class" => "form-horizontal form-label-left", "name" => "team_form"));
    ?>  
    <input type="hidden" id="altField" name="altField" value="">
    <div class="form-group">
        <div class="ln_solid"></div>
        <div class="col-md-6 col-md-offset-4">
            <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
            <button id="send" type="submit" class="btn btn-success">Submit</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        var today = new Date();
        var y = today.getFullYear();

        $('#m_date').multiDatesPicker({



<?php if(!empty($close_info)){?>
                addDates:
            <?php echo str_replace(' ','',str_replace('\/', '/', json_encode($close_info)));
?>
                ,
<?php  }?>
                numberOfMonths: [3, 4],
                defaultDate: '1/1/' + y,
                altField: '#altField',
                 minDate: 0

    });
    });


</script>
<?php // if(!empty($close_info)){?>
              
            
<?php // print_r($close_info); }?>