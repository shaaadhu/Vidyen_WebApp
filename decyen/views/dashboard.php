<div class="content-wrapper bg-light p-4">
    <!-- <h2 class="text-primary mb-4">Dashboard</h2> -->
     <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary mb-0">Dashboard</h2>
        
        <!-- Only displays this dropdown selector block if the user is logged in as an admin -->
        <?php if ($user_type == 'admin'): ?>
           <form method="GET" action="index.php" class="d-flex align-items-center bg-white p-2 rounded shadow-sm border">
                <input type="hidden" name="controller" value="authentication">
                <input type="hidden" name="action" value="dashboard">
                <label for="filter_year" class="me-2 fw-bold text-secondary mb-0 small text-nowrap">Filter by Year:</label>
                <select name="filter_year" id="filter_year" class="form-select form-select-sm" 
                        style="width: 130px;" onchange="this.form.submit()">
                    <?php foreach ($data['year_options'] as $val => $label): ?>
                        <option value="<?= htmlspecialchars($val) ?>"
                            <?= ($data['selected_year'] === (string)$val) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        <?php endif; ?>
    </div>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Conference Rooms</h4>  
        </div>
        <div class="card-body">
            <?php if (!empty($data['rooms'])): ?>
                <ul class="nav nav-tabs" id="roomTabs" role="tablist">
                    <?php
                    $active = true;
                    foreach ($data['rooms'] as $type => $rooms):
                        // Create a clean ID: Remove spaces and special chars
                        $tid = "room-" . preg_replace('/[^A-Za-z0-9]/', '', $type);
                    ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?= $active ? 'active' : '' ?>"
                                id="<?= $tid ?>-tab"
                                data-bs-toggle="tab"
                                href="#<?= $tid ?>"
                                role="tab"
                                aria-controls="<?= $tid ?>"
                                aria-selected="<?= $active ? 'true' : 'false' ?>">
                                <?= htmlspecialchars($type) ?>
                            </a>
                        </li>
                    <?php $active = false;
                    endforeach; ?>
                </ul>

                <div class="tab-content pt-3" id="roomTabsContent">
                    <?php
                    $active = true;
                    foreach ($data['rooms'] as $type => $rooms):
                        $tid = "room-" . preg_replace('/[^A-Za-z0-9]/', '', $type);
                    ?>
                        <div class="tab-pane fade <?= $active ? 'show active' : '' ?>"
                            id="<?= $tid ?>"
                            role="tabpanel"
                            aria-labelledby="<?= $tid ?>-tab">
                            <ul class="mt-3">
                                <?php foreach ($rooms as $room): ?>
                                    <li class="mb-2">
                                        <strong><?= htmlspecialchars($room['name']) ?></strong>:
                                        <?php
                                        $links = explode("\n", trim($room['links']));
                                        $html_links = [];
                                        foreach ($links as $link) {
                                            $link = trim($link);
                                            if (!$link) continue;
                                            $url = (preg_match('/^https?:\/\//i', $link)) ? $link : 'https://' . $link;
                                            $html_links[] = '<a href="' . htmlspecialchars($url) . '" target="_blank">' . htmlspecialchars($link) . '</a>';
                                        }
                                        echo implode(', ', $html_links);
                                        ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php $active = false;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-4">
        <?php foreach ($data['stats'] as $label => $value): ?>
            <div class="col-md-4 mb-4">
                <div class="card <?= $user_type == 'admin' ? 'card-dark-blue' : 'shadow-lg' ?> text-center h-100">
                    <div class="card-body">
                        <h4 class="<?= $user_type == 'admin' ? 'text-white' : '' ?>"><?= $label ?></h4>
                        <p class="fs-30 mt-4 <?= $user_type == 'admin' ? 'text-white' : '' ?>"><?= $value ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>