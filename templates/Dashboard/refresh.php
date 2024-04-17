<main class="refresh">
    <div class="refresh-grid">
        <div class="grid-item grid-packets panel-left">
            <div class="item-header">
                <h2>Mes paquets</h2>
                <div class="filters">
                    <div class="filter active">
                        <h5>En ligne</h5>
                    </div>
                    <div class="filter">
                        <h5>Privés</h5>
                    </div>
                    <div class="filter">
                        <h5>Amis uniquement</h5>
                    </div>
                    <div class="filter">
                        <h5>IA</h5>
                    </div>
                </div>
            </div>
            <div class="item-decks">
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <div class="deck">
                        <div class="deck-header">
                            <div class="deck-data">
                                <div class="creator">
                                    <?= $this->Html->image('/img/user_profile_pic/'. $user_data['profile_picture'], ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
                                    <h6 class="name"><?= $user_data['username'] ?></h6>
                                </div>
                                ⋅
                                <div class="flashcards">
                                    <h6 class="count">0</h6>
                                    <span>flashcards</span>
                                </div>
                            </div>
                        </div>
                        <h4 class="deck-name">Deck Name</h4>
                    </div>
                <?php endfor ?>
            </div>
        </div>
        <div class="grid-item grid-feed panel-center">
            <div class="item-header">
                <h2>Feed</h2>
            </div>
            <div class="item-body">
                <div class="go-back">
                    <?= $this->Html->image('/img/leitlearn-come-back-later.png', ['alt' => 'Please come back later.']) ?>
                    <h4><?= __('Merci de revenir plus tard.') ?></h4>
                </div>
            </div>
        </div>
        <div class="panel-right">
            <div class="grid-item grid-stats panel-right-top">
                <div class="item-header">
                    <h2>Statistiques</h2>
                </div>
                <div class="item-body">
                    <div class="go-back">
                        <?= $this->Html->image('/img/leitlearn-come-back-later.png', ['alt' => 'Please come back later.']) ?>
                        <h4><?= __('Merci de revenir plus tard.') ?></h4>
                    </div>
                </div>
            </div>
            <div class="grid-item grid-actions panel-right-bottom">
                <div class="item-header">
                    <h2>Moi (<?= $user_data['username'] ?>)</h2>
                </div>
            </div>
        </div>
    </div>
</main>