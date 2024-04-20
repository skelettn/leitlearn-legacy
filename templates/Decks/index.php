<main class="refresh">
    <div class="refresh-grid">
        <div class="grid-item grid-feed panel-left">
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
        <div class="grid-item grid-packets panel-center">
            <div class="item-header">
                <div class="item-flex">
                    <h2>Mes paquets</h2>
                    <ul class="header-actions">
                        <li class="action active modal-btn" data-modal="create-packet">
                            <span class="material-symbols-rounded">
                            add
                        </span>
                        </li>
                        <li class="action modal-btn" data-modal="import-packet">
                            <span class="material-symbols-rounded">
                            upload_file
                        </span>
                        </li>
                    </ul>
                </div>
                <div class="filters">
                    <div class="filter active" data-filter-action="all">
                        <h5>Tous</h5>
                    </div>
                    <div class="filter" data-filter-action="0">
                        <h5>Privés</h5>
                    </div>
                    <div class="filter" data-filter-action="2">
                        <h5>Amis uniquement</h5>
                    </div>
                    <div class="filter" data-filter-action="ai">
                        <h5>IA</h5>
                    </div>
                </div>
            </div>
            <div class="item-decks">
                <?= $cell = $this->cell('Packets::display_refreshed', ['my', $user_data["id"], 'dashboard']) ?>
            </div>
            <?= $this->element('modals/refreshed/create_packet'); ?>
            <?= $this->element('modals/refreshed/import_packet'); ?>
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
                            '/settings',
                            ['class' => 'action', 'escapeTitle' => false]
                        ); ?>
                        <?= $this->Html->link(
                            'Déconnexion',
                            '/logout',
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