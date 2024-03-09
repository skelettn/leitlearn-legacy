<div class="dashboard-sidebar hidden">
    <h2 class="title"><?= $this->fetch('title') ?></h2>
    <ul class="dashboard-links">
        <li class="dashboard-link page-redirect active" data-redirection="/dashboard">
            <span class="material-symbols-rounded">
             space_dashboard
            </span>
            Mon dashboard
        </li>
        <li class="dashboard-link page-redirect" data-redirection="/users/view/<?= $user_data['user_uid'] ?>">
            <span class="material-symbols-rounded">
             account_circle
            </span>
            Mon profil
        </li>
        <li class="dashboard-link page-redirect" data-redirection="/stats">
            <span class="material-symbols-rounded">
            equalizer
            </span>
            Statistiques
        </li>
        <li class="dashboard-link page-redirect" data-redirection="/users/settings">
            <span class="material-symbols-rounded">
                settings
            </span>
            Paramètres de compte
        </li>
        <li class="dashboard-link page-redirect" data-redirection="/docs">
            <span class="material-symbols-rounded">
                support
            </span>
            Besoin d'aide ?
        </li>
        <li class="dashboard-link page-redirect" data-redirection="/logout">
            <?= $this->Form->postLink(
                '<span class="material-symbols-rounded">logout</span> Déconnexion',
                ['controller' => 'Users', 'action' => 'logout'],
                ['escapeTitle' => false]
            ) ?>
        </li>
        <!-- If admin <li class="dashboard-link page-redirect" data-redirection="/admin">Administrateur</li> -->
    </ul>
    <div class="user">
        <div class="user-detail">
            <div class="user-modal leitlearn_dashboard_sidebar_open_user_detail_displayed">
                <ul class="links">
                    <li class="link">
                        <?= $this->Html->link(
                            '<span class="material-symbols-rounded">account_circle</span> Mon profil',
                            '/users/view/' . $user_data["user_uid"],
                            ['escapeTitle' => false]
                        ) ?>
                    </li>
                    <li class="link">
                        <span class="material-symbols-rounded">
                            diamond
                        </span>
                        Leitlearn +
                    </li>
                    <li class="link">
                        <?= $this->Form->postLink(
                            '<span class="material-symbols-rounded">logout</span> Déconnexion',
                            ['controller' => 'Users', 'action' => 'logout'],
                            ['escapeTitle' => false]
                        ) ?>
                    </li>
                </ul>
            </div>
            <div class="displayed leitlearn_dashboard_sidebar_open_user_detail_open">
                <?= $this->Html->image('/img/user_profile_pic/'. $user_data['profile_picture'], ['class' => 'avatar']) ?>
                <div class="detail">
                    <span class="name"><?= $user_data['name'] ?> <?= $user_data['last_name'] ?></span>
                    <span class="alias"><?= $user_data['username'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>