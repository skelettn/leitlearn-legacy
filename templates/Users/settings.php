<?php
$this->assign('title', 'Paramètres de compte');
?>
<main class="refresh">
    <div class="refresh-grid panel-full">
        <div class="grid-item grid-packets panel-left">
            <div class="item-header">
                <div class="item-flex">
                    <h2><?= __('Paramètres') ?></h2>
                    <ul class="header-actions">
                        <?= $this->Html->link(
                            '<li class="action">
                                    <span class="material-symbols-rounded">
                                        chevron_left
                                    </span>
                                </li>',
                            '/dashboard',
                            ['escapeTitle' => false]
                        ); ?>
                    </ul>
                </div>
            </div>
            <div class="item-body">
                <ul class="item-links">
                    <li class="item-link">
                        <span class="material-symbols-rounded active-icon">admin_panel_settings</span>
                        <h3><?= __('Gérer le compte') ?></h3>
                    </li>
                    <li class="item-link">
                        <span class="material-symbols-rounded active-icon">translate</span>
                        <h3><?= __('Langues') ?></h3>
                    </li>
                </ul>
            </div>
        </div>
        <div class="grid-item grid-feed panel-center">
            <div class="item-body">
                <div class="setting">
                    <h2><?= __('Gérer le compte') ?></h2>
                    <ul class="setting-actions">
                        <li class="action">
                            <span><?= __('Modifier le mot de passe') ?></span>
                            <button class="modal-btn" data-modal="update-user-password"><?= __('Modifier') ?></button>
                        </li>
                        <li class="action">
                            <span><?= __('Supprimer le compte') ?></span>
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
                    <h2><?= __('Langues') ?></h2>
                    <ul class="setting-actions">
                        <li class="action">
                            <span><?= __('Choisir la langue') ?></span>
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