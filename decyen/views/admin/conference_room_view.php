
<div class="content-wrapper bg-light">
    <div class="card shadow-lg">
        <div class="card-title p-3 text-primary d-flex justify-content-between">
            <h3>Conference Room View</h3>
            <button onclick="location.href='index.php?controller=admin&action=conference_room_add'" class="btn btn-primary">Add Conference Room</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Links</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $index => $room): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($room['name']); ?></td>
                            <td><?php echo htmlspecialchars($room['type']); ?></td>
                            <td><?php echo htmlspecialchars($room['links']); ?></td>
                            <td>
                                <a class="btn btn-outline-primary view-details" data-id="<?php echo $room['id']; ?>">View</a>
                                <a href="index.php?controller=admin&action=conference_room_edit&id=<?php echo $room['id']; ?>" class="btn btn-outline-warning">Edit</a>
                                <button class="btn btn-outline-danger delete-btn" data-id="<?php echo $room['id']; ?>" data-csrf="<?php echo $_SESSION['csrf_token']; ?>">>Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>   
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click', '.view-details', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "index.php?controller=admin&action=conference_room_viewDetails&id=" + id,
            success: function(response) {
                $('#conference_room_details_body').html(response);
                $('#conference_room_details').modal('show');
            }
        });
    });
    
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<!-- -----------modal----------- -->
<div id="conference_room_details" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" align="center">
                    Conference Room Details
                </h4>
            </div>
            <div class="modal-body" id="conference_room_details_body">


            </div>
            <div class="modal-footer text-center justify-content-center">
                <button type="button" class="btn btn-outline-danger btn_close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    $('.btn_close').click(function() {
        location.reload();

    });

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var csrf = $(this).data('csrf');
        if (confirm('Are you sure you want to delete this conference room?')) {
            $.ajax({
                type: "POST",
                url: "index.php?controller=admin&action=conference_room_delete",
                data: {
                    id: id
                    , csrf_token: csrf
                },
                success: function(data) {
                    alert('Conference room deleted successfully');
                    location.reload();
                },
                error: function() {
                    alert('Error deleting conference room');
                }
            });
        }
    });
</script>