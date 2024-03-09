<?php foreach ($packets as $packet): ?>
    <div class="explore-packet page-redirect" data-redirection="/packets/view/<?= $packet->id ?>">
        <div class="packet-title"><?= $packet->name ?></div>
        <div class="packet-infos">
            <strong><?= count($packet->flashcards) ?> cartes · X importations</strong>
        </div>
        <div class="view-packet">
            <span class="material-symbols-rounded">open_in_new</span>
        </div>
    </div>
<?php endforeach; ?>