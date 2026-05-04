

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title p-3 text-primary d-flex justify-content-between">
                <h3><?= $pageTitle; ?></h3> 
                <button onclick="location.href='index.php?controller=admin&action=reviewer_add'" class="btn btn-primary rounded fw-bold">Add</button> 
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt table-hover" id="dataTable" width="100%">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Id</th> 
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviewers as $index => $row): ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= htmlspecialchars($row['name']); ?></td>
                                    <td><?= htmlspecialchars($row['email']); ?></td>
                                    <td><?= htmlspecialchars($row['review_type']); ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#reviewer_details" 
                                           id="view_reviewer_btn" 
                                           data-id="<?= $row['id']; ?>" 
                                           title="View">View</a>
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

<div id="reviewer_details" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reviewer Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="reviewer_details_body">
                </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
$(document).ready(function () {
    $('#dataTable').DataTable();

    $(document).on('click', '#view_reviewer_btn', function (e) {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "index.php?controller=admin&action=reviewer_details", // Ensure path is correct
            data: { id: id },
            success: function (data) {
                $('#reviewer_details_body').html(data);
            }
        });
    });
});
</script>