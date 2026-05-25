<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-sm">
<div class="card-title pt-3 ps-3 text-primary d-flex justify-content-between align-items-center pe-3">
    <h3 class="mb-0">Assigned Abstract</h3>

    <form method="GET" action="index.php" class="d-flex align-items-center bg-white p-2 rounded shadow-sm border mb-0">
        <input type="hidden" name="controller" value="reviewer">
        <input type="hidden" name="action" value="abstract_view"> 
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
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt table-hover" id="dataTable" width="100%">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Serial No.</th>
                                <th>Registration ID</th>
                                <th>Abstract Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($abstracts)): ?>
                                <?php foreach ($abstracts as $index => $row): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($row['registration_id']) ?></td>
                                        <td><?= htmlspecialchars($row['abstract_id']) ?></td>
                                        <td>
                                            <?php if ($row['status'] === 0): ?>
                                                <a class="btn btn-primary add_review_btn" data-bs-toggle="modal" data-bs-target="#addCommment" type="button" data-id="<?php echo htmlspecialchars($row['abstract_id'], ENT_QUOTES);?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Verify">Verify</a>
                                            <?php else: ?>
                                                <span class="text-success fw-bold">Evaluated</span>
                                            <?php endif; ?>

                                            <!-- <a href="send-mail.php?registration_id=<?= urlencode($row['registration_id']) ?>"
                                                class="btn btn-info btn-sm">Send Mail</a> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No abstracts assigned.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- -----------modal----------- -->
<div id="addCommment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title align-center">
                    Evaluate
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" id="btn_close">&times;</button>
            </div>
            <div class="modal-body" id="add_comment_body">

            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $(document).on('click', '.add_review_btn', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');

            $.ajax({
                type: "GET",
                url: "index.php?controller=reviewer&action=abstract_verify", // Updated MVC Route
                data: {
                    id: id
                },
                success: function(data) {
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