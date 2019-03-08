<?php
	require('server.php');
	//selectare informatii clienti
	$query1 = "SELECT Nume, Prenume, Email from utilizatori WHERE TipUtilizator NOT LIKE 'admin' ORDER BY Nume";
	$result1= mysqli_query($connection, $query1);
	
	//selectare informatii produse
	$query2 = "SELECT NumeProducator, Model, ProdusID from produs";
	$result2= mysqli_query($connection, $query2);
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
			<h2> Vezi si ... </h2>	
		</div>
		
		<! optiuni vizualizare diverse statistici>
		<div class="forms">
		<table class = "table2">
		
		<tr>
			<form action="statistica_admin.php?id=1" method = 'post'>
			<td>~ Curierii ce livreaza comenzile unui anumit client</td>
			<td>
				<select name='Client'>
					<option value=''>Client..</option>	
					<?php 
					while($rows = $result1->fetch_assoc())
					{ ?>
						<option value='<?php echo $rows['Email'];?>'><?php echo $rows['Nume']," ", $rows['Prenume']; ?> </option>
					<?php } ?>
			</select></td>
			<td><button type = 'submit' class = 'btn btn-one' name = 'client'>>>></button></td>
			</form>
		</tr>
		
		<tr>
			<form action="statistica_admin.php?id=2" method = 'post'>
			<td>~ Furnizorii ce aprovizioneaza cu un anumit produs</td>
			<td>
				<select name='Produs'>
					<option value=''>Produs..</option>	
					<?php 
					while($rows = $result2->fetch_assoc())
					{ ?>
						<option value='<?php echo $rows['ProdusID']; ?>'><?php echo $rows['NumeProducator']," ",$rows['Model']; ?> </option>
					<?php } ?>
			</select></td>
			<td><button type='submit' class = "btn btn-one" name='produs'>>>></button></td>
			</form>
		</tr>
		
		<tr>
			<td>~ Produsele care apar in cel putin 2 comenzi plasate</td>
			<td><br></td>
			<td><a href="statistica_admin.php?id=3" class = "btn btn-one">>>></a></td>
		</tr>
		
		<tr>
			<td>~ Clientii ce au dat cel putin o comanda mai mare de 10.000 lei</td>
			<td><br></td>
			<td><a href="statistica_admin.php?id=4" class = "btn btn-one">>>></a></td>
		</tr>
		----------
		<tr>
			<td>~ Comenzile pentru care pretul total este mai mare decat media valorii unei comenzi si clientii asociati acestora </td>
			<td><br></td>
			<td><a href="statistica_admin.php?id=5" class = "btn btn-one">>>></a></td>
		</tr>
		
		<tr>
			<form action="statistica_admin.php?id=6" method = 'post'>
			<td>~ Comenzile care au fost plasate intr-o anumita luna si clientii aferenti acestora</td>
			<td><select name='Luna'>
					<option value=''>Luna..</option>
					<option value='1'>Ianuarie </option>
					<option value='2'>Februarie</option>
					<option value='3'>Martie</option>
					<option value='4'>Aprilie </option>
					<option value='5'>Mai</option>
					<option value='6'>Iunie</option>
					<option value='7'>Iulie </option>
					<option value='8'>August</option>
					<option value='9'>Septembrie</option>
					<option value='10'>Octombrie</option>
					<option value='11'>Noiembrie</option>
					<option value='12'>Decembrie</option>

			</select></td>
			<td><button type='submit' class = "btn btn-one" name='luna'>>>></button></td>
			</form>
		</tr>
		<tr>
			<form action="statistica_admin.php?id=7" method = 'post'>
			<td>~ Comenzile livrate de un anumit curier si numarul total de produse aferent</td>
			<td><select name='Curier'>
					<option value=''>Curier..</option>
					<option value='Fan Curier'>Fan Curier </option>
					<option value='Urgent Cargus'>Urgent Cargus</option>
					<option value='Sprint Curier'>Sprint Curier</option>
					<option value='DPD'>DPD</option>
			</select></td>
			<td><button type='submit' class = "btn btn-one" name='curier'>>>></button></td>
			</form>
		</tr>
		<tr>
			<td>~ Furnizorii ce aduc produse Samsung</td>
			<td><br></td>
			<td><a href="statistica_admin.php?id=8" class = "btn btn-one">>>></a></td>
		</tr>
		<tr>
			<td>~ Clientii care nu si-au primit inca comanda</td>
			<td><br></td>
			<td><a href="statistica_admin.php?id=9" class = "btn btn-one">>>></a></td>
		</tr>
		<tr>
			<td>~ Cel mai scump produs adus de fiecare furnizor</td>
			<td><br></td>
			<td><a href="statistica_admin.php?id=10" class = "btn btn-one">>>></a></td>
		</tr>
		</table>
	</div>
	</body>
	</html>