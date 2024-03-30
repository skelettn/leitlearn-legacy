<div class="sidebar">
    <div class="sidebar-container">
        <?= $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_2_logo.webp', ['class' => 'logo']) ?>
        <ul>
            <li class="<?= $this->getRequest()->getRequestTarget() === '/market' ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded">explore</span>',
                    '/market',
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <li class="<?= $this->getRequest()->getRequestTarget() === '/home' ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded">home</span>',
                    '/home',
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <li class="modal-btn" data-modal="turbo-modal">
                <span class="material-symbols-rounded">rocket_launch</span>
            </li>
            <?php if (!$is_logged) : ?>
                <li class="modal-btn" data-modal="login-modal">
                    <span class="material-symbols-rounded" style="font-variation-settings: 'FILL';">person</span>
                </li>
            <?php else: ?>
                <li class="<?= $this->getRequest()->getRequestTarget() === '/dashboard' ? 'active' : '' ?>">
                    <?= $this->Html->link(
                        '<span class="material-symbols-rounded">person</span>',
                        '/dashboard',
                        ['escapeTitle' => false]
                    ); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>