<?php
$this->assign('title', 'Mon dashboard');
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <section>
            <div class="section-header column">
                <h1 class="part-title"><?= __('Mes paquets') ?></h1>
                <ul class="actions">
                    <li class="action active modal-btn" data-modal="create-packet">
                        <?= __('Créer un paquet') ?>
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </li>
                    <li class="action modal-btn" data-modal="import-packet">
                        <?= __('Importer un paquet') ?>
                        <span class="material-symbols-rounded">
                            upload_file
                        </span>
                    </li>
                </ul>
            </div>
            <div class="packets">
                <?= $cell = $this->cell('Packets::display', ['my', $user_data["id"], 'dashboard']) ?>
            </div>
        </section>
        <section>
            <div class="section-header column">
                <h1 class="part-title"><?= __('Mes amis') ?></h1>
                <ul class="actions">
                    <li class="action active modal-btn" data-modal="search-users">
                        <?= __('Ajouter des amis') ?>
                        <span class="material-symbols-rounded">
                            person_add
                        </span>
                    </li>
                </ul>
            </div>
            <?= $this->cell('Friends::display') ?>
        </section>
        <section class="new">
            <h2 class="part-title"><?= __('Découvrez les nouveautés') ?></h2>
            <div class="features">
                <div class="feature">
                    <div class="media" style="background-image: url('/img/andre-hunter-AQ908FfdAMw-unsplash.jpg');"></div>
                    <div class="data">
                        <h4 class="title"><?= __('Suivi') ?></h4>
                        <p class="desc"><?= __('Accédez à votre suivi d\'avancement de chaque paquet directement dans la section statistique du paquet.') ?></p>
                    </div>
                </div>
                <div class="feature">
                    <div class="media" style="background-image: url('/img/andre-hunter-AQ908FfdAMw-unsplash.jpg');"></div>
                    <div class="data">
                        <h4 class="title"><?= __('Marché') ?></h4>
                        <p class="desc"><?= __('Explorez et utilisez les paquets et flashcards créés par d\'autres utilisateurs sur votre espace personnel.') ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>