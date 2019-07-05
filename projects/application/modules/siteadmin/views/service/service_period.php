<style>
    .btn-circle.btn-lg {
        width: 50px;
        height: 50px;
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 25px;
    }
</style>


<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Services Period</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    echo form_open_multipart(base_url() . "siteadmin/service/service_period_process/".$id, array("class" => "form-horizontal form-label-left", "name" => "course_form"));
                    ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <th>Days</th>
                        <th>Time</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Monday</td>
                                <td>
                                    <div class="monday" >
                                        <a class="add_field_button" onclick='period ("monday")'>Add More Fields</a>
                                        <div>From:<input type="text" class='from' name="monday[fromtime][]">
                                            To:<input type="text" class='to' name="monday[totime][]"></div>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>Tuesday</td>
                                <td>
                                    <div class="tuesday">
                                        <a class="add_field_button" onclick='period ("tuesday")'>Add More Fields</a>
                                        <div>From:<input type="text" class='from' name="tuesday[fromtime][]">
                                            To:<input type="text" class='to' name="tuesday[totime][]"></div>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>Wednesday</td>
                                <td>
                                    <div class="wednesday">
                                        <a class="add_field_button" onclick='period ("wednesday")'>Add More Fields</a>
                                        <div>From:<input type="text" class='from' name="wednesday[fromtime][]">
                                            To:<input type="text" class='to' name="wednesday[totime][]"></div>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>Thursday</td>
                                <td>
                                    <div class="thursday">
                                        <a class="add_field_button" onclick='period ("thursday")'>Add More Fields</a>
                                        <div>From:<input type="text" class='from' name="thursday[fromtime][]">
                                            To:<input type="text" class='to' name="thursday[totime][]"></div>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>Friday</td>
                                <td>
                                    <div class="friday">
                                        <a class="add_field_button" onclick='period ("friday")'>Add More Fields</a>
                                        <div>From:<input type="text" class='from' name="friday[fromtime][]">
                                            To:<input type="text" class='to' name="friday[totime][]"></div>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>Saturday</td>
                                <td>
                                    <div class="saturday">
                                        <a class="add_field_button" onclick='period ("saturday")'>Add More Fields</a>
                                        <div>From:<input type="text" class='from' name="saturday[fromtime][]">
                                            To:<input type="text" class='to' name="saturday[totime][]"></div>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>Sunday</td>
                                <td>
                                    <div class="sunday">
                                        <a class="add_field_button" onclick='period ("sunday")'>Add More Fields</a>
                                        <div>From:<input type="text" class='from' name="sunday[fromtime][]">
                                            To:<input type="text" class='to' name="sunday[totime][]"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.from').timepicker();
        $('.to').timepicker();
//
//        var max_fields = 10; //maximum input boxes allowed
//        var wrapper = $(".input_fields_wrap"); //Fields wrapper
//        var add_button = $(".add_field_button"); //Add button ID
//
//        var x = 1; //initlal text box count
//      
//
//        $(wrapper).on("click", ".remove_field", function () { //user click on remove text
//      
//            $(this).parent('div').remove();
//            x--;
//        });
//
//        $(wrapper).on("click", ".from", function () {
//            $(this).timepicker();
//        });
//        $(wrapper).on("click", ".to", function () {
//            $(this).timepicker();
//        });
//
////$('#onselectExample').on('changeTime', function() {
////    $('#onselectTarget').text($(this).val());
//
//
    });
    
    var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; 
     function period(day) { //on add input button click
      
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $('.'+day).append('<div>From:<input type="text" class="from" name="'+day+'[fromtime][]"> To:<input type="text" class="to" name="'+day+'[totime][]"><a href="#" class="remove_field">Remove</a></div>'); //add input box
            }
            $('.'+day).on("click", ".remove_field", function () { //user click on remove text
      
            $(this).parent('div').remove();
            x--;
        });
         $('.'+day).on("focus", ".from", function () {
            $(this).timepicker();
        });
        $('.'+day).on("focus", ".to", function () {
            $(this).timepicker();
        });
        }
    
    
</script>
