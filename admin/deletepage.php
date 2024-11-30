<?php include '../lib/Session.php'; ?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php 
	$db = new Database();
?>
<?php 
	if(!isset($_GET['delpage']) || $_GET['delpage'] == NULL){
		echo "<script type='text/javascript'> window.location ='index.php'; </script>";
		//header("Location: catlist.php");
	}else{
		$postid = $_GET['delpage'];
		

		$delquery = "DELETE FROM tbl_page WHERE id = '$postid' ";
		$delData = $db->delete($delquery);
		if($delData){
			echo "<script type='text/javascript'>
					alert('Page Deleted Successfully'); 
					window.location = 'index.php';
				</script>";
		}else{
			echo "<script type='text/javascript'>
					alert('Page Not Deleted');  
					window.location = 'index.php';
				</script>";
		}
	}
	
	
?>
