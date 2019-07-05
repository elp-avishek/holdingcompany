<div class="col-sm-12 col-m-12">
    <i> <b><h2 style="color:red;"><?php echo ucfirst($day);?></h2></b></I>
<table class="table table-striped ">
    <thead>
    <th style="color:blue">FROM</th>
    <th style="color:blue">TO</th>

    </thead>
    <tbody class="">
        <?php $i=0;
        if(!empty($from)){
           
        foreach ($from as $index=>$p){
            
            echo '<tr>'.'<td style="color:green">'.$p.'</td>'.'<td style="color:red">'.$to[$index].' <button class="btn-danger alignright" type="button" id="'.$i.'" onclick="removetime('.$i.')">X</button></td></tr>';
            $i++;
        }
        }else{
            echo "<tr><td><h1> TIME NOT SET</h1></td></tr>";
        }   
        
        ?>
    
   
    </tbody>
</table>
</div>
<div class="alignright">
  
    <label>From Time</label>
    <input type="text" id="ftime" name="ftime" size="8">
    <label>To Time</label>
    <input type="text" id="ttime" name="ftime" size="8">
    <button type="button" class="btn btn-dark" id="add" value="ADD" onclick="addtime()">ADD</button>
</div>
<!--<div class="col-sm-6 col-m-6">
<table class="table table-striped ">
    <thead>
    <th style="color:blue">TO</th>

    </thead>
    <tbody>
        //<?php // foreach ($to as $q){
//            
//            echo '<tr>'.'<td style="color:red">'.$q.'</td></tr>';
//            
//        }
//            ?>
       
    </tbody>
</table>
</div>-->
<script>
    function days(day){
       var day;
       
         $.ajax({url: "<?php echo base_url() . 'siteadmin/service/service_edit_period_process/'.$s_id; ?>/"+day, 
             success: function(result){
             $("#time1").html(result);
    }
    });
    } 
   
$('#ftime').timepicker({'timeFormat': 'H:i'});
 $('#ttime').timepicker({'timeFormat': 'H:i'});    
 function addtime(){
  var f=$('#ftime').val();
  var t=$('#ttime').val();
  if(f==t){
      alert('Enter diffrent time ');
      }else{
     $.ajax({url:"<?php echo base_url().'siteadmin/service/add_service_period/'.$s_id.'/'.$day?>/"+f+"/"+t,
         success:function(result){
              days('<?php echo $day; ?>');
         }
             });
             }
 }
 function removetime(a){
//     alert(a);
 $.ajax({url:"<?php echo base_url().'siteadmin/service/remove_service_period/'.$s_id.'/'.$day?>/"+a,
         success:function(result){
              days('<?php echo $day; ?>');
         }
             });
 }
  
 
 
 
</script>
    
   