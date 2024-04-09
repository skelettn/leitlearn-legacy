<li class="dashboard-link <?= $this->getRequest()->getRequestTarget() === '/stats' ? 'active' : '' ?>">
    <?= $this->Html->link(
        '<span class="material-symbols-rounded">equalizer</span>'. __('Statistiques')
        ,
        '/stats',
        ['escapeTitle' => false]
    ); ?>
</li>