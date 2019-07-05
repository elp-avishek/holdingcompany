<script type="text/javascript">
	$('document').ready(function()
{ 

$("#register-form").validate({
      rules:
   {
   fname: {
      required: true,
   minlength: 3
   },
   lname: {
      required: true,
   minlength: 3
   },
    registration_phone: {
      required: true,
   minlength: 3
   },
   registration_password: {
   required: true,
   minlength: 8,
   maxlength: 15
   },
   conf_pass: {
   required: true,
   equalTo: '#registration_password'
   },
   registration_email: {
            required: true,
            email: true
            },
    },
       messages:
    {
            fname: '<span class="alert alert-mini alert-danger" role="alert">\n\
                    <i class="fa fa-warning"></i> Please Enter First Name</span>',
            lname: '<span class="alert alert-mini alert-danger" role="alert">\n\
                    <i class="fa fa-warning"></i> Please Enter Last Name</span>',
            registration_password:{
                      required: '<span class="alert alert-mini alert-danger" role="alert">\n\
                        <i class="fa fa-warning"></i> Please Enter Password</span>',
                      minlength: '<span class="alert alert-mini alert-danger" role="alert">\n\
                        <i class="fa fa-warning"></i> Password Atleast 8 character</span>'
                     },
            registration_email: '<span class="alert alert-mini alert-danger" role="alert">\n\
                        <i class="fa fa-warning"></i> Please Enter Valid Email</span>',
            conf_pass:{
               required: '<span class="alert alert-mini alert-danger" role="alert">\n\
                                 <i class="fa fa-warning"></i> Please Retypr Your Password</span>',
               equalTo: '<span class="alert alert-mini alert-danger" role="alert">\n\
                                 <i class="fa fa-warning"></i> Password Does Not Matchs !</span>'
            },
            
            registration_phone:{
                required: '<span class="alert alert-mini alert-danger" role="alert">\n\
                                 <i class="fa fa-warning"></i> Please Enter Phone Number</span>'
            }
    
       },
    submitHandler: submitForm 
});

 function submitForm()
    {   alert("satya");   
    var data = $("#register-form").serialize();
    var url_reg = <?php echo base_url()."home/registration/";?>; 
    $.ajax({
    
    type : 'POST',
    url  : url_reg,
    data : data,
    beforeSend: function()
    { 
     $("#error").fadeOut();
     $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
    },
    success :  function(data)
         {   alert("satya");   
        if(data==1){
         
         $("#error").fadeIn(1000, function(){
           
           
           $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken !</div>');
           
           $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');
          
         });
                    
        }
        else if(data=="registered")
        {
         
         $("#btn-submit").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing Up ...');
         setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("success.php"); }); ',5000);
         
        }
        else{
          
         $("#error").fadeIn(1000, function(){
           
      $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');
           
         $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');
          
         });
           
        }
         }
    });
    return false;
  }
    /* form submit */ 

});
       
       
</script>