<footer>
    <div class="footer-content">
        <p class="footer-desc">C'est le moment d'apprendre.</p>
        <?php if($is_logged) : ?>
            <?= $this->Html->link(
                '<button>
                Mon espace utilisateur
                <span class="material-symbols-rounded">arrow_forward</span>
            </button>',
                '/dashboard',
                ['escape' => false]
            ) ?>
        <?php else: ?>
            <button class="modal-btn" data-modal="login-modal">
                Commencer à apprendre
                <span class="material-symbols-rounded">arrow_forward</span>
            </button>
        <?php endif; ?>
    </div>
    <div class="footer-data">
        <div class="languages">
            <h4>Langue</h4>
            <ul class="links">
                <li class="link">Français</li>
                <li class="link">Anglais</li>
                <li class="link">Espagnol</li>
            </ul>
        </div>
        <div class="social">
            <h4>Réseaux sociaux</h4>
            <ul class="links">
                <li class="link">
                    <?= $this->Html->link(
                        $this->Html->image('https://static.leitlearn.com/img/x-social-media-white-icon.webp', ['alt' => 'X']),
                        'https://x.com/Leitlearn',
                        ['class' => 'social', 'target' => '_blank', 'escapeTitle' => false]
                    ) ?>
                </li>
            </ul>
        </div>
        <div class="separator top"></div>
        <ul class="footer-links-group">
            <ul class="footer-links">
                <span>Pages</span>
                <li class="footer-link">
                    <?= $this->Html->link(
                        'Marché',
                        '/market',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        'Créer un compte',
                        '/users/register',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        'Connexion',
                        '/users/login',
                        ['escape' => false]
                    ) ?>
                </li>
            </ul>
            <?php if($is_logged) : ?>
                <ul class="footer-links">
                    <span>Moi</span>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            'Mon profil',
                            '/user/me',
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            'Espace utilisateur',
                            '/dashboard',
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            'Paramètres',
                            '/settings',
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li class="footer-link">
                        <?= $this->Html->link(
                            'Déconnexion',
                            '/logout',
                            ['escape' => false]
                        ) ?>
                    </li>
                </ul>
            <?php endif; ?>
            <ul class="footer-links">
                <span>Aide</span>
                <li class="footer-link">
                    <?= $this->Html->link(
                        'Statut des serveurs',
                        'https://leitlearn.instatus.com/',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        'Documentation',
                        '/docs',
                        ['escape' => false]
                    ) ?>
                </li>
            </ul>
            <ul class="footer-links">
                <span>Leitlearn</span>
                <li class="footer-link">
                    <?= $this->Html->link(
                        'À-propos',
                        '/about',
                        ['escape' => false]
                    ) ?>
                </li>
                <li class="footer-link">
                    <?= $this->Html->link(
                        'Contactez-nous',
                        '/contact',
                        ['escape' => false]
                    ) ?>
                </li>
            </ul>
        </ul>
        <div class="separator"></div>
        <div class="copyright">
            <?= $this->Html->image('/img/leitlearn_2_logo_white.png') ?>
            &copy; 2023-2024 Leitlearn.com
        </div>
    </div>
</footer>