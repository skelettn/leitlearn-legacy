<?php
$this->assign('title', 'Paramètres de '.$packet->name);
?>
<main>
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <h1 class="title part-title">Paramètre de <?= $packet->name ?></h1>
        <div class="infos general">
            <h5 class="infos-title">
                Informations
                <button class="edit modal-btn" data-modal="modify-paquet-modal">
                    <span class="material-symbols-rounded">
                        edit
                    </span>
                </button>
            </h5>
            <div class="info">
                <p>Nom</p>
                <p><?= $packet->name ?></p>
            </div>
            <div class="info">
                <p>Description</p>
                <p><?= $packet->description ?></p>
            </div>
            <div class="info">
                <p>Visibilité du paquet</p>
                <p><?= $packet->public ?></p>
            </div>
        </div>
        <div class="infos general">
            <h5 class="infos-title">Autres</h5>
            <div class="info">
                <p>Suppression du paquet</p>
                <?= $this->Form->postLink(
                    '<button type="submit">Supprimer le paquet</button>',
                    ['controller' => 'Packets', 'action' => 'remove', $packet->id],
                    [
                        'confirm' => 'Êtes-vous sur de vouloir supprimer le paquet ?',
                        'escapeTitle' => false,
                    ]
                ) ?>
            </div>
        </div>
    </div>
</main>