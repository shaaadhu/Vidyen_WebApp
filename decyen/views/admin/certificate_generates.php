


<div class="content-wrapper">
    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="card-title text-primary">Certificate Management</h4>
            <p class="card-description">
                Generate certificates for participants
            </p>

            <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Certificates generated for <?php echo $_GET['count']; ?> participant(s).
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            <?php endif; ?>

            <form method="POST" action="index.php?controller=admin&action=processGeneration" id="certificateForm">
                <?php echo Csrf::field(); ?>
                <div class="form-group">
                    <label>Select Certificate Type</label>
                    <select class="form-control" name="certificate_type" id="certificate_type" required>
                        <option value="">-- Select --</option>
                        <?php foreach ($certTypes as $val => $label): ?>
                            <option value="<?= $val ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="searchInput">Search by Registration Code or Name</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="searchInput"
                            placeholder="Enter registration code or participant name..."
                            onkeyup="searchParticipants()">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                <i class="fa-solid fa-xmark"></i> Clear
                            </button>
                        </div>
                    </div>
                    <small class="form-text text-muted">Type to filter participants in the table below</small>
                </div>
                

                <div class="table-responsive">
                    <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAll()">
                                    <i class="fa-solid fa-check-double"></i> Select All
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deselectAll()">
                                    <i class="fa-solid fa-xmark"></i> Deselect All
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" onclick="selectVisible()">
                                    <i class="fa-solid fa-check"></i> Select Visible
                                </button>
                                <span class="ml-3" id="selectedCount">Selected: 0</span>
                                <span class="ml-3" id="visibleCount"></span>
                            </div>
                    <table class="table table-hover" id="participantTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllCheckbox" onchange="toggleAll(this)"></th>
                                <th>Registration Code</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Certificate Status</th>
                            </tr>
                        </thead>
                        <tbody id="defaultTable">

                            <?php foreach ($participants as $row): ?>
                                <tr class="participant-row"
                                    data-regcode="<?= strtolower($row['registration_code']) ?>"
                                    data-name="<?= strtolower($row['honorofic'] . ' ' . $row['full_name']) ?>"
                                     data-email="<?= strtolower($row['email'] ) ?>">
                                    <td><input type="checkbox" name="users[]" value="<?= $row['registration_code'] ?>" class="user-checkbox" onchange="updateCount()"></td>
                                    <td><?= htmlspecialchars($row['registration_code']) ?></td>
                                    <td><?= htmlspecialchars($row['honorofic'] . ' ' . $row['full_name']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td class="certificate-status" data-user="<?= $row['registration_code'] ?>">
                                        <span class="badge badge-secondary">Select certificate type</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tbody id="coAuthorTable" style="display:none;">

                            <?php foreach ($coAuthors as $row): ?>
                                <tr class="participant-row"
                                    data-regcode="<?= strtolower($row['registration_id']) ?>"
                                    data-name="<?= strtolower($row['full_name']) ?>"
                                     data-email="<?= strtolower($row['author_email'] ) ?>">
                                    <td><input type="checkbox" name="users[]" value="<?= $row['registration_id'] ?>" class="user-checkbox" onchange="updateCount()"></td>
                                    <td><?= htmlspecialchars($row['registration_id']) ?></td>
                                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                                    <td><?= htmlspecialchars($row['author_email']) ?></td>
                                    <td class="certificate-status" data-user="<?= $row['registration_id'] ?>">
                                        <span class="badge badge-secondary">Select certificate type</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" id="generateBtn" disabled>
                                <i class="fa-solid fa-certificate"></i> Generate Selected Certificates
                            </button>
                        </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    // Update certificate status when certificate type changes
    document.getElementById('certificate_type').addEventListener('change', function() {
    const certType = this.value;

    const statusCells = document.querySelectorAll('.certificate-status');

    //  TABLE SWITCH LOGIC
    const coAuthorTable = document.getElementById('coAuthorTable');
    const defaultTable = document.getElementById('defaultTable');

    if (certType === 'co_author_certificate') {
        coAuthorTable.style.display = '';
        defaultTable.style.display = 'none';
    } else {
        coAuthorTable.style.display = 'none';
        defaultTable.style.display = '';
    }

    // RESET CHECKBOXES WHEN SWITCHING
    document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
    document.getElementById('selectAllCheckbox').checked = false;
    updateCount();


    if (!certType) {
        statusCells.forEach(cell => {
            cell.innerHTML = '<span class="badge badge-secondary">Select certificate type</span>';
        });
        return;
    }

    //  AJAX STATUS CHECK
    statusCells.forEach(cell => {
        const userId = cell.getAttribute('data-user');
        fetch('check_certificate_status.php?user=' + userId + '&type=' + certType)
            .then(response => response.json())
            .then(data => {
                if (data.generated) {
                    cell.innerHTML = '<span class="badge badge-success">✓ Generated on ' + data
                        .date + '</span>';
                } else {
                    cell.innerHTML = '<span class="badge badge-warning">Not Generated</span>';
                }
            });
    });

    updateGenerateButton();
   });

    function toggleAll(checkbox) {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(cb => cb.checked = checkbox.checked);
        updateCount();
    }

    function selectAll() {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(cb => cb.checked = true);
        document.getElementById('selectAllCheckbox').checked = true;
        updateCount();
    }

    function deselectAll() {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(cb => cb.checked = false);
        document.getElementById('selectAllCheckbox').checked = false;
        updateCount();
    }

    function updateCount() {
        const checked = document.querySelectorAll('.user-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = 'Selected: ' + checked;
        updateGenerateButton();
    }

    function updateGenerateButton() {
        const certType = document.getElementById('certificate_type').value;
        const checked = document.querySelectorAll('.user-checkbox:checked').length;
        const btn = document.getElementById('generateBtn');

        if (certType && checked > 0) {
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }

    // Search functionality
    function searchParticipants() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.participant-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const regCode = row.getAttribute('data-regcode');
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');

            if (regCode.includes(searchTerm) || name.includes(searchTerm) || email.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('visibleCount').textContent = 'Showing: ' + visibleCount + ' of ' + rows.length;
    }

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        searchParticipants();
    }

    function selectVisible() {
        const rows = document.querySelectorAll('.participant-row');
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const checkbox = row.querySelector('.user-checkbox');
                if (checkbox) {
                    checkbox.checked = true;
                }
            }
        });
        updateCount();
    }

    // Form submission confirmation
    document.getElementById('certificateForm').addEventListener('submit', function(e) {
        const certType = document.getElementById('certificate_type');
        const selectedText = certType.options[certType.selectedIndex].text;
        const count = document.querySelectorAll('.user-checkbox:checked').length;

        if (!confirm('Generate "' + selectedText + '" certificate for ' + count + ' participant(s)?')) {
            e.preventDefault();
        }
    });

    // Initialize visible count on page load
    window.addEventListener('load', function() {
        searchParticipants();
    });
</script> -->

<script>
// Update certificate status when certificate type changes
document.getElementById('certificate_type').addEventListener('change', function() {
    const certType = this.value;

    const statusCells = document.querySelectorAll('.certificate-status');

    //  TABLE SWITCH LOGIC
    const coAuthorTable = document.getElementById('coAuthorTable');
    const defaultTable = document.getElementById('defaultTable');

    if (certType === 'co_author_certificate') {
        coAuthorTable.style.display = '';
        defaultTable.style.display = 'none';
    } else {
        coAuthorTable.style.display = 'none';
        defaultTable.style.display = '';
    }

    // RESET CHECKBOXES WHEN SWITCHING
    document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
    document.getElementById('selectAllCheckbox').checked = false;
    updateCount();


    if (!certType) {
        statusCells.forEach(cell => {
            cell.innerHTML = '<span class="badge badge-secondary">Select certificate type</span>';
        });
        return;
    }

    //  AJAX STATUS CHECK
    statusCells.forEach(cell => {
        const userId = cell.getAttribute('data-user');
        fetch('index.php?controller=admin&action=checkStatusCertificate&user=' + userId + '&type=' + certType)
            .then(response => response.json())
            .then(data => {
                if (data.generated) {
                    cell.innerHTML = '<span class="badge badge-success">✓ Generated on ' + data
                        .date + '</span>';
                } else {
                    cell.innerHTML = '<span class="badge badge-warning">Not Generated</span>';
                }
            });
    });

    updateGenerateButton();
});

function toggleAll(checkbox) {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    updateCount();
}

function selectAll() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(cb => cb.checked = true);
    document.getElementById('selectAllCheckbox').checked = true;
    updateCount();
}

function deselectAll() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(cb => cb.checked = false);
    document.getElementById('selectAllCheckbox').checked = false;
    updateCount();
}

function updateCount() {
    const checked = document.querySelectorAll('.user-checkbox:checked').length;
    document.getElementById('selectedCount').textContent = 'Selected: ' + checked;
    updateGenerateButton();
}



function updateGenerateButton() {
    const certType = document.getElementById('certificate_type').value;


    const checked = document.querySelectorAll(
        'tbody:not([style*="display: none"]) .user-checkbox:checked'
    ).length;

    const btn = document.getElementById('generateBtn');

    if (certType !== '' && checked > 0) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}


// Search functionality
function searchParticipants() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.participant-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const regCode = row.getAttribute('data-regcode');
        const name = row.getAttribute('data-name');
        const email = row.getAttribute('data-email');

        if (regCode.includes(searchTerm) || name.includes(searchTerm) || email.includes(searchTerm)) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('visibleCount').textContent = 'Showing: ' + visibleCount + ' of ' + rows.length;
}

function clearSearch() {
    document.getElementById('searchInput').value = '';
    searchParticipants();
}

function selectVisible() {
    const rows = document.querySelectorAll('.participant-row');
    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const checkbox = row.querySelector('.user-checkbox');
            if (checkbox) {
                checkbox.checked = true;
            }
        }
    });
    updateCount();
}

// Form submission confirmation
document.getElementById('certificateForm').addEventListener('submit', function(e) {
    const certType = document.getElementById('certificate_type');
    const selectedText = certType.options[certType.selectedIndex].text;
    const count = document.querySelectorAll('.user-checkbox:checked').length;

    if (!confirm('Generate "' + selectedText + '" certificate for ' + count + ' participant(s)?')) {
        e.preventDefault();
    }
});

// Initialize visible count on page load
window.addEventListener('load', function() {
    searchParticipants();
});
</script>

