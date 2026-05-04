<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My Certificates</h4>
                    <div class="float-right mr-4">

                        <?php if (in_array('co_author_certificate', $data['generated_certs'])): ?>
                        <!-- Enabled Button -->
                        <a href="index.php?controller=participant&action=co_author_certificates" class="btn btn-info btn-sm">
                            <i class="fa-solid fa-download"></i> Co-Author Certificates
                        </a>
                        <?php endif; ?>

                    </div>
                    <p class="card-description">Download your certificates below</p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Certificate Type</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Conference Participation</td>
                                    <td>Certificate of participation in Conference</td>
                                    <td>
                                        <a href="index.php?controller=certificate&action=conference_participation" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>

                                <?php if ($data['has_paper']): ?>
                                    <tr>
                                        <td>Paper Presentation</td>
                                        <td>Certificate for Paper Presentation</td>
                                        <td>
                                            <a href="index.php?controller=certificate&action=paper_presentation" class="btn btn-success btn-sm">
                                                <i class="fa-solid fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($data['has_poster']): ?>
                                    <tr>
                                        <td>Poster Presentation</td>
                                        <td>Certificate for Poster Presentation</td>
                                        <td>
                                            <a href="index.php?controller=certificate&action=poster_presentation" class="btn btn-success btn-sm">
                                                <i class="fa-solid fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($data['has_yenvision']): ?>
                                    <tr>
                                        <td>Yenvision Lightning Talk</td>
                                        <td>Certificate for Yenvision Lightning Talk Presentation</td>
                                        <td>
                                            <a href="index.php?controller=certificate&action=yenvision" class="btn btn-success btn-sm">
                                                <i class="fa-solid fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php
                                // Define certificates in the View for display purposes
                                $certs = [
                                    'preconference_item_analysis' => ['Pre-Conference Participation', 'Certificate of participation in Pre-Conference Item Analysis'],
                                    'mindful_map'            => ['Pre-Conference Workshop', 'Certificate of participation in Pre-Conference Workshop Mindful Map'],
                                    'sage'                   => ['Pre-Conference Participation SAGE', 'Certificate of participation in Pre-Conference SAGE'],
                                    'itlm'                   => ['Pre-Conference Participation ITLM', 'Certificate of participation in Pre-Conference Interactive Teaching Learning Methods'],
                                    'workshop_bridging'      => ['Workshop Course', 'Certificate of participation in Workshop Course Bridging Mind Building Care'],
                                    'workshop_proms_prems'   => ['Workshop PROMs PREMs', 'Workshop Certificate: PROMs, PREMs, and Dentistry Experiences'],
                                    'workshop_microteaching' => ['Microteaching Workshop', 'Workshop Certificate: Microteaching'],
                                    'first_place_paper'      => ['1st Place Paper Award', 'Award Certificate: 1st Place Paper'],
                                    'second_place_paper'     => ['2nd Place Paper Award', 'Award Certificate: 2nd Place Paper'],
                                    'first_place_poster'     => ['1st Place Poster Award', 'Award Certificate: 1st Place Poster'],
                                    'second_place_poster'    => ['2nd Place Poster Award', 'Award Certificate: 2nd Place Poster'],
                                    'first_place_yenvision'  => ['1st Place YenVision Award', 'Award Certificate: 1st Place YenVision'],
                                    'second_place_yenvision' => ['2nd Place YenVision Award', 'Award Certificate: 2nd Place YenVision']
                                    // 'co_author' => ['Co-Author','Co-Author Certificate']
                                ];

                                foreach ($certs as $key => $info):
                                    // Use the isGenerated helper provided by your Controller data
                                    if (in_array($key, $data['generated_certs'])): ?>
                                        <tr>
                                            <td><?= $info[0] ?></td>
                                            <td><?= $info[1] ?></td>
                                            <td>
                                                <a href="index.php?controller=certificate&action=downloadGenerated&type=<?= $key ?>" class="btn btn-success btn-sm">
                                                    <i class="fa-solid fa-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                <?php endif;
                                endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>