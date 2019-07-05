<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Projects</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Project</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/projects/editprojects/".$_SESSION['projects']['projects_id'], array("class" => "form-horizontal form-label-left", "name" => "Login_Form"),array("projects_id"=>$_SESSION['projects']['projects_id'],"img"=>$_SESSION['projects']['projects_img']));
                    ?>   
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Title" required="required" type="text" value="<?php echo (!empty($_SESSION['projects']['projects_title'])) ? $_SESSION['projects']['projects_title'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Url <span class="required" placeholder="Enter Url">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (!empty($_SESSION['projects']['projects_url'])) ? $_SESSION['projects']['projects_url'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="descr" id="descr" style="display:none;"><?php echo (!empty($_SESSION['projects']['projects_details'])) ? $_SESSION['projects']['projects_details'] : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pdate">Published Date <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="input-group date">
                                <input type="text" class="form-control" name="pdate" id="pdate" readonly="readonly" value="<?php echo (!empty($_SESSION['projects']['projects_date'])) ? date("Y-m-d", strtotime($_SESSION['projects']['projects_date'])) : ''; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>  
                    <?php if (!empty($_SESSION['projects']['projects_img'])) { ?>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Previous Image 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <img src="<?php echo asset_url() . "projects/" . $_SESSION['projects']['projects_img']; ?>" style="height:100px;" />
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Location <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="location" class="form-control col-md-7 col-xs-12"  name="location" placeholder="Enter location name"  type="text" required="required" value="<?php echo (!empty($_SESSION['projects']['projects_where'])) ? $_SESSION['projects']['projects_where'] : ''; ?>">
                        </div>
                    </div>  





                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Active :
                                <input type="radio" class="flat" name="status" id="statusA" value="active" <?php echo (!empty($_SESSION['projects']['projects_status']) && $_SESSION['projects']['projects_status'] == 'active') ? 'checked' : ''; ?> required /> Inactive :
                                <input type="radio" class="flat" name="status" id="statusI" value="inactive" <?php echo (!empty($_SESSION['projects']['projects_status']) && $_SESSION['projects']['projects_status'] == 'inactive') ? 'checked' : ''; ?> />
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
                    </form>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#descr").cleditor();
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true,
            startDate: '-1d'
        });
    });
</script>
