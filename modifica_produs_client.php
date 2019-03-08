<?php
	require('server.php');
	//selectare comanda in desfasurare
	$query1 = "SELECT ComandaID FROM comanda WHERE ClientID='$_SESSION[user]' AND StatusComanda IS NULL";
	$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
	$rows1 = $result1->fetch_assoc();
	
	//selectare informatii produs din cos 
	$query = "SELECT produs.ProdusID, NumeProducator, Model, Pret*NrBucati as pret, Imagine, NrBucati, NrBucatiDisponibile FROM produs,produscomanda WHERE produs.ProdusID = produscomanda.ProdusID AND produs.ProdusID = '$_GET[id]' AND ComandaID = '$rows1[ComandaID]'";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result);
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
				<td><form class = "form_r" action = "cos_client.php"><li><a href = "cos_client.php">COSUL MEU</a></li></form></td>
				<td><form class = "form_r" action = "comenzi_client.php"><li><a href = "comenzi_client.php">COMENZILE MELE</a></li></form></td>
				<td><form class = "form_r" action = "welcome.php>logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
				</tr></table>
			</ul>
		</div>
	</header>
	<div class="header">
		<img src = "modific.png" style='width:7%'>
	</div>
	
	<! optiuni modificare produs din cos>
	<div class = "forms">
	<table class = "table2">
		<tr>
			<th>Produs</th>
			<th>Cantitate</th>
			<th>Modifica cantitate</th>
			<th>Sterge din cos</th>
		</tr>
		<tr>
			<form method = 'post' class='modify' action="modifica_produs_client.php?id=<?php echo $_GET['id'];?>">
			<?php
				echo "<td>".$row['NumeProducator']." ".$row['Model']."</td>";
				echo "<td><input type=text name='NrBucati' value='".$row['NrBucati']."'></td>";
				echo "<td><button type = submit class = 'btn btn-one' name = 'modify_cantity'>Modifica</button></td>";
				echo "</form>";
			?>
			<td><a class = 'btn btn-one' href="delete_product_client.php?id=<?php echo $_GET['id'];?>">Sterge</a></td>;
		</tr>
	</table>
	</div>
	
	
	
</body>
</html>