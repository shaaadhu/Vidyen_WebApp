

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title p-3 text-primary">
                <h3>Assigned Workshop Abstract</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Serial No.</th> 
                                <th>Registration ID</th>
                                <th>Abstract Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($assignments)): ?>
                                <?php foreach ($assignments as $index => $row): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($row['registration_id']) ?></td>
                                        <td><?= htmlspecialchars($row['abstract_id']) ?></td>
                                        <td class="text-center">
                                            <?php if($row['status'] == 0): ?>
                                                <button class="btn btn-outline-primary" 
                                                        id="add_review_btn" 
                                                        data-id="<?= htmlspecialchars($row['abstract_id']) ?>">
                                                    Verify
                                                </button>
                                            <?php else: ?>
                                                <span class="text-success fw-bold">Evaluated</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center">No assignments found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addCommment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Evaluate</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="btn_close"></button>
            </div>
            <div class="modal-body" id="add_comment_body">
                </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function () {
    $('#dataTable').DataTable();

    $(document).on('click', '#add_review_btn', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        
        $.ajax({
            type: "GET",
            url: "index.php?controller=reviewer&action=workshop_verify", // Unified Routing
            data: { id: id },
            success: function (data) {
                $('#add_comment_body').html(data);
                $('#addCommment').modal('show');
            }
        });
    });

    $('#btn_close').click(function() {
        location.reload();
    });
});
</script>