<div class="modal" id="login-modal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title">Connexion</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
            <div class="input-group">
                <?= $this->Form->text('email', ['id' => 'login-email', 'placeholder' => '']) ?>
                <?= $this->Form->label('login-email', 'Adresse e-mail') ?>
            </div>
            <div class="input-group">
                <?= $this->Form->password('password', ['id' => 'login-password', 'placeholder' => '']) ?>
                <?= $this->Form->label('login-password', 'Mot de passe') ?>
            </div>
            <div class="loader-button">
                <?= $this->Form->submit('Se connecter') ?>
                <span class="loader"></span>
            </div>
            <small class="policy">
                En continuant, tu acceptes les <?= $this->Html->link('Conditions d\'utilisation', ['controller' => 'Pages', 'action' => 'terms']) ?> de Leitlearn et confirmes avoir lu les <?= $this->Html->link('Politique de confidentialité', ['controller' => 'Pages', 'action' => 'privacy']) ?> de Leitlearn.
            </small>
            <?= $this->Html->link('Vous n\'avez pas de compte ?', '#', ['class' => 'modal-btn no-account', 'data-modal' => 'register-modal']) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>