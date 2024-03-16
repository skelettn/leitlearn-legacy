<div class="modal" id="register-modal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title">Créer votre compte</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <div class="features">
                <div class="feature ai">
                    <div class="icon"><?php echo ' <?xml version="1.0" encoding="utf-8"?> <svg fill="#6c6767" width="25px" height="25px" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M208,512a24.84,24.84,0,0,1-23.34-16l-39.84-103.6a16.06,16.06,0,0,0-9.19-9.19L32,343.34a25,25,0,0,1,0-46.68l103.6-39.84a16.06,16.06,0,0,0,9.19-9.19L184.66,144a25,25,0,0,1,46.68,0l39.84,103.6a16.06,16.06,0,0,0,9.19,9.19l103,39.63A25.49,25.49,0,0,1,400,320.52a24.82,24.82,0,0,1-16,22.82l-103.6,39.84a16.06,16.06,0,0,0-9.19,9.19L231.34,496A24.84,24.84,0,0,1,208,512Zm66.85-254.84h0Z"/><path d="M88,176a14.67,14.67,0,0,1-13.69-9.4L57.45,122.76a7.28,7.28,0,0,0-4.21-4.21L9.4,101.69a14.67,14.67,0,0,1,0-27.38L53.24,57.45a7.31,7.31,0,0,0,4.21-4.21L74.16,9.79A15,15,0,0,1,86.23.11,14.67,14.67,0,0,1,101.69,9.4l16.86,43.84a7.31,7.31,0,0,0,4.21,4.21L166.6,74.31a14.67,14.67,0,0,1,0,27.38l-43.84,16.86a7.28,7.28,0,0,0-4.21,4.21L101.69,166.6A14.67,14.67,0,0,1,88,176Z"/><path d="M400,256a16,16,0,0,1-14.93-10.26l-22.84-59.37a8,8,0,0,0-4.6-4.6l-59.37-22.84a16,16,0,0,1,0-29.86l59.37-22.84a8,8,0,0,0,4.6-4.6L384.9,42.68a16.45,16.45,0,0,1,13.17-10.57,16,16,0,0,1,16.86,10.15l22.84,59.37a8,8,0,0,0,4.6,4.6l59.37,22.84a16,16,0,0,1,0,29.86l-59.37,22.84a8,8,0,0,0-4.6,4.6l-22.84,59.37A16,16,0,0,1,400,256Z"/></svg> '; ?></div>
                    <span class="content">Utiliser Leitlearn Ai</span>
                </div>
                <div class="feature">
                    <div class="icon">
                        <span class="material-symbols-rounded">
                            folder_open
                        </span>
                    </div>
                    <span class="content">Créez vos paquets</span>
                </div>
                <div class="feature">
                    <div class="icon">
                        <span class="material-symbols-rounded">
                            group
                        </span>
                    </div>
                    <span class="content">Partagez avec la communauté</span>
                </div>
            </div>
            <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'register']]) ?>
            <div class="input-flex">
                <div class="input-group">
                    <?= $this->Form->text('name', ['id' => 'register-name', 'placeholder' => '']) ?>
                    <?= $this->Form->label('register-name', 'Prénom') ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->text('last_name', ['id' => 'register-lastname', 'placeholder' => '']) ?>
                    <?= $this->Form->label('register-lastname', 'Nom de famille') ?>
                </div>
            </div>
            <div class="input-group">
                <?= $this->Form->text('username', ['id' => 'register-username', 'placeholder' => '']) ?>
                <?= $this->Form->label('register-username', "Nom d'utilisateur") ?>
            </div>
            <div class="input-group">
                <?= $this->Form->text('email', ['id' => 'register-email', 'placeholder' => '']) ?>
                <?= $this->Form->label('register-email', 'Adresse e-mail') ?>
            </div>
            <div class="input-group">
                <?= $this->Form->password('password', ['id' => 'register-password', 'placeholder' => '']) ?>
                <?= $this->Form->label('register-password', 'Mot de passe') ?>
            </div>
            <div class="loader-button">
                <?= $this->Form->submit("S'inscrire") ?>
                <span class="loader"></span>
            </div>
            <small class="policy">
                En continuant, tu acceptes les <?= $this->Html->link('Conditions d\'utilisation', ['controller' => 'Pages', 'action' => 'terms']) ?> de Leitlearn et confirmes avoir lu les <?= $this->Html->link('Politique de confidentialité', ['controller' => 'Pages', 'action' => 'privacy']) ?> de Leitlearn.
            </small>
            <?= $this->Html->link('Vous avez déjà un compte ?', '#', ['class' => 'modal-btn no-account', 'data-modal' => 'login-modal']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>