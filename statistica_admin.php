<?php
	require('server.php');
	//selectare clienti ce nu si-au primit inca comenzile
	$date = date("Y-m-d");
	$query9 = "SELECT utilizatori.Nume AS Nut, Prenume, Email, DataPlasare, DataEstimataLivrare,ComandaID, curier.Nume as N FROM utilizatori, comanda, curier WHERE utilizatori.ClientID = comanda.ClientID AND curier.CurierID = comanda.CurierID AND DataEstimataLivrare > '$date'";
	$result9= mysqli_query($connection, $query9);
	$count = mysqli_num_rows($result9);
	
	//selectare furnizori ce aduc produse Samsung
	$query8 = "SELECT DISTINCT Nume, Telefon, Adresa FROM furnizor, produsfurnizor WHERE furnizor.FurnizorID=produsfurnizor.FurnizorID AND produsfurnizor.ProdusID IN (SELECT produs.ProdusID FROM produs WHERE NumeProducator = 'Samsung')";
	$result8= mysqli_query($connection, $query8);
	
	//selectare comenzi si produse livrate de un anumit curier
	if(isset($_POST['curier'])){
		if(isset($_POST['Curier'])){
				$query7 ="SELECT DISTINCT comanda.ComandaID AS COM, PretTotal, DataPlasare,    DataEstimataLivrare, SUM(NrBucati) AS nr FROM comanda, produscomanda WHERE produscomanda.ComandaID = comanda.ComandaID AND comanda.CurierID IN (SELECT CurierID FROM curier WHERE Nume  LIKE '$_POST[Curier]') GROUP BY comanda.ComandaID";
				$result7= mysqli_query($connection, $query7);
				$count = mysqli_num_rows($result7);
		}
	}
	//selectare comenzi ce au fost plasate intr-o anumita luna si clientii aferenti acestora 
	if(isset($_POST['luna'])){
		if(isset($_POST['Luna'])){
			$query6 = "SELECT Nume, Prenume, Email, PretTotal, ComandaID, DataPlasare  FROM utilizatori, comanda WHERE utilizatori.ClientID = comanda.ClientID AND DataPlasare LIKE '%-$_POST[Luna]-%'";	
			$result6= mysqli_query($connection, $query6);
			$count = mysqli_num_rows($result6);
		}
	}
	
	
	//selectare comenzi si cleinti asociati acestora pentru care pretul total este mai mare decat media valorii unei comenzi
	$query5 = "SELECT DISTINCT ComandaID, Nume, Prenume, Email, PretTotal FROM comanda, utilizatori WHERE comanda.ClientID = utilizatori.ClientID AND PretTotal > (SELECT AVG(PretTotal) FROM comanda)";
	$result5= mysqli_query($connection, $query5);
	
	//selectare clienti ce au dat o comanda mai mare de 10000 de lei
	$query4 = "SELECT DISTINCT Nume, Prenume, Email FROM utilizatori, comanda WHERE utilizatori.ClientID = comanda.ClientID AND PretTotal >= 10000";
	$result4= mysqli_query($connection, $query4);
	
	//selectare produse ce apr in cel putin 2 comenzi
	$query3 = "SELECT NumeProducator, Model, Pret,Specificatii, COUNT(produscomanda.ComandaID) as NrComenzi FROM produs, produscomanda WHERE produs.ProdusID = produscomanda.ProdusID GROUP BY produs.ProdusID HAVING COUNT(produscomanda.ComandaID) >=2";
	$result3= mysqli_query($connection, $query3);
	
	//selectare furnizori ce aprovizioneaza cu un anumit produs
	if(isset($_POST['produs'])){
		if(isset($_POST['Produs'])){
			$query2 = "SELECT *FROM furnizor, produsfurnizor WHERE furnizor.Furnizorid = produsfurnizor.Furnizorid AND produsfurnizor.ProdusID = $_POST[Produs]";
			$result2= mysqli_query($connection, $query2);
		}
	}
	//selectare curieri ce livreaza comenzile unei anumite persoane
	if(isset($_POST['client'])){
		if(isset($_POST['Client'])){
			$query1 = "SELECT curier.Nume AS N, curier.Telefon AS T, curier.Adresa AS A, comanda.ComandaID FROM curier, comanda, utilizatori WHERE curier.CurierID=comanda.CurierID  AND comanda.ClientID=utilizatori.ClientID AND Email LIKE '$_POST[Client]'";
			$result1= mysqli_query($connection, $query1);
	}
	}
	
	//selectare cel mai scump produs adus de fiecare furnizor
	$query10= "SELECT Nume, NumeProducator, Model, Specificatii, Pret FROM produs, produsfurnizor, furnizor F WHERE produs.ProdusID = produsfurnizor.ProdusID AND F.FurnizorID=produsfurnizor.FurnizorID AND Pret=(SELECT MAX(Pret) FROM produs, produsfurnizor WHERE produs.ProdusID = produsfurnizor.ProdusID AND produsfurnizor.FurnizorID=F.FurnizorID)";
	$result10 = mysqli_query($connection,$query10);
	
	
	
?>	
	
	<html>
	<head>
	<title>Tablette</title>
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
		<br>
		<! afisare informatii in functie de selectia utilizatorului>
		<?php
		if($_GET['id'] == 10){?>
			<div class="header">
				<h2>Cel mai scump produs adus de fiecare furnizor este: </h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nume</th>
				<th>NumeProducator</th>
				<th>Model</th>
				<th>Specificatii</th>
				<th>Pret(lei)</th>
				<?php
				while($rows = $result10->fetch_assoc()){ ?> 
					<tr>
						<td><?php echo $rows['Nume']; ?> </td>
						<td><?php echo $rows['NumeProducator']; ?> </td>
						<td><?php echo $rows['Model']; ?> </td>
						<td><?php echo $rows['Specificatii']; ?> </td>
						<td><?php echo $rows['Pret']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
		<?php }
		else if($_GET['id'] == 9){  
		   if($count >= 1){ ?>
			<div class="header">
				<h2>Clientii care nu  si-au primit inca comenzile sunt: </h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nr comanda</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Email</th>
				<th>Data Plasare</th>
				<th>Data Estimata Livrare </th>
				<th>Curier</th>
				<?php
				while($rows = $result9->fetch_assoc()){ ?> 
					<tr>
						<td><?php echo $rows['ComandaID']; ?> </td>
						<td><?php echo $rows['Nut']; ?> </td>
						<td><?php echo $rows['Prenume']; ?> </td>
						<td><?php echo $rows['Email']; ?> </td>
						<td><?php echo $rows['DataPlasare']; ?> </td>
						<td><?php echo $rows['DataEstimataLivrare']; ?> </td>
						<td><?php echo $rows['N']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
		<?php }
		   else { ?>
				<div class="header">
					<h2>Nu exista comenzi ce nu au ajuns la destinatar</h2>
				</div>
			<?php }
		} 		
		else if($_GET['id'] == 8){ ?>
			<div class="header">
				<h2>Furnizorii ce aduc produse Samsung sunt:</h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nume Furnizor</th>
				<th>Telefon</th>
				<th>Adresa</th>
				<?php 
				while($rows = $result8->fetch_assoc()){
				?> 
					<tr>
						<td><?php echo $rows['Nume']; ?> </td>
						<td><?php echo $rows['Telefon']; ?> </td>
						<td><?php echo $rows['Adresa']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
		   <?php }
		else if($_GET['id'] == 7){
			 if($count > 0){?>
				<div class="header">
					<h2>Comenzile livrate de curierul selectat sunt:</h2>
				</div>
				<div class="forms">
				<table class= 'table2'>
					<th>Nr comanda</th>
					<th>PretTotal</th>
					<th>DataPlasare</th>
					<th>DataEstimataLivrare</th>
					<th>Numar produse in comanda </th>
					<?php 
					while($rows = $result7->fetch_assoc()){ ?> 
					<tr>
						<td><?php echo $rows['COM']; ?> </td>
						<td><?php echo $rows['PretTotal']; ?> lei</td>
						<td><?php echo $rows['DataPlasare']; ?> </td>
						<td><?php echo $rows['DataEstimataLivrare']; ?> </td>
						<td><?php echo $rows['nr']; ?> </td>
					</tr>
				<?php } ?>
				</table>
				</div>
			<?php } 
			else{ ?>
				<div class="header">
					<h2>Curierul selectat nu a livrat inca nicio comanda.</h2>
				</div>
			<?php }
		} 
		else if($_GET['id'] == 6){ ?> 
			<?php if($count > 0){ ?>
			<div class="header">
				<h2>Comenzile plasate in luna <?php echo $_POST['Luna']; ?> si clientii aferenti acestora sunt :</h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nr comanda</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Email</th>
				<th>DataPlasare</th>
				<th>Pret total (lei)</th>
				<?php
				while($rows = $result6->fetch_assoc()){
				?> 
					<tr>
						<td><?php echo $rows['ComandaID']; ?> </td>
						<td><?php echo $rows['Nume']; ?> </td>
						<td><?php echo $rows['Prenume']; ?> </td>
						<td><?php echo $rows['Email']; ?> </td>
						<td><?php echo $rows['DataPlasare']; ?> </td>
						<td><?php echo $rows['PretTotal']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
			<?php }else { ?>
				<div class="header">
					<h2>Nu exista comenzi in perioada cautata</h2>
				</div>
		<?php } }
		else if($_GET['id'] == 5){ ?> 
			<div class="header">
					<h2>Comenzile si clientii asociati acestora pentru care pretul total este mai mare decat media valorii unei comenzi sunt:</h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nr Comanda</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Email</th>
				<th>Pret total (lei)</th>
				<?php 
				while($rows = $result5->fetch_assoc()){
				?> 
					<tr>
						<td><?php echo $rows['ComandaID']; ?> </td>
						<td><?php echo $rows['Nume']; ?> </td>
						<td><?php echo $rows['Prenume']; ?> </td>
						<td><?php echo $rows['Email']; ?> </td>
						<td><?php echo $rows['PretTotal']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
		<?php } 
		else if($_GET['id'] == 4){ ?> 
			<div class="header">
				<h2>Clientii ce au dat cel putin o comanda cu o valoare mai mare de 10.000 lei sunt:</h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Email</th>
				<?php 
				while($rows = $result4->fetch_assoc()){
				?> 
					<tr>
						<td><?php echo $rows['Nume']; ?> </td>
						<td><?php echo $rows['Prenume']; ?> </td>
						<td><?php echo $rows['Email']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
		<?php } 
		else if($_GET['id'] == 3){ ?> 
			<div class="header">
				<h2>Produsele ce apar in minim 2 comenzi plasate sunt:</h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Producator</th>
				<th>Model</th>
				<th>Specificatii</th>
				<th>Pret(lei)</th>
				<th>Numar comenzi</th>
				<?php 
				while($rows = $result3->fetch_assoc()){
				?> 
					<tr>
						<td><?php echo $rows['NumeProducator']; ?> </td>
						<td><?php echo $rows['Model']; ?> </td>
						<td><?php echo $rows['Specificatii']; ?> </td>
						<td><?php echo $rows['Pret']; ?></td>
						<td><?php echo $rows['NrComenzi']; ?></td>
					</tr>
				<?php } ?>
			</table>
			</div>
		<?php } 
		else if($_GET['id'] == 2){ ?> 
			<div class="header">
				<h2>Informatii despre furnizorii ce aprovizioneaza cu produsul selectat</h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nume</th>
				<th>Telefon</th>
				<th>Adresa</th>
				<?php 
				while($rows = $result2->fetch_assoc()){
				?> 
					<tr>
						<td><?php echo $rows['Nume']; ?> </td>
						<td><?php echo $rows['Telefon']; ?> </td>
						<td><?php echo $rows['Adresa']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
		<?php } 
		else if($_GET['id'] == 1){ 
			if (mysqli_num_rows($result1) > 0){ ?>
			<div class="header">
				<h2>Informatii despre curierii ce livreaza comenzi ce apartin clientului selectat</h2>
			</div>
			<div class="forms">
			<table class= 'table2'>
				<th>Nr comanda</th>
				<th>Nume curier</th>
				<th>Telefon</th>
				<th>Adresa</th>
				<?php 
				while($rows = $result1->fetch_assoc()){
				?> 
					<tr>
						<td><?php echo $rows['ComandaID']; ?> </td>
						<td><?php echo $rows['N']; ?> </td>
						<td><?php echo $rows['T']; ?> </td>
						<td><?php echo $rows['A']; ?> </td>
					</tr>
				<?php } ?>
			</table>
			</div>
			<?php }
			else { ?>
			<div class="header">
				<h2>Clientul selectat nu a plasat nicio comanda</h2>
			</div>
			<?php }
			} ?>
	</body>
	</html>