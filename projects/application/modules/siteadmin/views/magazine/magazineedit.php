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
                    <h2>Add Magazine</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                   <?php
                    echo form_open_multipart(base_url() . "siteadmin/magazine/addmagazine", array("class" => "form-horizontal form-label-left", "name" => "Login_Form"),array('img'=>$_SESSION['magazine']['magazine_img']));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <textarea name="descr" id="descr" style="display:none;"><?php echo (!empty($_SESSION['magazine']['magazine_details']))?$_SESSION['magazine']['magazine_details']:'';?></textarea>
                            </div>
                        </div>
  <?php if(!empty($_SESSION['magazine']['magazine_img'])){?>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Previous Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <img src="<?php echo asset_url()."magazine/".$_SESSION['magazine']['magazine_img'];?>" style="height:100px;" />
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bcost">Business Cost / month <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="bcost" class="form-control col-md-7 col-xs-12"  name="bcost" placeholder="Enter Business Cost / month" required="required" type="number" step="any" value="<?php echo (!empty($_SESSION['magazine']['magazine_business_cost']))?$_SESSION['magazine']['magazine_business_cost']:'';?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icost">Individual Cost / month <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="icost" class="form-control col-md-7 col-xs-12"  name="icost" placeholder="Enter Individual Cost / month" required="required" type="number" step="any" value="<?php echo (!empty($_SESSION['magazine']['magazine_individual_cost']))?$_SESSION['magazine']['magazine_individual_cost']:'';?>">
                            </div>
                        </div>






                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p>
                                    Active :
                                    <input type="radio" class="flat" name="status" id="statusA" value="active" <?php echo (!empty($_SESSION['magazine']['magazine_status']) && $_SESSION['magazine']['magazine_status']=='active')?'checked':'';?> required /> Inactive :
                                    <input type="radio" class="flat" name="status" id="statusI" value="inactive" <?php echo (!empty($_SESSION['magazine']['magazine_status']) && $_SESSION['magazine']['magazine_status']=='inactive')?'checked':'';?> />
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
    });
</script>

