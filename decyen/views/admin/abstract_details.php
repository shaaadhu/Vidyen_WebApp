

<div class="content-wrapper bg-light">
    <div class="card shadow-lg card-body">
        <div class="card-title p-3 text-primary d-flex justify-content-between">
            <h3><b>Abstract View</b></h3>
            <a class="btn btn-primary btn-sm" onClick="history.go(-1);">Back</a>
        </div>

        <div class=" table-responsive">
           
            <div class="table-responsive">
                      <table class="table table-bordered">
                        <tr>
                          <th scope="row" > Registration Id</th>
                          <td ><?php echo $abstract['registration_id'];?></td>
                        </tr>
                        <tr>
                          <th scope="row">Subthemes Categories</th>
                          <td><?php echo $abstract['sub_theme'];?></td>
                        </tr>
                        <tr>
                          <th scope="row">Type Of Presentation</th>
                          <td><?php echo $abstract['type_of_presentation'];?></td>
                        </tr>
                        <tr>
                          <th scope="row">Title Of The Paper</th>
                          <td style="word-wrap:break-word;white-space: normal"><?php echo $abstract['paper_title'];?></td>
                        </tr>
                        <tr>
                          <th scope="row">Keywords</th>
                          <td><?php echo $abstract['keywords'];?></td>
                        </tr>
                        
                      </table>       
                    </div> 

            <h3 class="text-primary my-3">Name Of the Author(s) and Affiliations</h3>
            <?php foreach ($authors as $index => $author): ?>
                <h3 class="text-primary mb-3">Author <?= $index + 1 ?></h3>
                <!-- <h5>Author <?= $index + 1 ?></h5> -->
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


           

            <div class=" mt-5">
                <label for=""><b>Abstract Details</b></label>
                <textarea class="form-control" rows="5" disabled><?php echo $abstract['paper_abstract']; ?></textarea>
            </div>

            <?php if ($_SESSION['usertype'] == "admin" && !empty($comments)): ?>
                <div class="mt-5">
                    <label><b>Reviewer Comments</b></label>
                    <textarea class="form-control" disabled><?= $comments ?></textarea>
                </div>
            <?php endif; ?>

            <?php if ($_SESSION['usertype'] == "admin" && $abstract['status'] == '0'): ?>
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
                    <!-- <input type="hidden" name="participant_id" value="<?= $abstract['registration_id']; ?>">
          <input type="hidden" name="abstract_code" value="<?= $abstract['abstract_id']; ?>"> -->
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
                                <input type="hidden" name="participant_id" value="<?= $abstract['registration_id']; ?>">
                                <input type="hidden" name="abstract_code" value="<?= $abstract['abstract_id']; ?>">
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
            url: "index.php?controller=admin&action=assignAbstractReviewer", // Updated MVC Route
            data: formData,
            success: function(response) {
                alert(response);
            },
            error: function() {
                alert("General Server Error");
            }
        });
        window.location.assign('index.php?controller=admin&action=abstract_view'); // Redirect to Abstract View
    });
</script>