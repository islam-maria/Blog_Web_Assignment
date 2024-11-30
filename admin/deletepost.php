<?php include '../lib/Session.php'; ?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php 
	$db = new Database();
?>
<?php 
	if(!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL){
		echo "<script type='text/javascript'> window.location ='postlist.php'; </script>";
		//header("Location: catlist.php");
	}else{
		$postid = $_GET['delpostid'];
		
		$query = "SELECT * FROM tbl_post WHERE id = '$postid' ";
		$getData = $db->select($query);
		if($getData){
			while ($delimg = $getData->fetch_assoc()){
				$dellink = $delimg['image'];
				unlink($dellink);
			}
		}
		$delquery = "DELETE FROM tbl_post WHERE id = '$postid' ";
		$delData = $db->delete($delquery);
		if($delData){
			echo "<script type='text/javascript'>
					alert('Data Deleted Successfully'); 
					window.location = 'postlist.php';
				</script>";
		}else{
			echo "<script type='text/javascript'>
					alert('Data Not Deleted');  
					window.location = 'postlist.php';
				</script>";
		}
	}
	
	
?>
