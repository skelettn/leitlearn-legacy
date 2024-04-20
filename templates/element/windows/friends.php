<div class="item-header">
    <div class="item-flex">
        <?php if ($user->user_uid === $user_data['user_uid']) : ?>
            <h2><?= __('Amis') ?></h2>
            <ul class="header-actions">
                <li class="action active modal-btn" data-modal="search-users">
                                    <span class="material-symbols-rounded">
                                    add
                                </span>
                </li>
            </ul>
        <?php else : ?>
            <h2><?= __('Amis') ?></h2>
        <?php endif; ?>
    </div>
</div>
<div class="item-body">
    <?= $this->cell('Friends::display', [$user->id]) ?>
</div>