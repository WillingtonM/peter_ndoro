<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'header.php'; ?>

<div class="row">
	<div id="subscription_message" class="col-12"></div>
	<div class="col-12">
		<h4 class="modal-title"><?= ((isset($_POST['subscrb_id']) && $_POST['subscrb_id'] != '') ? 'Subscription | <i class="text-warning">' . $user['subscription_name'] . $user['subscription_last_name'] . '</i>' : 'Add Subscriber') ?></h4>
	</div>
	<form id="feedbackForm" class="col-12" method="post"><br><br>
		<div class="rounded-0/">

			<div class="">
				<div id="feedbackErrors" class=""></div>
				<div class="form-row align-items-center">
					<div class="col-12 col-lg-6/">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text text-warning"> <i class="fa fa-user input_color"></i> </div>
							</div>
							<input type="text" class="form-control shadow-none" id="subscribe_name" name="name" placeholder="Name" value="<?= ((isset($user) && $user != null) ? $user['subscription_name'] : '') ?>" required>
						</div>
					</div>
				</div>
				<div class="form-row align-items-center">
					<div class="col-12 col-lg-6/">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text text-warning"> <i class="fa fa-user input_color"></i> </div>
							</div>
							<input type="text" class="form-control shadow-none" id="subscribe_last_name" name="lastname" placeholder="Surname" value="<?= ((isset($user) && $user != null) ? $user['subscription_last_name'] : '') ?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text text-warning"><i class="fa fa-envelope input_color"></i></div>
						</div>
						<input type="email" class="form-control shadow-none" id="signup_email" name="feedbackemail" placeholder="Email" value="<?= ((isset($user) && $user != null) ? $user['subscription_email'] : '') ?>" required>
					</div>
				</div>

				<input type="hidden" name="subscription_id" id="subscription_id" value="<?= ((isset($user) && $user != null) ? $user['subscription_id'] : '') ?>">

				<div class="text-center" style="border-radius: 35px;">
					<button type="button" class="btn btn-block rounded-0 btn-warning shadow-none" style="border-radius: 35px !important;" onclick="postCheck('subscription_message', {'name':$('#subscribe_name').val(), 'last_name':$('#subscribe_last_name').val(), 'signup_email':$('#signup_email').val(), 'subscription_id':$('#subscription_id').val()});"> Submit </button>
				</div>
			</div>
		</div>
	</form>

</div>

<?php require_once $config['PARSERS_PATH'] . 'modal' . DS . 'footer.php' ?>