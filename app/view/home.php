<p class="text-right"><a href="#">Hello <?php echo isset($user) ? $user['fullname'] : ''; ?></a></p>

<h3>Main Menu</h3>
<ul class="list-group">
    <li class="list-group-item list-group-item-warning">Welcome to MasterLampart</li>
    <a href="/user/profile">
        <li class="list-group-item list-group-item-success">Profile</li>
    </a>
    <a href="/user/changeemail">
        <li class="list-group-item list-group-item-success">Change email</li>
    </a>
    <a href="/user/changepassword">
        <li class="list-group-item list-group-item-success">Change password</li>
    </a>
    <a href="/user/logout">
        <li class="list-group-item list-group-item-success">Logout</li>
    </a>
    <!--	<li class="list-group-item list-group-item-danger"><a href="/friend/index">Friend/index</a></li>-->
</ul>
