<div class="panel panel-primary">
	<div class="panel-heading">Login form</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">

				<div class="col-md-8">
					<section>
						<h1 class="entry-title"><span>Login</span></h1>
						<hr>
						<form class="form-horizontal" method="POST" action="/user/login">

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
							<div class="form-group">
								<label class="control-label col-sm-3">Username <span
										class="text-danger">*</span></label>
								<div class="col-md-9 col-sm-9">
									<input type="text" class="form-control" name="username"
									       placeholder="Enter your Username here" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Password <span
										class="text-danger">*</span></label>
								<div class="col-md-9 col-sm-9">
									<div class="input-group">
                                            <span class="input-group-addon"><i
		                                            class="glyphicon glyphicon-lock"></i></span>
										<input type="password" class="form-control" name="password"
										       placeholder="Enter your Password here" value="">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12 text-right">
									<button type="submit" class="btn btn-primary">Login</button>
									<a href="/" class="btn btn-default">Cancel</a>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>