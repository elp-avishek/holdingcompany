<div class="">
    
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <th>SN</th>
            <th>Stylist Name</th>
        <th>Course Name</th>
        
        <th>Date Join</th>
        <th>Date of Approval</th>
        <th>Status</th>
        </thead>
        <tbody>
            <?php $i=1;foreach ($joining_list as $list){?>
            <tr>
                <td><?php echo $i ?></td>
                 <td><?php echo  $list['stylist_name'] ?></td>
                <td><?php echo  $list['course_name'] ?></td>
                <td><?php echo  $list['date_join'] ?></td>
                <td><?php echo  $list['date_change_status'] ?></td>
                <td><button class="<?php echo $list['status']=='active'?'btn btn-success':' btn btn-danger';?>" onclick="statuschange(<?php echo  $list['cj_id'] ?>)"><?php echo strtoupper($list['status']) ?></button></td>
            </tr>
            <?php $i++;} ?>
        </tbody>
    </table>
</div>
<script> 
  
    $(document).ready(function() {
            $("#datatable").dataTable();
        });
        
        
        function statuschange(id){
            $.alert.open('confirm', 'Do you want to continue?', function(button) {
             
    if (button == 'yes')
    {
 $.ajax({url: '<?php echo base_url()."siteadmin/course/joining_activation";?>/'+id,
                success:function(result){
                     joining_list();
                }
            });


    }
   
});}
        
</script>