<?php
$rows = $data['details'];
?>

<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card shadow-lg">
            <div class="card-title p-3 text-primary d-flex justify-content-between">
                <h3><b>Pre Conference in Detail</b></h3>
                <a class="btn  btn-primary btn-sm " onClick="history.go(-1);">Back</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th scope="row"> Registration Id</th>
                            <td><?php echo $rows['registration_id']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Subthemes Categories</th>
                            <td><?php echo $rows['sub_theme']; ?></td>
                        </tr>
                        <!--   <tr>
                          <th scope="row">Type Of Presentation</th>
                          <td><?php echo $rows['type_of_presentation']; ?></td>
                        </tr> -->
                        <tr>
                            <th scope="row">Title Of The Paper</th>
                            <td><?php echo $rows['title_paper']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Keywords</th>
                            <td><?php echo $rows['keywords']; ?></td>
                        </tr>

                    </table>
                </div>
                <div class="row mt-5">
                    <h3 class="text-primary mb-3">Name Of the Author(s) and Affiliations</h3>
                </div>
                <?php if (!empty($data['authors'])): ?>
                    <?php foreach ($data['authors'] as $authorRow):
                        $firstNames = explode(",", $authorRow['first_name']);
                        $emails = explode(",", $authorRow['author_email']);
                        $author = explode(",", $authorRow['author_type']);
                        $designation = explode(",", $authorRow['designation']);
                        $institution = explode(",", $authorRow['author_institution']);
                        $city = explode(",", $authorRow['author_city']);
                        $state = explode(",", $authorRow['author_state']);
                        $pincode = explode(",", $authorRow['author_pincode']);
                        for ($i = 0; $i < count($firstNames); $i++): ?>
                            <h3 class="text-primary mt-3">Author <?= $i + 1 ?></h3>
                            <table class="table table-bordered mb-3">
                                <tr>
                                    <th width="30%">Name</th>
                                    <td><?= htmlspecialchars($firstNames[$i]) ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= htmlspecialchars($emails[$i] ?? '') ?></td>
                                </tr>
                                <tr>
                                    <th>Author</th>
                                    <td><?= htmlspecialchars($author[$i] ?? '') ?></td>
                                </tr>
                                 <tr>
                                    <th>Designation</th>
                                    <td><?= htmlspecialchars($designation[$i] ?? '') ?></td>
                                </tr>
                                 <tr>
                                    <th>Institution</th>
                                    <td><?= htmlspecialchars($institution[$i] ?? '') ?></td>
                                </tr>
                                 <tr>
                                    <th>City</th>
                                    <td><?= htmlspecialchars($city[$i] ?? '') ?></td>
                                </tr>
                                 <tr>
                                    <th>State</th>
                                    <td><?= htmlspecialchars($state[$i] ?? '') ?></td>
                                </tr>
                                 <tr>
                                    <th>Pincode</th>
                                    <td><?= htmlspecialchars($pincode[$i] ?? '') ?></td>
                                </tr>
                            </table>
                        <?php endfor; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No author information found.</p>
                <?php endif; ?>

                 <div class="table-responsive ">
            <table class="table table-bordered mb-3">
              <tr>
                <th><b>Abstract Background</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['abstract_background']; ?></td>
              </tr>
              <tr>
                <th><b>Abstract Rationale</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['abstract_rationale']; ?></td>
              </tr>
              <tr>
                <th><b>Abstract Objective</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['abstract_objective']; ?></td>
              </tr>
              <tr>
                <th><b>Abstract Outcome</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['abstract_outcome']; ?></td>
              </tr>
              <tr>
                <th><b>Abstract Structure</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['abstract_structure']; ?></td>
              </tr>
              <tr>
                <th><b>Abstract Description</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['abstract_description']; ?></td>
              </tr>
              <tr>
                <th><b>Participants</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['participant']; ?></td>
              </tr>
              <tr>
                <th><b>Participant Description</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['participant_description']; ?></td>
              </tr>
              <tr>
                <th><b>Maximum Participant</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['max_participants']; ?></td>
              </tr>
              <tr>
                <th><b>Workshop Overview</b></th>
                <td style="word-wrap: break-word;white-space: normal;max-width: 400px;"><?php echo $rows['workshop_overview']; ?></td>
              </tr>
            </table>
          </div>


            </div>



        </div>
    </div>
</div>


