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

                            <div class="form-group">
                                <label class="control-label col-sm-3">Full Name <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" name="fullname"
                                           placeholder="Enter your Name here (4-30 chars)"
                                           value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '' ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Username <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" name="username"
                                           placeholder="Enter your Username here (4-30 chars)"
                                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Email<span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <div class="input-group">
										<span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="email" class="form-control" name="email"
                                               placeholder="Enter your Email ID"
                                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Set Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" name="password"
                                               placeholder="Choose password (3-20 chars + @#$%!)" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Re-password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" name="re-password"
                                               placeholder="Confirm your password" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Address <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" name="address"
                                           placeholder="Enter your Address here"
                                           value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Sex <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <label>
                                        <input name="sex" type="radio" value="1" checked>
                                        Male </label>
                                       
                                    <label>
                                        <input name="sex" type="radio" value="2">
                                        Female </label>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-3">Birthday <span
                                            class="text-danger">*</span></label>
                                <input type="hidden" id="birthday" name="birthday" value="<?php echo isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : '' ?>">
                                <div class="col-md-9 col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="form-date">Date</label>
                                            <select id="form-date" class="form-control" name="date">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="form-month">Month</label>
                                            <select id="form-month"
                                                    class="form-control"
                                                    name="month">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="form-year">Year</label>
                                            <select id="form-year"
                                                    class="form-control" name="year">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3">Security check <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">

                                    <p id="sessionOrigin"
                                       class="hide"><?php echo $_SESSION['captcha']['image_src']; ?></p>
                                    <img id="captcha-image" src="<?php echo $_SESSION['captcha']['image_src'] ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Text in the box<span
                                            class="text-danger">*</span></label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" class="form-control" name="code"
                                           placeholder="Enter the captcha here"
                                           value="<?php echo isset($_POST['code']) ? htmlspecialchars($_POST['code']) : '' ?>">
                                </div>

                                <div class="col-md-1">
                                    <a id="refresh-captcha" class="btn btn-info"><i
                                                class="glyphicon glyphicon-repeat"></i></a>
                                    <!--                                    <button id="refresh-captcha">sdasdas</button>-->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-md-9 col-sm-9"><span class="text-muted"><span
                                                class="label label-danger">Note:-</span> By clicking Register, you agree to our <a
                                                href="#">Terms</a> and that you have read our <a href="#">Policy</a>, including our <a
                                                href="#">Cookie Use</a>.</span></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3 text-center">
                                    <a id="submit-register" class="btn btn-primary">Register</a>
                                    <a href="/" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>