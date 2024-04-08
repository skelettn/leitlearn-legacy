<?php
$this->assign('title', 'Session');
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <div class="packet-header">
            <h1 class="title">
                <?= $packet->name ?>
            </h1>
            <div class="actions" id="play-actions-btn">
                <?= $this->Html->link(
                    'Retour <span class="material-symbols-rounded">undo</span>',
                    '/deck/' . $packet->packet_uid,
                    [
                        'class' => 'action play btnPlay ',
                        'escapeTitle' => false,
                        'id' => 'btn-play',
                    ]
                ) ?>

            </div>
        </div>
        <section>
            <h2 class="session-title" id="title-game">Session en cours</h2>
            <div class="overview-container">
                <div class="overview" id="game-visu-session" data-idPacket = <?= $packet->id ?>>
                    <div class="progress">
                        <progress value="0" max="100" id="progressBar-session"></progress>
                    </div>
                    <?php
                    $firstCard = true;
                    foreach ($flashcards as $flashcard) :
                        ?>
                        <div class="card <?= $firstCard ? 'active' : '' ?> flipped-card" data-idFlashcard = <?= $flashcard->id ?>>
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
                    <div class="actions-btn" id="actions-btn">
                        <div class="action-btn " id="btn-fail">
                                <span class="material-symbols-rounded">
                                    close
                                </span>
                        </div>
                        <?= $this->cell('FeatureFlags::display', ['deck_session_features_experiment']) ?>
                        <div class="action-btn" id="btn-valid">
                                <span class="material-symbols-rounded">
                                    check
                                </span>
                        </div>
                    </div>
                </div>
                <div class="game-text-area" id="game-text-area">
                    <textarea name="" id="input-text-area"></textarea>
                </div>
            </div>
        </section>
    </div>
</main>