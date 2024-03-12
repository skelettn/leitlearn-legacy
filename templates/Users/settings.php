<?php
$this->assign('title', 'Paramètres de compte');
?>
<main>
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <h1 class="title part-title">Mon Compte</h1>
        <div class="infos general">
            <h5 class="infos-title">
                Mes informations générales
                <button class="edit modal-btn" data-modal="update-userdata">
                    <span class="material-symbols-rounded">
                        edit
                    </span>
                </button>
            </h5>
            <div class="info-picture">
                <?= $this->Html->image('/img/user_profile_pic/'. $user_data['profile_picture'], ['class' => 'avatar']) ?>
            </div>
            <div class="info">
                <p>Nom</p>
                <p><?= $user_data['last_name'] ?></p>
            </div>
            <div class="info">
                <p>Prénom</p>
                <p><?= $user_data['name'] ?></p>
            </div>
            <div class="info">
                <p>Nom d'utilisateur</p>
                <p><?= $user_data['username'] ?></p>
            </div>
            <div class="info">
                <p>Date de naissance</p>
                <p><?= $user_data['dateBirth'] ?></p>
            </div>
            <div class="info">
                <p>Genre</p>
                <p><?= $user_data['gender'] ?></p>
            </div>
            <div class="info">
                <p>UID</p>
                <p><?= $user_data['user_uid'] ?></p>
            </div>
        </div>
        <div class="infos general">
            <h5 class="infos-title">Mes coordonnées</h5>
            <div class="info">
                <p>Adresse email</p>
                <p><?= $user_data['email'] ?></p>
            </div>
        </div>
        <div class="infos general">

            <h5 class="infos-title">Sécurité</h5>
            <div class="info modal-btn" data-modal="update-user-password">
                <p>Mot de passe</p>
                <p>•••••••••••••••</p>
            </div>
            <div class="info">
                <p>Suppression de compte</p>
                <?= $this->Form->postLink(
                    '<button type="submit">Supprimer</button>',
                    ['controller' => 'Users', 'action' => 'delete'],
                    [
                        'confirm' => 'Êtes-vous sur de vouloir supprimer votre compte ?',
                        'escapeTitle' => false,
                    ]
                ) ?>
            </div>
        </div>
    </div>
</main>
