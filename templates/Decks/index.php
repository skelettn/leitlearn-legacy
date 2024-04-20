<main class="refresh">
    <div class="refresh-grid">
        <div class="grid-item grid-feed panel-left">
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
        <div class="grid-item grid-packets panel-center">
            <?= $this->element('windows/decks'); ?>
            <?= $this->element('modals/refreshed/create_packet'); ?>
            <?= $this->element('modals/refreshed/import_packet'); ?>
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