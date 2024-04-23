<?php
$this->assign('title', 'Inscription');
echo $this->Html->link(
    $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_2_logo.webp', ['class' => 'fixed-logo-left', 'alt' => 'Leitlearn 2']),
    '/home',
    ['escape' => false]
);
?>
<main>
    <div class="auth-content">
        <h1>Démarrez sur Leitlearn</h1>
        <p>Accédez à l’intégralité de nos services en vous connectant dès maintenant. Profitez d’une expérience personnalisée et tirez le meilleur parti de toutes les fonctionnalités exclusives offertes aux membres de notre communauté.</p>    </div>
    <div class="auth-form">
        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'register']]) ?>
        <div class="auth-form-header">
            <h3><?= __('Rejoignez Leitlearn') ?></h3>
            <p>
                <?= $this->Html->link(
                    __('Déjà un compte ? <span>Connectez-vous</span>'),
                    '/users/login',
                    ['escape' => false]
                ) ?>
            </p>
        </div>
        <div class="auth-form-body">
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
        </div>
        <div class="auth-form-submit">
            <div class="loader-button">
                <?= $this->Form->submit(__('S\'inscrire')) ?>
                <span class="loader"></span>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</main>