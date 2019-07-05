<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>Tag Services</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tag<?php echo " " . ucwords($service_tag['name']) ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/service/service_taging/" . $service_tag['id'], array("class" => "form-horizontal form-label-left", "name" => "tag_form"));
                    ?>
                    <div class="item form-group">
                        <ul class="list-group">
                            <?php
                            if (!empty($service_stylist)) {
                                foreach ($service_stylist as $sty) {
                                    ?>
                                    <div class="list-group-item col-md-3 text-center"> 
                                        <img class="img-circle" src="<?php echo asset_url() . '/stylist/' . $sty['image'] ?>" height="100px" width="100px" >
                                        <span class="button-checkbox"><br>
                                            
                                            <button type="button" class="btn" data-color="primary"><?php echo strtoupper($sty['name']) ?></button>
                                            <input type="checkbox" class="hidden" name="tag[]" value="<?php echo $sty['id'] ?>" 
                                            <?php
                                            if (!empty($check_stylist['id'])){
                                            if (in_array($sty['id'], $check_stylist['id'])) {
                                                echo 'checked';
                                            }
                                            }
                                            ?>

                                                   />
                                        </span>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>   




                    <div class="form-group ">
                        <div class="col-md-12  text-center">
                            <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
                            <button id="send" type="submit" class="btn btn-success">Set Stylist</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('.button-checkbox').each(function () {

            // Settings
            var $widget = $(this),
                    $button = $widget.find('button'),
                    $checkbox = $widget.find('input:checkbox'),
                    color = $button.data('color'),
                    settings = {
                        on: {
                            icon: 'glyphicon glyphicon-check'
                        },
                        off: {
                            icon: 'glyphicon glyphicon-unchecked'
                        }
                    };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                        .removeClass()
                        .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                            .removeClass('btn-default')
                            .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                            .removeClass('btn-' + color + ' active')
                            .addClass('btn-default');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });

    });

</script>
