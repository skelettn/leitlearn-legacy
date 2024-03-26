<div class="modal" id="modify-flashcard">
    <div class="modal-container wider">
        <div class="modal-header">
            <h2 class="title"><?= __('Modifier la flashcard') ?></h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?php echo $this->Form->create(
                null,
                ['url' => ['controller' => 'Flashcards', 'action' => 'edit', $packet->id]]
            ); ?>
            <?php echo $this->Form->hidden('flashcard_id'); ?>
            <div class="input-group front modify">
                <span class="title">Recto de la carte</span>
                <div class="text-area" id="editor-modify-flashcard-front"></div>
                <?= $this->Form->control('question', ['id' => 'question-modify', 'type' => 'hidden']) ?>
            </div>
            <div class="input-group back modify">
                <span class="title">Recto de la carte</span>
                <div class="text-area" id="editor-modify-flashcard-back"></div>
                <?= $this->Form->control('answer', ['id' => 'answer-modify', 'type' => 'hidden']) ?>
            </div>
            <div class="loader-button">
                <?= $this->Form->submit('Modifier') ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>