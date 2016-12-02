<div>
	<?php if (isset($page)) : ?>
        <p class="pull-left"><a href="/user/home">Home::<?php echo $page; ?></a></p>
	<?php endif; ?>
    <p class="pull-right"><a href="#">Hello <?php echo isset($user) ? $user['fullname'] : ''; ?></a></p>
    <div class="clearfix"></div>
</div>
<div class="panel panel-primary <?php echo $edit_status ? '' : 'hide'; ?>">
    <div class="panel-heading">Change your email</div>
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <h1 class="entry-title"><span>Change your Email</span></h1>
                        <hr>
                        <form id="change-email-form" class="form-horizontal" method="POST"
                              action="/user/changeemail">
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
                                <label class="control-label col-sm-3">Current Email<span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <span><?php echo $user['email']; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">New Email<span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" name="email"
                                           placeholder="Enter your new email here" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Change</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<p class="alert alert-info <?php echo $edit_status ? 'hide' : ''; ?>">
    A confirm email has been sent to <b><?php echo $user['email']; ?></b>.
    <br>
    Please click on the confirmation link to confirm your new email.
</p>