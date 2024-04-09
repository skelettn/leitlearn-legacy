<?php
$this->assign('title', 'Inscription');
?>
<main>
    <div class="auth-form">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <div class="close page-redirect" data-redirection="/home">
                    <span class="material-symbols-rounded">
                        close
                    </span>
                </div>
                <?= $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_2_logo.webp', ['class' => 'logo', 'alt' => 'Leitlearn 2']) ?>
            </div>
            <div class="auth-form-body">
                <h3 class="title"><?= __('S\'inscrire sur Leitlearn') ?></h3>
                <h5 class="desc"><?= __('Inscrivez-vous pour utiliser toutes les fonctionnalités de Leitlearn') ?></h5>
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'register']]) ?>
                <div class="input-flex">
                    <div class="input-group">
                        <?= $this->Form->text('name', ['id' => 'register-page-name', 'placeholder' => '']) ?>
                        <?= $this->Form->label('register-page-name', __('Prénom')) ?>
                    </div>
                    <div class="input-group">
                        <?= $this->Form->text('last_name', ['id' => 'register-page-lastname', 'placeholder' => '']) ?>
                        <?= $this->Form->label('register-page-lastname', __('Nom de famille')) ?>
                    </div>
                </div>
                <div class="input-group">
                    <?= $this->Form->text('username', ['id' => 'register-page-username', 'placeholder' => '']) ?>
                    <?= $this->Form->label('register-page-username', __("Nom d'utilisateur")) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->email('email', ['id' => 'login-page-email', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-email', __('Adresse e-mail')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->password('password', ['id' => 'login-page-password', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-password', __('Mot de passe')) ?>
                </div>
                <div class="loader-button">
                    <?= $this->Form->submit(__('S\'inscrire')) ?>
                    <span class="loader"></span>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>