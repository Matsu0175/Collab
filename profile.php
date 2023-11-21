

<?php
if (isset($_SESSION["auth_logged_in"])) {
?>
	<div class="btn-group">
	<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
	 <i class="bi bi-person"></i> <?= $_SESSION["auth_email"]; ?>
	</button>
	<ul class="dropdown-menu">
	  <li><a class="dropdown-item" href="user.php">Profile</a></li>
	  <li><a class="dropdown-item" href="posting.php">Posting Page</a></li>
	  <li><hr class="dropdown-divider"></li>
	  <li><a class="dropdown-item" style="cursor: pointer;" id="logout">Logout Account</a></li>
	</ul>
	</div>
<?php	
}else{
?>
<a class="btn-book-a-table" style="cursor: pointer;" id="login-btn">Login/Register</a>
<?php
}
?>