<?php foreach ($packets as $packet): ?>
    <div class="deck page-redirect <?php echo $packet->ia ? 'ai-deck' : ''; ?>" data-redirection="/deck/<?= $packet->packet_uid ?>">
        <div class="deck-header">
            <div class="deck-data">
                <div class="creator">
                    <?= $this->Html->image('/img/user_profile_pic/'. $user['profile_picture'], ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
                    <h6 class="name"><?= $user['username'] ?></h6>
                </div>
                ⋅
                <div class="flashcards">
                    <h6 class="count"><?= count($packet->flashcards) ?></h6>
                    <span><?= __('cartes') ?></span>
                </div>
            </div>
        </div>
        <h4 class="deck-name"><?= h($packet->name) ?></h4>
    </div>
<?php endforeach; ?>