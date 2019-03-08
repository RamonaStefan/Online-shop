<?php  
	require("server.php");
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
					<td><form class = "form_r" action = "autentificare_guest.php"><li><a href = "autentificare_guest.php">AUTENTIFICARE</a></li></form></td>
				</tr></table>
			</ul>
		</div>
	</header>	
	
	<div class="header">
		<h2>Bine ai venit!</h2>
	</div>
	
	<! formular de inregistrare>
	<form class = "forms" method = "post" action = "cont_nou_guest.php">
		<div class="input-group">
			<label for= "Nume">*<input type="text" name="Nume" class = "box" placeholder = "Nume"/>
		</div>
		<div class="input-group">
			<label for= "Prenume">*<input type="text" name="Prenume" class="box" placeholder = "Prenume"/>
		</div>
		<div class="input-group">
			<label for= "Adresa">*<input type="text" name="Adresa" class="box" placeholder = "Adresa" />
		</div>
		<div class="input-group">
			<label for= "Telefon"><input type="text" name="Telefon" class="box" placeholder = "Telefon"/>
		</div>
		<div class="input-group">
			<label for= "Email">*<input type="text" name="Email" class="box" placeholder = "Email" />
		</div>
		<div class="input-group">
			<label for= "Parola">*<input type="password" name="Parola" class="box" placeholder = "Parola" />
		</div>
		<div class="input-group">
			<label for= "ConfParola">*<input type="password" name="ConfParola" class="box" placeholder = "Confirmare parola" />
		</div>
		<div class="input-group">
			<button type = "submit" class = "btn btn-one" name = "create">Cont nou</button>
		</div>
	</form>

</body>
</html>