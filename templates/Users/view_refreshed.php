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
        <div class="grid-item grid-feed panel-left">
            <div class="item-header">
                <h2><?= __('Paquets') ?></h2>
                <div class="filters">
                    <div class="filter active" data-filter-action="all">
                        <h5><?= __('Tous') ?></h5>
                    </div>
                    <div class="filter" data-filter-action="0">
                        <h5><?= __('Privés') ?></h5>
                    </div>
                    <div class="filter" data-filter-action="2">
                        <h5><?= __('Amis uniquement') ?></h5>
                    </div>
                    <div class="filter" data-filter-action="ai">
                        <h5><?= __('IA') ?></h5>
                    </div>
                </div>
            </div>
            <div class="item-decks">
                <?= $this->cell('Packets::display_refreshed', ['my', $user->id, 'dashboard']) ?>
            </div>
        </div>
        <div class="grid-item grid-packets panel-center">
            <?= $this->element('windows/profile'); ?>
            <?= $this->element('modals/refreshed/update_user'); ?>
        </div>
        <div class="panel-right">
            <div class="grid-item grid-actions panel-right-top">
                <?= $this->element('windows/friends'); ?>
                <?= $this->element('modals/refreshed/search_users') ?>
            </div>
            <div class="grid-item grid-stats panel-right-bottom">
                <?= $this->element('windows/statistics'); ?>
            </div>
        </div>
    </div>
</main>