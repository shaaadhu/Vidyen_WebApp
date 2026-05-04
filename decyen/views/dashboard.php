<div class="content-wrapper bg-light p-4">
    <h2 class="text-primary mb-4">Dashboard</h2>

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