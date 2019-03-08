<?php
	require('server.php');
	//selectare informatii furnizori
	$query = "SELECT * FROM furnizor";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection))
?>

<html>
<head>
<title>Tablette</title>
<link href = "style3.css" rel = "stylesheet" type = "text/css"
</head>

<body>
<header>
		<div class = "row">
			<div class = "logo">
				<img src = "logo3.png">
			</div>
			
			<! meniu principal>
			<ul class = "menu">
				<table><tr>
					<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
					<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
					<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
					<td><form class = "form_r" action = "operatiuni_admin.php"><li><a href = "operatiuni_admin.php">OPERATIUNI</a></li></form></td>
					<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
				</tr></table>
			</ul>
		</div>
	</header>	
	<div class="header">
		<h2>Alege: </h2>
	</div>
	
	<! lista alegere furnizor ce va fi eliminat>
	<div class = "forms">
		<table class = "table2">
			<tr>
				<th>Nume </th>
				<th>Telefon</th>
				<th>Adresa</th>
				<th>Sterge furnizor</th>
			</tr>
			<?php
				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row['Nume']."</td>";
					echo "<td>".$row['Telefon']."</td>";
					echo "<td>".$row['Adresa']." lei</td>";
					echo "<td><a class = 'btn btn-one' href=delete_provider_admin.php?id=".$row['FurnizorID'].">Sterge</a></td>";
					}
			?>
			</tr>
		</table>
	</div>
	
	
</body>
</html>