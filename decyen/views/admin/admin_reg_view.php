
<div class="content-wrapper bg-light">
    <div style="display:none;">
        <?php echo Csrf::field(); ?>
    </div>
    <div class="col-12 grid-margin">
        
        <div class="card shadow-lg">
            <!-- <div class="card-title p-3 text-primary d-flex justify-content-between">
                <h3>Participant List</h3>
            
                <a href="index.php?controller=admin&action=exportCSV" class="btn btn-primary rounded fw-bold">Download Excel</a>
            </div> -->
            <div class="card-title p-3 text-primary d-flex justify-content-between align-items-center">
                    <h3>Participant List</h3>

                    <div class="d-flex align-items-center gap-2">
                        <form method="GET" action="index.php" class="d-flex align-items-center bg-white p-2 rounded shadow-sm border mb-0">
                            <input type="hidden" name="controller" value="admin">
                            <input type="hidden" name="action" value="admin_reg_view">
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

                        <a href="index.php?controller=admin&action=exportCSV" class="btn btn-primary rounded fw-bold">Download Excel</a>
                    </div>
                    </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt table-hover" id="dataTable">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Sl.No</th>
                                <th>Type of Delegate</th>
                                <th>Name of Participant</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php $i = 1;
                            while ($row = mysqli_fetch_array($participants)) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row['type_of_delegate']; ?></td>
                                    <td><?= $row['full_name']; ?></td>
                                    <td><?= $row['status'] == '0' ? 'Not Active' : 'Active'; ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary" id="registration_view_btn" data-id="<?= $row['registration_code']; ?>">View</a>
                                        <?php if ($row['status'] == 0) { ?>
                                            <a class="btn btn-outline-danger" id="active_user_btn" data-id="<?= $row['registration_code']; ?>">Activate</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var isSubmitting = false;
    $(document).on('click', '#active_user_btn', function(e) {
        e.preventDefault();
        if (isSubmitting) {
            return;
        }
        isSubmitting = true;
        var userid = $(this).attr('data-id');
        var token = $('input[name="csrf_token"]').val();
        $.ajax({
            url: "index.php?controller=admin&action=ajaxActivateUser",
            type: "POST",
            data: {
                userid: userid,
                csrf_token: token 
            },
            success: function(data) {
                alert("Successfully Activated");
                location.reload();
            },
            complete: function() {
                isSubmitting = false;
            }
        });
    });
    $(document).on('click', '#registration_view_btn', function(e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        $('#registration_details').modal('show');
        $.ajax({
            type: "GET",
            url: "index.php?controller=admin&action=ajaxGetRegistrationDetails",
            data: {
                id: id,
            },
            success: function(data) {
                $('#registration_details_body').html(data);


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
<div id="registration_details" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-height: 80vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title align-center">
                    Registration Details
                </h4>
            </div>
            <div class="modal-body" id="registration_details_body">


           

            




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
</script>