function show_history(url){
    $.ajax  ({
                type: "POST",
                url: url,
                cache: false,
                success: function(html)
                {    $("#datatable").html(" ");
                    $("#datatable").html(html);
                } 
            });
}
//$(document).ready(function(e)
//{     alert()
//	$("#loding1").hide();
//	$(".state").on('change', function()
//	{       
//		$("#loding1").show();
//		var id_stname=$(this).val();
//		     id_stname=id_stname.split("@@@");
//		     id = id_stname[0];
//		
//		//$(".state").find('option').remove();
//		$(".city").find('option').remove();
//		$.ajax
//		({
//			type: "POST",
//			url: "<?php echo SDOM_SITE_URL; ?>postingad/getcity_statewise/" + id,
//			
//			cache: false,
//			success: function(html)
//			{
//				$("#loding1").hide();
//				$(".city").append(html);
//			} 
//		});
//	});
//	
//});
//	
