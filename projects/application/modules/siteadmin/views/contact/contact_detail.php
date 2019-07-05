
<!--<div>
     <div class="page-title">
        <div class="col-xs-12 col-md-12 title_left">
            <h3>Email:<?php echo $contact_info['email'] ?></h3>
            <h3>Subject:<?php echo $contact_info['subject'] ?></h3>
            <h3>Date Added:<?php echo DATE('d/M/Y', strtotime($contact_info['date_added'])) ?></h3>
            <hr>
<?php echo $contact_info['message'] ?>
         </div>
    </div>
</div>-->
<div class="page-title">
    <div class="title_left">
        <h3>Contact</h3>
    </div>


</div>
<div class="clearfix"></div>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Contact Detail</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <div class="col-md-6 col-sm-6 col-xs-6">
                    Email:
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php echo $contact_info['email'] ?>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    Subject:
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php echo $contact_info['subject'] ?>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    Date Added
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php echo DATE('d/M/Y', strtotime($contact_info['date_added'])) ?>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    Masseage
                </div>
               
                <div class="col-md-6 col-sm-6 col-xs-6 text-justify" style="word-break:break-all " >
                    <p>  <?php echo $contact_info['message'] ?></p>
                </div>



            </div>
        </div>
    </div>
</div>