<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Testimonial</h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Update Testimonial</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url("siteadmin/testimonial/testimonial_update_process/".$update['id']) , array("class" => "form-horizontal form-label-left", "name" => "Testimonial_update_form"));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Enter Name" required="required" type="text" value="<?php echo $update['name']; ?>">
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="email" class="form-control col-md-7 col-xs-12"  name="email" placeholder="Enter Email" required="required" type="email" value="<?php echo $update['email']; ?>">
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Comment<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="comment" id="comment" style="display:none;"><?php echo $update['comment']; ?></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status<span class="required">*</span>
                        </label>
                     <div class="  col-md-3 col-sm-3 col-xs-12">
                            <select id="status" name="status" class="form-control selectpicker show-tick">
                                <option value="active" style="background: #5cb85c; color: #fff;">Active</option>
                                <option value="inactive"style="background: #FF3300; color: #fff;">Inactive</option>
                            </select>
                        </div>
                    </div>
                     <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    
                        <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#comment").cleditor();
    });
 </script>