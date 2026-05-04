<?php if (isset($reviewer)): ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Name</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($reviewer['name']); ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Phone No</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($reviewer['phone_number']); ?>" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Email</b></label>
            <input type="text" class="form-control bg-white text-dark" value="<?= htmlspecialchars($reviewer['email']); ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Designation</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($reviewer['designation']); ?>" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Institution</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($reviewer['institution']); ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Address</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($reviewer['address']); ?>" readonly>
        </div>
    </div>
<?php endif; ?>