<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update {controller_name}</title>
	<?php $this->load->view('layout/head') ?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<?php $this->load->view('layout/sidebar') ?>
			</div>
			<div class="col-xs-9">
				<div class="box">
					<form action="" method="POST" role="form">
						<?php alert() ?>
						<legend>Update {controller_name}</legend>
						<?php form_text('{first_field}', ${controller_name}->{first_field})?>
						<?php form_button('Update {controller_name}') ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>