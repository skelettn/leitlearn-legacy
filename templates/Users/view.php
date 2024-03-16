<?php
$this->assign('title', 'Mon profil');
if ($user->user_uid != $user_data['user_uid']) {
    $this->assign('title', 'Profil de '.$user->username);
}
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <div class="profile">
            <div class="profile-data">
                <div class="personal-infos">
                    <div class="info">
                        <span class="name"><?= $user->name ?> <?= $user->last_name ?></span>
                        <span class="username">@<?= $user->username ?></span>
                        <div class="stats">
                            <?= $cell = $this->cell('Users::display_public_data', [$user->id]) ?>
                        </div>
                    </div>
                    <?php
                    if (is_null($relation)) : ?>
                        <?php if ($user->user_uid != $user_data['user_uid']) : ?>
                            <div class="actions">
                                <?= $this->Form->postLink(
                                    ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_add
                                        </span>
                                        Ajouter en amis
                                    </button>',
                                    ['controller' => 'Friends', 'action' => 'request', $user->user_uid],
                                    ['escapeTitle' => false,]
                                ) ?>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if ($relation->status == 'pending') : ?>
                            <?php if ($relation->recipient_id == $user_data['id']) : ?>
                                <div class="actions">
                                    <?= $this->Form->postLink(
                                        ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_add
                                        </span>
                                        Accepter la demande en amis
                                    </button>',
                                        ['controller' => 'Friends', 'action' => 'accept', $user->user_uid],
                                        ['escapeTitle' => false,]
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_add
                                        </span>
                                        Refuser la demande en amis
                                    </button>',
                                        ['controller' => 'Friends', 'action' => 'delete', $user->user_uid],
                                        ['escapeTitle' => false,]
                                    ) ?>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="status">
                                Vous êtes amis ensemble.
                            </div>
                            <div class="actions">
                                <?= $this->Form->postLink(
                                    ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_add
                                        </span>
                                       Supprimer des amis
                                    </button>',
                                    ['controller' => 'Friends', 'action' => 'delete', $user->user_uid],
                                    ['escapeTitle' => false,]
                                ) ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?= $this->Html->image('/img/user_profile_pic/' . $user->profile_picture, ['class' => 'logo']) ?>
            </div>
        </div>
        <section class="section-packets profile-packets">
            <div class="section-header profile">
                <h2 class="paquet-title">
                    Paquets
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
                    <?= $cell = $this->cell('Packets::display', ['my_no_ia', $user->id, 'dashboard']) ?>
                </div>
            </div>
        </section>
        <section class="section-packets profile-packets">
            <div class="section-header profile">
                <h2 class="paquet-title">
                    Réservés aux amis
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
                    <?= $cell = $this->cell('Packets::protected', [$user->id, 'dashboard']) ?>
                </div>
            </div>
        </section>
        <section class="section-packets profile-packets">
            <div class="section-header profile">
                <h2 class="paquet-title">
                    Générés avec l'IA
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
                    <?= $cell = $this->cell('Packets::display', ['my_ia', $user->id, 'dashboard']) ?>
                </div>
            </div>
        </section>
    </div>
</main>