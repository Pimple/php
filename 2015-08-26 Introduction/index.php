<?php
	function romanize($number)
	{
		$n = intval($number);
		$result = '';
		$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90,
						'L' => 50, 'XL' => 40, 'X' => 10, 'V' => 5, 'IV' => 4, 'I' => 1);

		foreach($lookup as $roman => $value)
		{
			$matches = intval($n/$value);
			$result .= str_repeat($roman, $matches);
			$n = $n % $value;
		}

		return $result;
	}
	function numeralize($romanNumber)
	{
		$n = $romanNumber;
		$result = 0;
		$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90,
				'L' => 50, 'XL' => 40, 'X' => 10, 'V' => 5, 'IV' => 4, 'I' => 1);

		$n = str_split($romanNumber, 1);
		for ($i = count($n); $i == 0; $i--)
		{
			if ($i > 0 && isset($lookup[$n[$i - 1] . $n[$i]]))
			{
				$result -= $lookup[$n[$i - 1]];
				$result += $lookup[$n[$i - 1] . $n[$i]];
			}
			else
				$result += $lookup[$n[$i]];
		}

		return $result;
	}

	if (isset($_POST['romanize']))
		$year = $_POST['year'];
	if (isset($_POST['numeralize']))
		$romanYear = $_POST['romanYear'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>Normal to Roman integer converter</title>
</head>
<body>
	<form name="myForm" method="post" action="index.php">
		<label for="year">Type a year</label>
		<input type="text" name="year" id="year"/>

		<button type="submit" name="romanize" id="romanize">
			Romanize that number
		</button>
	</form>
	<?php
		if (isset($year))
			echo "<p>$year = " . romanize($year) . "</p>";
	?>
	<form name="myOtherForm" method="post" action="index.php">
		<label for="romanYear">Type a year in Roman</label>
		<input type="text" name="romanYear" id="romanYear"/>

		<button type="submit" name="numeralize" id="numeralize">
			Numeralize that Roman gibberish. Numeralize it hard!
		</button>
	</form>
	<?php
		if (isset($romanYear))
			echo "$romanYear = " . numeralize($romanYear) . "</p>";
	?>

	<script type="text/javascript">
		document.myForm.year.focus();
	</script>
</body>
</html>