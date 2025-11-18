<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link https://cakephp.org CakePHP(tm) Project
 * @since 0.10.0
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = ' - Leitlearn';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?= $this->Html->charset() ?>
    <?= $this->element('meta'); ?>
    <title>
        <?= $this->fetch('title') ?>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon', '/img/favicon.webp') ?>
    <?= $this->fetch('meta') ?>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
</head>

<body data-csrf-token="<?= $this->request->getAttribute('csrfToken'); ?>" class="landing">
<?php
echo $this->Flash->render();
echo $this->element('landing_sidebar');
echo $this->fetch('content');
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<?php if (APP_ENV !== 'development') : ?>
    <script src="<?= $this->Url->build('/js/bundle.js') ?>"></script>
<?php else : ?>
    <script src="<?= $this->Url->build('/js/bundle.js') ?>"></script>
<?php endif; ?>
</body>

</html>