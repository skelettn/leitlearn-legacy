<?php
$this->assign('title', $packet->name);
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <div class="packet-header">
            <h1 class="title">
                <?= $packet->name ?>
                <sup>ID: <?= $packet->id ?></sup>
            </h1>
            <div class="actions" id="play-actions-btn">
                <?php if ($is_my_packet) : ?>
                    <?= $this->Html->link(
                        '<span class="material-symbols-rounded">tune</span>',
                        '/packets/settings/' . $packet->id,
                        ['class' => 'action play-hidden', 'escapeTitle' => false],
                    ) ?>
                    <?php if($flashcards_numb != 0) : ?>
                    <button class="action play hidden" id="btn-retour">
                        Retour au paquet
                        <span class="material-symbols-rounded">
                            web_traffic
                        </span>
                    </button>
                    <button class="action play btnPlay <?= $handlePlayBtn ?>" id="btn-play">
                        Lancer
                        <span class="material-symbols-rounded">
                            arrow_selector_tool
                        </span>
                    </button>
                    <p class="<?= $handleRemainingTime ?>" id="remainingTime"></p>
                    <?php endif; ?>
                <?php elseif (!$is_my_packet && !$is_private) : ?>
                    <?= $this->Form->postLink(
                        '<button class="action play">
                                Importer le paquet
                                <span class="material-symbols-rounded">
                                      cloud_upload
                                </span>
                              </button>',
                        ['controller' => 'Packets', 'action' => 'import', $packet->id],
                        [
                            'confirm' => 'Êtes-vous sur de vouloir importer le paquet ?',
                            'escapeTitle' => false,
                        ]
                    ) ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if($flashcards_numb != 0) : ?>
        <section>
            <h2 class="section-title" id="title-game">Visualisation du jeu</h2>
            <div class="containerGame">
                <div class="game" id="game-visu">
                    <div class="progress">
                        <progress value="0" max="100" id="progressBar"></progress>
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
                                    <?php
                                    if ($flashcard->media != null) :
                                        $ext = pathinfo($flashcard->media, PATHINFO_EXTENSION);
                                        if (strtolower($ext) === 'mp3') :
                                            echo '<audio controls src="' . $flashcard->media . '"></audio>';
                                        elseif (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) :
                                            echo '<img src="https://static.leitlearn.com/img/market.jpg" alt="Media">';
                                        else :
                                            echo 'Le type du fichier n\'est pas pris en charge ou n\'est ni un MP3 ni une image.';
                                        endif;
                                    endif;
                                    ?>
                                </div>
                                <div class="card-back">
                                    <div class="content-flashcard">
                                        <p><?= $flashcard->question ?></p>
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
                            <p>Vous avez terminé 🎉 🥳</p>
                        </div>
                        <div class="card-back">
                            <p>Vous avez terminé 🎉 🥳</p>
                        </div>
                    </div>
                    <div class="actions-btn">
                        <div class="action-btn next change-card" id="btn-visu-prev" data-change-card="-1">
                            <span class="material-symbols-rounded">
                                chevron_left
                            </span>
                        </div>
                        <div class="action-btn next hidden" id="btn-valid">
                            <span class="material-symbols-rounded">
                                check
                            </span>
                        </div>
                        <div class="action-btn">
                            <span class="material-symbols-rounded">
                                screen_rotation
                            </span>
                        </div>
                        <div class="action-btn">
                            <span class="material-symbols-rounded">
                                volume_up
                            </span>
                        </div>
                        <div class="action-btn next hidden" id="btn-echec">
                            <span class="material-symbols-rounded">
                                close
                            </span>
                        </div>
                        <div class="action-btn previus change-card" id="btn-visu-next" data-change-card="1">
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
                Cartes
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
                <?php if($flashcards_numb == 0) : ?>
                    <span>Vous n'avez aucune carte.</span>
                <?php endif; ?>
                <?php foreach ($packet->flashcards as $flashcard) : ?>
                    <div class="flashcard" data-flashCard-id="<?= $flashcard->id ?>">
                        <div class="time-remaining">
                            <span class="material-symbols-rounded">
                                schedule
                            </span>
                            Jouable dans..
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
                            <div class="question"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Le contenu de la flashcard est verrouillé</div>
                        <?php endif; ?>
                        <?php if ($is_my_packet) : ?>
                            <div class="flashcard-actions">
                                <div class="flashcard-action dropdown">
                                    <span class="material-symbols-rounded" onclick="toggleDropdown(this)">
                                        more_vert
                                    </span>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li>
                                                <span class="material-symbols-rounded">
                                                    edit_note
                                                </span>
                                                Modifier la carte
                                            </li>
                                            <li class="delete">
                                                <?= $this->Form->postLink(
                                                    '
                                                    <span class="material-symbols-rounded">
                                                        remove
                                                    </span>
                                                    Supprimer la carte',
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

        <?php if ($is_my_packet &&  $flashcards_numb != 0) : ?>
            <section class="play-hidden charts">
                <h2 class="section-title">Visualisation de l'avancement</h2>
                <canvas id="barChart"></canvas>
            </section>
            <section class="play-hidden">
                <h2 class="section-title">Paramètres de jeu</h2>
                <div class="algorithm">
                    <div class="icon"></div>
                    <div class="text">
                        <p>Méthode par répétition (Leitner)</p>
                        <span>Algorithme pour apprendre sur une longue période. Basé sur la méthode de Leitner cette méthode vous permet d'apprendre en 7 jours vos cartes efficacement.</span>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <section class="play-hidden">
            <h2 class="section-title">Informations</h2>
            <div class="creator-infos">
                <div class="information made-by">
                    <div class="data">
                        <span>Nombre de flashcards</span>
                        <strong><?= count($packet->flashcards) ?></strong>
                    </div>
                </div>
                <div class="information made-by">
                    <div class="data">
                        <span>Crée le</span>
                        <strong>le <?= date('d', strtotime($packet->dateCreation)) . ' ' . [
                                        '01' => 'janvier', '02' => 'février', '03' => 'mars', '04' => 'avril',
                                        '05' => 'mai', '06' => 'juin', '07' => 'juillet', '08' => 'août',
                                        '09' => 'septembre', '10' => 'octobre', '11' => 'novembre', '12' => 'décembre',
                                    ][date('m', strtotime($packet->dateCreation))] . ' ' . date('Y', strtotime($packet->dateCreation)) ?></strong>
                    </div>
                </div>
                <div class="information">
                    <?= $this->Html->image('/img/user_profile_pic/' . $creator->profile_picture, ['class' => 'profile-picture avatar']) ?>
                    <div class="data made-by">
                        <span>Crée par</span>
                        <strong><?= $creator->username ?></strong>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    function toggleDropdown(button) {
        var dropdownContent = button.nextElementSibling;
        if (dropdownContent.classList.contains('show')) {
            dropdownContent.classList.remove('show');
        } else {
            dropdownContent.classList.add('show');
        }
    }
</script>

<script>
    var currentDate, lastRevisionDate, nextRevisionDate, timeDiff, secondsRemaining, secondsRemainingFinal, hoursRemaining, minutesRemaining, remainingTimeElement;
    const remainingTime = document.querySelector("#remainingTime");

    if (remainingTime) {
        function updateRemainingTime() {
            currentDate = new Date();
            lastRevisionDate = new Date('<?= addslashes($date) ?>')
            nextRevisionDate = new Date(lastRevisionDate);
            nextRevisionDate.setDate(lastRevisionDate.getDate());

            timeDiff = nextRevisionDate.getTime() - currentDate.getTime();


            if (timeDiff < 0) {
                nextRevisionDate.setDate(nextRevisionDate.getDate());
                timeDiff = nextRevisionDate.getTime() - currentDate.getTime();
            }

            secondsRemaining = Math.floor(timeDiff / 1000);
            secondsRemainingFinal = secondsRemaining % 60;
            hoursRemaining = Math.floor(secondsRemaining / 3600);
            minutesRemaining = Math.floor((secondsRemaining % 3600) / 60);

            remainingTimeElement = document.getElementById('remainingTime');

            remainingTimeElement.textContent = hoursRemaining + 'H ' + minutesRemaining + 'min ' + secondsRemainingFinal + 's';
        }

        setInterval(updateRemainingTime, 1000);
        updateRemainingTime();
    }

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
    var barChart = new Chart(document.getElementById("barChart"), config);
</script>