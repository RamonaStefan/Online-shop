<?php  
	require('server.php');
?>

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
					<td><form class = "form_r" action = "operatiuni_admin.php"><li><a href = "operatiuni_admin.php">OPERATIUNI</a></li></form></td>
					<td><form class = "form_r" action = "welcome.php?logout='1'"><li><a href = "welcome.php?logout='1'">DECONECTARE</a></li></form></td>
				</tr></table>
			</ul>
		</div>
	</header>	
	
	<! formular adaugare produs nou in oferta magazinului>
	<div class="header">
		<h2>Produs:</h2>
		<img src = "tableta.png" style="width:10%">
	</div>
		<form class = "forms" method = "post" action = "adauga_produs_admin.php">
			<div class="input-group">
				<input type="text" name="NumeProducator" class = "box" placeholder="Nume producator"/>
			</div>
			<div class="input-group">
				<input type="text" name="Model" class="box" placeholder="Model" />
			</div>
			<div class="input-group">
				<input type="text" name="Specificatii" class="box" placeholder="Specificatii" />
			</div>	
			<div class="input-group">
				<input type="text" name="Pret" class="box" placeholder="Pret" />
			</div>
			<div class="input-group">
				<input type="text" name='Imagine' class="box" placeholder="Nume imagine" />
			</div>
			<div class="input-group">
				<button type = "submit" class = "btn btn-one" name ="create_product">Produs nou</button>
			</div>
		</form>
	

</body>
</html>