<div class="">

    <div class="page-title">
	<div class="title_left">
	    <h3>CMS</h3>
	</div>


    </div>
    <div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
                <div class="x_title">
		    <h2>List</h2>
		    <div class="clearfix"></div>
                </div>
		<div class="x_content">
		    <p><?php
			echo $this->session->flashdata('msg');
			?></p>
		    <table id="datatable" class="table table-striped table-bordered">
			<thead>
			    <tr>
				<th>Title</th>
				<th>Order</th>
				<th>Status</th>
				<th>Edit</th>
			    </tr>
			</thead>
			<tbody>
			    <?php
			    if (!empty($cms)) {
				foreach ($cms as $list) {
				    ?>
				    <tr>
					<td><?php echo $list['cms_title'] ?></td>


					<td><?php echo $list['cms_menu_order'] ?></td>
					<td><?php if ($list['cms_status'] == 'active') {
					echo "ACTIVE";
				    } else if ($list['cms_status'] == 'inactive') {
					echo "INACTIVE";
				    } ?>
					</td>
					
					<td><?php if($list['cms_title']!='Home'){?>
					<a  href="<?php echo base_url() . 'siteadmin/cms/edit_cms/' . $list['cms_id'] ?>"  class="btn btn-dark" >Edit</a><?php }?>
					</td>
				    </tr>
    <?php
    }
}
?>

			</tbody>
		    </table>


		</div>
	    </div>
	</div>
    </div>
</div>
