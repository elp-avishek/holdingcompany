<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>News</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit News</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/news/editnews/".$_SESSION['news']['news_id'], array("class" => "form-horizontal form-label-left", "name" => "Login_Form"),array("news_id"=>$_SESSION['news']['news_id'],"img"=>$_SESSION['news']['news_img']));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Title" required="required" type="text" value="<?php echo (!empty($_SESSION['news']['news_title'])) ? $_SESSION['news']['news_title'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Url <span class="required" placeholder="Enter Url">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (!empty($_SESSION['news']['news_url'])) ? $_SESSION['news']['news_url'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="descr" id="descr" style="display:none;"><?php echo (!empty($_SESSION['news']['news_description'])) ? $_SESSION['news']['news_description'] : ''; ?></textarea>
                        </div>
                    </div>

                     <?php if(!empty($_SESSION['news']['news_img'])){?>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Previous Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <img src="<?php echo asset_url()."news/".$_SESSION['news']['news_img'];?>" style="height:100px;" />
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author">Author <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="author" class="form-control col-md-7 col-xs-12"  name="author" placeholder="Enter author name"  type="text" required="required" value="<?php echo (!empty($_SESSION['news']['news_author'])) ? $_SESSION['news']['news_author'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pdate">Published Date <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="input-group date">
                                <input type="text" class="form-control" name="pdate" id="pdate" required="required" value="<?php echo (!empty($_SESSION['news']['news_create_date'])) ? $_SESSION['news']['news_create_date'] : ''; ?>" readonly="readonly"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>  

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="facebook" class="form-control col-md-7 col-xs-12"  name="facebook" placeholder="Enter Facebook Link"  type="text" value="<?php echo (!empty($_SESSION['news']['social'])) ? $_SESSION['news']['social']['facebook'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Twitter">Twitter 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Twitter" class="form-control col-md-7 col-xs-12"  name="twitter" placeholder="Enter Twitter Link"  type="text" value="<?php echo (!empty($_SESSION['news']['social'])) ? $_SESSION['news']['social']['twitter'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="googleplus">Google Plus 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="googleplus" class="form-control col-md-7 col-xs-12"  name="googleplus" placeholder="Enter googleplus Link"  type="text" value="<?php echo (!empty($_SESSION['news']['social'])) ? $_SESSION['news']['social']['google-plus'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Pinterest">Pinterest 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Pinterest" class="form-control col-md-7 col-xs-12"  name="pinterest" placeholder="Enter Pinterest Link"  type="text" value="<?php echo (!empty($_SESSION['news']['social'])) ? $_SESSION['news']['social']['pinterest'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Linkedin">Linkedin 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Linkedin" class="form-control col-md-7 col-xs-12"  name="linkedin" placeholder="Enter Linkedin Link"  type="text" value="<?php echo (!empty($_SESSION['news']['social'])) ? $_SESSION['news']['social']['linkedin'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Youtube">Youtube 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Youtube" class="form-control col-md-7 col-xs-12"  name="youtube" placeholder="Enter Youtube Link"  type="text" value="<?php echo (!empty($_SESSION['news']['social'])) ? $_SESSION['news']['social']['youtube'] : ''; ?>">
                        </div>
                    </div>  
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="instagram" class="form-control col-md-7 col-xs-12"  name="instagram" placeholder="Enter Instagram Link"  type="text" value="<?php echo (!empty($_SESSION['news']['social'])) ? $_SESSION['news']['social']['instagram'] : ''; ?>">
                        </div>
                    </div>  




                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Active :
                                <input type="radio" class="flat" name="status" id="statusA" value="active" <?php echo (!empty($_SESSION['news']['news_status']) && $_SESSION['news']['news_status'] == 'active') ? 'checked' : ''; ?> required /> Inactive :
                                <input type="radio" class="flat" name="status" id="statusI" value="inactive" <?php echo (!empty($_SESSION['news']['news_status']) && $_SESSION['news']['news_status'] == 'inactive') ? 'checked' : ''; ?> />
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
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true,
            startDate: '-1d'
        });
    });
</script>
