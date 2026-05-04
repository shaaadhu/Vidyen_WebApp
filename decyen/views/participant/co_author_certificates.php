<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Co-Author Certificates</h4>
                    <p class="card-description">
                        Download your co-author certificates below
                    </p>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Co-author Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td><?php echo $full_name; ?></td>
                                    <td>Certificate for co-authors</td>
                                    <td>
                                        <a href="index.php?controller=certificate&action=downloadGenerated&type=co_author_certificate&name=<?php echo urlencode($full_name); ?>"
                                            class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>    