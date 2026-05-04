<form role="form" id="add_comment_preconference_form">
     <?php echo Csrf::field(); ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Participant Id</b></label>
            <input type="text" class="form-control bg-white" name="participant_id" value="<?= htmlspecialchars($data['registration_id']) ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Abstract Code</b></label>
            <input type="text" class="form-control bg-white" name="abstract_code" value="<?= htmlspecialchars($id) ?>" readonly>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <label class="form-label"><b>Sub-themes/categories</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($data['sub_theme']) ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Keywords</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($data['keywords']) ?>" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <label class="form-label"><b>Title Of The Paper</b></label>
            <textarea class="form-control bg-white" rows="3" readonly><?= htmlspecialchars($data['title_paper']) ?></textarea>
        </div>
    </div>

    <div class="mt-3">
        <label><b>Abstract Details</b></label>                
        <textarea class="form-control bg-white" rows="5" readonly><?= htmlspecialchars($data['abstract_background']) ?></textarea>
    </div>

    <div class="mt-3">
        <label><b>Add Comments</b></label>                
        <textarea class="form-control" rows="5" name="comment" required placeholder="Enter review comments..."></textarea>
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Submit Review</button>
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
    </div>
</form>

<script>
$('#add_comment_preconference_form').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "index.php?controller=reviewer&action=save_preconference_comment",
        data: $(this).serialize(),
        success: function (response) {
            alert("Successfully Reviewed");
            location.reload();
        }
    });
});
</script>