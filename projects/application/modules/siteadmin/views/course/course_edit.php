<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Course</h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Course</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/course/course_edit_process", array("class" => "form-horizontal form-label-left", "name" => "course_form"));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Title" required="required" type="text" value="<?php echo $c_edit['title']; ?>">
                            <input id="id"   name="id"  type="hidden" value="<?php echo $c_edit['id']; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="Enter URL" required="required" type="text" value="<?php echo $c_edit['url']; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Detail <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="detail" id="detail" style="display:none;"><?php echo $c_edit['details']; ?></textarea>
                        </div>
                    </div>
                     <div class="item form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" >
                            <input id="image"  name="image" placeholder="Enter Image"  type="file">
                        </div>
                          <div><input id="img" name='img' class="form-control" type="hidden" value="<?php echo $c_edit['image']?>"></div>
                          <label class="col-md-3 col-sm-3 col-xs-12 border-green" > <img src='<?php echo asset_url()."/course/".$c_edit['image'] ?>' height="100px" width="100px"></label>
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


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-6" for="duration">Duration<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <input id="duration" class="form-control col-md-3 col-xs-6"  name="duration"  required="required" type="number" value="<?php echo $c_edit['duration']; ?>" min="1" max="365">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <select class="form-control" id="duration_type" class="form-control col-md-3 col-xs-6" name="duration_type">
                                <option value="year" <?php if($c_edit['duration_type']=='year'){?> selected="selected" <?php } ?>>Year</option>
                                <option value="month" <?php if($c_edit['duration_type']=='month'){?> selected="selected" <?php } ?>>Month</option>
                                <option value="week" <?php if($c_edit['duration_type']=='week'){?> selected="selected" <?php } ?>>Week</option>
                                <option value="days" <?php if($c_edit['duration_type']=='days'){?> selected="selected" <?php } ?>>Days</option>
                            </select>
                        </div>
                    </div>
                     <?php 
                       if(!empty($c_edit['price_breakup'])){?>
                      <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for=old_price_Break">Previous Price Break
                        </label>
                    <div id="old_price_break" class=" col-md-9 col-sm-9 col-xs-12">
                      <?php
                       $price_break=explode(',',$c_edit['price_breakup']);
                       $i=0;
                       foreach($price_break as $var){
                           echo "<div  class='input-group col-md-9 col-sm-9 col-xs-12' id='h".$i."'><input name='price_break[]' class='form-control col-md-6 col-xs-12' value='$var' readonly><span class='input-group-btn'>
                  <button class='btn btn-default' class='pb' type='button' onClick='$(h".$i.").remove();'>delete</button>
                  </span></div>";
                           $i++;
                       }
                       ?>
                        
                    </div>
                     </div>
                    <?php  
                    }
                       ?>
                    
                    
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-6" for="price_brk"> Add New Price Break Up<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <input id="price_brk" class="form-control col-md-3 col-xs-6"  name="price_brk"  required="required" type="number" value="0" min="0" max="365">
                        </div>
                       
                    </div>
                     <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for=price_Break">
                        </label>
                    <div id="price_break" class=" col-md-9 col-sm-9 col-xs-12">
                        
                    </div>
                     </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="price" class="form-control col-md-6 col-xs-6"  name="price"  required="required" type="text"  value="<?php echo $c_edit['price']; ?>">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
                                <button id="send" type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>

                    </div>
 <div class="clearfix"></div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#detail").cleditor();
        
$("#price_brk").keyup(function(){ //on add input button click
      var value=$(this).val();
       $("#price_break").html('');
         for(var i=1;i<=value;i++){
             $("#price_break").append('<div class="col-md-9 col-sm-9 col-xs-12">'+i+'<input id="price_break" class="form-control col-md-6 col-xs-12"  name="price_break[]"  placeholder="Enter Price"  type="text" value=""></div>');
         }
    });
    $("#price_brk").change(function(){ //on add input button click
      var value=$(this).val();
       $("#price_break").html('');
         for(var i=1;i<=value;i++){
             $("#price_break").append('<div class="col-md-9 col-sm-9 col-xs-12">'+i+'<input id="price_break" class="form-control col-md-6 col-xs-12"  name="price_break[]"  placeholder="Enter Price"  type="text" value=""></div>');
         }
    });
    });
</script>
