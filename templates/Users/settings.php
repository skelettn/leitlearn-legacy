<?php
$this->assign('title', 'Paramètres de compte');
?>
<main>
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <section>
            <div class="section-header">
                <h1 class="title part-title"><?= __('Mon Compte') ?></h1>
            </div>
            <div class="infos general">
                <h5 class="infos-title">
                    <?= __('Mes informations générales') ?>
                    <button class="edit modal-btn" data-modal="update-userdata">
                        <span class="material-symbols-rounded">
                            edit
                        </span>
                    </button>
                </h5>
                <div class="info-picture">
                    <?= $this->Html->image('/img/user_profile_pic/' . $user_data['profile_picture'], ['class' => 'avatar']) ?>
                </div>
                <div class="info">
                    <p><?= __('Nom')?></p>
                    <p><?= $user_data['last_name'] ?></p>
                </div>
                <div class="info">
                    <p><?=__('Prénom')?></p>
                    <p><?= $user_data['name'] ?></p>
                </div>
                <div class="info">
                    <p><?=__('Nom d\'utilisateur')?></p>
                    <p><?= $user_data['username'] ?></p>
                </div>
                <div class="info">
                    <p><?= __('Genre')?></p>
                    <p><?= $user_data['gender'] === 'M' ? __('Homme') : ($user_data['gender'] === 'W' ? __('Femme') : __('Non renseigné')); ?></p>
                </div>
                <div class="info">
                    <p>UID</p>
                    <p><?= $user_data['user_uid'] ?></p>
                </div>
            </div>
            <div class="infos general">
                <h5 class="infos-title"><?= __('Mes coordonnées') ?></h5>
                <div class="info">
                    <p><?=__('Adresse email')?></p>
                    <p><?= $user_data['email'] ?></p>
                </div>
            </div>
            <div class="infos general">
                <h5 class="infos-title"><?= __('Sécurité') ?></h5>
                <div class="info modal-btn" data-modal="update-user-password">
                    <p><?= __('Mot de passe')?></p>
                    <p>•••••••••••••••</p>
                </div>
                <div class="info">
                    <p><?= __('Suppression de compte') ?></p>
                    <?= $this->Form->postLink(
                        '<button type="submit">' . __('Supprimer')
                        . '</button>',
                        ['controller' => 'Users', 'action' => 'delete'],
                        [
                            'confirm' => 'Êtes-vous sur de vouloir supprimer votre compte ?',
                            'escapeTitle' => false,
                        ]
                    ) ?>
                </div>
            </div>
        </section>
    </div>
</main>
