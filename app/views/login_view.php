<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mockup</title>
	<?php $this->load->view('layout/head') ?>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-xs-3"></div>
			<div class="col-xs-6">
				<div class="box">
					<form action="" method="POST" role="form">
						<?php alert() ?>
						<legend>Login</legend>
						<?php form_text('username') ?>
						<?php form_password('password') ?>
						<?php form_button('Login') ?>
					</form>
				</div>
				<p><?php echo br(). anchor('signup', 'Signup Now') ?></p>
			</div>
		</div>
	</div>
</body>
</html>