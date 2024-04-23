<?php
$this->assign('title', 'Connexion');
echo $this->Html->link(
    $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_2_logo.webp', ['class' => 'fixed-logo-left', 'alt' => 'Leitlearn 2']),
    '/home',
    ['escape' => false]
);
?>
<main>
    <div class="auth-content">
        <h1>Démarrez sur Leitlearn</h1>
        <p>Accédez à l’intégralité de nos services en vous connectant dès maintenant. Profitez d’une expérience personnalisée et tirez le meilleur parti de toutes les fonctionnalités exclusives offertes aux membres de notre communauté.</p>
    </div>
    <div class="auth-form">
        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
            <div class="auth-form-header">
                <h3><?= __('Rejoignez Leitlearn') ?></h3>
                <p>
                    <?= $this->Html->link(
                        __('Pas de compte ? <span>Inscrivez-vous</span>'),
                        '/users/register',
                        ['escape' => false]
                    ) ?>
                </p>
            </div>
            <div class="auth-form-body">
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