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
            <?= $this->element('windows/decks'); ?>
            <?= $this->element('modals/refreshed/create_packet'); ?>
            <?= $this->element('modals/refreshed/import_packet'); ?>
        </div>
        <div class="grid-item grid-feed panel-center">
            <?= $this->element('windows/feed'); ?>
        </div>
        <div class="panel-right">
            <div class="grid-item grid-actions panel-right-top">
                <?= $this->element('windows/me'); ?>
            </div>
            <div class="grid-item grid-stats panel-right-bottom">
                <?= $this->element('windows/statistics'); ?>
            </div>
        </div>
    </div>
</main>