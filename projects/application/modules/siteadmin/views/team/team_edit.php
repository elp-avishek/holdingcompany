<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Team</h3>
        </div></div>
        <div class="clearfix"></div>
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Team</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php
                        echo form_open_multipart(base_url(). "siteadmin/team/team_edit_process/".$info['id'], array("class" => "form-horizontal form-label-left", "name" => "team_form"));
                        ?>  
                        <?php $social= explode(',',$info['social'])?>
                        <p><?php
                            echo $this->session->flashdata('msg');
                            ?></p>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Name" required="required" type="text" value="<?php echo (!empty($_SESSION['team']['name'])) ? $_SESSION['team']['name'] : $info['name']; ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="Enter URL" required="required" type="text" value="<?php echo (!empty($_SESSION['team']['url'])) ? $_SESSION['team']['url'] : $info['url']; ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Previous Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <img src="<?php echo asset_url()."team/".$info['image'];?>" style="height:100px;width:100px" />
                           
                        </div>
                    </div>  
                        
                        
                         <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="image"  name="image" placeholder="Enter Image"  type="file" >
                        </div>
                    </div>  
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status<span class="required">*</span>
                        </label>
                        <div class=" col-md-3 col-sm-3 col-xs-12">
                            <select id="status" name="status" class="selectpicker show-tick">
                                <option value="active" style="background: #5cb85c; color: #fff;">Active</option>
                                <option value="inactive"style="background: #FF3300; color: #fff;">Inactive</option>
                            </select>
                        </div>
                    </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <textarea name="descr" id="descr" style="display:none;"><?php echo (!empty($_SESSION['team']['descr'])) ? $_SESSION['team']['descr'] : $info['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="hidden" name="img" id='img' value="<?php echo $info['image'];?>">
                                <input id="facebook" class="form-control col-md-7 col-xs-12"  name="facebook" placeholder="Enter Facebook Link"  type="url" value="<?php echo (!empty($_SESSION['team']['facebook'])) ? $_SESSION['team']['facebook'] :  $social[0]; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Twitter">Twitter 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Twitter" class="form-control col-md-7 col-xs-12"  name="twitter" placeholder="Enter Twitter Link"  type="url" value="<?php echo (!empty($_SESSION['team']['twitter'])) ? $_SESSION['team']['twitter'] : $social[1]; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="googleplus">Google Plus 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="googleplus" class="form-control col-md-7 col-xs-12"  name="googleplus" placeholder="Enter googleplus Link"  type="url" value="<?php echo (!empty($_SESSION['team']['googleplus'])) ? $_SESSION['team']['googleplus'] :$social[2]; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Pinterest">Pinterest 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Pinterest" class="form-control col-md-7 col-xs-12"  name="pinterest" placeholder="Enter Pinterest Link"  type="url" value="<?php echo (!empty($_SESSION['team']['pinterest'])) ? $_SESSION['team']['pinterest'] :$social[3]; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Linkedin">Linkedin 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Linkedin" class="form-control col-md-7 col-xs-12"  name="linkedin" placeholder="Enter Linkedin Link"  type="url" value="<?php echo (!empty($_SESSION['team']['linkedin'])) ? $_SESSION['team']['linkedin'] : $social[4]; ?>">
                            </div>
                        </div>  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Youtube">Youtube 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="Youtube" class="form-control col-md-7 col-xs-12"  name="youtube" placeholder="Enter Youtube Link"  type="url" value="<?php echo (!empty($_SESSION['team']['youtube'])) ? $_SESSION['team']['youtube'] : $social[5]; ?>">
                            </div>
                        </div>  
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="instagram" class="form-control col-md-7 col-xs-12"  name="instagram" placeholder="Enter Instagram Link"  type="url" value="<?php echo (!empty($_SESSION['team']['instagram'])) ? $_SESSION['team']['instagram'] : $social[6]; ?>">
                            </div>
                        </div>  
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
                                <button id="send" type="submit" class="btn btn-danger">Update</button>
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
//        $('.date').datepicker({
//            format: 'yyyy-mm-dd',
//            orientation: "bottom auto",
//            autoclose: true,
//            todayHighlight: true,
//            startDate: '-1d'
//        });
    });
</script>