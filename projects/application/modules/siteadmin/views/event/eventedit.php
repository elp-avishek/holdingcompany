<style type="text/css">

    .custom-date-style {
        background-color: red !important;
    }

    .input{	
    }
    .input-wide{
        width: 500px;
    }

</style>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Event</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Event</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/event/editevent/" . $_SESSION['event']['event_id'], array("class" => "form-horizontal form-label-left", "name" => "Login_Form"), array("event_id" => $_SESSION['event']['event_id'], "img" => $_SESSION['event']['event_img']));
                    ?>  

                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Title" required="required" type="text" value="<?php echo (!empty($_SESSION['event']['event_title'])) ? $_SESSION['event']['event_title'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Url <span class="required" placeholder="Enter Url">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (!empty($_SESSION['event']['event_url'])) ? $_SESSION['event']['event_url'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="descr" id="descr" style="display:none;"><?php echo (!empty($_SESSION['event']['event_description'])) ? $_SESSION['event']['event_description'] : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sdate">Start Date <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <input type="text" class="form-control datetime"  name="sdate" id="sdate" placeholder="mm/dd/yyyy HH:ii"  value="<?php echo (!empty($_SESSION['event']['event_start_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_start_date'])) : ''; ?>"/>

                        </div>
                    </div>  


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edate">End Date <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control datetime"  name="edate" id="edate" placeholder="mm/dd/yyyy HH:ii" value="<?php echo (!empty($_SESSION['event']['event_end_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_end_date'])) : ''; ?>" />
                        </div>
                    </div>  

                    <?php if (!empty($_SESSION['event']['event_img'])) { ?>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Previous Image 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <img src="<?php echo asset_url() . "event/" . $_SESSION['event']['event_img']; ?>" style="height:100px;" />
                            </div>
                        </div>  
                    <?php } ?>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="image" class="form-control col-md-7 col-xs-12"  name="image" placeholder="Enter Image"  type="file">
                        </div>
                    </div>  


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Location">Location <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Location" class="form-control col-md-7 col-xs-12"  name="location" placeholder="Enter Location Link"  type="text" required="required" value="<?php echo (!empty($_SESSION['event']['event_location'])) ? $_SESSION['event']['event_location'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Link">Link <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Link" class="form-control col-md-7 col-xs-12"  name="link" placeholder="Enter Pinterest Link"  type="url" required="required" value="<?php echo (!empty($_SESSION['event']['event_link'])) ? $_SESSION['event']['event_link'] : ''; ?>">
                        </div>
                    </div>  




                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Active :
                                <input type="radio" class="flat" name="status" id="statusA" value="active" <?php echo (!empty($_SESSION['event']['event_status']) && $_SESSION['event']['event_status'] == 'active') ? 'checked' : ''; ?> required /> Inactive :
                                <input type="radio" class="flat" name="status" id="statusI" value="inactive" <?php echo (!empty($_SESSION['event']['event_status']) && $_SESSION['event']['event_status'] == 'inactive') ? 'checked' : ''; ?> />
                            </p>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary" onclick="history.back();">Back</button>
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#descr").cleditor();



        $('#sdate').datetimepicker({
            format: "m/d/Y H:i",
            dayOfWeekStart: 1,
            lang: 'en',
            /*disabledDates:['1986/01/08','1986/01/09','1986/01/10'],*/
            startDate: '<?php echo (!empty($_SESSION['event']['event_start_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_start_date'])) : date("m/d/Y H:i"); ?>',
        });
        $('#sdate').datetimepicker({value: '<?php echo (!empty($_SESSION['event']['event_start_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_start_date'])) : date("m/d/Y H:i"); ?>', step: 10});
        $('#edate').datetimepicker({
            format: "m/d/Y H:i",
            dayOfWeekStart: 1,
            lang: 'en',
            /*disabledDates:['1986/01/08','1986/01/09','1986/01/10'],*/
            startDate: '<?php echo (!empty($_SESSION['event']['event_end_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_end_date'])) : date("m/d/Y H:i"); ?>',
        });
        $('#edate').datetimepicker({value: '<?php echo (!empty($_SESSION['event']['event_end_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_end_date'])) : date("m/d/Y H:i"); ?>', step: 10});


        $('#edate1').datetimepicker({
            format: "m/d/Y H:i",
            dayOfWeekStart: 1,
            lang: 'en',
            /*disabledDates:['1986/01/08','1986/01/09','1986/01/10'],*/
            startDate: '<?php echo (!empty($_SESSION['event']['event_end_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_end_date'])) : date("m/d/Y H:i"); ?>',
        });
        $('#edate1').datetimepicker({value: '<?php echo (!empty($_SESSION['event']['event_end_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_end_date'])) : date("m/d/Y H:i"); ?>', step: 10});

        $('#sdate1').datetimepicker({
            format: "m/d/Y H:i",
            dayOfWeekStart: 1,
            lang: 'en',
            /*disabledDates:['1986/01/08','1986/01/09','1986/01/10'],*/
            startDate: '<?php echo (!empty($_SESSION['event']['event_start_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_start_date'])) : date("m/d/Y H:i"); ?>',
        });
        $('#sdate1').datetimepicker({value: '<?php echo (!empty($_SESSION['event']['event_start_date'])) ? date("m/d/Y H:i", strtotime($_SESSION['event']['event_start_date'])) : date("m/d/Y H:i"); ?>', step: 10});


    });

</script>
