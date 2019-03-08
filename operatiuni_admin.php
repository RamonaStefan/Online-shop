<?php require('server.php'); ?>
	
	<html>
	<head>
	<title>Tablette</title>
	<link href = "style.css" rel = "stylesheet" type = "text/css"
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
						<td><form class = "form_r" action = "operatiuni_admin.php"><li class= "active"><a href = "operatiuni_admin.php">OPERATIUNI</a></li></form></td>
						<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
					</tr></table>
				</ul>
			</div>
		</header>	
		
		<br><br><br>
		<div class="header">
			<h2>Bine ai venit!</h2>
			<img src = "admin.png" style="width:10%">
		</div>
		
		<! meniu operatiuni posibile administrator>
		<form class = "forms">
			<div class="input-group">
				<a href = "adauga_produs_admin.php" class = "btn btn-one"> Adauga produs</a>
			</div>
			<div class="input-group">
				<a href = "sterge_produs_admin.php" class = "btn btn-one"> Sterge produs</a>
			</div>
			<div class="input-group">
				<a href = "modifica_produs_admin.php" class = "btn btn-one"> Modifica produs</a>
			</div>	
			<div class="input-group">
				<a href = "adauga_furnizor_admin.php" class = "btn btn-one"> Adauga furnizor</a>
			</div>
			<div class="input-group">
				<a href = "sterge_furnizor_admin.php" class = "btn btn-one"> Sterge furnizor</a>
			</div>
			<div class="input-group">
				<a href = "modifica_furnizor_admin.php" class = "btn btn-one"> Modifica furnizor</a>
			</div>	
			<div class="input-group">
				<a href = "vezi_admin.php" class = "btn btn-one">Vezi si ...</a>
			</div>
		</form
	</body>
	</html>