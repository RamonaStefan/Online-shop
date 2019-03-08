<?php  
	require('server.php');
	//selectare informatii produs
	$query = "SELECT * FROM `produs` WHERE ProdusID = '$_GET[id]'";
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
	
	<! formular modificare informatii produs>
	<div class = "forms">	
	<table class = "table2">
		<?php while($row = mysqli_fetch_array($result)) {
				echo "<form action=produs_modificat_admin.php?id=".$row['ProdusID']." method = post class=modify>";
				echo "<tr><td>Nume Producator</td><td><input type=text name='NumeProducator' value='".$row['NumeProducator']."'></td></tr>";
				echo "<tr><td>Model</td><td><input type=text name='Model' value='".$row['Model']."'></td></tr>";
				echo "<tr><td>Specificatii</td><td><input type=text name='Specificatii' value='".$row['Specificatii']."'></td></tr>";
				echo "<tr><td>Pret (lei)</td><td><input type=text name='Pret' value='".$row['Pret']."'></td></tr>";
				echo "<tr><td>Numar bucati disponibile</td><td>".$row['NrBucatiDisponibile']."</td></tr>";
				echo "<tr><td>Imagine</td><td><input type=text name='Imagine' value='".$row['Imagine']."'></td></tr>";
				echo "<tr><td>Modifica</td><td><button type = submit class = btn btn-one name = 'modify_product'>Modifica produs</button></td></tr>";
				echo "</form>";
		} ?>
	</table>
	<br><br>
	
	<?php $result = mysqli_query($connection, $query) or die(mysqli_error($connection)); ?>
	
	<! formular modificare cantitate pe stoc produs>
	<table class = "table2">
		<?php while($row = mysqli_fetch_array($result)) {
				echo "<form action=produs_modificat_admin.php?id=".$row['ProdusID']." method = post class=modify>";
				echo "<tr><td>Nume furnizor</td><td><select name='NumeFurnizor'>";
					echo "<option value=''>Alege...</option>";	
					echo "	<option value='Emag'>Emag</option>";
					echo "	<option value='Mobiparts SRL'>Mobiparts SRL</option>";
					echo "	<option value='Gersim Impex'>Gersim Impex</option>";
					echo "	<option value='Garaj'>Garaj</option>";
				echo "</select></td>";
				echo "<tr><td>Numar bucati noi furnizate</td><td><input type=text name='NrBucati'></td>";
				echo "<tr><td>Modifica</td><td><button type = submit class = btn btn-one name = 'modify_stoc'>Modifica cantitate de pe stoc</button></td>";
				echo "</form>";
		} ?>
	</table>
	</div>
	
</body>
</html>