<?php
	require('server.php');
	//selectare comenzi utilizator curent
	$query = "SELECT ComandaID FROM comanda WHERE ClientID =".$_SESSION['user'];
	$result = mysqli_query($connection, $query);
	$count = mysqli_num_rows($result); 
?>

<html>
<head>
<title>Produse</title>
<link href = "style3.css" rel = "stylesheet" type = "text/css"
</head>


<body>
	<header>
		<div class = "row">
			<div class = "logo">
				<img src = "logo3.png">
			</div>
			<! meniu principal >
			<ul class = "menu">
				<table><tr>
				<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
				<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
				<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
				<td><form class = "form_r" action = "cos_client.php"><li><a href = "cos_client.php">COSUL MEU</a></li></form></td>
				<td><form class = "form_r" action = "comenzi_client.php"><li class = "active"><a href = "comenzi_client.php">COMENZILE MELE</a></li></form></td>
				<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
				</tr></table>
			</ul>
			
		</div>
		
	</header>
	<div class = "images">
	<?php
	if($count > 0){ ?>
		<div class="header">
			<h2>Comenzile mele</h2>
		</div>
		<div class='forms'>
		<! afisare detalii comenzi >
		<?php
		while($rows = $result->fetch_assoc()){
			//date despre produsele comandate
			$query2 = "SELECT * FROM produs,produscomanda WHERE produs.ProdusID = produscomanda.ProdusID AND ComandaID='".$rows['ComandaID']."'";
			$result2 = mysqli_query($connection, $query2); 
			//date despre comanda
			$query3 = "SELECT * FROM comanda WHERE ComandaID ='".$rows['ComandaID']."'";
			$result3 = mysqli_query($connection, $query3);
			$rows3 = $result3->fetch_assoc();
			//date despre curier
			$query5 = "SELECT * FROM curier, comanda WHERE curier.CurierID=comanda.CurierID AND ComandaID='".$rows['ComandaID']."'";
			$result5 = mysqli_query($connection, $query5);
			$rows5 = $result5->fetch_assoc();

			if(mysqli_num_rows($result2) > 0){ ?>
				<br>
				<h1>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~<h1>
				<h1>Numar comanda: <?php echo $rows['ComandaID']; ?></h1>
				<br>
				<table class="table2">
					<th>Produs</th>
					<th>Cantitate</th>
					<th>Pret(lei)</th>
			<?php
					while($rows2 = $result2->fetch_assoc()){
			?>		
						<tr>
						<td><img class = "poza" src = <?php echo $rows2['Imagine']; ?> style = "width :5%">
						<?php echo $rows2['NumeProducator']," ",$rows2['Model']; ?></td>
						<td><?php echo $rows2['NrBucati']; ?></td>
						<td><?php echo $rows2['Pret']*$rows2['NrBucati']; ?></td>
						</tr>
			<?php } ?>	
				</table>
				<table class = "table2">
					<tr><td><b>Total comanda : </b></td><td><?php echo $rows3['PretTotal']; ?></td></tr> 
					<tr><br></tr>
					<tr><td><b>Status comanda : </b></td><td><?php echo $rows3['StatusComanda']; ?></td></tr> 
					<tr><td><b>Data estimala livrare : </b></td><td><?php echo $rows3['DataEstimataLivrare']; ?></td></tr> 
					<tr><td><b>Firma curier : </b></td><td><?php echo $rows5['Nume']; ?></td></tr> 
					<tr><td><b>Telefon curierat : </b></td><td><?php echo $rows5['Telefon']; ?></td></tr> 
				</table>
		<?php } }?>
		</div>
		<?php
		}	
		else{ ?>
			<div class="header">
				<h2>Nu aveti nicio comanda</h2>
			</div>
		<?php }
		
		?>
	</div>
		
	

</body>
</html>