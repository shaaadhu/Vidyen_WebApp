
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="card-title mb-0">Generated Certificates List</h4>
                            <p class="card-description">View all certificates generated for participants</p>
                        </div>
                        <div>
                            <a href="index.php?controller=admin&action=certificate_generates" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Generate Certificates
                            </a>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <div class="card bg-primary text-white p-3">
                                <h6>Total Generated</h6>
                                <h3><?= $totalCount ?></h3>
                            </div>
                        </div>
                        <?php foreach ($certTypes as $key => $name): ?>
                            <div class="col-md-2 mt-1 text-center">
                                <div class="card bg-info text-white p-2">
                                    <h6 class="small"><?= substr($name, 0, 15) ?>...</h6>
                                    <h4><?= $stats[$key] ?? 0 ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- <form method="GET" action="index.php?controller=admin" class="row mb-4">
                        <input type="hidden" name="action" value="view_generated">
                        <div class="col-md-4">
                            <label>Filter by Certificate Type</label>
                            <select name="type" class="form-control" onchange="this.form.submit()">
                                <option value="all">All Types</option>
                                <?php foreach ($certTypes as $key => $name): ?>
                                    <option value="<?= $key ?>" <?= ($type == $key) ? 'selected' : '' ?>><?= $name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                             <label>Search Participant</label>
                            <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="router.php?action=view_generated" class="btn btn-secondary">Reset</a>
                        </div>
                    </form> -->
                    <form method="GET" action="index.php" class="row mb-4">
                        <input type="hidden" name="controller" value="admin">
                        <input type="hidden" name="action" value="viewGeneratedCertificates">

                        <div class="col-md-4">
                            <label>Filter by Certificate Type</label>
                            <select name="type" class="form-control" onchange="this.form.submit()">
                                <option value="all">All Types</option>
                                <?php foreach ($certTypes as $key => $name): ?>
                                    <option value="<?= $key ?>" <?= ($type == $key) ? 'selected' : '' ?>><?= $name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Search Participant</label>
                            <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
                        </div>

                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="index.php?controller=admin&action=viewGeneratedCertificates" class="btn btn-secondary">
                                    <i class="fa-solid fa-rotate"></i>Reset</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Registration Code</th>
                                    <th>Participant Name</th>
                                    <th>Email</th>
                                    <th>Certificate Type</th>
                                    <th>Generated Date</th>
                                    <th>Actions</th>

                                    <!-- <th>Reg Code</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($certificates)):
                                    $counter = 1;
                                ?>

                                    <?php foreach ($certificates as $row): ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?= htmlspecialchars($row['registration_code']) ?></td>
                                            <td><?= htmlspecialchars($row['honorofic'] . ' ' . $row['full_name']) ?></td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td><span class="badge badge-info"><?= $certTypes[$row['certificate_type']] ?? $row['certificate_type'] ?></span></td>
                                            <td><?php echo date('M d, Y h:i A', strtotime($row['generated_date'])); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" onclick="deleteCertificate(<?php echo $row['id']; ?>)">
                                                    <i class="fa-solid fa-trash"></i> Revoke
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="py-4">
                                            <i class="fa-solid fa-certificate fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No certificates generated yet or no results found.</p>
                                            <a href="index.php?controller=admin&action=certificate_generates" class="btn btn-primary mt-2">
                                                Generate Certificates
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="index.php?controller=admin&action=export_certificates&type=<?php echo $type; ?>&search=<?php echo urlencode($search); ?>" class="btn btn-success">
                            <i class="fa-solid fa-file-csv"></i> Export to CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteCertificate(id) {
    if (confirm('Are you sure you want to revoke this certificate? The participant will no longer be able to download it.')) {
        window.location.href = 'index.php?controller=admin&action=revoke&id=' + id;
    }
}
</script>

