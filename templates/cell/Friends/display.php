<div class="friends">
    <?php foreach ($friends as $friend) : ?>
        <div class="friend page-redirect"
             style="background-image: url('/img/user_profile_pic/<?= $friend->user->profile_picture ?>')"
             data-redirection="/users/view/<?= $friend->user->user_uid ?>">
        </div>
    <?php endforeach; ?>
</div>
