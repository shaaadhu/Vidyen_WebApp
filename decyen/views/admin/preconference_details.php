
<div class="content-wrapper bg-light">
    <div class="card shadow-lg">
        <div class="card-title p-3 text-primary d-flex justify-content-between">
            <h3><b>Pre Conference Detail</b></h3>
            <a class="btn btn-primary btn-sm" onClick="history.go(-1);">Back</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Registration Id</th>
                    <td><?= $conference['registration_id'] ?></td>
                </tr>
                <tr>
                    <th>Subthemes Categories</th>
                    <td><?= $conference['sub_theme'] ?></td>
                </tr>
                <tr>
                    <th>Title Of The Paper</th>
                    <td><?= $conference['title_paper'] ?></td>
                </tr>
                <tr>
                    <th>Keywords</th>
                    <td><?= $conference['keywords'] ?></td>
                </tr>
            </table>

            <h3 class="text-primary my-3">Name Of the Author(s) and Affiliations</h3>
            <?php if (!empty($authors)): ?>

    <?php foreach ($authors as $index => $author): ?>
        <h3 class="text-primary mb-3">Author <?= $index + 1 ?></h3>

        <table class="table table-bordered mb-3">
            <tr>
                <th>Name</th>
                <td><?= $author['name'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $author['email'] ?></td>
            </tr>
            <tr>
                <th>Author</th>
                <td><?= $author['author_type'] ?></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td><?= $author['designation'] ?></td>
            </tr>
            <tr>
                <th>Institution</th>
                <td><?= $author['institution'] ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?= $author['city'] ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?= $author['state'] ?></td>
            </tr>
            <tr>
                <th>Pincode</th>
                <td><?= $author['pincode'] ?></td>
            </tr>
        </table>
    <?php endforeach; ?>

<?php else: ?>
    <p class="text-muted"><?= $no_author ?></p>
<?php endif; ?>


            <div class="table-responsive">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th><b>Abstract Background</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['abstract_background']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Abstract Rationale</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['abstract_rationale']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Abstract Objective</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['abstract_objective']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Abstract Outcome</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['abstract_outcome']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Abstract Structure</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['abstract_structure']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Abstract Description</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['abstract_description']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Participants</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['participant']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Participant Description</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['participant_description']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Maximum Participant</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['max_participants']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Workshop Overview</b></th>
                        <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $conference['workshop_overview']; ?></td>
                    </tr>
                </table>
            </div>

            <?php if ($_SESSION['usertype'] == "admin" && !empty($comments)): ?>
                <div class="mt-5">
                    <label><b>Reviewer Comments</b></label>
                    <textarea class="form-control" disabled><?= $comments ?></textarea>
                </div>
            <?php endif; ?>

            <?php if ($_SESSION['usertype'] == "admin" && $conference['status'] == '0'): ?>
                <div class="text-center mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myActivate">Assign Reviewer</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="myActivate" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assign Reviewer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="assign_reviewer">
                    <!-- <input type="hidden" name="participant_id" value="<?= $conference['registration_id']; ?>">
          <input type="hidden" name="abstract_code" value="<?= $conference['pre_confernce_id']; ?>"> -->
                      <?php echo Csrf::field(); ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reviewer Name</th>
                                    <th>Designation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" name="participant_id" value="<?= $conference['registration_id']; ?>">
                                <input type="hidden" name="abstract_code" value="<?= $conference['pre_confernce_id']; ?>">
                                <?php if (!empty($reviewers)): ?>
                                    <?php foreach ($reviewers as $rev): ?>
                                        <tr>

                                            <td>
                                               
                                                <input type="radio" name="reviewers" value="<?= $rev['reviewer_code']; ?>" required>
                                            </td>
                                            <td><?= htmlspecialchars($rev['name']); ?></td>
                                            <td><?= htmlspecialchars($rev['designation']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No reviewers available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100 mt-3" id="btnContactUs">
                        Submit Reviewer &rarr;
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).on('submit', '#assign_reviewer', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            method: "POST",
            url: "index.php?controller=admin&action=assignPreConferenceReviewer", // Updated MVC Route 
            data: formData,
            success: function(response) {
                alert(response);
            },
            error: function() {
                alert("General Server Error");
            }
        });
        window.location.assign('index.php?controller=admin&action=preconference_view'); // Redirect to Abstract View
    });

</script>