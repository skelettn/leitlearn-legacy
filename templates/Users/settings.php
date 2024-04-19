<?php
$this->assign('title', 'Paramètres de compte');
?>
<main class="refresh">
    <div class="new-ui">
        <div class="switch-container">
            <h5 class="action-name"><?= __('Activer la nouvelle interface') ?></h5>
            <?= $this->Form->postLink(
                '<label class="switch">
                    <input type="checkbox" name="status"' . ($this->request->getSession()->check('leitlearn_2_new_ui_enabled') ? ' checked' : '') . '>
                    <span></span>
                </label>',
                ['controller' => 'Dashboard', 'action' => 'enableNewUi'],
                [
                    'escapeTitle' => false,
                ]
            ) ?>
        </div>
    </div>
    <div class="refresh-grid panel-full">
        <div class="grid-item grid-packets panel-left">
            <div class="item-header">
                <div class="item-flex">
                    <h2>Paramètres</h2>
                </div>
            </div>
            <div class="item-body">
                <ul class="item-links">
                    <li class="item-link active">
                        <span class="material-symbols-rounded active-icon">admin_panel_settings</span>
                        <h3>Gérer le compte</h3>
                    </li>
                    <li class="item-link">
                        <span class="material-symbols-rounded active-icon">translate</span>
                        <h3>Langues</h3>
                    </li>
                </ul>
            </div>
            <?= $this->element('modals/refreshed/update_user'); ?>
        </div>
        <div class="grid-item grid-feed panel-center">
            <div class="item-body">
                <div class="setting">
                    <h2>Gérer le compte</h2>
                    <ul class="setting-actions">
                        <li class="action">
                            <span>Modifier le mot de passe</span>
                            <button>Modifier</button>
                        </li>
                        <li class="action">
                            <span>Supprimer le compte</span>
                            <button class="alert">Supprimer</button>
                        </li>
                    </ul>
                </div>
                <div class="setting">
                    <h2>Langues</h2>
                    <ul class="setting-actions">
                        <li class="action">
                            <span>Choisir la langue</span>
                            <select name="" id="">
                                <option value="fr-FR"><?= __('Français') ?></option>
                                <option value="en-US"><?= __('Anglais') ?></option>
                            </select>
                        </li>
                    </ul>
                </div>
                <h6 class="version">Leitlearn 2.0 RC 4</h6>
            </div>
        </div>
    </div>
</main>