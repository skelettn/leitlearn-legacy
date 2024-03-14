<?php foreach ($packets as $packet): ?>
    <div class="result modal-btn" data-modal="detail-modal" data-paquet-id="<?= $packet->id ?>">
        <?= $packet->name ?>
    </div>
<?php endforeach; ?>