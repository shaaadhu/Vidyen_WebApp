<?php include('config.php');
$db=$conn;

			if(isset($_GET['id'])){

				$id=$_GET['id'];

				$query="SELECT * FROM role";
				$sqlcon=mysqli_query($db,$query);
				$rowfetch=mysqli_fetch_array($sqlcon);
				if ($rowfetch) {

					$rowcon="SELECT * FROM role WHERE id='$id'";
					$rowresult=mysqli_query($db,$rowcon);
					while($row=mysqli_fetch_assoc($rowresult)){
						$id=$row['id'];
						?>




				<div class="row">
						<div class="col-lg-1"></div>
						<div class="col-lg-3 text-end">
							<label class="form-label">ID NO:</label>
						</div>
						<div class="col-lg-6">
							<p type="text" id="id" name="id" ><?php echo $row['id'];?></p>
						</div>											
					</div>
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="col-lg-3 text-end">
							<label class="form-label">Role Name</label>
						</div>
						<div class="col-lg-6">
							<input type="text" class="form-control" value="<?php echo $row['role'];?>" name="role" id="role">
						</div>											
					</div>
					<div class="row mt-3 mb-3">
						<div class="col-lg-1"></div>
						<div class="col-lg-3 text-end">
							<label class="form-label">Description</label>
						</div>
						<div class="col-lg-6">
							<input type="text" class="form-control" value="<?php echo $row['description'];?>" name="role_description" id="role_description">
						</div>
					</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="update_role(this.getAttribute('data-id'))" data-id="<?php echo $row['id'];?>" id="submit_role" name="submit_role" method="POST">Save</button>
				</div>
		<?php 
					}
				}

		}

?>
<script type="text/javascript" src="ajax/edit_update_role.js"></script>