<div class="item-header">
    <div class="item-flex">
        <?php if ($user->user_uid === $user_data['user_uid']) : ?>
            <h2><?= __('Mon profil') ?></h2>
            <ul class="header-actions">
                <li class="action active modal-btn" data-modal="update-userdata">
                                <span class="material-symbols-rounded">
                                    edit
                                </span>
                </li>
                <?= $this->Html->link(
                    '<li class="action">
                                    <span class="material-symbols-rounded">
                                        settings
                                    </span>
                                </li>',
                    '/settings',
                    ['escapeTitle' => false]
                ); ?>
            </ul>
        <?php else : ?>
            <h2><?= __('Profil de') ?> <?= $user->username ?></h2>
        <?php endif; ?>
    </div>
</div>
<div class="item-body">
    <div class="user">
        <?= $this->Html->image('/img/user_profile_pic/'. $user->profile_picture, ['class' => 'avatar', 'alt' => 'Profile Picture']) ?>
        <h3 class="name"><?= $user->username ?></h3>
    </div>
    <?php if (is_null($relation)) : ?>
        <?php if ($user->user_uid != $user_data['user_uid']) : ?>
            <div class="actions">
                <?= $this->Form->postLink(
                    ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_add
                                        </span>' .
                    __('Ajouter en amis') .

                    '</button>',
                    ['controller' => 'Friends', 'action' => 'request', $user->user_uid],
                    ['escapeTitle' => false,]
                ) ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <?php if ($relation->status == 'pending') : ?>
            <?php if ($relation->recipient_id == $user_data['id']) : ?>
                <div class="actions">
                    <?= $this->Form->postLink(
                        ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_add
                                        </span>' .
                        __('Accepter la demande en amis')
                        . '
                                    </button>',
                        ['controller' => 'Friends', 'action' => 'accept', $user->user_uid],
                        ['escapeTitle' => false,]
                    ) ?>
                    <?= $this->Form->postLink(
                        ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_remove
                                        </span>' .
                        __('Refuser la demande en amis')
                        . '
                                 
                                    </button>',
                        ['controller' => 'Friends', 'action' => 'delete', $user->user_uid],
                        ['escapeTitle' => false,]
                    ) ?>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="friend-status">
                <?= __('Vous êtes amis ensemble.') ?>
            </div>
            <div class="actions">
                <?= $this->Form->postLink(
                    ' <button class="action">
                                        <span class="material-symbols-rounded">
                                            person_remove
                                        </span>' .
                    __('Supprimer des amis') .
                    '</button>',
                    ['controller' => 'Friends', 'action' => 'delete', $user->user_uid],
                    ['escapeTitle' => false,]
                ) ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="go-back">
        <?= $this->Html->image('/img/leitlearn-come-back-later.png', ['alt' => 'Please come back later.']) ?>
        <h4><?= __('Merci de revenir plus tard.') ?></h4>
    </div>
</div>