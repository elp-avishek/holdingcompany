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
                    <h2>Add Course</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/course/add_course", array("class" => "form-horizontal form-label-left", "name" => "course_form"));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Title" required="required" type="text" value="<?php echo (!empty($_SESSION['course_add']['title'])) ? $_SESSION['course_add']['title'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="Enter URL" required="required" type="text" value="<?php echo (!empty($_SESSION['course_add']['url'])) ? $_SESSION['course_add']['url'] : ''; ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Detail <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="detail" id="detail" style="display:none;"><?php echo (!empty($_SESSION['course_add']['detail'])) ? $_SESSION['course_add']['detail'] : ''; ?></textarea>
                        </div>
                    </div>
                     <div class="item form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" >
                            <input id="image"  name="image" placeholder="Enter Image"  type="file">
                        </div>
                    </div> 
                    
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-6" for="duration">Duration<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <input id="duration" class="form-control col-md-3 col-xs-6"  name="duration"  required="required" type="number" min='1' max='200'>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <select class="form-control" id="duration_type" class="form-control col-md-3 col-xs-6" name="duration_type">
                                <option value="year">Year</option>
                                <option value="month">Month</option>
                                <option value="week">Week</option>
                                <option value="days">Days</option>
                            </select>
                        </div>
                    </div>
                     <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for=price_Break">Price Break up
                        </label>
                           <div class="col-md-2 col-sm-2 col-xs-6">
                            <input id="price_brk" class="form-control col-md-3 col-xs-6"  name="price_brk"  required="required" type="number" value="0" min="1" max="365">
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
                            <input id="price" class="form-control col-md-6 col-xs-6"  name="price"  required="required" type="number" step="any" min="0" >
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