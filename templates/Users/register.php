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
                    <?= $this->Form->text('email', ['id' => 'login-page-email', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-email', __('Adresse e-mail')) ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->password('password', ['id' => 'login-page-password', 'placeholder' => '']) ?>
                    <?= $this->Form->label('login-page-password', __('Mot de passe')) ?>
                </div>
                <div class="birth">
                    <h3 class="info"><?= __('Date de naissance') ?></h3>
                    <div class="selects">
                        <?php // $this->Form->select('update-birth-day', array_combine(range(1, 31), range(1, 31)), ['id' => 'day']) ?>
                        <?php // $this->Form->select('update-birth-month', $months, ['id' => 'month']) ?>
                        <?php //$this->Form->select('update-birth-year', array_combine(range(1900, $currentYear), range(1900, $currentYear)), ['id' => 'year']) ?>
                    </div>
                </div>
                <?= $this->Form->submit(__("S'inscrire")) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>