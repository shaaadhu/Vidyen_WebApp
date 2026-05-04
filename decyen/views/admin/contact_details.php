<?php if ($data): ?>
<!-- <div class="row">
    <div class="col-md-6"><p><strong>Name:</strong> <?= htmlspecialchars($data['name']) ?></p></div>
    <div class="col-md-6"><p><strong>Phone:</strong> <?= htmlspecialchars($data['phone_number']) ?></p></div>
    <div class="col-12"><p><strong>Subject:</strong> <?= htmlspecialchars($data['subject']) ?></p></div>
    <hr>
    <div class="col-12"><p><strong>Message:</strong></p>
        <div class="p-3 bg-light border rounded"><?= nl2br(htmlspecialchars($data['message'])) ?></div>
    </div>
</div> -->
<div class="row mt-3">
	<div class="col-md-6">
		<label class="form-label"><b>Name</b></label>
		<input type="text" class="form-control bg-white" value="<?php echo $data['name']; ?>" readonly>
	</div>
	<div class="col-md-6">
		<label class="form-label"><b>Phone No</b></label>
		<input type="text" class="form-control bg-white" value="<?php echo $data['phone_number']; ?>" readonly>
	</div>
</div>

<div class="row mt-3">
	<div class="col-md-6">
		<label class="form-label"><b>Email</b></label>
		<input type="text" class="form-control bg-white text-dark" value="<?php echo $data['email']; ?>" readonly>
	</div>
	<div class="col-md-6">
		<label class="form-label"><b>Subject</b></label>
		<input type="text" class="form-control bg-white" value="<?php echo $data['subject']; ?>" readonly>
	</div>
</div>

<div class="row mt-3">
	<div class="col-md-6">
		<label class="form-label"><b>Message</b></label>
		<textarea class="form-control bg-white" rows="5" readonly><?php echo $data['message']; ?></textarea>
	</div>
	<div class="col-md-6">
		<label class="form-label"><b>Sent On</b></label>
		<input type="text" class="form-control bg-white" value="<?php echo $data['created_on']; ?>" readonly>
	</div>
</div>

<?php endif; ?>



