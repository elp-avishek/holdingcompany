<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Gallery</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Image</h2>
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
                    echo form_open_multipart(base_url() . "siteadmin/gallery/addgallery", array("class" => "form-horizontal form-label-left", "name" => "Login_Form"));
                    ?>   
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photocredit">Photo credit                  </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="photocredit" name="photocredit"  class="form-control col-md-7 col-xs-12" >
                        </div>
                    </div>


                    <div class="input-group">
                        <input id="image" class="form-control col-md-7 col-xs-12"  name="image" placeholder="Upload image"  type="file">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Upload Image!</button>
                        </span>
                    </div>  


                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Gallery Image</h2>
                    <div class="clearfix"></div>
                </div>





                <div class="x_content">

                    <div class="row">

                        <?php
                        if (!empty($gallery)) {
                            foreach ($gallery as $galleryvalue) {
                                ?>

                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                           <img style="width: 100%; display: block;" src="<?php echo asset_url(); ?>gallery/<?php echo $galleryvalue['gallery_img'];?>" alt="image" />
                                            <div class="mask">
                                               
                                                <div class="tools tools-bottom">
                                                     <?php if($galleryvalue['gallery_status'] == 'inactive'){?>
                                                    <a href="<?php echo  base_url('siteadmin/gallery/changestatus/'.$galleryvalue['gallery_id']);?>" class="btn btn-success btn-xs">Active</a>
                                                    <?php } ?>
                                                     <?php if($galleryvalue['gallery_status'] == 'active'){?>
                                                    <a href="<?php echo  base_url('siteadmin/gallery/changestatus/'.$galleryvalue['gallery_id']);?>" class="btn btn-danger btn-xs">In active</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <p><?php echo $galleryvalue['gallery_img_credit'];?></p>
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

