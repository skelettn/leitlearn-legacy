<div class="modal" id="import-packet">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title"><?= __('Importer un paquet') ?></h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">close</span>
            </div>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Packets', 'action' => 'importViaFile'], 'enctype' => 'multipart/form-data']) ?>
            <div class="input-group">
                <?= $this->Form->text('name', ['placeholder' => '', 'required' => true]) ?>
                <?= $this->Form->label('name', __('Nom du paquet')) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text('description', ['placeholder' => '', 'required' => true]) ?>
                <?= $this->Form->label('description', __('Description du paquet')) ?>
            </div>
            <div class="leitlearn_import_paquet_via_file">
                <label for="uploaded_packet">
                    <div class="icon">
                        <span class="material-symbols-rounded">
                            upload_file
                        </span>
                    </div>
                    <h3 class="title"><?= __('Parcourir les fichiers') ?></h3>
                    <span class="supported"><?= __('Types de fichiers pris en charge : .csv, .apkg (Anki)') ?></span>
                </label>
                <?= $this->Form->file('uploaded_file', ['name' => 'uploaded_file', 'id' => 'uploaded_packet', 'accept' => '.csv, .apkg']) ?>
            </div>
            <?= $this->Form->hidden('ia', ['value' => 0]); ?>
            <div class="loader-button">
                <?= $this->Form->submit(__('Importer le paquet')) ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>