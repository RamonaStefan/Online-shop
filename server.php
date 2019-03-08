<?php
	session_start();
	require('db_connect.php');
	if(!isset($_SESSION['user']))
		$_SESSION['user'] = "guest";
	
	//deconectare utilizator
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: autentificare_guest.php");
	}
	
	//inregistrare utilizator
	if (isset($_POST['create'])){
		if (isset($_POST['Nume']) and isset($_POST['Prenume']) and isset($_POST['Adresa']) and isset($_POST['Telefon']) and isset($_POST['Email']) and isset($_POST['Parola']) and strlen($_POST['Nume'])> 0 and strlen($_POST['Prenume'])> 0 and strlen($_POST['Parola']) >0 and strlen($_POST['Email'])>0 and strlen($_POST['Adresa'])>0)	{
			$nume = $_POST['Nume'];
			$prenume = $_POST['Prenume'];
			$adresa = $_POST['Adresa'];
			$email = $_POST['Email'];
			$telefon = $_POST['Telefon'];
			$parola = $_POST['Parola'];
			$confparola = $_POST['ConfParola'];
			if(strcmp($parola, $confparola) == 0){
				$query = "INSERT INTO `utilizatori`(`Nume`, `Prenume`, `Adresa`, `Email`, `Telefon`, `Parola`, `TipUtilizator`)
					      VALUES ('$nume','$prenume','$adresa', '$email', '$telefon', '$parola', 'client')";
				$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
				if($result== TRUE){
					echo "<script type='text/javascript'>alert('Ati creat un cont nou cu succes!')</script>";
				}
				else{
					echo "<script type='text/javascript'>alert('Creare nereusita!')</script>";
				}
			}
			else
				echo "<script type='text/javascript'>alert('Cele doua parole nu corespund!')</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Nu ati completat toate campurile obligatorii')</script>";
		
		}
	}
	
	//autentificare utilizator
	if (isset($_POST['login'])){
		if (isset($_POST['Email']) and isset($_POST['Parola']) and strlen($_POST['Email'])> 0 and strlen($_POST['Parola'])> 0)
		{
			$Email = $_POST['Email'];
			$Parola = $_POST['Parola'];
			
			//selectare informatii utilizator pentru verificare
			$query = "SELECT * FROM `utilizatori` WHERE Email='$Email' and Parola='$Parola'";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			$rows = $result->fetch_assoc();
			if (mysqli_num_rows($result) == 1)
			{		
				$_SESSION['user'] = $rows['ClientID'];
				if(strcmp($rows['TipUtilizator'],'admin') == 0)
					header('Location:operatiuni_admin.php');
				else 
				{
					if(strcmp($rows['TipUtilizator'],'client') == 0) 
						header("Location:welcome.php");
				}
			}
			else
			{
				echo "<script type='text/javascript'>alert('Email si/sau parola gresite')</script>";
			}	
		}
		else
			echo "<script type='text/javascript'>alert('Nu ati completat toate campurile obligatorii')</script>";
	}
	
	//client adauga un produs in cos
	if(isset($_POST['add_prod'])){
		//informatii produs
		$query = "SELECT * FROM produs WHERE ProdusID = '$_GET[id]'";
		$result = mysqli_query($connection, $query);
		$rows = $result->fetch_assoc();
		$result = mysqli_query($connection, $query);
		if (isset($_POST['NrBucati']) and strlen($_POST['NrBucati']) > 0){
			//verificare existenta comanda in desfasurare sau demarare comanda noua
			$query3 = "SELECT * FROM comanda WHERE ClientID='$_SESSION[user]' AND StatusComanda IS NULL";
			$result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
			if (mysqli_num_rows($result3) == 0){
				$query0 = "INSERT INTO `comanda`(`ClientID`) VALUES ('$_SESSION[user]')"; 
				$result0 = mysqli_query($connection, $query0) or die(mysqli_error($connection));
			}
			
			//selectare comanda in desfasurare
			$query1 = "SELECT ComandaID FROM comanda WHERE ClientID='$_SESSION[user]' AND StatusComanda IS NULL";
			$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
			$rows1 = $result1->fetch_assoc();
			
			//verificare stoc suficient
			if($_POST['NrBucati'] <= $rows['NrBucatiDisponibile']){
				$query2 = "INSERT INTO `produscomanda`(`ComandaID`, `ProdusID`, `NrBucati`) VALUES (".$rows1['ComandaID'].", ".$_GET['id'].", ".$_POST['NrBucati'].")";
				$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
				if($result2 = TRUE){
					echo "<script type='text/javascript'>alert('Ati adaugat un produs in cos cu succes')</script>";
				}
				else
					echo "<script type='text/javascript'>alert('Adaugare nereusita')</script>";
			}
			else
				echo "<script type='text/javascript'>alert('Stoc insuficient')</script>";
		}
		else{
				echo "<script type='text/javascript'>alert('Nu ati completat numarul de produse')</script>";
		}	
	}
	
	//administrator adauga un produs in oferta magazinului
	if(isset($_POST['create_product'])){
		if (isset($_POST['NumeProducator']) and isset($_POST['Model']) and isset($_POST['Specificatii']) and isset($_POST['Pret']) and isset($_POST['Imagine']) AND strlen($_POST['NumeProducator'])>0 and strlen($_POST['Model'])>0 and strlen($_POST['Specificatii'])>0 and strlen($_POST['Pret'])>0 and strlen($_POST['Imagine'])>0){
			$numep = $_POST['NumeProducator'];
			$model = $_POST['Model'];
			$spec = $_POST['Specificatii'];
			$pret = $_POST['Pret'];
			$imagine = $_POST['Imagine'];
			
			$query = "INSERT INTO `produs`(`NumeProducator`, `Model`, `Specificatii`, `Pret`, `NrBucatiDisponibile`, `Imagine`)
					  VALUES ('$numep','$model','$spec', '$pret', '0', '$imagine')";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			if($result){
				echo "<script type='text/javascript'>alert('Ati adaugat un produs nou cu succes!')</script>";
			}
			else
				echo "<script type='text/javascript'>alert('Adaugare nereusita!')</script>";
		}
		else{
				echo "<script type='text/javascript'>alert('Nu ati completat toate campurile!')</script>";
		}
	}
	
	//administrator modifica un produs
	if(isset($_POST['modify_product'])){
		if (isset($_POST['NumeProducator']) and isset($_POST['Model']) and isset($_POST['Specificatii']) and isset($_POST['Pret']) and isset($_POST['Imagine']) and strlen($_POST['NumeProducator'])> 0 and strlen($_POST['Model'])> 0 and strlen($_POST['Pret']) >0 and strlen($_POST['Specificatii'])>0 and strlen($_POST['Imagine'])>0){
			$numep = $_POST['NumeProducator'];
			$model = $_POST['Model'];
			$spec = $_POST['Specificatii'];
			$pret = $_POST['Pret'];
			$imagine = $_POST['Imagine'];
			$query1 = "UPDATE produs SET NumeProducator='$numep', Model='$model',Specificatii='$spec', Pret='$pret',Imagine='$imagine' WHERE ProdusID = '$_GET[id]'";
			$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
			if($result1 = TRUE){
				echo "<script type='text/javascript'>alert('Ati updatat produsul cu succes')</script>";
			}
			else
				echo "<script type='text/javascript'>alert('Modificare nereusita')</script>";
		}
		else{
				echo "<script type='text/javascript'>alert('Au ramas campuri necompletate!')</script>";
			}
	}
	
	//administrator adauga o cantitate mai mare de produs pe stoc
	if(isset($_POST['modify_stoc'])){
		//selectare informatii produs
		$query = "SELECT * FROM `produs` WHERE ProdusID = '$_GET[id]'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$row = mysqli_fetch_array($result);
		if(isset($_POST['NumeFurnizor']) and isset($_POST['NrBucati']) and strlen($_POST['NumeFurnizor'])>0 and strlen($_POST['NrBucati'])>0)  {
			//verificare existenta furnizor
			$query0= "SELECT * from furnizor WHERE Nume = '".$_POST['NumeFurnizor']."'";
			$result0 = mysqli_query($connection, $query0) or die(mysqli_error($connection));
			$count = mysqli_num_rows($result0);
			$row0 = mysqli_fetch_array($result0);
			if($count > 0){
				//verificare  produs furnizat deja existent
				$query3 = "SELECt * FROM produsfurnizor WHERE ProdusID='".$_GET['id']."' AND FurnizorID='".$row0['FurnizorID']."'";
				$result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
				$count = mysqli_num_rows($result3);
				$row3 = mysqli_fetch_array($result3);
				if($count>0){
					//updatare cantitate produs furnizat
					$value = $_POST['NrBucati'] + $row3['NrBucatiFurnizate'];
					$query2 = "UPDATE produsfurnizor SET NrBucatiFurnizate='".$value."' WHERE ProdusID = '$_GET[id]' AND FurnizorID='".$row0['FurnizorID']."'";
					$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
				}
				else{
					//adaugare produs nou furnizat
					$query2 = "INSERT INTO `produsfurnizor`(`FurnizorID`,`ProdusID`, `NrBucatiFurnizate`) VALUES('".$row0['FurnizorID']."','".$_GET['id']."','".$_POST['NrBucati']."')";
					$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
				}
				//updatare cantitate de pe stoc produs
				$value = $_POST['NrBucati'] + $row['NrBucatiDisponibile'];
				$query1 = "UPDATE produs SET NrBucatiDisponibile='".$value."' WHERE ProdusID = '$_GET[id]'";
				$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
				if($result1 = TRUE and $resul2 = TRUE){
					echo "<script type='text/javascript'>alert('Ati updatat produsul cu succes')</script>";
				}
				else
					echo "<script type='text/javascript'>alert('Modificare nereusita')</script>";
			}
			else
				echo "<script type='text/javascript'>alert('Nu exista acest furnizor!')</script>";
		}
		else
			echo "<script type='text/javascript'>alert('Au ramas campuri necompletate!')</script>";
	}
	
	//client modifica cantitatea din cos a unui produs
	if(isset($_POST['modify_cantity'])){
		//selectare comanda in desfasurare
		$query1 = "SELECT ComandaID FROM comanda WHERE ClientID='$_SESSION[user]' AND StatusComanda IS NULL";
		$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
		$rows1 = $result1->fetch_assoc();
		
		//selectare informatii produs din cos
		$query = "SELECT NrBucatiDisponibile FROM produs,produscomanda WHERE produs.ProdusID = produscomanda.ProdusID AND produs.ProdusID = '$_GET[id]' AND ComandaID = '$rows1[ComandaID]'";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		if(isset($_POST['NrBucati']) and strlen($_POST['NrBucati']) > 0){
			//verificare stoc suficient
			if($_POST['NrBucati'] <= $row['NrBucatiDisponibile']){
				$query1 = "UPDATE produscomanda SET NrBucati='".$_POST['NrBucati']."' WHERE ProdusID = '$_GET[id]' AND ComandaID = '$rows1[ComandaID]'";
				$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
				if($result1)
					echo "<script type='text/javascript'>alert('Ati updatat produsul cu succes')</script>";
				else
					echo "<script type='text/javascript'>alert('Modificare nereusita')</script>";
			}
			else
				echo "<script type='text/javascript'>alert('Stoc insuficient')</script>";
		}
		else
			echo "<script type='text/javascript'>alert('A ramas un camp necompletat')</script>";
	}
	
	//administrator adauga un furnizor partener
	if(isset($_POST['create_provider'])){
		if (isset($_POST['Nume']) and isset($_POST['Telefon']) and isset($_POST['Adresa']) and strlen($_POST['Nume'])>0 and strlen($_POST['Telefon'])>0 and strlen($_POST['Adresa'])>0){
			$nume = $_POST['Nume'];
			$tel = $_POST['Telefon'];
			$addr = $_POST['Adresa'];
			
			$query = "INSERT INTO `furnizor`(`Nume`, `Telefon`, `Adresa`) VALUES ('$nume','$tel','$addr')";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			if($result){
				echo "<script type='text/javascript'>alert('Ati adaugat un furnizor nou cu succes!')</script>";
			}
			else
				echo "<script type='text/javascript'>alert('Adaugare nereusita!')</script>";
		}
		else
				echo "<script type='text/javascript'>alert('Nu ati completat toate campurile!')</script>";
	}
	
	//administrator modifica un furnizor partener
	if(isset($_POST['modify_provider'])){
		if (isset($_POST['Nume']) and isset($_POST['Telefon']) and isset($_POST['Adresa']) and strlen($_POST['Nume'])>0 and strlen($_POST['Telefon'])>0 and strlen($_POST['Adresa'])>0){
			$nume = $_POST['Nume'];
			$tel = $_POST['Telefon'];
			$addr = $_POST['Adresa'];
			
			$query = "UPDATE `furnizor` SET Nume = '$nume', Telefon = '$tel', Adresa = '$addr' WHERE FurnizorID = '$_GET[id]'";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			if($result){
				echo "<script type='text/javascript'>alert('Ati modificat furnizorul nou cu succes!')</script>";
			}
			else
				echo "<script type='text/javascript'>alert('Modificare nereusita!')</script>";
		}
		else
				echo "<script type='text/javascript'>alert('Nu ati completat toate campurile!')</script>";
	}
	
	
?>