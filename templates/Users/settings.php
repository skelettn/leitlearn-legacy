<?php
$this->assign('title', 'Paramètres de compte');
?>
<main class="refresh">
    <div class="refresh-grid panel-full">
        <div class="grid-item grid-packets panel-left">
            <div class="item-header">
                <div class="item-flex">
                    <h2>Paramètres</h2>
                </div>
            </div>
            <div class="item-body">
                <ul class="item-links">
                    <li class="item-link">
                        <span class="material-symbols-rounded active-icon">admin_panel_settings</span>
                        <h3>Gérer le compte</h3>
                    </li>
                    <li class="item-link">
                        <span class="material-symbols-rounded active-icon">translate</span>
                        <h3>Langues</h3>
                    </li>
                </ul>
            </div>
        </div>
        <div class="grid-item grid-feed panel-center">
            <div class="item-body">
                <div class="setting">
                    <h2>Gérer le compte</h2>
                    <ul class="setting-actions">
                        <li class="action">
                            <span>Modifier le mot de passe</span>
                            <button class="modal-btn" data-modal="update-user-password">Modifier</button>
                        </li>
                        <li class="action">
                            <span>Supprimer le compte</span>
                            <?= $this->Form->postLink(
                                '<button class="alert">' . __('Supprimer') . '</button>',
                                ['controller' => 'Users', 'action' => 'delete'],
                                [
                                    'confirm' => 'Êtes-vous sur de vouloir supprimer votre compte ?',
                                    'escapeTitle' => false,
                                ]
                            ) ?>
                        </li>
                    </ul>
                </div>
                <div class="setting">
                    <h2>Langues</h2>
                    <ul class="setting-actions">
                        <li class="action">
                            <span>Choisir la langue</span>
                            <select name="" id="setting-lang">
                                <option value="fr-FR" <?= ($locale == 'fr-FR') ? 'selected' : '' ?>><?= __('Français') ?></option>
                                <option value="en-US" <?= ($locale == 'en-US') ? 'selected' : '' ?>><?= __('Anglais') ?></option>
                            </select>
                        </li>
                    </ul>
                </div>
                <h6 class="version">Leitlearn 2.0 RC 4</h6>
            </div>
            <?= $this->element('modals/update_user_password'); ?>
        </div>
    </div>
</main>