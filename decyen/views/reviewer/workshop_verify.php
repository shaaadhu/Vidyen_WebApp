<form role="form" id="add_comment_workshop_form">
    <?php echo Csrf::field(); ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label"><b>Participant Id</b></label>
            <input type="text" class="form-control bg-white" name="participant_id" value="<?= htmlspecialchars($data['registration_id']) ?>" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"><b>Workshop Code</b></label>
            <input type="text" class="form-control bg-white" name="workshop_id" value="<?= htmlspecialchars($id) ?>" readonly>
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
        <label><b>Add Review Comments</b></label>                
        <textarea class="form-control" rows="5" name="comment" required placeholder="Type your evaluation here..."></textarea>
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Submit Review</button>
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
    </div>
</form>

<script type="text/javascript">
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

$('#add_comment_workshop_form').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "index.php?controller=reviewer&action=save_workshop_comment",
        data: $(this).serialize(),
        success: function (data) {
            alert("Successfully Reviewed");
            location.reload();
        }
    });
});
</script>