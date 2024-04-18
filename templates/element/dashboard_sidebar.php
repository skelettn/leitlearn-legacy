<div class="dashboard-sidebar hidden">
    <h2 class="title"><?= $this->fetch('title') ?></h2>
    <ul class="dashboard-links">
        <li class="dashboard-link <?= $this->getRequest()->getRequestTarget() === '/dashboard' ? 'active' : '' ?>">
            <?= $this->Html->link(
                '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/dashboard' ? ' active-icon' : '') . '">space_dashboard</span>'. __('Mon dashboard')
                ,
                '/dashboard',
                ['escapeTitle' => false]
            ); ?>
        </li>
        <li class="dashboard-link <?= $this->getRequest()->getRequestTarget() === '/profile/' . $user_data['user_uid'] ? 'active' : '' ?>">
            <?= $this->Html->link(
                '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/users/view/' . $user_data['user_uid'] ? ' active-icon' : '') . '">account_circle</span>'. __('Mon profil')
                ,
                '/profile/' . $user_data['user_uid'],
                ['escapeTitle' => false]
            ); ?>
        </li>
        <?= $this->cell('FeatureFlags::display', ['leitlearn_stats_page_link']) ?>
        <li class="dashboard-link <?= $this->getRequest()->getRequestTarget() === '/users/settings' ? 'active' : '' ?>">
            <?= $this->Html->link(
                '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/users/settings' ? ' active-icon' : '') . '">settings</span>'. __('Paramètres de compte'),
                '/users/settings',
                ['escapeTitle' => false]
            ); ?>
        </li>
        <li class="dashboard-link">
            <?= $this->Html->link(
                '<span class="material-symbols-rounded">support</span>'. __('Besoin d\'aide ?'),
                'mailto:kilianpeyn@gmail.com',
                ['escapeTitle' => false]
            ); ?>
        </li>
        <li class="dashboard-link">
            <?= $this->Form->postLink(
                '<span class="material-symbols-rounded">logout</span>'. __('Déconnexion'),
                ['controller' => 'Users', 'action' => 'logout'],
                ['escapeTitle' => false]
            ) ?>
        </li>
    </ul>
    <div class="user dashboard-sidebar-user">
        <div class="user-detail">
            <div class="user-modal leitlearn_dashboard_sidebar_open_user_detail_displayed">
                <ul class="links">
                    <li class="link">
                        <?= $this->Html->link(
                            '<span class="material-symbols-rounded">account_circle</span> Mon profil',
                            '/profile/' . $user_data["user_uid"],
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
                <?= $this->Html->image('/img/user_profile_pic/'. $user_data['profile_picture'], ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
                <div class="detail">
                    <span class="name"><?= $user_data['name'] ?> <?= $user_data['last_name'] ?></span>
                    <span class="alias"><?= $user_data['username'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>