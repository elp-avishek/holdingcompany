<!DOCTYPE html>
<html lang="en">

    <head>
       
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $title; ?> | Sbssalons </title>

        <!-- Bootstrap core CSS -->

        <link href="<?php echo asset_url(); ?>admin/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo asset_url(); ?>admin/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>admin/css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="<?php echo asset_url(); ?>admin/css/custom.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>admin/css/icheck/flat/green.css" rel="stylesheet">


        <script src="<?php echo asset_url(); ?>admin/js/jquery.min.js"></script>

        <!--[if lt IE 9]>
              <script src="<?php echo asset_url(); ?>admin/js/ie8-responsive-file-warning.js"></script>
              <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="<?php echo asset_url(); ?>admin/js/html5shiv.min.js"></script>
                <script src="<?php echo asset_url(); ?>admin/js/respond.min.js"></script>
              <![endif]-->

        <?php
        if (!empty($stylesheets)) {
            foreach ($stylesheets as $stylesheet) {
                ?>
                <link href="<?php echo asset_url() . $stylesheet; ?>" type="text/css" rel="stylesheet" media="screen,projection">
                <?php
            }
        }
        ?>

    </head>


    <body class="nav-md">

        <div class="container body">


            <div class="main_container">

                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo base_url();?>siteadmin" class="site_title"><img src="<?php echo asset_url().'home/images/footer-logo.png'; ?>" width="100" height="60"/></a>
                        </div>
                        <div class="clearfix"></div>

                        <br>
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section ">

                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-pencil-square-o "></i> CMS <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url() . "siteadmin/cms/add_cms"; ?>">Add Cms Without Doc</a>
                                            </li>
					     <li><a href="<?php echo base_url() . "siteadmin/cms/add_cms_pdf"; ?>">ADD Cms With Doc</a>
                                            </li>
                                            <li><a href="<?php echo base_url() . "siteadmin/cms"; ?>">List Cms Without Doc</a>
                                            </li>
					    <li><a href="<?php echo base_url() . "siteadmin/cms/list_cms_pdf"; ?>">List Cms With Doc</a>
                                            </li>
                                        </ul>
                                    </li>
<!--                                    <li><a><i class="fa fa-file-text "></i> Payment <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                           
                                            <li><a href="<?php echo base_url() . "siteadmin/payment"; ?>">List</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-desktop"></i> News <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url() . "siteadmin/news"; ?>">Add News</a>
                                            </li>
                                            <li><a href="<?php echo base_url() . "siteadmin/news/newslist"; ?>">List News</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-book"></i> Course <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url() . "siteadmin/course"; ?>">Add Course</a>
                                            </li>
                                            <li><a href="<?php echo base_url() . "siteadmin/course/course_list"; ?>">List Course</a>
                                            </li>
                                            <li><a href="<?php echo base_url() . "siteadmin/course/join_course"; ?>">Join Course</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-cut"></i> Stylist <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                           
                                            <li><a href="<?php echo base_url() . "siteadmin/stylist/stylist_add"; ?>">Add Stylist</a>
                                            </li>
                                             <li><a href="<?php echo base_url() . "siteadmin/stylist"; ?>">List Stylist</a>
                                            </li>
                                             
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-male"></i> Client <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            
                                            <li><a href="<?php echo base_url() . "siteadmin/Client/client_list"; ?>">Client List</a>
                                            </li>

                                        </ul>
                                    </li>
                                  

                                    <li><a><i class="fa fa-envelope-o "></i> Contact <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url() . "siteadmin/contact";?>">View Contact List</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-file-image-o "></i> Gallery <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php // echo base_url() . "siteadmin/gallery"; ?>"> Gallery</a>
                                            </li>


                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-female "></i> Team <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url() . "siteadmin/Team"; ?>">Add Team</a>
                                            </li>
                                            <li><a href="<?php echo base_url() . "siteadmin/Team/team_list"; ?>">List Team</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-picture-o "></i> Banner <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url() . "siteadmin/banner"; ?>">Banner</a>
                                            </li>



                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-users"></i>Service <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                             <li><a href="<?php echo base_url() . "siteadmin/service"; ?>">Add Service</a>
                                            </li>
                                            <li><a href="<?php echo base_url() . "siteadmin/service/service_list"; ?>">List Service</a>
                                            </li>


                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-file-text"></i>Appointment <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            
                                            <li><a href="<?php echo base_url() . "siteadmin/appointment"; ?>">List Appointment</a>
                                            </li>


                                        </ul>
                                    </li>
                                       <li><a><i class="fa fa-male"></i> Testimonial <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            
                                            <li><a href="<?php echo base_url() . "siteadmin/testimonial"; ?>">Add testimonial</a>
                                            </li>
                                            <li><a href="<?php echo base_url() . "siteadmin/testimonial/testimonial_list"; ?>">List testimonial</a>
                                            </li>

                                        </ul>
                                    </li>-->
                                    
                                    
                                    
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>

                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url();?>siteadmin/logout">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>


                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">