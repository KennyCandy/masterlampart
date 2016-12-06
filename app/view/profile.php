<div>
	<?php if (isset($page)) : ?>
        <p class="pull-left"><a href="/user/home">Home::<?php echo $page; ?></a></p>
	<?php endif; ?>
    <p class="pull-right"><a href="#">Hello <?php echo isset($user) ? $user['fullname'] : ''; ?></a></p>
    <div class="clearfix"></div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading"><span class="edit-hide hide">Change your </span>Profile</div>
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <h1 class="entry-title"><span class="edit-show">Profile View Mode</span></h1>
                        <h1 class="entry-title"><span class="edit-hide hide">Profile Edit Mode</span></h1>
                        <hr>
                        <form id="edit-form" class="form-horizontal" method="POST"
                              action="/user/profile/<?php echo $user["id"] ?>">
                            <input type="hidden" name="edit-status" id="edit-status"
                                   value="<?php echo ($edit_status == false) ? 0 : 1; ?>">
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
                                <label class="control-label col-sm-3">Full Name
                                    <span class="text-danger edit-hide hide">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <span class="edit-show"><?php echo $user['fullname']; ?></span>
                                    <input type="text" class="form-control edit-hide hide" name="fullname"
                                           placeholder="Enter your Name here (4-30 chars)"
                                           value="<?php echo $user['fullname']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Username <span
                                            class="text-danger edit-hide hide">*</span></label>
                                <div class="col-md-9 col-sm-9">
									<?php echo $user['username']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Email<span
                                            class="text-danger edit-hide hide">*</span></label>
                                <div class="col-md-9 col-sm-9">
									<?php echo $user['email']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Address <span
                                            class="text-danger edit-hide hide">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <span class="edit-show"><?php echo $user['address']; ?></span>
                                    <input class="form-control edit-hide hide" name="address"
                                           value="<?php echo $user['address']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Sex <span
                                            class="text-danger edit-hide hide">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <span class="edit-show"><?php echo ($user['sex'] == 1) ? 'Male' : 'Female'; ?></span>
                                    <div class="edit-hide hide">
                                        <input type="radio" value="1"
                                               name="sex" <?php echo ($user['sex'] == 1) ? 'checked' : ''; ?>/> Male
                                        <input type="radio" value="2"
                                               name="sex" <?php echo ($user['sex'] == 2) ? 'checked' : ''; ?>/> Female
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Birthday <span
                                            class="text-danger edit-hide hide">*</span></label>
                                <div class="col-md-9 col-sm-9">
                                    <span class="edit-show"><?php echo $user['birthday']; ?></span>
                                    <div class="edit-hide hide">
                                        <input type="hidden" name="birthday" id="birthday"
                                               value="<?php echo $user['birthday']; ?>">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="form-date">Date</label>
                                                <select id="form-date" class="form-control" name="date"
                                                        value="<?php echo explode('-', $user['birthday'])[2]; ?>">
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="form-month">Month</label>
                                                <select id="form-month" class="form-control" name="month"
                                                        value="<?php echo explode('-', $user['birthday'])[1]; ?>"></select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="form-year">Year</label>
                                                <select id="form-year" class="form-control" name="year"
                                                        value="<?php echo explode('-', $user['birthday'])[0]; ?>"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <a id="change-button" class="btn btn-primary edit-show">Change</a>
                                    <a id="edit-profile" class="btn btn-info edit-hide hide">Save</a>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>