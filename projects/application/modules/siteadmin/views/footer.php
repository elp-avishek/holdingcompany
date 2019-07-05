 
</div>
<!-- /page content --> 
</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="<?php echo asset_url(); ?>admin/js/bootstrap.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo asset_url(); ?>admin/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo asset_url(); ?>admin/js/icheck/icheck.min.js"></script>

<script src="<?php echo asset_url(); ?>admin/js/custom.js"></script>

<!-- pace -->
<script src="<?php echo asset_url(); ?>admin/js/pace/pace.min.js"></script>
<?php
if (!empty($javascripts)) {
    foreach ($javascripts as $javascript) {
        ?>
        <script type="text/javascript" src="<?php echo asset_url() . $javascript; ?>"></script>
        <?php
    }
}
?>
        
        <script>
            $('#title').bind('keyup keypress blur', function() 
{  

	var myStr = $(this).val()
		myStr=myStr.toLowerCase();
		myStr=myStr.replace(/ /g,"-");
		myStr=myStr.replace(/[^a-zA-Z0-9\.]+/g,"-");
		myStr=myStr.replace(/\.+/g, "-");


    $('#url').val(myStr); 
});
            
            </script>


</body>

</html>
