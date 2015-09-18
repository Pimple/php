<?php
include_once 'includes/functions.php';

sec_session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Secure Login: Protected Page</title>
	<link rel="stylesheet" href="styles/bootstrap.css">
	<link rel="stylesheet" href="styles/bootstrap-theme.css">
	<link rel="stylesheet" href="styles/main.css">
</head>
<body>
<div class="container-fluid">
<?php if (login_check() == true) : ?>
	<?php include_once("includes/navbar.php") ?>

	<h1>Welcome, <?php echo htmlentities($_SESSION['username']); ?>!</h1>
	<p>
		This is an example protected page.  To access this page, users
		must be logged in.  At some stage, we'll also check the role of
		the user, so pages will be able to determine the type of user
		authorised to access the page.
	</p>
	<h2 class="sub-header">Section title</h2>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
			<tr>
				<th></th>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Email</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$database = Database::getInstance();
			$connection = $database->query("select * from randomusers where id <= 10");

			while($user = $connection->fetch()): ?>
			<tr>
				<td><img width="60px" height="60px" src="<?php echo $user['mediumpic'] ?>"></td>
				<td><a href="userinfo.php?id=<?php echo $user['id'] ?>"><?php echo $user['username'] ?></a></td>
				<td><?php echo ucfirst($user['firstname']) ?></td>
				<td><?php echo ucfirst($user['lastname']) ?></td>
				<td style="color: <?php echo $user['gender'] == "male" ? "#6666ff" : "#ff6666"; ?>"><?php echo $user['gender'] ?></td>
				<td><a href="mailto:<?php echo $user['email'] ?>"><?php echo $user['email'] ?></a></td>
			</tr>
			<?php endwhile; ?>
			</tbody>
		</table>
	</div>
<?php else : ?>
	<p>
		<span class="error">You are not authorized to access this page.</span>Please <a href="index.php">login</a>.
	</p>
<?php endif; ?>
</div>

<script src="scripts/jquery-1.11.3.js"></script>
<script src="scripts/bootstrap.min.js"></script>
</body>
</html>