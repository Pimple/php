<?php
if (!isset($_SESSION['user']))
	header('Location:index.php');
else
	$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

</body>
</html>