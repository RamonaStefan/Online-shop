<?php  
	require("server.php");
	//administrator sterge un produs din oefrta magazinului
		$query = "DELETE FROM `produs` WHERE ProdusID = '$_GET[id]'";
		if(mysqli_query($connection, $query)){
			echo "<script type='text/javascript'>alert('Ati sters produsul cu succes')</script>";
			header("Location:sterge_produs_admin.php");
		}
		else
			echo "<script type='text/javascript'>alert('Stergere nereusita')</script>";
	
		
?>

