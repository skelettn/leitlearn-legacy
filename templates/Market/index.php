<?php
$this->assign('title', 'Marché');
?>
<main>
    <div class="container">
        <section class="section-packets me">
            <div class="filter"></div>
            <div class="section-header">
                <div class="profile">
                    <?= $this->Html->image('/img/user_profile_pic/'. $user_data['profile_picture'], ['class' => 'profile-picture']) ?>
                    <div class="text">
                        <span><?= $user_data['username'] ?></span>
                        <h2>Vos paquets</h2>
                    </div>
                </div>
                <div class="scroll-buttons">
                    <button class="prev-button scroll-button">
                        <span class="material-symbols-rounded">
                            chevron_left
                        </span>
                    </button>
                    <button class="next-button scroll-button">
                        <span class="material-symbols-rounded">
                            chevron_right
                        </span>
                    </button>
                </div>
            </div>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display', ['my', $user_data["id"]]) ?>
                </div>
            </div>
        </section>
        <section class="search">
            <div class="search-input">
                <label for="market_search">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                </label>
                <input type="text" name="" id="market_search" placeholder="Rechercher sur Leitlearn">
            </div>
        </section>
        <section class="section-packets">
            <div class="section-header">
                <h2 class="paquet-title">
                    Tendances
                </h2>
                <div class="scroll-buttons">
                    <button class="prev-button scroll-button">
                        <span class="material-symbols-rounded">
                            chevron_left
                        </span>
                    </button>
                    <button class="next-button scroll-button">
                        <span class="material-symbols-rounded">
                            chevron_right
                        </span>
                    </button>
                </div>
            </div>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display', ['trend']) ?>
                </div>
            </div>
        </section>
        <section class="section-packets">
            <div class="section-header">
                <h2 class="paquet-title">
                    Généré avec l'IA
                </h2>
                <div class="scroll-buttons">
                    <button class="prev-button scroll-button">
                    <span class="material-symbols-rounded">
                        chevron_left
                    </span>
                    </button>
                    <button class="next-button scroll-button">
                    <span class="material-symbols-rounded">
                        chevron_right
                    </span>
                    </button>
                </div>
            </div>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display', ['ai']) ?>
                </div>
            </div>
        </section>
        <section>
            <h2 class="paquet-title">Catégories</h2>
            <div class="categories">
                <?= $cell = $this->cell('Keywords::display', []) ?>
            </div>
        </section>
        <section class="section-packets">
            <div class="section-header">
                <h2 class="paquet-title">
                    Les plus importés
                </h2>
                <div class="scroll-buttons">
                    <button class="prev-button scroll-button">
                    <span class="material-symbols-rounded">
                        chevron_left
                    </span>
                    </button>
                    <button class="next-button scroll-button">
                    <span class="material-symbols-rounded">
                        chevron_right
                    </span>
                    </button>
                </div>
            </div>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display', ['import']) ?>
                </div>
            </div>
        </section>
        <?= $this->element('landing_footer') ?>
    </div>
</main>
