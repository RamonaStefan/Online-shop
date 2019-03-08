<?php
	require('server.php');
	//selectare informatii produs
	$query1 = "SELECT * FROM produs WHERE ProdusID = '$_GET[id]'";
	$result1 = mysqli_query($connection, $query1);

?>

<html>
<head>
<title>Produse</title>
<link href = "style2.css" rel = "stylesheet" type = "text/css"
</head>


<body>
	<header>
		<div class = "row">
			<div class = "logo">
				<img src = "logo3.png">
			</div>
			<! meniu principal>
			<ul class = "menu">
			<?php
				$query = "SELECT * FROM utilizatori WHERE ClientID='$_SESSION[user]'";
				$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
				$rows = $result->fetch_assoc();
				$check = 0;
				
				if(strcmp($rows['TipUtilizator'],'client') == 0) {
					$check = 1;
					?>
					<! caz utilizator = client >
					<table><tr>
						<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
						<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
						<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
						<td><form class = "form_r" action = "cos_client.php"><li><a href = "cos_client.php">COSUL MEU</a></li></form></td>
						<td><form class = "form_r" action = "comenzi_client.php"><li><a href = "comenzi_client.php">COMENZILE MELE</a></li></form></td>
						<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
					</tr></table>
				<?php } 
				else if(strcmp($rows['TipUtilizator'],'admin') == 0) { ?>
					<! caz utilizator = administrator>
					<table><tr>
						<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
						<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
						<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
						<td><form class = "form_r" action = "operatiuni_admin.php"><li><a href = "operatiuni_admin.php">OPERATIUNI</a></li></form></td>
						<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
					</tr></table>
			    <?php }
				else {?>
					<! caz utilizator = guest>
					<table><tr>
						<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
						<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
						<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
						<td><form class = "form_r" action = "autentificare_guest.php"><li><a href = "autentificare_guest.php">AUTENTIFICARE</a></li></form></td>
					</tr></table>
				<?php } ?>
			</ul>
			
		</div>
		
	</header>
	<div>
		<! afisare informatii produs>
		<?php
		while($rows = $result1->fetch_assoc()) { ?>
			<form class = "information" method = "post" action="pagina_produs.php?id=<?php echo $_GET['id'];?>">
				~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				<img class = "poza" src =  <?php echo $rows['Imagine']; ?> style = "width :40%">
				<br>
				<p><i><u>Producator:</u></i><?php echo $rows['NumeProducator']; ?></p>
				<br>
				<p><i><u>Model:</u> </i><?php echo $rows['Model']; ?></p>
				<br>
				<p><i><u>Specificatii tehnice:</u> </i><?php echo $rows['Specificatii']; ?></p>
				<br>
				<p><i><u>Pret:</u> </i><?php echo $rows['Pret']; ?> lei</p>
				<br>
				<p><i><u>Numar bucati disponibile:</u> </i><?php echo $rows['NrBucatiDisponibile']; ?></p> 
				<br>
				<?php if($check == 1){ ?>
						<label for= "NrBucati"><i>Cantitate:</i><br><input type="text" name='NrBucati' class="box">
						<button type = "submit" class = "btn btn-one" name = "add_prod">Adauga produs in cos</button>
				<?php } ?>
			</form>
		<?php } ?>	
			
	</div>
		
	

</body>
</html>