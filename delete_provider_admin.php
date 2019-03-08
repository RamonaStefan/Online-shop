<?php  
	require("server.php");
	//administrator elimina un furnizor partener
		$query = "DELETE FROM `furnizor` WHERE FurnizorID = '$_GET[id]'";
		if(mysqli_query($connection, $query)){
			echo "<script type='text/javascript'>alert('Ati sters furnizorul cu succes')</script>";
			header("Location:sterge_furnizor_admin.php");
		}
		else
			echo "<script type='text/javascript'>alert('Stergere nereusita')</script>";
	
		
?>