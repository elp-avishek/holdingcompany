<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Course </h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Join Course</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/course/join_course_process", array("class" => "form-horizontal form-label-left", "name" => "course_join_form"));
                    ?>  
                    <p><?php
                        echo $this->session->flashdata('msg');
                        ?></p>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Course Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name='course' class="form-control">
                                <option value="">Select Course</option>
                                <?php foreach($course as $va) {  ?>
                                    
                                <option value="<?php echo $va['id']?>"><?php echo strtoupper($va['course_title'])?></option>
                                    
                   <?php             }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Stylist Name <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name='stylist'>
                                   <option value="">Select Stylist</option>
                                <?php foreach($stylist as $sty) {  ?>
                                    
                                <option value="<?php echo $sty['id']?>"><?php echo $sty['name']?></option>
                                    
                   <?php             }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >ID Code <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control-sm" id="id-code" name='idcode' value="99">
                        </div>
                    </div><div class="ln_solid"></div>
                  
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                     
                        <?php echo form_close(); ?>
                    <div class='col-md-12 col-sm-12 text-center '>    <img id="loading" src="<?php echo asset_url()."admin/images/loading_white.gif"?>"></div>
                      <div id='joining_list'>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function joining_list(){
        $.ajax({ url: '<?php echo  base_url() . "siteadmin/course/list_joining"?>',
            success:function(result){
               
               $("#joining_list").html(result);
               $('#loading').hide();
               
            }
        });
    }
    $(document).ready(function(){
        joining_list();
    });
 </script>