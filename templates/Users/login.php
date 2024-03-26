<main>
    <div class="auth-form">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <div class="close page-redirect" data-redirection="/home">
                    <span class="material-symbols-rounded">
                        close
                    </span>
                </div>
                <?= $this->Html->image('https://static.leitlearn.com/v2/img/leitlearn_2_logo.webp', ['class' => 'logo', 'alt' => 'Leitlearn 2']) ?>
            </div>
            <div class="auth-form-body">
                <h3 class="title"><?= __('Se connecter à Leitlearn') ?></h3>
                <h5 class="desc"><?= __('Connectez-vous pour utiliser toutes les fonctionnalités de Leitlearn') ?></h5>
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
                <div class="input-group">
                    <?= $this->Form->text('email', ['id' => 'login-page-email', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-email', __('Adresse e-mail')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->password('password', ['id' => 'login-page-password', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-password', __('Mot de passe')) ?>
                </div>
                <?= $this->Form->submit(__('Se connecter')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>