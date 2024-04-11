<?php
$this->assign('title', 'Connexion');
?>
<?= $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_2_logo.webp', ['class' => 'fixed-logo-left', 'alt' => 'Leitlearn 2']) ?>
<main>
    <div class="auth-content">
        <h1>Démarrez sur Leitlearn</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium culpa cum dicta dolorem doloremque earum error facere inventore ipsum itaque iure molestiae odit perspiciatis praesentium reiciendis repellendus repudiandae sequi, veniam.</p>
    </div>
    <div class="auth-form">
            <div class="auth-form-header">
                <h3><?= __('Rejoignez Leitlearn') ?></h3>
                <p><?= __('Pas de compte ? Connectez-vous') ?></p>
            </div>
            <div class="auth-form-body">
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
                <div class="input-group">
                    <?= $this->Form->email('email', ['id' => 'login-page-email', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-email', __('Adresse e-mail')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->password('password', ['id' => 'login-page-password', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-password', __('Mot de passe')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->email('email', ['id' => 'login-page-email', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-email', __('Adresse e-mail')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->password('password', ['id' => 'login-page-password', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-password', __('Mot de passe')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->email('email', ['id' => 'login-page-email', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-email', __('Adresse e-mail')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->password('password', ['id' => 'login-page-password', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-password', __('Mot de passe')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->email('email', ['id' => 'login-page-email', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-email', __('Adresse e-mail')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->password('password', ['id' => 'login-page-password', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-password', __('Mot de passe')) ?>
                </div>
            </div>
        <div class="auth-form-submit">
            <div class="loader-button">
                <?= $this->Form->submit(__('Se connecter')) ?>
                <span class="loader"></span>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</main>