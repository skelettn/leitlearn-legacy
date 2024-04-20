<div class="friends">
    <?php
    if (!empty($friends)) :
        foreach ($friends as $friend) : ?>
            <div class="friend page-redirect"
                 style="background-image: url('/img/user_profile_pic/<?= $friend->user->profile_picture ?>')"
                 data-redirection="/user/<?= $friend->user->user_uid ?>">
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <h4 class="no-friends">Vous n'avez pas d'amis.</h4>
    <?php endif; ?>
</div>
