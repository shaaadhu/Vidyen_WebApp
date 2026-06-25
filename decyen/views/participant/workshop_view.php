

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title p-3 text-primary d-flex justify-content-between">
                <h3>Submitted Workshop View</h3> 
                <button onclick="location.href='index.php?controller=participant&action=workshop_submission'" class="btn btn-primary rounded text-light fw-bold">
                    Workshop Submission
                </button>
            </div>
            
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Workshop Id</th> 
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($workshops)): ?>
                                <?php foreach ($workshops as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['workshop_id']) ?></td>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 200px;">
                                            <?= htmlspecialchars($row['title_paper']) ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $color = '#999999';
                                                $text = 'Not Assigned';
                                                if ($row['status'] == 1) {
                                                    $color = '#FF9800';
                                                    $text = 'Assigned';
                                                } else if ($row['status'] == 2) {
                                                    $color = '#4CAF50';
                                                    $text = 'Evaluated';
                                                } else if ($row['status'] == 3) {
                                                    $color = '#F44336';
                                                    $text = 'Rejected';
                                                }
                                            ?>
                                            <span style="color: <?= $color; ?>; font-weight: bold;"><?= $text; ?></span>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-primary" 
                                               href="index.php?controller=participant&action=workshop_details&id=<?= $row['workshop_id'] ?>">
                                               View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        No workshops submitted yet.
                                    </td>
                                </tr>
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