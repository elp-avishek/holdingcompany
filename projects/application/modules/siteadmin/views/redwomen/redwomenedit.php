<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Red Women</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Redwomen</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">


                     <?php
                    echo form_open_multipart(base_url() . "siteadmin/redwomen/editredwomen/".$_SESSION['redwomen']['red_women_id'], array("class" => "form-horizontal form-label-left", "name" => "Login_Form"),array("red_women_id"=>$_SESSION['redwomen']['red_women_id'],"img"=>$_SESSION['redwomen']['red_women_img']));
                    ?>   
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>



                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Enter Name" required="required" type="text" value="<?php echo (!empty($_SESSION['redwomen']['red_women_name'])) ? $_SESSION['redwomen']['red_women_name'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Title" required="required" type="text" value="<?php echo (!empty($_SESSION['redwomen']['red_women_title'])) ? $_SESSION['redwomen']['red_women_title'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company">Company <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="company" name="company" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Company" value="<?php echo (!empty($_SESSION['redwomen']['red_women_company'])) ? $_SESSION['redwomen']['red_women_company'] : ''; ?>">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Email" value="<?php echo (!empty($_SESSION['redwomen']['red_women_email'])) ? $_SESSION['redwomen']['red_women_email'] : ''; ?>">
                        </div>
                    </div>   

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="phone" id="phone" name="phone" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Phone" value="<?php echo (!empty($_SESSION['redwomen']['red_women_phone'])) ? $_SESSION['redwomen']['red_women_phone'] : ''; ?>">
                        </div>
                    </div>     

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="country" name="country" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Country" value="<?php echo (!empty($_SESSION['redwomen']['red_women_country'])) ? $_SESSION['redwomen']['red_women_country'] : ''; ?>"> 
                        </div>
                    </div>   

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="state" name="state" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter State" value="<?php echo (!empty($_SESSION['redwomen']['red_women_state'])) ? $_SESSION['redwomen']['red_women_state'] : ''; ?>">
                        </div>
                    </div>   

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="city" name="city" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter City" value="<?php echo (!empty($_SESSION['redwomen']['red_women_city'])) ? $_SESSION['redwomen']['red_women_city'] : ''; ?>">
                        </div>
                    </div>   

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zip">Zip <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="zip" name="zip" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Zip" value="<?php echo (!empty($_SESSION['redwomen']['red_women_zip'])) ? $_SESSION['redwomen']['red_women_zip'] : ''; ?>">
                        </div>
                    </div> 

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="services">Services <span class="required" >*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="services" placeholder="Enter Services" id="services" class="resizable_textarea form-control" style="width: 100%; overflow: hidden; word-wrap: break-word; resize: horizontal; height: 87px;"><?php echo (!empty($_SESSION['redwomen']['red_women_services'])) ? $_SESSION['redwomen']['red_women_services'] : ''; ?></textarea>

                        </div>
                    </div> 


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">About <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="descr" id="descr" style="display:none;"><?php echo (!empty($_SESSION['redwomen']['red_women_about'])) ? $_SESSION['redwomen']['red_women_about'] : ''; ?></textarea>
                        </div>
                    </div>
                    
                    <?php if(!empty($_SESSION['redwomen']['red_women_img'])){?>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Previous Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <img src="<?php echo asset_url()."redwomen/".$_SESSION['redwomen']['red_women_img'];?>" style="height:100px;" />
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="facebook" class="form-control col-md-7 col-xs-12"  name="facebook" placeholder="Enter Facebook Link"  type="text" value="<?php echo (!empty($_SESSION['redwomen']['social'])) ? $_SESSION['redwomen']['social']['facebook'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Twitter">Twitter 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Twitter" class="form-control col-md-7 col-xs-12"  name="twitter" placeholder="Enter Twitter Link"  type="text" value="<?php echo (!empty($_SESSION['redwomen']['social'])) ? $_SESSION['redwomen']['social']['twitter'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="googleplus">Google Plus 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="googleplus" class="form-control col-md-7 col-xs-12"  name="googleplus" placeholder="Enter googleplus Link"  type="text" value="<?php echo (!empty($_SESSION['redwomen']['social'])) ? $_SESSION['redwomen']['social']['google-plus'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Pinterest">Pinterest 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Pinterest" class="form-control col-md-7 col-xs-12"  name="pinterest" placeholder="Enter Pinterest Link"  type="text" value="<?php echo (!empty($_SESSION['redwomen']['social'])) ? $_SESSION['redwomen']['social']['pinterest'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Linkedin">Linkedin 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Linkedin" class="form-control col-md-7 col-xs-12"  name="linkedin" placeholder="Enter Linkedin Link"  type="text" value="<?php echo (!empty($_SESSION['redwomen']['social'])) ? $_SESSION['redwomen']['social']['linkedin'] : ''; ?>">
                        </div>
                    </div>  

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Youtube">Youtube 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="Youtube" class="form-control col-md-7 col-xs-12"  name="youtube" placeholder="Enter Youtube Link"  type="text" value="<?php echo (!empty($_SESSION['redwomen']['social'])) ? $_SESSION['redwomen']['social']['youtube'] : ''; ?>">
                        </div>
                    </div>  
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="instagram" class="form-control col-md-7 col-xs-12"  name="instagram" placeholder="Enter Instagram Link"  type="text" value="<?php echo (!empty($_SESSION['redwomen']['social'])) ? $_SESSION['redwomen']['social']['instagram'] : ''; ?>">
                        </div>
                    </div>  






                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Active :
                                <input type="radio" class="flat" name="status" id="statusA" value="active" <?php echo (!empty($_SESSION['redwomen']['red_women_status']) && $_SESSION['redwomen']['red_women_status'] == 'active') ? 'checked' : ''; ?> required /> Inactive :
                                <input type="radio" class="flat" name="status" id="statusI" value="inactive" <?php echo (!empty($_SESSION['redwomen']['red_women_status']) && $_SESSION['redwomen']['red_women_status'] == 'inactive') ? 'checked' : ''; ?> />
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
        autosize($('.resizable_textarea'));
    });


</script>
