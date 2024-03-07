<?php
/** @var \App\Model\Entity\Packet $packet */
/** @var \App\Model\Entity\Keyword $keywords */
?>
<div class="modal" id="update-user-password">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title">Modification du mot de passe</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'updatePassword']]) ?>
            <div class="input-group">
                <?= $this->Form->text('current_password', ['id' => 'current-password', 'placeholder' => '', 'required' => true , 'type' => 'password']) ?>
                <?= $this->Form->label('current_password', 'Mot de passe actuel') ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text('new_password', ['id' => 'new-password', 'placeholder' => '', 'required' => true , 'type' => 'password']) ?>
                <?= $this->Form->label('new-password', 'Nouveau mot de passe') ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text('confirm_new_password', ['id' => 'confirm-new-password', 'placeholder' => '', 'required' => true , 'type' => 'password']) ?>
                <?= $this->Form->label('confirm-new-password', 'Confirmez votre nouveau mot de passe') ?>
            </div>
            <div class="loader-button">
                <?= $this->Form->submit('Modifier le mot de passe', ['name' => 'modify-user-password']) ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
