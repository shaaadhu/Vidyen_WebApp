<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title p-3 text-primary d-flex justify-content-between">
                <h3>Submitted Pre-Conference View</h3> 
                <button onclick="location.href='index.php?controller=participant&action=preconference_submission'" class="btn btn-primary rounded text-light fw-bold">
                    Pre-Conference Submission
                </button>
            </div>
            
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Pre Conference Id</th> 
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($submissions)): ?>
                                <?php foreach ($submissions as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['pre_confernce_id']) ?></td>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 200px;">
                                            <?= htmlspecialchars($row['title_paper']) ?>
                                        </td>
                                        <td><?= $row['display_status'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-primary" 
                                               href="index.php?controller=participant&action=preconference_details&id=<?= $row['pre_confernce_id'] ?>">
                                               View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center">No submissions found.</td></tr>
                            <?php endif; ?>
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