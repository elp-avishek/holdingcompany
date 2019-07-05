<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Red Women Admin</title>

        <!-- Bootstrap core CSS -->

        <link href="<?php echo asset_url(); ?>admin/css/bootstrap.min.css" rel="stylesheet">


        <script src="<?php echo asset_url(); ?>admin/js/jquery.min.js"></script>

        <!--[if lt IE 9]>
              <script src="<?php echo asset_url(); ?>admin/js/ie8-responsive-file-warning.js"></script>
              <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="<?php echo asset_url(); ?>admin/js/html5shiv.min.js"></script>
                <script src="<?php echo asset_url(); ?>admin/js/respond.min.js"></script>
              <![endif]-->



    </head>

    <body style="background:#ffffff;">

        <div class="">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>

            <div id="wrapper">
                <div class = "container">
                    <div class="wrapper">
                      
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img src="<?php echo asset_url();?>admin/images/banner.png"  />
                                    <br>
                                    <a href="<?php echo base_url();?>siteadmin" class="btn btn-lg btn-danger">Home</a> &nbsp;<a onclick=" window.history.back();" class="btn btn-lg btn-success">Back</a>
                                </div>
                                
                            </div>
                    
                    </div>

                </div>
            </div>
        </div>
    </body>

</html>
