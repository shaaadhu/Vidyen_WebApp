
<div class="content-wrapper bg-light">
    <div class="card shadow-lg">
        <div class="card-title text-primary p-3">
            <h3>Contacted Details</h3> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover dt" id="dataTable" width="100%">
                    <thead class="text-center bg-primary text-white">
                        <tr>
                            <th>S.No.</th> 
                            <th>Name</th>
                            <th>Number</th>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['phone_number']); ?></td>
                                <td><?= htmlspecialchars($row['subject']); ?></td>
                                <td>
                                    <button class="btn btn-outline-primary contact_view_btn" 
                                            data-id="<?= $row['id']; ?>" 
                                            title="View">View</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="contact_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Contact Message Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="contact_details_body"></div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
$(document).ready(function () {
    $('#dataTable').DataTable();

    $(document).on('click', '.contact_view_btn', function (e) {
        var id = $(this).attr('data-id');
        $('#contact_details').modal('show');
        $.ajax({
            type: "GET",
            url: "index.php?controller=admin&action=ajaxGetContactDetails", 
            data: { id: id },
            success: function (data) {
                $('#contact_details_body').html(data);
            }
        });
    });
});
</script>