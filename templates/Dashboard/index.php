<?php
$this->assign('title', 'Mon dashboard');
?>
<main class="dashboard-container">
    <div class="new-ui">
        <div class="switch-container">
            <h5 class="action-name"><?= __('Activer la nouvelle interface') ?></h5>
            <?= $this->Form->postLink(
                '<label class="switch">
                    <input type="checkbox" name="status">
                    <span></span>
                </label>',
                ['controller' => 'Dashboard', 'action' => 'enableNewUi'],
                [
                    'escapeTitle' => false,
                ]
            ) ?>
        </div>
    </div>
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
            <?= $this->cell('Friends::display', [$user_data['id']]) ?>
        </section>
        <section class="new">
            <h2 class="part-title"><?= __('Découvrez les nouveautés') ?></h2>
            <div class="features">
                <div class="feature">
                    <div class="media" style="background-image: url('/img/leitlearn_2_landing.gif');"></div>
                    <div class="data">
                        <h4 class="title"><?= __('Importation de paquets') ?></h4>
                        <p class="desc"><?= __('Vous pouvez désormais importer facilement des paquets de données via des fichiers CSV et des fichiers Anki.') ?></p>
                    </div>
                </div>
                <div class="feature">
                    <div class="media" style="background-image: url('/img/leitlearn_2_landing.gif');"></div>
                    <div class="data">
                        <h4 class="title"><?= __('Relations') ?></h4>
                        <p class="desc"><?= __('Nouveau système d\'amis, rendant la connexion et le partage avec la communauté plus simple que jamais.') ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>