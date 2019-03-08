<?php  
	require('server.php');
	//selectare informatii furnizor
	$query = "SELECT * FROM `furnizor` WHERE FurnizorID = '$_GET[id]'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
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
		<img src="modific.png" style="width:10%" />
	</div>
	
	<! formular modificare informatii furnizor>
	<div class = "forms">	
	<table class = "table2">
		<?php
			while($row = mysqli_fetch_array($result))
			{
				echo "<form action=furnizor_modificat_admin.php?id=".$row['FurnizorID']." method = post class=modify>";
				echo "<tr><td>Nume</td><td><input type=text name='Nume' value='".$row['Nume']."'></td></tr>";
				echo "<tr><td>Telefon</td><td><input type=text name='Telefon' value='".$row['Telefon']."'></td></tr>";
				echo "<tr><td>Adresa</td><td><input type=text name='Adresa' value='".$row['Adresa']."'></td></tr>";
				echo "<tr><td>Modifica</td><td><button type = submit class = btn btn-one name = 'modify_provider'>Modifica furnizor</button></td></tr>";
				echo "</form>";
			}
		?>
	</table>
	</div>
	
</body>
</html>