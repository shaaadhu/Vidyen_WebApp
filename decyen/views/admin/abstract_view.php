

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title p-3 text-primary d-flex justify-content-between align-items-center">
    <h3 class="mb-0">Submitted Abstract</h3>

    <div class="d-flex align-items-center gap-2">
        <form method="GET" action="index.php" class="d-flex align-items-center bg-white p-2 rounded shadow-sm border mb-0">
            <input type="hidden" name="controller" value="admin">
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

        <a href="index.php?controller=admin&action=downloadAbstractExcel" class="btn btn-primary btn-sm">
            Download Excel&nbsp;&nbsp;<i class="fa-solid fa-download"></i>
        </a>
    </div>
</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt table-hover" id="dataTable" width="100%">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>Serial No.</th> 
                                <th>Registration ID</th>
                                <th>Abstract Code</th>
                                <th>Title Of Paper</th>
                                <th>Type Of Presentation</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($abstracts as $index => $row): ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= htmlspecialchars($row['registration_id']); ?></td>
                                    <td><?= htmlspecialchars($row['abstract_id']); ?></td>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 200px;">
                                        <?= htmlspecialchars($row['paper_title']); ?>
                                    </td>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 200px;">
                                        <?= htmlspecialchars($row['type_of_presentation']); ?>
                                    </td>
                                    <td><?= $row['status_html']; ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary" 
                                           href="index.php?controller=admin&action=abstract_details&id=<?= $row['abstract_id']; ?>" 
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




<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTable').DataTable();
  });
</script>