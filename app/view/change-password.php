<div>
	<?php if (isset($page)) : ?>
        <p class="pull-left"><a href="/user/home">Home::<?php echo $page; ?></a></p>
	<?php endif; ?>
    <p class="pull-right"><a href="#">Hello <?php echo isset($user) ? $user['fullname'] : ''; ?></a></p>
    <div class="clearfix"></div>
</div>
<div class="panel panel-primary <?php echo $edit_status==true ? '' : 'hide'; ?>">
    <div class="panel-heading">Change your password</div>
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <h1 class="entry-title"><span>Change Your Password</span></h1>
                        <hr>
                        <form id="change-password-form" class="form-horizontal" method="POST"
                              action="/user/changepassword">
							<?php
							if (isset($message)) :
								?>
                                <div class="alert alert-warning">
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
                                <label class="control-label col-sm-3">Current Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Enter your current password" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">New Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="password" class="form-control" name="new-password"
                                           placeholder="Enter your new password" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Confirm New Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="password" class="form-control" name="confirm-password"
                                           placeholder="Confirm your password" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Change</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
<p class="alert alert-success <?php echo ($edit_status==true) ? 'hide' : ''; ?>">
    Your password has been changed successfully!
</p>