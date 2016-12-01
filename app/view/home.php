<p class="text-right"><a href="#">Hello <?php echo isset($user) ? $user['fullname'] : ''; ?></a></p>

<h3>Main Menu</h3>
<ul class="list-group">
	<li class="list-group-item list-group-item-warning">Welcome to MasterLampart</li>
	<li class="list-group-item list-group-item-success"><a href="/user/profile/<?php echo $user['id'] ?>">Profile</a></li>
	<li class="list-group-item list-group-item-success"><a href="/user/changeemail">Change email</a></li>
	<li class="list-group-item list-group-item-success"><a href="/user/changepassword">Change password</a></li>
	<li class="list-group-item list-group-item-success"><a href="/user/logout">Logout</a></li>
	<li class="list-group-item list-group-item-danger"><a href="/friend/index">Friend/index</a></li>
</ul>
