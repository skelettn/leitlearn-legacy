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
<html>

<head>
    <?= $this->Html->charset() ?>
    <?= $this->element('meta'); ?>
    <title>
        <?= $this->fetch('title') ?>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon', 'https://static.leitlearn.com/img/v2/favicon.webp') ?>
    <?= $this->Html->css(['dashboard']) ?>
    <?= $this->fetch('meta') ?>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
</head>

<body data-csrf-token="<?= $this->request->getAttribute('csrfToken'); ?>">
<?php
echo $this->Flash->render();
echo $this->element('sidebar');
echo $this->element('dashboard_sidebar');
echo $this->fetch('content');
?>

<?php if($is_logged) : ?>
    <?= $this->Html->link(
        '<div class="ia">
        <?xml version="1.0" encoding="utf-8"?>
        <svg fill="#FFFFFF" width="25px" height="25px" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M208,512a24.84,24.84,0,0,1-23.34-16l-39.84-103.6a16.06,16.06,0,0,0-9.19-9.19L32,343.34a25,25,0,0,1,0-46.68l103.6-39.84a16.06,16.06,0,0,0,9.19-9.19L184.66,144a25,25,0,0,1,46.68,0l39.84,103.6a16.06,16.06,0,0,0,9.19,9.19l103,39.63A25.49,25.49,0,0,1,400,320.52a24.82,24.82,0,0,1-16,22.82l-103.6,39.84a16.06,16.06,0,0,0-9.19,9.19L231.34,496A24.84,24.84,0,0,1,208,512Zm66.85-254.84h0Z"/><path d="M88,176a14.67,14.67,0,0,1-13.69-9.4L57.45,122.76a7.28,7.28,0,0,0-4.21-4.21L9.4,101.69a14.67,14.67,0,0,1,0-27.38L53.24,57.45a7.31,7.31,0,0,0,4.21-4.21L74.16,9.79A15,15,0,0,1,86.23.11,14.67,14.67,0,0,1,101.69,9.4l16.86,43.84a7.31,7.31,0,0,0,4.21,4.21L166.6,74.31a14.67,14.67,0,0,1,0,27.38l-43.84,16.86a7.28,7.28,0,0,0-4.21,4.21L101.69,166.6A14.67,14.67,0,0,1,88,176Z"/><path d="M400,256a16,16,0,0,1-14.93-10.26l-22.84-59.37a8,8,0,0,0-4.6-4.6l-59.37-22.84a16,16,0,0,1,0-29.86l59.37-22.84a8,8,0,0,0,4.6-4.6L384.9,42.68a16.45,16.45,0,0,1,13.17-10.57,16,16,0,0,1,16.86,10.15l22.84,59.37a8,8,0,0,0,4.6,4.6l59.37,22.84a16,16,0,0,1,0,29.86l-59.37,22.84a8,8,0,0,0-4.6,4.6l-22.84,59.37A16,16,0,0,1,400,256Z"/></svg></div>',
        '/ai',
        ['escape' => false]
    ) ?>
<?php endif; ?>

<span class="redirect dynamic-redirect">
    <span class="material-symbols-rounded">
        keyboard_double_arrow_up
    </span>
</span>

<?php
echo $this->element('modals/detail_packet');
echo $this->element('modals/create_flashcard');
echo $this->element('modals/modify_flashcard');
echo $this->element('modals/modify_packet');
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<?php if (APP_ENV !== 'development') : ?>
    <script src="<?= $this->Url->build('/js/bundle.js') ?>"></script>
<?php else : ?>
    <script src="<?= $this->Url->build('http://localhost:9000/bundle.js') ?>"></script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>

</body>

</html>
