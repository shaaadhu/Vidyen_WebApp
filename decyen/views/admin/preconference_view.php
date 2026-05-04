


<div class="content-wrapper bg-light">
  <div class="col-12 grid-margin">
    <div class="card shadow-lg">
      <div class="card-title text-primary p-3">
        <h3>Submitted Pre-Conference</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered dt table-hover" id="dataTable">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Serial No.</th>
                <th>Registration ID</th>
                <th>Abstract Code</th>
                <th>Title Of Paper</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
							<?php $i = 1;
							while ($row = mysqli_fetch_array($result)) {
								$status = $row['status'];
								if ($status == '1') {
									$status = "Assigned";
									// code...
								} else if ($status == '2') {
									$status = "Reviewed";
								} else {
									$status = "Not Assigned";
								}
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['registration_id']; ?></td>
									<td><?php echo $row['pre_confernce_id']; ?></td>
									<td style="word-wrap: break-word;white-space: normal;max-width: 200px;"><?php echo $row['title_paper']; ?></td>
									<td class="tdtest"><?php echo $status; ?></td>
									<td><a class="btn btn-outline-primary" href="index.php?controller=admin&action=preconference_viewDetails&id=<?php echo $row['pre_confernce_id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="View">View</a>
									</td>

								</tr>
							<?php $i++;
							}
							?>
						</tbody>

            <!-- <tbody>
              <?php $i=1; while($row = mysqli_fetch_array($result)) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $row['registration_id']; ?></td>
                  <td><?= $row['pre_confernce_id']; ?></td>
                  <td style="word-wrap: break-word;white-space: normal;max-width:200px;">
                    <?= $row['title_paper']; ?>
                  </td>
                  <td class="tdtest">
                    <?= $this->model->getStatusLabel($row['status']); ?>
                  </td>
                  <td>
                    <a class="btn btn-outline-primary"
                       href="preconference_details?id=<?= $row['pre_confernce_id']; ?>"
                       data-bs-toggle="tooltip"
                       title="View">View</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody> -->
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>