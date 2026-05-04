<?php 

include('header.php');
include('config.php');

$db=$conn;
?>
  
<div class="content-wrapper">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">View Role</h1>
                        <a href="add_role.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-add fa-sm text-white-50"></i>&nbsp;Add Role</a>
                    </div>
                    <div class="card shadow mb-4">
                      
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dt table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
					<tr class="text-center">
						<th>S.NO</th>
						<th>Role</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tbody>

<?php
		$query="SELECT * FROM role";
		$sqlcon=mysqli_query($db,$query);
		$i=1;
		while($row=mysqli_fetch_array($sqlcon)){


			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['role'];?></td>
				<td><?php echo $row['description'];?></td>
				<td class="text-center">
					
					<button class="btn btn-outline-primary" onclick="edit_role(this.getAttribute('data-id'))" data-id="<?php echo $row['id'];?>" id="edit_role" name="edit_role"data-bs-toggle="modal" data-bs-target="#modal_role"  method="GET">Edit</button>
					<a class="btn btn-outline-danger" href="delete_role.php?id=<?php echo $row['id'];?>">delete</a>
				</td>
			</tr>
		</tbody>
		<div class="modal fade" id="modal_role" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg text-black">
									<div class="modal-content">
										<div class="modal-header bg-warning">
											<h5 class="modal-title  ms-auto me-auto" id="exampleModalLabel">View Role</h5>
											<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
										</div>
										<div class="modal-body" id="modal_role_bd">
											
										</div>
									</div>
								</div>
							</div>

			<?php
		$i++;


		}
		?>

		</thead>
		</table>
		</div>
		 </div>
     </div>
</div>
<?php include('footer.php');?>
<script type="text/javascript" src="ajax/edit_update_role.js"></script>
<style type="text/css">
   
.form-select-lg {
    padding-top: .5rem;
    padding-bottom: .5rem;
    padding-left: 1rem;
    font-size: 1.25rem;
}
</style>

