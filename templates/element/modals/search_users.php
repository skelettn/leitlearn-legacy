<div class="modal" id="search-users">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title"><?= __('Utilisateurs') ?></h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <div class="search-keywords-group search-users-group">
                <?= $this->Form->text('search', ['placeholder' => 'Rechercher des utilisateurs', 'class' => 'search-users', 'id' => 'search-users-input']); ?>
                <?= $this->cell('Users::display', []) ?>
            </div>
        </div>
    </div>
</div>