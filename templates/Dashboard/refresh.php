<main class="refresh">
    <div class="new-ui">
        <div class="switch-container">
            <h5 class="action-name"><?= __('Activer la nouvelle interface') ?></h5>
            <?= $this->Form->postLink(
                '<label class="switch">
        <input type="checkbox" name="status"' . ($this->request->getSession()->check('leitlearn_2_new_ui_enabled') ? ' checked' : '') . '>
        <span></span>
    </label>',
                ['controller' => 'Dashboard', 'action' => 'enableNewUi'],
                [
                    'escapeTitle' => false,
                ]
            ) ?>
        </div>
    </div>
    <div class="refresh-grid">
        <div class="grid-item grid-packets panel-left">
            <div class="item-header">
                <h2>Mes paquets</h2>
                <div class="filters">
                    <div class="filter active">
                        <h5>Tous</h5>
                    </div>
                    <div class="filter">
                        <h5>Privés</h5>
                    </div>
                    <div class="filter">
                        <h5>Amis uniquement</h5>
                    </div>
                    <div class="filter">
                        <h5>IA</h5>
                    </div>
                </div>
            </div>
            <div class="item-decks">
                <?= $cell = $this->cell('Packets::display_refreshed', ['my', $user_data["id"], 'dashboard']) ?>
            </div>
        </div>
        <div class="grid-item grid-feed panel-center">
            <div class="item-header">
                <h2>Feed</h2>
            </div>
            <div class="item-body">
                <div class="go-back">
                    <?= $this->Html->image('/img/leitlearn-come-back-later.png', ['alt' => 'Please come back later.']) ?>
                    <h4><?= __('Merci de revenir plus tard.') ?></h4>
                </div>
            </div>
        </div>
        <div class="panel-right">
            <div class="grid-item grid-actions panel-right-top">
                <div class="item-header">
                    <h2>Moi</h2>
                </div>
                <div class="item-body">
                    <div class="user">
                        <?= $this->Html->image('/img/user_profile_pic/'. $user_data['profile_picture'], ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
                        <h3 class="name"><?= $user_data['username'] ?></h3>
                    </div>
                    <div class="actions">
                        <?= $this->Html->link(
                            'Mon profil',
                            '/users/view/' . $user_data["user_uid"],
                            ['class' => 'action', 'escapeTitle' => false]
                        ); ?>
                        <?= $this->Html->link(
                            'Paramètres de compte',
                            '/users/settings',
                            ['class' => 'action', 'escapeTitle' => false]
                        ); ?>
                        <?= $this->Html->link(
                            'Déconnexion',
                            '',
                            ['class' => 'action primary', 'escapeTitle' => false]
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="grid-item grid-stats panel-right-bottom">
                <div class="item-header">
                    <h2>Statistiques</h2>
                </div>
                <div class="item-body">
                    <div class="go-back">
                        <?= $this->Html->image('/img/leitlearn-come-back-later.png', ['alt' => 'Please come back later.']) ?>
                        <h4><?= __('Merci de revenir plus tard.') ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>