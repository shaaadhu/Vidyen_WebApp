<form role="form" id="add_comment_form">
    <?php echo Csrf::field(); ?>
    <input type="hidden" name="session_name" value="<?= htmlspecialchars($abstract['session_name']) ?>">
    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Participant Id</b></label>
            <input type="text" class="form-control bg-white" name="participant_id" value="<?= htmlspecialchars($abstract['registration_id']) ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Abstract Code</b></label>
            <input type="text" class="form-control bg-white" name="abstract_code" value="<?= htmlspecialchars($id) ?>" readonly>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <label class="form-label"><b>Sub-themes/categories</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($abstract['sub_theme']) ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Type Of Presentation</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($abstract['type_of_presentation']) ?>" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Title Of The Paper</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($abstract['paper_title']) ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Keywords</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($abstract['keywords']) ?>" readonly>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Session Alloted</b></label>
            <input type="text" class="form-control bg-white" value="<?= htmlspecialchars($abstract['session_name']) ?>" readonly>
        </div>
    </div>



    <div class="mt-3">
        <label><b>Abstract Details</b></label>                
        <textarea class="form-control" rows="10" readonly><?= htmlspecialchars($abstract['paper_abstract']) ?></textarea>
    </div>

   <div class="mt-3">
    <label><b>Evaluation Decision</b></label>
    <input type="hidden" name="decision" id="decisionInput" value="accept">
    <div class="d-flex gap-2 mt-1">
        <button type="button" id="btnAccept" class="btn btn-dark btn-sm" onclick="setDecision('accept')">
            <i class="fa-solid fa-circle-check"></i> Accept
        </button>
        <button type="button" id="btnReject" class="btn btn-outline-dark btn-sm" onclick="setDecision('reject')">
            <i class="fa-solid fa-circle-xmark"></i> Reject
        </button>
    </div>
</div>


    <div class="mt-3">
        <label><b>Add Comments</b></label>                
        <textarea class="form-control" rows="5" name="comment" required placeholder="Enter your evaluation here..."></textarea>
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Submit Evaluation</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</form>

<script>
    function setDecision(value) {
    document.getElementById('decisionInput').value = value;

    if (value === 'accept') {
        document.getElementById('btnAccept').className = 'btn btn-dark btn-sm';
        document.getElementById('btnReject').className = 'btn btn-outline-dark btn-sm';
    } else {
        document.getElementById('btnAccept').className = 'btn btn-outline-dark btn-sm';
        document.getElementById('btnReject').className = 'btn btn-dark btn-sm';
    }
}
// Logic to handle the form submission inside the modal
$('#add_comment_form').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "index.php?controller=reviewer&action=save_abstract_comment",
        data: $(this).serialize(),
        success: function (response) {
            alert("Evaluation submitted successfully");
            location.reload();
        }
    });
});
</script>