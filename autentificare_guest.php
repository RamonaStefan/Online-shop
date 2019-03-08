<?php  
	require("server.php");
?>

<html>
<head>
<title>Autentificare</title>
<link href = "style.css" rel = "stylesheet" type = "text/css"
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
					<td><form class = "form_r" action = "autentificare_guest.php"><li class = "active"><a href = "autentificare_guest.php">AUTENTIFICARE</a></li></form></td>
				</tr></table>
			</ul>
		</div>
	</header>
	<div class="header">
		<h2>Autentificare</h2>
		<img src="client.png" style="width:10%" />
	</div>
	<! formular log in >
	<form class = "forms" method = "post" action = 'autentificare_guest.php' >
		<div class="input-group">
			<input type="text" name="Email" class = "box" placeholder="Email"/>
		</div>
		<div class="input-group">
			<input type="password" name="Parola" class = "box" placeholder="Parola"/>
		</div>
		<div class="input-group">
			<button type = "submit" class = "btn btn-one" name = "login">Autentificare</button>
		</div>
		<! optiune cont nou>
		<p>
			<a href= "cont_nou_guest.php" class = "btn btn-one">Creeaza cont nou</a>
		</p>
	</form>
	
</body>
</html>