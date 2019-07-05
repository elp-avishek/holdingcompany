<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>CMS</h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ADD CMS</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    echo form_open(base_url() . "siteadmin/cms/cms_add_process/", array("class" => "form-horizontal form-label-left", "name" => "cms"));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Name" required="required" type="text" value="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="Enter URL" required="required" type="text" value="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descr">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="descr" id="descr" style="display:none;"></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu">Menu Order<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="menu" class="form-control col-md-7 col-xs-12"  name="menu" required="required" type="text" value="">
                        </div>
                    </div>
		    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Active :
                                <input type="radio" class="flat" name="cms_status" id="banner_typeI" value="active" checked="" required /> Inactive :
                                <input type="radio" class="flat" name="cms_status" id="banner_typeV" value="inactive" />
                            </p>
                        </div>
                    </div>
		    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Show In Top Menu</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Yes :
                                <input type="radio" class="flat" name="cms_menu" id="banner_typeI" value="Y" checked="" required /> No :
                                <input type="radio" class="flat" name="cms_menu" id="banner_typeV" value="N" />
                            </p>
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
        $("#descr").cleditor();
    });
</script>
