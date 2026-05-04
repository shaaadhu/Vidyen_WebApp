
<div class="content-wrapper bg-light">
    <div class="card p-3 shadow-lg">
        <div class="card-title p-3 text-primary d-flex justify-content-between">
            <h3>Add Conference Room</h3> 
            <a class="btn btn-primary btn-sm" onClick="history.go(-1);">Back</a>
        </div>
        <div class="card-body">
            <form id="add_conference_room_form">
                <?php echo Csrf::field(); ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><b>Conference Room Name</b></label>
                        <input type="text" name="room_name" required class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><b>Type of Conference</b></label>
                        <select name="room_type" class="form-control" required>
                            <option value="">Choose type of conference</option>
                            <option value="Conference Hall">Conference Hall</option>
                            <option value="Pre conference hall">Pre conference hall</option>
                            <option value="Scientific session rooms">Scientific session rooms</option>
                            <option value="Workshops">Workshops</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><b>Links</b></label>
                        <textarea name="room_links" class="form-control" placeholder="Enter Links" rows="4"></textarea>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="submit_btn">Submit</button>
                    <button type="reset" class="btn btn-outline-danger btn-lg">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
$(document).on('submit', '#add_conference_room_form', function(e) {
    e.preventDefault();
    const $btn = $('#submit_btn');
    $btn.prop('disabled', true); // Prevents double submission

    $.ajax({
        method: "POST",
        url: "index.php?controller=admin&action=store", // Route to Controller->store()
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
            if(res.status === 'success') {
                alert("Successfully inserted");
                window.location.assign('index.php?controller=admin&action=conference_room_view');
            } else {
                alert("Error inserting record");
            }
        },
        complete: function() {
            $btn.prop('disabled', false);
        }
    });
});
</script>



