<?php
$this->assign('title', "Session");
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <section>
            <h2 class="section-title" id="title-game">Session en cours</h2>
            <div class="containerGame">
                <div class="game" id="game-visu">
                    <?php
                    $firstCard = true;
                    foreach ($flashcards as $flashcard) :
                        ?>
                        <div class="card <?= $firstCard ? 'active' : '' ?> flipped-card">
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
                    <div class="actions-btn">

                        <div class="action-btn previus change-card" id="btn-visu-next" data-change-card="1">
                                <span class="material-symbols-rounded">
                                    close
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
                        <div class="action-btn next change-card" id="btn-visu-prev" data-change-card="-1">
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