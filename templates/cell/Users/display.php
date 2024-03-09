<div class="view-users" id="users-result">
    <?php foreach ($users as $user) : ?>
        <div class="user">
            <div class="profile-picture" style="background-image: url('/img/user_profile_pic/<?= $user->profile_picture ?>')"></div>
            <span><?= $user->username ?></span>
            <a href="/users/view/<?= $user->user_uid ?>">
                <span class="material-symbols-rounded">
                    open_in_new
                </span>
            </a>
        </div>
    <?php endforeach; ?>
</div>