<div class="fixed-nav-mobile">
    <div class="open-sidebar">
        <span class="material-symbols-rounded">
            menu
        </span>
    </div>
    <?= $this->Html->image('https://static.kilianpeyron.fr/leitlearn/img/leitlearn_2_logo.webp', ['class' => 'logo','alt' => 'Leitlearn 2']) ?>
    <div class="user dashboard-sidebar-user fixed-nav">
        <div class="displayed page-redirect" data-redirection="/users/view/<?= $user_data['user_uid'] ?>">
            <?= $this->Html->image('/img/user_profile_pic/' . $user_data['profile_picture'], ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
            <div class="detail">
                <span class="name"><?= $user_data['name'] ?> <?= $user_data['last_name'] ?></span>
                <span class="alias"><?= $user_data['username'] ?></span>
            </div>
        </div>
    </div>
</div>