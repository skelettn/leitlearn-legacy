<div class="sidebar">
    <div class="sidebar-container">
        <?= $this->Html->image('/img/leitlearn_2_logo.webp', ['class' => 'logo', 'alt' => 'Leitlearn']) ?>
        <ul>
            <li class="<?= $this->getRequest()->getRequestTarget() === '/market' ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/market' ? ' active-icon' : '') . '">explore</span>',
                    '/market',
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <li class="<?= strpos($this->getRequest()->getRequestTarget(), '/dashboard') === 0 ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded' . (strpos($this->getRequest()->getRequestTarget(), '/dashboard') === 0 ? ' active-icon' : '') . '">home</span>',
                    '/dashboard',
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <?= $this->cell('FeatureFlags::display', ['leitlearn_plus_sidebar_link']) ?>
            <li class="<?= $this->getRequest()->getRequestTarget() === '/decks' ? 'active' : '' ?> mobile-only">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/decks' ? ' active-icon' : '') . '">style</span>',
                    '/decks',
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <li class="<?= strpos($this->getRequest()->getRequestTarget(), '/profile') === 0 ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded' . (strpos($this->getRequest()->getRequestTarget(), '/profile') === 0 ? ' active-icon' : '') . '">person</span>',
                    '/profile/' . $user_data['user_uid'],
                    ['escapeTitle' => false]
                ); ?>
            </li>
            <li class="<?= $this->getRequest()->getRequestTarget() === '/settings' ? 'active' : '' ?>">
                <?= $this->Html->link(
                    '<span class="material-symbols-rounded' . ($this->getRequest()->getRequestTarget() === '/settings' ? ' active-icon' : '') . '">settings</span>',
                    '/settings',
                    ['escapeTitle' => false]
                ); ?>
            </li>
        </ul>
    </div>
</div>