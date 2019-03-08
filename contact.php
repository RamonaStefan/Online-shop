<?php require('server.php'); ?>

<html>
<head>
<title>Tablette</title>
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
				if(strcmp($rows['TipUtilizator'],'client') == 0) { ?>
				<! caz utilizator = client>
				<table><tr>
					<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
					<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
					<td><form class = "form_r" action = "contact.php"><li class = "active"><a href = "contact.php">CONTACT </a></li></form></td>
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
					<td><form class = "form_r" action = "contact.php"><li class = "active"><a href = "contact.php">CONTACT </a></li></form></td>
					<td><form class = "form_r" action = "operatiuni_admin.php"><li><a href = "operatiuni_admin.php">OPERATIUNI</a></li></form></td>
					<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
				</tr></table>
			    <?php }
				else {?>
				<! caz utilizator = guest>
				<table><tr>
					<td><form class = "form_r" action = "welcome.php"><li><a href = "welcome.php">ACASA</a></li></form></td>
					<td><form class = "form_r" action= "produse.php"> <li><a href = "produse.php">PRODUSE </a></li></form></td>
					<td><form class = "form_r" action = "contact.php"><li class = "active"><a href = "contact.php">CONTACT </a></li></form></td>
					<td><form class = "form_r" action = "autentificare_guest.php"><li><a href = "autentificare_guest.php">AUTENTIFICARE</a></li></form></td>
				</tr></table>
				<?php } ?>
			</ul>
		</div>
	</header>
		
	<! date de contact>
	<div class = "info">
		<p align = "center"><u> Ne gasiti aici: </u></p>
		<p> ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</p>
        <p align = "left"><i>Adresa:  </i> Str. Biharia, nr. 67 - 77, sector 1, Bucuresti </p>
		<p align = "left"><i>Telefon fix:  </i>021 240.56.10</p>
		<p align = "left"><i>Telefon mobil:  </i>0725.75.10.10</p>
		<p align = "left"><i>Fax:  </i> 021 599 77 68</p>
		<p align = "left"><i>Program:  </i> L-D: 24/24</p>
		<p align = "left"><i>Suport clienti:  </i> 24/7</p>
		<p align = "left"><i>Email:  </i>contact@tablette.ro</p>
		<p> ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</p>
	</div>
	

</body>
</html>