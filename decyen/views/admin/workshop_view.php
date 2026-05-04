

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title text-primary p-3">
                <h3>Submitted Pre-Conference</h3> 
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt table-hover" id="dataTable" width="100%" cellspacing="0">
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
                            <?php foreach ($workshops as $index => $workshop): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($workshop['registration_id']); ?></td>
                                <td><?= htmlspecialchars($workshop['workshop_id']); ?></td>
                                <td style="word-wrap: break-word; white-space: normal; max-width: 200px;">
                                    <?= htmlspecialchars($workshop['title_paper']); ?>
                                </td>
                                <td class="tdtest"><?= $workshop['status_text']; ?></td>
                                <td>
                                    <a class="btn btn-outline-primary" 
                                       href="index.php?controller=admin&action=workshop_details&id=<?= $workshop['workshop_id']; ?>" 
                                       data-bs-toggle="tooltip" title="View">View</a>
                                </td>
                            </tr>   
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTable').DataTable();
  });
</script>