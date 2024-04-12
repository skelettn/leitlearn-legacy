<?php

/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div id="snackbar" class="snackbar show message error" onclick="this.classList.add('hidden');">
    <div class="icon">
        <span class="material-symbols-rounded">
            error
        </span>
    </div>
    <span><?= $message ?></span>
</div>