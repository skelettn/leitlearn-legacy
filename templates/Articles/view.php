<?php
$this->assign('title', $article->title);
?>
<main>
    <div class="container">
        <div class="article">
            <div class="article-header">
                <h1><?= $article->title ?></h1>
                <h4 class="date"><?= $article->created ?></h4>
            </div>
            <div class="article-content">
                <?= $article->body ?>
            </div>
        </div>
        <?= $this->element('landing_footer') ?>
    </div>
</main>
