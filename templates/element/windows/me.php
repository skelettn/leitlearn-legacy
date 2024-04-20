<div class="item-header">
    <h2><?= __('Moi') ?></h2>
</div>
<div class="item-body">
    <div class="user">
        <?= $this->Html->image('/img/user_profile_pic/'. $user_data['profile_picture'], ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
        <h3 class="name"><?= $user_data['username'] ?></h3>
    </div>
    <div class="actions">
        <?= $this->Html->link(
            __('Mon profil'),
            '/users/view/' . $user_data["user_uid"],
            ['class' => 'action', 'escapeTitle' => false]
        ); ?>
        <?= $this->Html->link(
            __('Paramètres de compte'),
            '/settings',
            ['class' => 'action', 'escapeTitle' => false]
        ); ?>
        <?= $this->Html->link(
            __('Déconnexion'),
            '/logout',
            ['class' => 'action primary', 'escapeTitle' => false]
        ); ?>
    </div>
</div>