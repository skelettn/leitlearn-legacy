<?php
$this->assign('title', $packet->name);
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <div class="packet-header">
            <h1 class="title">
                <?= $packet->name ?>
            </h1>
            <div class="actions" id="play-actions-btn">
                <?php if ($is_my_packet) : ?>
                    <?= $this->Html->link(
                        '<span class="material-symbols-rounded">tune</span>',
                        '/deck/settings/' . $packet->packet_uid,
                        [
                            'class' => 'action play-hidden',
                            'title' => 'Paramètres du paquet',
                            'escapeTitle' => false,
                        ],
                    ) ?>
                    <?= $this->Form->postLink(
                        '<span class="material-symbols-rounded">ios_share</span>',
                        ['controller' => 'Packets', 'action' => 'export', $packet->id],
                        [
                            'confirm' => __('Êtes-vous sûr de vouloir exporter le paquet ?'),
                            'class' => 'action play-hidden',
                            'title' => 'Exporter le paquet en CSV',
                            'escapeTitle' => false,
                        ]
                    ) ?>
                    <?php if ($flashcards_numb != 0) : ?>
                    <button class="action play hidden" id="btn-retour">
                        <?= __('Retour au paquet') ?>
                        <span class="material-symbols-rounded">
                            web_traffic
                        </span>
                    </button>
                        <?php if (isset($session)) : ?>
                            <?= $this->Form->postLink(
                                '<span class="material-symbols-rounded">history</span>',
                                ['controller' => 'Sessions', 'action' => 'delete', $session->session_uid],
                                [
                                    'confirm' => 'Êtes-vous sur de vouloir réinitialiser la session ?',
                                    'class' => 'action play-hidden',
                                    'title' => 'Réinitialiser la session',
                                    'escapeTitle' => false,
                                ]
                            )
                            ?>
                        <?php endif; ?>

                        <?php if (!isset($date) || ($now > $date)) : ?>
                            <?= $this->Form->postLink(
                                'Lancer <span class="material-symbols-rounded">start</span>',
                                ['controller' => 'Sessions', 'action' => 'createOrRedirect', $packet->id],
                                ['class' => 'action play btnPlay create-session-btn', 'escapeTitle' => false]
                            ) ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php elseif (!$is_my_packet && !$is_private) : ?>
                    <?= $this->Form->postLink(
                        '<button class="action play">' .
                                 __('Importer le paquet') . '
                                <span class="material-symbols-rounded">
                                      cloud_upload
                                </span>
                              </button>',
                        ['controller' => 'Packets', 'action' => 'import', $packet->id],
                        [
                            'confirm' => __('Êtes-vous sûr de vouloir importer le paquet ?'),
                            'escapeTitle' => false,
                        ]
                    ) ?>
                    <?= $this->Form->postLink(
                        '<span class="material-symbols-rounded">ios_share</span>',
                        ['controller' => 'Packets', 'action' => 'export', $packet->id],
                        [
                            'confirm' => __('Êtes-vous sûr de vouloir exporter le paquet ?'),
                            'class' => 'action play-hidden',
                            'escapeTitle' => false,
                        ]
                    ) ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($flashcards_numb != 0 && ($is_private && $is_my_packet) || (!$is_private)) : ?>
        <section>
            <h2 class="section-title" id="title-game"><?= __('Visualisation du paquet') ?></h2>
            <div class="overview-container">
                <div class="overview" id="game-visu">
                    <div class="progress">
                        <progress value="0" max="100" id="deck-visualisation-progress"></progress>
                    </div>
                    <?php
                    $firstCard = true;
                    foreach ($packet->flashcards as $flashcard) :
                        ?>
                        <div class="card <?= $firstCard ? 'active' : '' ?> flipped-card">
                            <?php if (($is_private && $is_my_packet) || (!$is_private)) : ?>
                                <div class="card-front">
                                    <div class="content-flashcard">
                                        <p><?= $flashcard->question ?></p>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="content-flashcard">
                                        <p><?= $flashcard->answer ?></p>
                                    </div>
                                </div>
                            <?php else :
                                ?>
                                <div class="card-front">
                                    <p><i class="fa-solid fa-lock"></i></p>
                                </div>
                                <div class="card-back">
                                    <p><i class="fa-solid fa-lock"></i></p>
                                </div>
                            <?php endif;
                            ?>
                        </div>
                        <?php
                        $firstCard = false;
                    endforeach;
                    ?>
                    <div class="card finish flipped-card">
                        <div class="card-front">
                            <p><?= __('Vous avez terminé') ?> 🎉 🥳</p>
                        </div>
                        <div class="card-back">
                            <p><?= __('Vous avez terminé') ?> 🎉 🥳</p>
                        </div>
                    </div>
                    <div class="actions-btn">
                        <div class="action-btn next change-card" id="deck-visualisation-previous" data-change-card="-1">
                            <span class="material-symbols-rounded">
                                chevron_left
                            </span>
                        </div>
                        <?= $this->cell('FeatureFlags::display', ['deck_session_features_experiment']) ?>
                        <div class="action-btn previus change-card" id="deck-visualisation-next" data-change-card="1">
                            <span class="material-symbols-rounded">
                                chevron_right
                            </span>
                        </div>
                    </div>
                </div>
                <div class="game-text-area" id="game-text-area">
                    <textarea name="" id="input-text-area"></textarea>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section>
            <h2 class="section-title play-hidden flex">
                <?= __('Cartes') ?>
                <div class="actions">
                    <?php if ($is_my_packet) : ?>
                        <div class="action modal-btn play-hidden" data-modal="create-flashcard">
                            <span class="material-symbols-rounded">
                            add
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </h2>
            <div class="flashcards play-hidden">
                <?php if ($flashcards_numb == 0) : ?>
                    <span><?= __('Vous n\'avez aucune carte.') ?></span>
                <?php endif; ?>
                <?php foreach ($packet->flashcards as $flashcard) : ?>
                    <div class="flashcard" data-flashCard-id="<?= $flashcard->id ?>">
                        <div class="time-remaining">
                            <span class="material-symbols-rounded">
                                schedule
                            </span>
                            <?= $flashcard->time_string ?>
                        </div>
                        <?php if (($is_private && $is_my_packet) || (!$is_private)) : ?>
                            <div class="question"><?= $flashcard->question ?></div>
                            <div class="answer">
                                <div class="content"><?= $flashcard->answer ?></div>
                                <div class="show-btn">
                                    <span class="material-symbols-rounded">
                                        visibility_off
                                    </span>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="question"><i class="fa-solid fa-lock"></i>&nbsp;<?= __('Le contenu de la carte est verrouillé') ?></div>
                        <?php endif; ?>
                        <?php if ($is_my_packet) : ?>
                            <div class="flashcard-actions">
                                <div class="flashcard-action dropdown">
                                    <span class="material-symbols-rounded" onclick="toggleDropdown(this)">
                                        more_vert
                                    </span>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="flashcard-item" data-flashCard-id="<?= $flashcard->id ?>">
                                                <span class="material-symbols-rounded">
                                                    edit_note
                                                </span>
                                                <?= __('Modifier la carte') ?>
                                            </li>
                                            <li class="delete">
                                                <?= $this->Form->postLink(
                                                    '
                                                    <span class="material-symbols-rounded">
                                                        remove
                                                    </span>' . __('Supprimer la carte'),
                                                    ['controller' => 'Flashcards',
                                                        'action' => 'delete', $flashcard->id],
                                                    ['escapeTitle' => false, 'confirm' => 'Êtes-vous sur de vouloir supprimer la flashcard ?']
                                                )
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </section>

        <?php if ($is_my_packet && $flashcards_numb != 0) : ?>
            <section class="play-hidden charts">
                <h2 class="section-title"><?= __('Visualisation de l\'avancement') ?></h2>
                <canvas id="barChart"></canvas>
            </section>
            <section class="play-hidden">
                <h2 class="section-title"><?= __('Paramètres de jeu') ?></h2>
                <div class="algorithm">
                    <div class="icon"></div>
                    <div class="text">
                        <p><?= __('Méthode par répétition (Leitner)') ?></p>
                        <span><?= __('Algorithme pour apprendre sur une longue période. Basé sur la méthode de Leitner cette méthode vous permet d\'apprendre en 7 jours vos cartes efficacement.') ?></span>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <section class="play-hidden">
            <h2 class="section-title"><?= __('Informations') ?></h2>
            <div class="creator-infos">
                <div class="information made-by">
                    <div class="data">
                        <span><?= __('Nombre de flashcards') ?></span>
                        <strong><?= count($packet->flashcards) ?></strong>
                    </div>
                </div>
                <div class="information made-by">
                    <div class="data">
                        <span><?= __('Crée le') ?></span>
                        <strong>
                            <?= $packet->created->format('d') ?>
                            <?= [
                                '01' => 'janvier', '02' => 'février', '03' => 'mars', '04' => 'avril',
                                '05' => 'mai', '06' => 'juin', '07' => 'juillet', '08' => 'août',
                                '09' => 'septembre', '10' => 'octobre', '11' => 'novembre', '12' => 'décembre',
                            ][date_format($packet->created, 'm')] ?>
                            <?= $packet->created->format('Y') ?>
                        </strong>
                    </div>
                </div>
                <div class="information">
                    <?= $this->Html->image('/img/user_profile_pic/' . $creator->profile_picture, ['class' => 'profile-picture avatar']) ?>
                    <div class="data made-by">
                        <span><?= __('Crée par') ?></span>
                        <strong><?= $creator->username ?></strong>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    function _0x144a(_0x188dc8,_0x104577){const _0xaf6a63=_0xaf6a();return _0x144a=function(_0x144a4d,_0x518286){_0x144a4d=_0x144a4d-0x11d;let _0x27896e=_0xaf6a63[_0x144a4d];return _0x27896e;},_0x144a(_0x188dc8,_0x104577);}function _0xaf6a(){const _0x59ea78=['111qiESbi','10736099rGlLYh','32373XpXvlM','8516599dBSWWD','remove','classList','6168qabQhW','show','154052bfRoWN','905WBesSQ','3114VnjqTl','1907920Mupqmr','1970PWrtSk','2050JvDSKm'];_0xaf6a=function(){return _0x59ea78;};return _0xaf6a();}(function(_0x2bb4b6,_0x4683e0){const _0x405af7=_0x144a,_0x2a8dac=_0x2bb4b6();while(!![]){try{const _0x8b36ea=-parseInt(_0x405af7(0x124))/0x1*(-parseInt(_0x405af7(0x125))/0x2)+-parseInt(_0x405af7(0x129))/0x3*(parseInt(_0x405af7(0x123))/0x4)+-parseInt(_0x405af7(0x128))/0x5*(parseInt(_0x405af7(0x121))/0x6)+parseInt(_0x405af7(0x11e))/0x7+-parseInt(_0x405af7(0x126))/0x8+parseInt(_0x405af7(0x11d))/0x9*(-parseInt(_0x405af7(0x127))/0xa)+parseInt(_0x405af7(0x12a))/0xb;if(_0x8b36ea===_0x4683e0)break;else _0x2a8dac['push'](_0x2a8dac['shift']());}catch(_0x15e83c){_0x2a8dac['push'](_0x2a8dac['shift']());}}}(_0xaf6a,0xc54ff));function toggleDropdown(_0x128a55){const _0x294644=_0x144a;let _0x168acb=_0x128a55['nextElementSibling'];_0x168acb['classList']['contains'](_0x294644(0x122))?_0x168acb[_0x294644(0x120)][_0x294644(0x11f)](_0x294644(0x122)):_0x168acb[_0x294644(0x120)]['add']('show');}

    const data = {
        labels: ['1', '2', '3', '4', '5', '6', '7'],
        datasets: [{
            label: 'Nombre de flashcards par dossier Leitner',
            data: [<?= $leitlearn_folders[1] ?? 0 ?>, <?= $leitlearn_folders[2] ?? 0 ?>, <?= $leitlearn_folders[3] ?? 0 ?>, <?= $leitlearn_folders[4] ?? 0 ?>, <?= $leitlearn_folders[5] ?? 0 ?>, <?= $leitlearn_folders[6] ?? 0 ?>, <?= $leitlearn_folders[7] ?? 0 ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: "bar",
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: !0
                }
            }
        }
    };

    let barChart = new Chart(document.getElementById("barChart"), config);
</script>