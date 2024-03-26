<?php
$this->assign('title', 'Paramètres de ' . $packet->name);
?>
<main>
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <section>
            <div class="section-header">
                <h1 class="title part-title"><?= __('Paramètre de') . ' ' ?> <?= $packet->name ?></h1>
            </div>
            <div class="infos general">
                <h5 class="infos-title">
                    <?= __('Informations') ?>
                    <button class="edit modal-btn" data-modal="modify-paquet-modal">
                        <span class="material-symbols-rounded">
                            edit
                        </span>
                    </button>
                </h5>
                <div class="info">
                    <p><?= __('Nom') ?></p>
                    <p><?= $packet->name ?></p>
                </div>
                <div class="info">
                    <p><?=__('Description')?></p>
                    <p><?= $packet->description ?></p>
                </div>
                <div class="info">
                    <p><?= __('Visibilité du paquet') ?></p>
                    <p><?= ($packet->status == 1) ? "Ce paquet est visible sur le marché." : "Ce paquet n'est accessible que par vous-même."; ?></p>
                </div>
            </div>
            <div class="infos general">
                <h5 class="infos-title"><?= __('Autres') ?></h5>
                <div class="info">
                    <p><?= __('Suppression du paquet') ?></p>
                    <?= $this->Form->postLink(
                        '<button type="submit">' . __('Supprimer le paquet') . '</button>',
                        ['controller' => 'Packets', 'action' => 'remove', $packet->id],
                        [
                            'confirm' => __('Êtes-vous sûr de vouloir supprimer le paquet ?'),
                            'escapeTitle' => false,
                        ]
                    ) ?>
                </div>
            </div>
        </section>
    </div>
</main>