<div class="modal" id="create-flashcard">
    <div class="modal-container wider">
        <div class="modal-header">
            <h2 class="title"><?= __('Créer une flashcard') ?></h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Flashcards', 'action' => 'create', $packet->id]]); ?>
            <div class="input-group front">
                <span class="title"><?= __('Recto de la carte') ?></span>
                <div class="text-area" id="editor-flashcard-front"></div>
                <?= $this->Form->control('question', ['id' => 'question', 'type'=>'hidden']) ?>
            </div>
            <div class="input-group back">
                <span class="title"><?= __('Verso de la carte') ?></span>
                <div class="text-area" id="editor-flashcard-back"></div>
                <?= $this->Form->control('answer', ['id' => 'answer', 'type'=>'hidden']) ?>
            </div>
            <div class="loader-button">
                <?= $this->Form->submit(__('Créer')) ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
