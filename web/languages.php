<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>RDA Languages</title>
</head>
<body>
<h1>Available Languages</h1>
<table>
<tr><td>Code</td><td>Locale</td></tr>
		<?php foreach (unserialize(file_get_contents("../data/symfony/i18n/en.dat","r"))['Languages'] as $key => $value) {
	echo "<tr><td>$key</td><td>$value[0]</td></tr>\n";
}
?>
<//table>
</body>
