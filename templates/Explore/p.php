<?php
$this->assign('title', 'Explorez les paquets');
?>
<main>
    <div class="open-sidebar">
        <span class="material-symbols-rounded">
            apps
        </span>
    </div>
    <div class="container dashboard">
        <h1 class="title part-title">Explorez</h1>
        <div class="explore">
            <div class="search">
                <div class="search-input">
                    <label for="explore_input">
                        <span class="material-symbols-rounded">
                            search
                        </span>
                    </label>
                    <input type="text" class="explore_input" name="explore_input" id="explore_input" placeholder="Recherchez des paquets sur Leitlearn">
                </div>
            </div>
            <div class="explore-categories">
                <?= $cell = $this->cell('Keywords::display', []) ?>
            </div>
            <div class="explore-packets" data-category="<?= $category ?>">
                <?= $cell = $this->cell('Packets::display_explore', [$category]) ?>
            </div>
        </div>
    </div>
</main>