<div class="item-header">
    <div class="item-flex">
        <h2><?= __('Mes paquets') ?></h2>
        <ul class="header-actions">
            <li class="action active modal-btn" data-modal="create-packet">
                            <span class="material-symbols-rounded">
                            add
                        </span>
            </li>
            <li class="action modal-btn" data-modal="import-packet">
                            <span class="material-symbols-rounded">
                            upload_file
                        </span>
            </li>
        </ul>
    </div>
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
    <?= $cell = $this->cell('Packets::display_refreshed', ['my', $user_data["id"], 'dashboard']) ?>
</div>