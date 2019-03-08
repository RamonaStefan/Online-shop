<?php
	require('server.php');
	//selecare informatii produse
	$query1 = "SELECT * FROM produs";
	$result1 = $connection->query($query1);

?>

<html>
<head>
<title>Produse</title>
<link href = "style4.css" rel = "stylesheet" type = "text/css"
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
				if(strcmp($rows['TipUtilizator'],'client') == 0) { ?>
					<! caz utiliztor = client>
					<table><tr>
						<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
						<td><form class = "form_r" action= "produse.php"> <li class = "active"><a href = "produse.php">PRODUSE </a></li></form></td>
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
						<td><form class = "form_r" action= "produse.php"> <li class = "active"><a href = "produse.php">PRODUSE </a></li></form></td>
						<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
						<td><form class = "form_r" action = "operatiuni_admin.php"><li><a href = "operatiuni_admin.php">OPERATIUNI</a></li></form></td>
						<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
					</tr></table>
			    <?php }
				else {?>
					<! caz utilizator = guest>
					<table><tr>
						<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
						<td><form class = "form_r" action= "produse.php"> <li class = "active"><a href = "produse.php">PRODUSE </a></li></form></td>
						<td><form class = "form_r" action = "contact.php"><li><a href = "contact.php">CONTACT </a></li></form></td>
						<td><form class = "form_r" action = "autentificare_guest.php"><li><a href = "autentificare_guest.php">AUTENTIFICARE</a></li></form></td>
					</tr></table>
				<?php } ?>
			</ul>
			
		</div>
		
	</header>
	
	<div class="header">
		<h2>Produse </h2>
	</div>
	
	<! afisare lista de produse>
	<form class = "forms" >
	<table class = "table2">
			<tr>
			<?php
				$i = 0;
				while($rows = $result1->fetch_assoc()) { ?>
					<td>
						<button name= 'ProdusID' type="button" onClick="location.href ='pagina_produs.php?id=<?php echo $rows['ProdusID']; ?>'" class = "btn btn-one"><?php echo $rows['NumeProducator'], " ", $rows['Model'];?></button>
						<img src =  <?php echo $rows['Imagine']; ?> style = "width:75%">
					</td>	
					<?php
					$i = $i + 1;
					if ($i%3 == 0) { ?>
						</tr><tr>
					<?php }
				} ?>	
			</tr>
	</table>
	</form>
		
</body>
</html>