

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title p-3 text-primary d-flex justify-content-between">
                <h3>Submitted Abstract View</h3> 
                <a href="index.php?controller=participant&action=abstract_create" class="btn btn-primary rounded text-light fw-bold">Create</a> 
            </div>

            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Abstract Code</th> 
                                <th>Abstract Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($abstracts)): ?>
                                <?php foreach ($abstracts as $abstract): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($abstract['abstract_id']) ?></td>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 200px;">
                                            <?= htmlspecialchars($abstract['paper_title']) ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $color = '#999999';
                                                $text = 'Not Assigned';
                                                if ($abstract['status'] == 1) {
                                                    $color = '#FF9800';
                                                    $text = 'Assigned';
                                                } else if ($abstract['status'] == 2) {
                                                    $color = '#4CAF50';
                                                    $text = 'Evaluated';
                                                } else if ($abstract['status'] == 3) {
                                                    $color = '#F44336';
                                                    $text = 'Rejected';
                                                }
                                            ?>
                                            <span style="color: <?= $color; ?>; font-weight: bold;"><?= $text; ?></span>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-primary" 
                                               href="index.php?controller=participant&action=abstract_details&id=<?= $abstract['abstract_id'] ?>">
                                               View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No abstracts found.</td>
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