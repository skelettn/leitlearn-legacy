<?php
/** @var \App\Model\Entity\Packet $packet */
/** @var \App\Model\Entity\Keyword $keywords */
?>
<div class="modal refreshed-modal" id="update-user-password">
    <div class="modal-container">
        <div class="modal-header">
            <h2><?= __('Modification du mot de passe') ?></h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'updatePassword']]) ?>
        <div class="modal-body">
            <div class="input-group">
                <?= $this->Form->text('current_password', ['id' => 'current-password', 'placeholder' => '', 'required' => true , 'type' => 'password']) ?>
                <?= $this->Form->label('current_password', __('Mot de passe actuel')) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text('new_password', ['id' => 'new-password', 'placeholder' => '', 'required' => true , 'type' => 'password']) ?>
                <?= $this->Form->label('new-password', __('Nouveau mot de passe')) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text('confirm_new_password', ['id' => 'confirm-new-password', 'placeholder' => '', 'required' => true , 'type' => 'password']) ?>
                <?= $this->Form->label('confirm-new-password', __('Confirmez votre nouveau mot de passe')) ?>
            </div>
        </div>
        <div class="modal-form-submit">
            <div class="loader-button">
                <?= $this->Form->submit(__('Modifier le mot de passe')) ?>
                <span class="loader"></span>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
