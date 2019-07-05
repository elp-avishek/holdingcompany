<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Stylist</h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Stylist</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/stylist/stylist_add_process", array("class" => "form-horizontal form-label-left", "name" => "team_form"));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Name" required="required" type="text" value="<?php echo (!empty($_SESSION['stylist']['title'])) ? $_SESSION['stylist']['title'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="Enter URL" required="required" type="text" value="<?php echo (!empty($_SESSION['stylist']['url'])) ? $_SESSION['stylist']['url'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="email" class="form-control col-md-7 col-xs-12"  name="email" placeholder="Enter Email" required="required" type="email" value="<?php echo (!empty($_SESSION['stylist']['email'])) ? $_SESSION['stylist']['email'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="password" class="form-control col-md-7 col-xs-12 <?php  echo $this->session->flashdata('color_add');?>"  name="password" placeholder="Enter Password" required="required" type="password" value="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_password">Confirm Password <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="confirm_password" class="form-control col-md-7 col-xs-12 <?php  echo $this->session->flashdata('color_add');?>"  name="confirm_password" placeholder="Enter Password" required="required" type="password" value="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="license_number">License Number <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="license_number" class="form-control col-md-7 col-xs-12"  name="license_number" placeholder="Enter License Number" required="required" type="text" value="<?php echo (!empty($_SESSION['stylist']['license_number'])) ? $_SESSION['stylist']['license_number'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" >
                            <input id="image"  name="image" placeholder="Enter Image"  type="file">
                        </div>
                    </div>  
                    <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="find_us">How did you find us? 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
<input id="find_us" class="form-control col-md-7 col-xs-12"  name="find_us" placeholder="Enter Detail" type="text" value="<?php echo (!empty($_SESSION['stylist']['find_us'])) ? $_SESSION['stylist']['find_us'] : ''; ?>">
                            </div>      
                        </div>
                       
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="school_completed">School Completed 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="school_completed" class="form-control col-md-7 col-xs-12"  name="school_completed" placeholder="Enter School Name"  type="text" value="<?php echo (!empty($_SESSION['stylist']['school_completed'])) ? $_SESSION['stylist']['school_completed'] : ''; ?>">
                        </div>
                    </div>
                     <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="facebook" class="form-control col-md-7 col-xs-12"  name="facebook" placeholder="Enter Facebook Link"  type="url" value="<?php echo (!empty($_SESSION['stylist']['facebook'])) ? $_SESSION['stylist']['facebook'] : ''; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Twitter">Twitter 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Twitter" class="form-control col-md-7 col-xs-12"  name="twitter" placeholder="Enter Twitter Link"  type="url" value="<?php echo (!empty($_SESSION['stylist']['twitter'])) ? $_SESSION['stylist']['twitter'] : ''; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="googleplus">Google Plus 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="googleplus" class="form-control col-md-7 col-xs-12"  name="googleplus" placeholder="Enter googleplus Link"  type="url" value="<?php echo (!empty($_SESSION['stylist']['googleplus'])) ? $_SESSION['stylist']['googleplus'] : ''; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Pinterest">Pinterest 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Pinterest" class="form-control col-md-7 col-xs-12"  name="pinterest" placeholder="Enter Pinterest Link"  type="url" value="<?php echo (!empty($_SESSION['stylist']['pinterest'])) ? $_SESSION['stylist']['pinterest'] : ''; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Linkedin">Linkedin 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Linkedin" class="form-control col-md-7 col-xs-12"  name="linkedin" placeholder="Enter Linkedin Link"  type="url" value="<?php echo (!empty($_SESSION['stylist']['linkedin'])) ? $_SESSION['stylist']['linkedin'] : ''; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Youtube">Youtube 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Youtube" class="form-control col-md-7 col-xs-12"  name="youtube" placeholder="Enter Youtube Link"  type="url" value="<?php echo (!empty($_SESSION['stylist']['youtube'])) ? $_SESSION['stylist']['youtube'] : ''; ?>">
                            </div>
                        </div>  
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="instagram" class="form-control col-md-7 col-xs-12"  name="instagram" placeholder="Enter Instagram Link"  type="url" value="<?php echo (!empty($_SESSION['stylist']['instagram'])) ? $_SESSION['stylist']['instagram'] : ''; ?>">
                            </div>
                        </div>  
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type=button" class="btn btn-primary" onclick="history.back();">Back</button>
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

<!--<script>
    $(document).ready(function () {
        $("#find_us").cleditor();
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true,
            startDate: '-1d'
        });
    });
</script>-->

