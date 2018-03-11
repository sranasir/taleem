<div class="jumbotron" text-align="center">
	<h2>
		Welcome to Applications Section
	</h2>

	<p class="lead">
		Apply for an Education Loan or Scholarship, African American Education Grant<br> or
		Annual Talent Award. Find details about these programs <a href="guidelines">here</a>.
	</p>
	<br>

	<?php if (isset($current_user->email)): ?>
		<?php
		if($current_user->role_id == 1)
			$dashboard_url = site_url(SITE_AREA . '/content/applications/manage');
		elseif($current_user->role_id == 2)
			$dashboard_url = site_url(SITE_AREA . '/content/applications/review');
		elseif($current_user->role_id == 4)
			$dashboard_url = site_url(SITE_AREA . '/content/applications');
		?>
		<a href="<?php echo $dashboard_url; ?>" class="btn btn-large btn-success">Go to your Dashboard</a>
	<?php else: ?>
		<a href="<?php echo site_url(LOGIN_URL); ?>" class="btn btn-large btn-primary"><?php echo 'Sign In'; ?></a>
		<a href="<?php echo site_url(REGISTER_URL); ?>" class="btn btn-large btn-primary"><?php echo 'Register'; ?></a>
	<?php endif;?>

</div>