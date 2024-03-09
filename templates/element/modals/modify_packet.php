<?php
/** @var \App\Model\Entity\Packet $packet */
/** @var \App\Model\Entity\Keyword $keywords */
?>
<div class="modal" id="modify-paquet-modal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title">Modification du paquet</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, [
                    'url' =>
                        [
                            'controller' => 'Packets',
                            'action' => 'modify',
                             $packet->id,
                        ],
                    ]); ?>
            <?= $this->Form->hidden('packet_id', ['value' => $packet->id]); ?>
            <div class="input-group">
                <?= $this->Form->text(
                    'name',
                    [
                        'id' => 'modify-paquet-name',
                        'value' => $packet->name,
                        'placeholder' => '',
                    ]
                ); ?>
                <?= $this->Form->label('modify-paquet-name', 'Nom du paquet') ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text(
                    'description',
                    [
                        'id' => 'modify-paquet-desc',
                        'value' => $packet->description,
                        'placeholder' => '',
                    ]
                ); ?>
                <?= $this->Form->label('modify-paquet-desc', 'Description du paquet') ?>
            </div>
            <div class="search-keywords-group">
                <?= $this->Form->text(
                    'search',
                    [
                        'placeholder' => 'Recherche de mots clés',
                        'class' => 'search-keywords',
                    ]
                ); ?>
                <?= $this->cell('Keywords::selected', [$packet->id]) ?>
            </div>
            <?php if($flashcards_numb != 0): ?>
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" name="public">
                    <span></span>
                </label>
                <span class="action-name">Afficher le paquet sur le marché</span>
            </div>
            <?php endif; ?>
            <div class="loader-button">
                <?= $this->Form->submit('Enregistrer les modifications'); ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>