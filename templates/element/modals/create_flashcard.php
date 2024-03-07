<div class="modal" id="create-flashcard">
    <div class="modal-container wider">
        <div class="modal-header">
            <h2 class="title">Créer une flashcard</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Flashcards', 'action' => 'create']]); ?>
            <?php echo $this->Form->hidden('packet_id', ['value' => $packet->id]); ?>
            <div class="input-group front">
                <?= $this->Form->textarea('question', ['id' => 'create-flashcard-question', 'placeholder' => '']) ?>
                <?= $this->Form->label('create-flashcard-question', 'Recto de la carte') ?>
            </div>
            <div class="btn-group-front">
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        add_photo_alternate
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        video_library
                    </span>
                </div>

                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        stylus_note
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        select
                    </span>
                </div>
                <div class="separator"></div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_bold
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_italic
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_underlined
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        strikethrough_s
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        title
                    </span>
                </div>
                <div class="separator"></div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_list_bulleted
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_list_numbered
                    </span>
                </div>
            </div>
            <div class="input-group back">
                <?= $this->Form->textarea('answer', ['id' => 'create-flashcard-answer', 'placeholder' => '']) ?>
                <?= $this->Form->label('create-flashcard-answer', 'Verso de la carte') ?>
            </div>
            <div class="btn-group-front">
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        add_photo_alternate
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        video_library
                    </span>
                </div>

                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        stylus_note
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        select
                    </span>
                </div>
                <div class="separator"></div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_bold
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_italic
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_underlined
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        strikethrough_s
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        title
                    </span>
                </div>
                <div class="separator"></div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_list_bulleted
                    </span>
                </div>
                <div class="btn-flashcard-options">
                    <span class="material-symbols-outlined">
                        format_list_numbered
                    </span>
                </div>
            </div>

            <div class="loader-button">
                <?= $this->Form->submit('Créer') ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
