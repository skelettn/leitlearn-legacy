<div class="sidebar">
    <div class="sidebar-container">
        <?= $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_2_logo.webp', ['class' => 'logo', 'alt' => 'Leitlearn']) ?>
        <ul>
            <li class="<?= $this->getRequest()->getRequestTarget() === '/market' ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/market' ? ' active-icon' : '') . '">explore</span>',
                    '/market',
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <li class="<?= $this->getRequest()->getRequestTarget() === '/home' ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/home' ? ' active-icon' : '') . '">home</span>',
                    '/home',
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <?= $this->cell('FeatureFlags::display', ['leitlearn_plus_sidebar_link']) ?>
            <?php if (!$is_logged) : ?>
                <li class="modal-btn" data-modal="login-modal">
                    <span class="material-symbols-rounded" style="font-variation-settings: 'FILL';">person</span>
                </li>
            <?php else: ?>
                <li class="<?= $this->getRequest()->getRequestTarget() === '/dashboard' ? 'active' : '' ?>">
                    <?= $this->Html->link(
                        '<span class="material-symbols-rounded active-icon">person</span>',
                        '/dashboard',
                        ['escapeTitle' => false]
                    ); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>