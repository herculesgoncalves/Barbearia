<?php 
@session_start();
if(@$_SESSION['id'] == ""){
	echo "<script>window.location='../index.php'</script>";
	exit();
}
 ?>