<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
	if(isset($_GET['seenid'])){
		$seenid = $_GET['seenid'];
		$query = "UPDATE tbl_contact SET status = '1' WHERE id = '$seenid' ";
		$updated_row = $db->update($query);
		if($updated_row){
			echo "<span class='success'>Message send in the seenbox!!</span>";
		}else{
			echo "<span class='error'>Something went wrong !!</span>";
		}
	}
	if(isset($_GET['remsg'])){
		$remsg = $_GET['remsg'];
		$query = "UPDATE tbl_contact SET status = '0' WHERE id = '$remsg' ";
		$updated_row = $db->update($query);
		if($updated_row){
			echo "<span class='success'>Message send in the inbox!!</span>";
		}else{
			echo "<span class='error'>Something went wrong !!</span>";
		}
	}
?>
<?php 
	if(isset($_GET['delmsg'])){
		$delid = $_GET['delmsg'];
		

		$delquery = "DELETE FROM tbl_contact WHERE id = '$delid' ";
		$delData = $db->delete($delquery);
		if($delData){
			echo "<span class='success'>Message Deleted scucessfully!!</span>";
		}else{
			echo "<span class='error'>Something went wrong !!</span>";
		}
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
						<?php 
							$query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id DESC";
							$msg = $db->select($query);
							if($msg){
								$i = 0;
								while($result = $msg->fetch_assoc()){
									$i++;
						?>
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
							<td><?php echo $fm->formatDate( $result['date']); ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || <a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> || <a onclick="return confirm('Are you sure to move?')" href="?seenid=<?php echo $result['id']; ?>">Seen</a></td>
						</tr>
						<?php 
								}
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
            <div class="box round first grid">
                <h2>Seen Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
						<?php 
							$query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id DESC";
							$msg = $db->select($query);
							if($msg){
								$i = 0;
								while($result = $msg->fetch_assoc()){
									$i++;
						?>
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
							<td><?php echo $fm->formatDate( $result['date']); ?></td>
							<td><a onclick="return confirm('Are you sure to Delete?')" href="?delmsg=<?php echo $result['id']; ?>">Delete</a> || <a onclick="return confirm('Are you sure to Restore?')" href="?remsg=<?php echo $result['id']; ?>">Restore</a></td>
						</tr>
						<?php 
								}
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
		<script type="text/javascript">

			$(document).ready(function () {
				setupLeftMenu();

				$('.datatable').dataTable();
				setSidebarHeight();


			});
		</script>
<?php include 'inc/footer.php'; ?>
