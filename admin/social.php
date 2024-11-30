<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
			<?php 
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$fb = $fm->validation($_POST['facebook']);
					$tw = $fm->validation($_POST['twitter']);
					$ln = $fm->validation($_POST['linkedin']);
					$gp = $fm->validation($_POST['googleplus']);
					
					$fb = mysqli_real_escape_string($db->link, $fb);
					$tw = mysqli_real_escape_string($db->link, $tw);
					$ln = mysqli_real_escape_string($db->link, $ln);
					$gp = mysqli_real_escape_string($db->link, $gp);
					
					if($fb == "" || $tw == "" || $ln == "" || $gp == ""){
					echo "<span class='error'>Feild must not be empty ! </span>";
					} else{
						$update = "UPDATE tbl_social
							SET 
							fb = '$fb',
							tw = '$tw',
							ln = '$ln',
							gp = '$gp'
							WHERE 
							id = '1'
						";
						$update_data = $db->UPDATE($update);
						if ($update_data) {
						 echo "<span class='success'>Data updated Successfully.
						 </span>";
						}else {
						 echo "<span class='error'>Data Not updated !</span>";
						}
					}
				}
			?>
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">   
				<?php 
					$query = "SELECT * FROM tbl_social WHERE id = '1' ";
					$data = $db->SELECT($query);
					if($data){
						while($result = $data->fetch_assoc()){
				?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $result['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $result['tw']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $result['ln']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus" value="<?php echo $result['gp']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
				<?php 
						}
					}
				?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>
