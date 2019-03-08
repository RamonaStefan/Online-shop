<?php  
	//stergere produs din oferta magazinului online
	require('server.php');
	$query = "DELETE FROM `produscomanda` WHERE ProdusID ='$_GET[id]'";
	if(mysqli_query($connection, $query)){
		echo "<script type='text/javascript'>alert('Ati sters produsul cu succes')</script>";
		header("Location:cos_client.php");
	}
	else
		echo "Stergere nereusita";
		
?>
