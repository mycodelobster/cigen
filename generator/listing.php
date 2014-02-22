<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listing {controller_name}</title>
	<?php $this->load->view('layout/head') ?>
</head>
<body>
	<div class="container">
		<a href="<?php echo base_url("{controller_name}/add")?>" class="btn btn-primary pull-right" style="margin:-40px 0">Add New {controller_name}</a>
		<div class="row">
			<div class="col-xs-3">
				<?php $this->load->view('layout/sidebar') ?>
			</div>
			<div class="col-xs-9">
				<?php generate_table(${controller_name}_lists, "{primary_key}", "{controller_name}")?>
			</div>
		</div>
	</div>
</body>
</html>