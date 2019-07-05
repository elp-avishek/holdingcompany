<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Service</h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Service</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/service/edit_service", array("class" => "form-horizontal form-label-left", "name" => "edit_form"));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Title" required="required" type="text" value="<?php echo $service_edit['name']; ?>">
                            <div><input id="id" name='id' class="form-control" type="hidden" value="<?php echo $service_edit['id']?>"></div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="Enter URL" required="required" type="text" value="<?php echo  $service_edit['url']; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Details <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="detail" id="detail" style="display:none;"><?php echo $service_edit['details']; ?></textarea>
                        </div>
                    </div>
                    <div><input id="img" name='img' class="form-control" type="hidden" value="<?php echo $service_edit['image'];?>"></div>
                     <div class="item form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" >
                            <input id="image"  name="image" placeholder="Enter Image"  type="file">
                        </div>
                         
                        <label class="col-md-3 col-sm-3 col-xs-12 border-green" > <img src='<?php echo asset_url()."/service/".$service_edit['image'] ?>' height="100px" width="100px"></label>
                    </div> 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="price" class="form-control col-md-6 col-xs-6"  name="price"  required="required" type="text" value="<?php echo $service_edit['price']; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <select id="status" name="status" class="form-control ">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
        $("#detail").cleditor();
    });
 </script>