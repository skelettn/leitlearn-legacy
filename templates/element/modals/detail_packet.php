<div class="modal detail-modal" id="detail-modal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title" id="modal-title">Deck Name</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <div class="detail">
                <div class="creator-infos">
                    <div class="information">
                        <div class="data">
                            <span>Description</span>
                            <strong class="desc" id="modal-detail-description"></strong>
                        </div>
                    </div>
                    <div class="information">
                        <div class="data">
                            <span>Mots clés</span>
                            <div class="keys" id="modal-detail-keys"></div>
                        </div>
                    </div>
                    <div class="information">
                        <div class="data">
                            <span>Créateur du paquet</span>
                            <div class="packet-creator" id="modal-detail-creator">
                                <img class='avatar' src="" alt="avatar-user">
                                <strong></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs">
                <?php if ($is_logged) : ?>
                    <button class="switch-tab active" data-tab="detail-tab-paquets">Paquet</button>
                    <button class="switch-tab" data-tab="detail-tab-flashcards">Cartes</button>
                <?php else : ?>
                    <button class="switch-tab active" data-tab="detail-tab-flashcards">Cartes</button>
                <?php endif;
                ?>
            </div>
            <?php if ($is_logged) :  ?>
                <?=  $this->Form->create(null, ['url' => ['controller' => 'Packets', 'action' => 'import']]); ?>
                <?= $this->Form->hidden('packet_id', ['value' => '', 'id' => 'modal-detail-packet-id']) ?>
                <div class="tab detail-tab" id="detail-tab-paquets" style="display: flex;">
                    <div class="loader-button">
                        <?= $this->Form->submit('Importer le paquet sur mon espace') ?>
                        <span class="loader"></span>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            <?php endif; ?>
            <?= $this->Form->create(null, ['url' => ['controller' => 'Flashcards', 'action' => 'importFromMarket'], 'method' => 'post']) ?>
            <div class="tab detail-tab" id="detail-tab-flashcards" style="<?= !$is_logged ? 'display: block' : '' ?>">
                <div class="flashcards" id="modal-detail-flashcards"></div>
                <?php if ($is_logged) : ?>
                    <div class="actions">
                        <select name="selected_packet" id="modal-detail-selected-packet" class="select-paquet"></select>
                        <div class="loader-button">
                            <?= $this->Form->submit('Importer la/les cartes') ?>
                            <span class="loader"></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
