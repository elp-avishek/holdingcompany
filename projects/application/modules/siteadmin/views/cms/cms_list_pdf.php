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
				<th>PDF DETAILS</th>
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
					<?php
					$cms_file_arr = explode(",", $list['cms_file']);
					?>
					<td>
					    <?php
					    $i = 1;
					    foreach ($cms_file_arr as $value) {
						?>

	    				    <a href="<?php echo base_url() . 'assets/pdf_details/' . $value ?>" target="_blank" style="text-decoration: none;"><i class="fa fa-eye"></i></a>&nbsp;<?php if ($i == 3 || $i == 6 || $i == 9 || $i == 12) {
					echo "<br>";
				    } ?>

						<?php $i+=1;
					    } ?>
					</td> 
					<td><?php echo $list['cms_menu_order'] ?></td>
					<td><?php
				    if ($list['cms_status'] == 'active') {
					echo "ACTIVE";
				    } else if ($list['cms_status'] == 'inactive') {
					echo "INACTIVE";
				    }
					    ?>
					</td>

					<td><a  href="<?php echo base_url() . 'siteadmin/cms/edit_cms_pdf/' . $list['cms_id'] ?>"  class="btn btn-dark" >Edit</a></td>
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
