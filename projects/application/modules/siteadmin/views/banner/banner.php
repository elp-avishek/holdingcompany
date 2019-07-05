<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Banner</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Banner</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">

                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/banner/addbanner", array("class" => "form-horizontal form-label-left", "name" => "Login_Form"));
                    ?>   
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Banner Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Image :
                                <input type="radio" class="flat" name="banner_type" id="banner_typeI" value="img" checked="" required /> Video :
                                <input type="radio" class="flat" name="banner_type" id="banner_typeV" value="video" />
                            </p>
                        </div>
                    </div>  


                    <div class="input-group">
                        <input id="banner" class="form-control col-md-7 col-xs-12"  name="banner" placeholder="Upload image"  type="file">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Upload Banner Image!(1009x411)</button>
                        </span>
                    </div>  




                    <div class="input-group">
                        <input id="videourl" class="form-control col-md-7 col-xs-12"  name="videourl" placeholder="Add  Banner Video Url"  type="text">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Add Banner Video Url!</button>
                        </span>
                    </div>  
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Banner List</h2>
                    <div class="clearfix"></div>
                </div>





                <div class="x_content">

                    <div class="row">

                        <?php
                        if (!empty($banner)) {
                            foreach ($banner as $bannervalue) {
                                ?>

                                <div class="col-md-55">
                                    <div class="thumbnail" style="height: 130px;">
                                        <div class="image view view-first">
                                            <?php if($bannervalue['banner_type']=='video'){?>
                                            
                                            <img style="width: 100%; display: block;" src="<?php echo asset_url(); ?>banner/video.jpg" alt="image" />
                                            <?php } ?>
                                            <?php if($bannervalue['banner_type']=='img'){?>
                                            
                                            <img style="width: 100%; display: block;" src="<?php echo asset_url(); ?>banner/<?php echo $bannervalue['banner_data'];?>" alt="image" />
                                            <?php } ?>
                                            <div class="mask">

                                                <div class="tools tools-bottom">
                                                    <?php if($bannervalue['banner_status'] == 'inactive'){?>
                                                    <a href="<?php echo  base_url('siteadmin/banner/changestatus/'.$bannervalue['banner_id']);?>" class="btn btn-success btn-xs">Active</a>
                                                    <?php } ?>
                                                     <?php if($bannervalue['banner_status'] == 'active'){?>
                                                    <a href="<?php echo  base_url('siteadmin/banner/changestatus/'.$bannervalue['banner_id']);?>" class="btn btn-danger btn-xs">In active</a>
                                                    <?php } ?>
                                                   
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>


                    </div>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

