<?php if (isset($navbar)) : ?>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
				        data-target="#main-menu" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">L2</a>
			</div>
			<div class="collapse navbar-collapse" id="main-menu">
				<form class="navbar-form navbar-left" action="/user/search" method="POST">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="s">
						<span class="input-group-btn">
					        <button type="submit" class="btn btn-default"><i
							        class="glyphicon glyphicon-search"></i></button>
					      </span>
					</div>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/">Home</a></li>
					<li><a href="/friend/index">Friend list (<?php echo isset($count_friend) ? $count_friend : 0; ?>
							)</a></li>
					<li><a href="/friend/request">Friend request
							(<?php echo isset($count_request) ? $count_request : 0; ?>)</a></li>
					<?php if (($count_request < 5) && true) : ?>
						<li><a href="/friend/suggest">Friend suggestion</a></li>
					<?php endif; ?>
					<?php if (true) : ?>
						<li><a href="/follow/index">Follow list
								(<?php echo isset($count_follow) ? $count_follow : 0; ?>)</a></li>
					<?php endif; ?>
					<?php if (false) : ?>
						<li><a href="/message/index">Message
								(<?php echo isset($count_message) ? $count_message : 0; ?>)</a></li>
					<?php endif; ?>
					<?php if (($user['group_id'] == 1) && false) { ?>
						<li><a href="/user/manage">Management users</a></li>
					<?php } ?>
					<li><a href="/user/logout">Logout</a></li>
					<li><a href="/friend/view/<?php echo $user['id'] ?>">Hi <?php echo $user['fullname']; ?></a>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-collapse -->
	</nav>
<?php endif; ?>