

<div class="content-wrapper bg-light">
    <div class="card p-3 shadow-lg">
        <div class="card-title p-3 text-primary d-flex justify-content-between">
            <h3>Edit Conference Room</h3> 
            <a class="btn btn-primary btn-sm" onClick="history.go(-1);">Back</a>
        </div>
        <div class="card-body">
            <form id="edit_conference_room_form">
                <?php echo Csrf::field(); ?>
                <input type="hidden" name="id" value="<?= $room['id'] ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><b>Conference Room Name</b></label>
                        <input type="text" name="room_name" required class="form-control" 
                               value="<?= htmlspecialchars($room['name']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><b>Type of Conference</b></label>
                        <select name="room_type" class="form-control" required>
                            <?php 
                            $types = ['Conference Hall', 'Pre Conference Hall', 'Scientific Session Rooms', 'Workshops'];
                            foreach($types as $t): ?>
                                <option value="<?= $t ?>" <?= ($room['type'] == $t) ? 'selected' : '' ?>><?= $t ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><b>Links</b></label>
                        <textarea name="room_links" class="form-control" rows="4"><?= htmlspecialchars($room['links']) ?></textarea>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="submit_btn">Update</button>
                    <button type="reset" class="btn btn-outline-danger btn-lg">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).on('submit', '#edit_conference_room_form', function(e) {
    e.preventDefault();
    const $btn = $('#submit_btn');
    $btn.prop('disabled', true);

    $.ajax({
        method: "POST",
        url: "index.php?controller=admin&action=updateConferenceRoom", // Routed to Controller->update()
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
            if(res.status === 'success') {
                alert("Successfully updated");
                window.location.assign('index.php?controller=admin&action=conference_room_view');
            } else {
                alert("Update failed");
            }
        },
        complete: function() {
            $btn.prop('disabled', false);
        }
    });
});
</script>


