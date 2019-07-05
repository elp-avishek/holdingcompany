<?php  $url = $this->uri->segment(1); ?>
<!DOCTYPE HTML>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your description">
        <meta name="keywords" content="Your keywords">
        <title>Welcome to our site</title>
        <link type="text/css" href="<?php echo asset_url(); ?>home/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
	<link type="text/css" href="<?php echo asset_url(); ?>home/bootstrap/css/bootstrap-theme.css" rel="stylesheet" media="screen">
        <link type="text/css" href="<?php echo asset_url(); ?>home/css/style.css?v=1" rel="stylesheet" media="screen">
	<link href="<?php echo asset_url(); ?>home/css/fileinput_test.css?v=3" media="all" rel="stylesheet" type="text/css" />
	<link href="<?php echo asset_url(); ?>home/css/owl.carousel.css?v=3" media="all" rel="stylesheet" type="text/css" />	
	<link href="<?php echo asset_url(); ?>home/css/owl.theme.css?v=3" media="all" rel="stylesheet" type="text/css" />
	<link href="<?php echo asset_url(); ?>home/css/bootstrap-chosen.css?v=3" media="all" rel="stylesheet" type="text/css" />

    </head>
    <style>

    </style>
    <body>
	<header>
	    <div class="logo_style">
		<div class="container">
		    <a href="<?php echo base_url(); ?>">
			<img src="<?php echo base_url(); ?>assets/home/images/footer-logo.png">
		    </a>
		</div>
	    </div>
	    <nav class="navbar navbar-inverse custom-margin">
		<div class="container">
		    <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			</button>
			<!--			<a class="navbar-brand" href="#">WebSiteName</a>-->
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
			      <li><a href="<?php echo base_url(); ?>" <?php if ($url == "") { ?>class="active"<?php } else { ?>
    				   class="menu-font"
				   <?php } ?>>Home</a></li>
			    <?php foreach ($menu as $value) {?>
				
			   
			    <li><a href="<?php echo base_url().strtolower($value['cms_url']); ?>" <?php if ($url == $value['cms_url']) { ?>class="active"<?php } else { ?>
    				   class="menu-font"
				   <?php } ?>><?php echo $value['cms_title']; ?></a></li>
			   <?php  }?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			    <li><a href="<?php echo base_url(); ?>home/payment" <?php if ($url == "payment") { ?>class="active"<?php } else { ?>
    				   class="menu-font"
				   <?php } ?>>Secure Payment</a></li>
			    <li><a href="<?php echo base_url(); ?>home/contactus" <?php if ($url == "contactus") { ?>class="active"<?php } else { ?>
    				   class="menu-font"
				   <?php } ?>>Contact Us</a></li>
			</ul>
		    </div>
		</div>
	    </nav>
        </header>
	<div class="container index_container my_boxshadow">
	    <div id="owl-demo" class="owl-carousel owl-theme">
		<div class="item"><img src="<?php echo base_url(); ?>assets/home/images/01.jpg" alt="Owl Image"></div>
		<div class="item"><img src="<?php echo base_url(); ?>assets/home/images/02.jpg" alt="Owl Image"></div>
		<div class="item"><img src="<?php echo base_url(); ?>assets/home/images/03.jpg" alt="Owl Image"></div>
		<div class="item"><img src="<?php echo base_url(); ?>assets/home/images/04.jpg" alt="Owl Image"></div>
		<div class="item"><img src="<?php echo base_url(); ?>assets/home/images/05.jpg" alt="Owl Image"></div>
	    </div>



	    <!-- End Header Section ==================================================-->