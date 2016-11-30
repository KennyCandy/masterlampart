<div class="panel panel-primary">
	<div class="panel-heading">Registration form</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<section>
						<h1 class="entry-title"><span>Registration</span></h1>
						<hr>
						<form id="register-form" class="form-horizontal" method="POST" action="/user/registration">
							<?php
							if (isset($message)) :
								?>
								<div class="alert alert-warning col-md-9 col-md-offset-3">
									<ul>
										<?php
										foreach ($message as $m) {
											echo '<li>' . $m . '</li>';
										}
										?>
									</ul>
								</div>
								<?php
							endif;
							?>
<!--							<div class="form-group">-->
<!--								<label class="col-md-6">Fullname(*)</label>-->
<!--								<div class="col-md-6">-->
<!--									<input class="form-control" type="text" name="fullname"-->
<!--									       value="--><?php //echo isset($fullname) ? $fullname : '' ?><!--"/>-->
<!--								</div>-->
<!--							</div>-->
							<div class="form-group">
								<label class="control-label col-sm-3">Full Name <span
										class="text-danger">*</span></label>
								<div class="col-md-9 col-sm-9">
									<input type="text" class="form-control" name="fullname"
									       placeholder="Enter your Name here"
									       value="<?php echo isset($fullname) ? $fullname : '' ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Username(*)</label>
								<div class="col-md-6">
									<input class="form-control" name="username"
									       value="<?php echo isset($username) ? $username : '' ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Email(*)</label>
								<div class="col-md-6">
									<input class="form-control" type="text" name="email"
									       value="<?php echo isset($email) ? $email : '' ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Password(*)</label>
								<div class="col-md-6">
									<input class="form-control" type="password" name="password"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Re-password(*)</label>
								<div class="col-md-6">
									<input class="form-control" type="password" name="re-password"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Address(*)</label>
								<div class="col-md-6">
									<input class="form-control" type="text" name="address"
									       value="<?php echo isset($address) ? $address : '' ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Sex(*)</label>
								<div class="col-md-6">
									<input type="radio" value="1" name="sex" checked/> Male
									<input type="radio" value="2" name="sex"/> Female
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Birthday(*)</label>
								<input type="hidden" id="birthday" name="birthday">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4">
											<select id="form-date" class="form-control" name="date"></select>
										</div>
										<div class="col-md-4">
											<select id="form-month" class="form-control" name="month"></select>
										</div>
										<div class="col-md-4">
											<select id="form-year" class="form-control" name="year"></select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Security check</label>
								<div class="col-md-6 text-center">
									<img id="capcha-image" src="/public/libs/capcha/capcha.php"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-6">Text in the box(*)</label>
								<div class="col-md-5">
									<input class="form-control" name="code" type="text"/>
								</div>
								<div class="col-md-1">
									<a id="refresh-capcha" class="btn btn-default"><i
											class="glyphicon glyphicon-repeat"></i></a>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-6 text-center">
									<a id="submit-register" class="btn btn-default">Register</a>
									<a href="/" class="btn btn-default">Cancel</a>
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>