<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>CMS</h3>
        </div></div>
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ADD CMS</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
		    <?php
		    echo form_open_multipart(base_url() . "siteadmin/cms/cms_pdf_edit_process/" . $edit_detail['cms_id'], array("class" => "form-horizontal form-label-left", "name" => "cms"));
		    ?>  
                    <p><?php
			echo $this->session->flashdata('add_cms_pdf_msg');
			?></p>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12"  name="title" placeholder="Enter Name" required="required" type="text" value="<?php echo $edit_detail['cms_title'] ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="Enter URL" required="required" type="text" value="<?php echo $edit_detail['cms_url'] ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descr">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <textarea name="descr" id="descr" style="display:none;"><?php echo $edit_detail['cms_description'] ?></textarea>
                        </div>
                    </div>
<!--		    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cms_file_title">File Title<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="cms_file_title" class="form-control col-md-7 col-xs-12"  name="cms_file_title" placeholder="Enter File Title" required="required" type="text" value="<?php //echo $edit_detail['cms_file_title'] ?>">
                        </div>
                    </div>
		    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cms_file_date">File Date<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="cms_file_date" class="form-control col-md-7 col-xs-12"  name="cms_file_date" placeholder="Enter File Date" required="required" type="text" value="<?php //echo $edit_detail['cms_file_date'] ?>">
                        </div>
                    </div>-->
		    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Upload Document <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <input type="file" name="userFiles[]" multiple class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu">Menu Order<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="menu" class="form-control col-md-7 col-xs-12"  name="menu" required="required" type="text" value="<?php echo $edit_detail['cms_menu_order'] ?>">
			    <input type="hidden" name="existance_file" value="<?php echo $edit_detail['cms_file']; ?>">
			    <input type="hidden" name="exist_cms_file_title" value="<?php echo $edit_detail['cms_file_title']; ?>">
                        </div>
                    </div>
		    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <p>
                                Active :
				<input type="radio" class="flat" name="cms_status" id="banner_typeI" value="active" <?php if ($edit_detail['cms_status'] == "active") { ?>checked="" <?php } ?> required /> Inactive :
                                <input type="radio" class="flat" name="cms_status" id="banner_typeV" value="inactive"
				       <?php if ($edit_detail['cms_status'] == "inactive") { ?>checked="" <?php } ?>/>
                            </p>
                        </div>
                    </div>
		    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Show In Top Menu</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>
                                Yes :
                                <input type="radio" class="flat" name="cms_menu" id="banner_typeI" value="Y" <?php if ($edit_detail['cms_menu'] == "Y") { ?> checked="" <?php } ?> required /> No :
                                <input type="radio" class="flat" name="cms_menu" id="banner_typeV" value="N" <?php if ($edit_detail['cms_menu'] == "N") { ?>checked="" <?php } ?>/>
                            </p>
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
    <div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	    <?php
	    if (!empty($edit_detail['cms_file'])) {
		$cms_file_arr = explode(",", $edit_detail['cms_file']);
		$i = 1;
		foreach ($cms_file_arr as $value) {
		    ?>
		    <div class="col-md-3" id="pdf_<?php echo $i; ?>">
			<a href="<?php echo base_url() . 'assets/pdf_details/' . $value ?>" target="_blank" style="text-decoration: none;"><img src="<?php echo base_url() . 'assets/admin/images/pdf.png'; ?>" style="width:100px;"></a>
			<span style="cursor: pointer;" onclick="delete_img('<?php echo $value; ?>', '<?php echo $i; ?>')"><i class="fa fa-trash fa-2x"></i>Delete</span>
			<?php
			if (strchr($value, $edit_detail['cms_url'])) {
			    ?>
	    		<span><?php echo $edit_detail['cms_url']; ?>-DOC-<?php echo $i; ?></span>
			<?php } ?>
		    </div>
		    <?php
		    $i+=1;
		}
	    }
	    ?>
	</div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#descr").cleditor();
    });
</script>
<script>
    function delete_img(img, divid) {
        var pdfid = divid;
        var img = img;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>siteadmin/cms/delete_img/<?php echo $edit_detail['cms_id']; ?>",
                        data: {img: img},
                        success: function (data) {
                            if (data == "success") {

                                $("#pdf_" + pdfid).hide();
                            }
                        }
                    });
                }
</script>
