<p class="text-right"><a href="#">Hello <?php echo isset($user) ? $user['fullname'] : ''; ?></a></p>
<h4>Main menu</h4>
<ul class="list-group">
	<li class="list-group-item"><a href="/user/profile/<?php echo $user['id'] ?>">Profile</a></li>
	<li class="list-group-item"><a href="/user/changeemail">Change email</a></li>
	<li class="list-group-item"><a href="/user/changepassword">Change password</a></li>
	<li class="list-group-item"><a href="/user/logout">Logout</a></li>
	<li class="list-group-item list-group-item-info"><a href="/friend/index"><b>Lesson2</b></a></li>
</ul>
