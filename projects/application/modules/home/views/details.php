<?php // $url_arr = explode("/",$_SERVER['REQUEST_URI']);
//echo $url_arr[1];die; ?>
<style>
    .valuation_ul{padding-left: 20px;}
    .valuation_download_sec{border: 1px solid #a8a9aa;color: #000000;padding: 0px;}
    .odd_dwn_sec{background-color: #80ccff;}
    .both_dwn_sec{padding: 5px !important;}
</style>
<div class="col-md-12 col-xs-12 col-sm-12">
    <div class="col-md-6 col-xs-12 col-sm-6">
	<!--	<h3>Holdingcompany Business Valuation Services</h3>
		<p>
		    Ayaris 9 provides independent Business Valuations to companies, investors and transaction intermediaries. Depending on the growth stage of the business, the firm utilizes well-accepted standard models as well as industry-specific valuation models. 
		</p>-->
	<?php echo $cms_details['cms_description']; ?>
	<!--	<p><b>The standard models include:</b></p>
		<ul class="valuation_ul">
		    <li><b>Discounted Cash Flow</b></li>
		    <li><b>Capital Cash Flow</b></li>
		    <li><b>Adjusted Present Value</b></li>
		    <li><b>Discounted Abnormal Earnings</b></li>
		    <li><b>Options Pricing Model</b></li>
		    <li><b>Multiples.</b></li>
		</ul>
		<p><b>The industry-specific valuation models include:</b></p>
		<ul class="valuation_ul">
		    <li><b>Subscriber-Valuation</b></li>
		    <li><b>Intellectual Property</b></li>
		    <li><b>Project Financing</b></li>
		    <li><b>Brand Valuation</b></li>
		</ul>-->
	<p>
	    For more information, please <a href="<?php echo base_url(); ?>home/contactus">contact us</a>
	</p>
    </div> 
    <div class="col-md-6 col-xs-12 col-sm-6">

	<h3>Need Help?</h3>
	<h3>Companies</h3>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center no-pad"><p class="mybox">Sell My Business</p></div>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center "><p class="mybox">Need Capital</p></div>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center "><p class="mybox">Financial Advisory</p></div>
	<p><b>Attorneys - CPAs - Brokers - Academics</b></p>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center no-pad"><p class="mybox">Indepedent Valuation</p></div>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center "><p class="mybox">Quantitative Research</p></div>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center "><p class="mybox">Partnership</p></div>
	<p><b>Investors</b></p>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center no-pad"><p class="mybox">Buy a Business</p></div>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center "><p class="mybox">Investment Analysis</p></div>
	<div class="col-md-4 col-xs-12 col-sm-4  text-center "><p class="mybox">Opportunities</p></div>
	<?php if (!empty($cms_details['cms_file'])) { ?>
    	<p>File Download</p>
    	<div class="col-md-12 col-xs-12 col-sm-12 valuation_download_sec">
    	    <div class="col-md-12 col-xs-12 col-sm-12 text-center">
    		Document
    	    </div>
<!--    	    <div class="col-md-2 col-xs-2 col-sm-2 text-center ">
    		Version
    	    </div>-->
		<?php
		$cms_file = explode(",", $cms_details['cms_file']);
		$cms_file_title = explode(",", $cms_details['cms_file_title']);
		if (!empty($cms_file) && !empty($cms_file_title)) {
		    ?>
		    <?php $i = 0;$j=1;
		    foreach ($cms_file as $value_file) { ?>
		    <div class="col-md-12 col-xs-12 col-sm-12 no-pad <?php if($j%2 !=0){?>odd_dwn_sec <?php }?> both_dwn_sec">
			<a style="text-decoration:none;color:#000000;" target="_blank" href="<?php echo base_url()."assets/pdf_details/".$value_file?>"><i class="fa fa-arrow-circle-down fa-lg" ></i>&nbsp;<?php echo $cms_file_title[$i];?></a>
	    	    </div>
		    <?php $i+=1;$j+=1;}
		    ?>

		<?php }
		?>
    	</div>
	<?php }
	?>
    </div>
</div>
</div>
