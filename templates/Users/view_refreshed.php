<?php
$this->assign('title', 'Mon profil');
if ($user->user_uid != $user_data['user_uid']) {
    $this->assign('title', 'Profil de ' . $user->username);
}
?>
<main class="refresh">
    <div class="new-ui">
        <div class="switch-container">
            <h5 class="action-name"><?= __('Activer la nouvelle interface') ?></h5>
            <?= $this->Form->postLink(
                '<label class="switch">
                    <input type="checkbox" name="status"' . ($this->request->getSession()->check('leitlearn_2_new_ui_enabled') ? ' checked' : '') . '>
                    <span></span>
                </label>',
                ['controller' => 'Dashboard', 'action' => 'enableNewUi'],
                [
                    'escapeTitle' => false,
                ]
            ) ?>
        </div>
    </div>
    <div class="refresh-grid">
        <div class="grid-item grid-packets panel-left">
            <div class="item-header">
                <div class="item-flex">
                    <?php if ($user->user_uid === $user_data['user_uid']) : ?>
                        <h2>Mon profil</h2>
                        <ul class="header-actions">
                            <li class="action active modal-btn" data-modal="update-userdata">
                                <span class="material-symbols-rounded">
                                    edit
                                </span>
                            </li>
                            <?= $this->Html->link(
                                '<li class="action">
                                    <span class="material-symbols-rounded">
                                        settings
                                    </span>
                                </li>',
                                '/settings',
                                ['escapeTitle' => false]
                            ); ?>
                        </ul>
                    <?php else : ?>
                    <h2>Profil de <?= $user->username ?></h2>
                    <?php endif; ?>
                </div>
            </div>
            <div class="item-body">
                <div class="user">
                    <?= $this->Html->image('/img/user_profile_pic/'. $user->profile_picture, ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
                    <h3 class="name"><?= $user->username ?></h3>
                </div>
                <?php if (is_null($relation)) : ?>
                    <?php if ($user->user_uid != $user_data['user_uid']) : ?>
                        <div class="actions">
                            <?= $this->Form->postLink(
                                ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_add
                                        </span>' .
                                __('Ajouter en amis') .

                                '</button>',
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
                                        </span>' .
                                    __('Accepter la demande en amis')
                                    . '
                                    </button>',
                                    ['controller' => 'Friends', 'action' => 'accept', $user->user_uid],
                                    ['escapeTitle' => false,]
                                ) ?>
                                <?= $this->Form->postLink(
                                    ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_remove
                                        </span>' .
                                    __('Refuser la demande en amis')
                                    . '
                                 
                                    </button>',
                                    ['controller' => 'Friends', 'action' => 'delete', $user->user_uid],
                                    ['escapeTitle' => false,]
                                ) ?>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="friend-status">
                            <?= __('Vous êtes amis ensemble.') ?>
                        </div>
                        <div class="actions">
                            <?= $this->Form->postLink(
                                ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_remove
                                        </span>' .
                                __('Supprimer des amis') .
                                '</button>',
                                ['controller' => 'Friends', 'action' => 'delete', $user->user_uid],
                                ['escapeTitle' => false,]
                            ) ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="go-back">
                    <?= $this->Html->image('/img/leitlearn-come-back-later.png', ['alt' => 'Please come back later.']) ?>
                    <h4><?= __('Merci de revenir plus tard.') ?></h4>
                </div>
            </div>
            <?= $this->element('modals/refreshed/update_user'); ?>
        </div>
        <div class="grid-item grid-feed panel-center">
            <div class="item-header">
                <h2>Paquets</h2>
                <div class="filters">
                    <div class="filter active" data-filter-action="all">
                        <h5>Tous</h5>
                    </div>
                    <div class="filter" data-filter-action="0">
                        <h5>Privés</h5>
                    </div>
                    <div class="filter" data-filter-action="2">
                        <h5>Amis uniquement</h5>
                    </div>
                    <div class="filter" data-filter-action="ai">
                        <h5>IA</h5>
                    </div>
                </div>
            </div>
            <div class="item-decks">
                <?= $this->cell('Packets::display_refreshed', ['my', $user->id, 'dashboard']) ?>
            </div>
        </div>
        <div class="panel-right">
            <div class="grid-item grid-actions panel-right-top">
                <div class="item-header">
                    <div class="item-flex">
                        <?php if ($user->user_uid === $user_data['user_uid']) : ?>
                            <h2>Amis</h2>
                            <ul class="header-actions">
                                <li class="action active modal-btn" data-modal="search-users">
                                    <span class="material-symbols-rounded">
                                    add
                                </span>
                                </li>
                            </ul>
                        <?php else : ?>
                            <h2>Amis</h2>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="item-body">
                    <?= $this->cell('Friends::display', [$user->id]) ?>
                </div>
                <?= $this->element('modals/refreshed/search_users') ?>
            </div>
            <div class="grid-item grid-stats panel-right-bottom">
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
        </div>
    </div>
</main>