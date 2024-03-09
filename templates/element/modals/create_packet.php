<div class="modal" id="create-packet">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title">Créer un paquet</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Packets', 'action' => 'create'], 'type' => 'file']) ?>
            <div class="input-group">
                <?= $this->Form->text('name', ['id' => 'create-name', 'placeholder' => '', 'required' => true]) ?>
                <?= $this->Form->label('create-name', 'Nom du paquet') ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text('description', ['id' => 'create-description', 'placeholder' => '', 'required' => true]) ?>
                <?= $this->Form->label('create-description', 'Description du paquet') ?>
            </div>
            <div class="search-keywords-group">
                <?= $this->Form->text('search', ['placeholder' => 'Recherche de mots clés', 'class' => 'search-keywords']); ?>
                <?= $this->cell('Keywords::selected', []) ?>
            </div>
            <?= $this->Form->hidden('ia', ['value' => 0]); ?>
            <div class="loader-button">
                <?= $this->Form->submit('Créer le paquet',) ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>