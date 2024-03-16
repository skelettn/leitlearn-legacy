<?php
$months = [
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Août',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre'
];
?>
<div class="modal" id="update-userdata">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="title">Modification du profil</h2>
            <div class="modal-close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </div>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'update'], 'type' => 'file']) ?>
            <div class="edit-picture-group">
                <?= $this->Html->image('/img/user_profile_pic/'.$user_data['profile_picture'], ['class' => 'avatar', 'id' => 'profilePicturePreview']) ?>
                <?= $this->Form->label(
                    'profile_picture',
                    '<span class="material-symbols-rounded">edit</span>',
                    ['id' => 'label-picture', 'escape' => false]
                )
                ?>
                <?= $this->Form->control(
                    'profile_picture',
                    ['id' => 'profile-picture', 'style' => 'display: none;', 'type' => 'file']
                )
                ?>
            </div>
            <div class="input-flex">
                <div class="input-group">
                    <?= $this->Form->input('name', ['id' => 'update-name', 'placeholder' => '', 'default' => $user_data['name']]); ?>
                    <?= $this->Form->label('update-name', 'Prénom') ?>
                </div>
                <div class="input-group">
                    <?= $this->Form->input('last_name', ['id' => 'update-lastname', 'placeholder' => '', 'default' => $user_data['last_name']]); ?>
                    <?= $this->Form->label('update-lastname', 'Nom de famille') ?>
                </div>
            </div>
            <div class="input-group">
                <?= $this->Form->input('username', ['id' => 'update-username', 'placeholder' => '', 'default' => $user_data['username']]); ?>
                <?= $this->Form->label('update-username', 'Nom d\'utilisateur') ?>
            </div>
            <div class="input-group">
                <?= $this->Form->input('email', ['id' => 'update-email', 'placeholder' => '', 'default' => $user_data['email']]); ?>
                <?= $this->Form->label('update-email', 'Adresse e-mail') ?>
            </div>
            <div class="genre">
                <h3 class="info">Genre</h3>
                <div class="selects">
                    <?php
                    echo $this->Form->select(
                        'gender',
                        ['M' => 'Homme', 'W' => 'Femme', 'O' => 'Non renseigné'],
                        ['empty' => '-- Sélectionner --']
                    );
                    ?>
                </div>
            </div>
            <div class="loader-button">
                <?= $this->Form->submit('Sauvegarder'); ?>
                <span class="loader"></span>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>