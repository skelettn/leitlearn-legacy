<footer>
    <div class="footer-content">
        <h3 class="footer-desc"><?= __('C\'est le moment d\'apprendre.') ?></h3>
        <?php if ($is_logged) : ?>
            <?= $this->Html->link(
                '<button>' .
                 __('Mon espace utilisateur') . '
                <span class="material-symbols-rounded">arrow_forward</span>
            </button>',
                '/dashboard',
                ['escape' => false]
            ) ?>
        <?php else : ?>
            <button class="modal-btn" data-modal="login-modal">
                <?= __('Commencer à apprendre') ?>
                <span class="material-symbols-rounded">arrow_forward</span>
            </button>
        <?php endif; ?>
    </div>
    <div class="footer-data">
        <div class="languages">
            <h4><?= __('Langue') ?></h4>
            <ul class="links">
                <li class="link"><?=$this->Html->link(__('Français'), ['controller' => 'Lang', 'action' => 'change', 'fr-FR'])?></li>
                <li class="link"><?= $this->Html->link(__('Anglais'), ['controller' => 'Lang', 'action' => 'change', 'en-US']) ?></li>
            </ul>
        </div>
        <div class="social">
            <h4><?= __('Réseaux sociaux') ?></h4>
            <ul class="links">
                <li class="link">
                    <?= $this->Html->link(
                        $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/x-social-media-white-icon.webp', ['alt' => 'X']),
                        'https://x.com/Leitlearn',
                        [
                            'class' => 'social',
                            'target' => '_blank',
                            'rel' => 'noopener',
                            'escapeTitle' => false,
                        ]
                    ) ?>
                </li>
            </ul>
        </div>
        <div class="separator top"></div>
        <ul class="footer-links-group">
            <ul class="footer-links">
                <h4>Pages</h4>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Marché'),
                        '/market',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Créer un compte'),
                        '/users/register',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Connexion'),
                        '/users/login',
                        ['escape' => false]
                    ) ?>
                </li>
            </ul>
            <?php if ($is_logged) : ?>
                <ul class="footer-links">
                    <h4><?= __('Moi') ?></h4>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            __('Mon profil'),
                            '/user/' . $user_data['user_uid'],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            __('Espace utilisateur'),
                            '/dashboard',
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            __('Paramètres'),
                            '/settings',
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            __('Déconnexion'),
                            '/logout',
                            ['escape' => false]
                        ) ?>
                    </li>
                </ul>
            <?php endif; ?>
            <ul class="footer-links">
                <h4><?= __('Aide') ?></h4>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Statut des serveurs'),
                        'https://leitlearn.instatus.com/',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Trello'),
                        'https://trello.com/b/iUvzfXzs/leitlearn',
                        ['target' => '_blank'],
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Documentation'),
                        '/docs',
                        ['escape' => false]
                    ) ?>
                </li>
            </ul>
            <ul class="footer-links">
                <h4>Leitlearn</h4>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Mentions légales'),
                        '/legal',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Contactez-nous'),
                        'mailto:kilianpeyn@gmail.com',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        __('Gérer les cookies'),
                        'javascript:openAxeptioCookies()',
                        ['escape' => false]
                    ) ?>
                </li>
            </ul>
        </ul>
        <div class="separator"></div>
        <div class="copyright">
            <?= $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_white.webp', ['alt' => 'Leitlearn']) ?>
            &copy; 2023-2024 Leitlearn.com
        </div>
        <div class="version">2.0 RC 4 Pre-Version</div>
    </div>
</footer>