<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
			<?php 
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$note = $fm->validation($_POST['copyright']);
					
					$note = mysqli_real_escape_string($db->link, $note);
					
					if($note == ""){
					echo "<span class='error'>Feild must not be empty ! </span>";
					} else{
						$update = "UPDATE tbl_footer
							SET 
							note = '$note'
							WHERE 
							id = '1'
						";
						$update_data = $db->update($update);
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
                <h2>Update Copyright Text</h2>
                <div class="block copyblock">
					<?php 
						$query = "SELECT * FROM tbl_footer WHERE id = '1' ";
						$data = $db->select($query);
						if($data){
							while($result = $data->fetch_assoc()){
					?>
					 <form action="" method="post">
						<table class="form">					
							<tr>
								<td>
									<input type="text" value="<?php echo $result['note']; ?>" name="copyright" class="large" />
								</td>
							</tr>
							
							 <tr> 
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