

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
           
            <div class="card-title pt-3 ps-3 text-primary d-flex flex-column flex-sm-row justify-content-between align-items-center pe-3 gap-2">
    <h3 class="mb-0">Assigned Pre-Conference Abstract</h3>

    <form method="GET" action="index.php" class="d-flex align-items-center bg-white p-2 rounded shadow-sm border mb-0">
        <input type="hidden" name="controller" value="reviewer">
        <input type="hidden" name="action" value="preconference_view"> 
        <label for="filter_year" class="me-2 fw-bold text-secondary mb-0 small text-nowrap">Filter by Year:</label>
        <select name="filter_year" id="filter_year" class="form-select form-select-sm"
                style="width: 110px;" onchange="this.form.submit()">
            <?php foreach ($data['year_options'] as $val => $label): ?>
                <option value="<?= htmlspecialchars($val) ?>"
                    <?= ($data['selected_year'] === (string)$val) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($label) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
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
                                                <p class="text-success mb-0"><b>Evaluated</b></p>
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

    // AJAX to load the verification form
    $(document).on('click', '#add_review_btn', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        
        $.ajax({
            type: "GET",
            url: "index.php?controller=reviewer&action=preconfernce_verify", // Updated Route
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