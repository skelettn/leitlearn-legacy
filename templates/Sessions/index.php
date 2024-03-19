<?php
$this->assign('title', "Session");
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <section>
            <h2 class="section-title" id="title-game">Visualisation du jeu</h2>
            <div class="containerGame">
                <div class="game" id="game-visu">
                    <div class="progress">
                        <progress value="0" max="100" id="progressBar"></progress>
                    </div>
                        <div class="card active flipped-card">
                                <div class="card-front">
                                    <div class="content-flashcard">
                                        <p>Question</p>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="content-flashcard">
                                        <p>Réponse</p>
                                    </div>
                                </div>
                        </div>
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