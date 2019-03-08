<?php
	require('server.php');
	//selectare comanda aflata in desfasurare
	$query1 = "SELECT ComandaID FROM comanda WHERE ClientID=".$_SESSION['user']." AND StatusComanda IS NULL";
	$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
	$rows1 = $result1->fetch_assoc();
	if($result1){
		//selectare informatii despre produsele adaugate in cos
		$query = "SELECT produs.ProdusID, NumeProducator, Model, Pret*NrBucati as pret, Imagine, NrBucati FROM produs,produscomanda,comanda WHERE produs.ProdusID = produscomanda.ProdusID AND comanda.ComandaID = produscomanda.ComandaID AND comanda.ComandaID='$rows1[ComandaID]'";
		$result = mysqli_query($connection, $query);
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
			<! meniu principal>
			<ul class = "menu">
				<table><tr>
				<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
				<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
				<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
				<td><form class = "form_r" action = "cos_client.php"><li class = "active"><a href = "cos_client.php">COSUL MEU</a></li></form></td>
				<td><form class = "form_r" action = "comenzi_client.php"><li><a href = "comenzi_client.php">COMENZILE MELE</a></li></form></td>
				<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
				</tr></table>
			</ul>
			
		</div>
		
	</header>

	<?php 
	if($result){
		if(mysqli_num_rows($result) >= 1){ ?>
			<! informatii produse cos>
			<div class = "header">
				<h2>Cosul meu: </h2>
			</div>
			<div class = "forms">
			<table class = "table2">
				<th> Produs</th>
				<th> Cantitate </th>
				<th> Pret(lei) </th>
				<th> Modifica</th>
				<?php
				while($rows = $result->fetch_assoc())
				{ ?>
					<tr>
					<td><img class = "poza" src = <?php echo $rows['Imagine']; ?> style = "width :5%">
					<?php echo $rows['NumeProducator']." ".$rows['Model'];?> </td>
					<td><?php echo $rows['NrBucati']; ?></p> 
					<td><?php echo $rows['pret'];?></td>
					<td><a class = 'btn btn-one' href="modifica_produs_client.php?id=<?php echo $rows['ProdusID'];?>">Modifica</a></td>;
					
					</tr>
			<?php } ?>
			</table>
			<br><br>
			<a class = 'btn btn-one' href="sumar_comanda_client.php">Finalizeaza comanda</a>
			</div>
		<?php }
		else { ?>
			<div class = "header">
				<h2>Nu ai niciun produs in cos</h2>
			</div>
		
	<?php } }?>	
		
</body>
</html>
<?php }?>