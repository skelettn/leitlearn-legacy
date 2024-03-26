<?php
$this->assign('title', $category . ' - Marché');
?>
<main>
    <div class="container">
        <section class="search">
            <div class="search-input">
                <label for="market_search">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                </label>
                <input type="text" name="" id="market_search" placeholder="Rechercher sur Leitlearn">
            </div>
            <div class="search-results">
                <?= $cell = $this->cell('Packets::display_search', ['trend']) ?>
            </div>
        </section>
        <section class="section-packets">
            <div class="section-header">
                <h2 class="packets-title">
                    <?= ucfirst($category) ?>
                </h2>
                <div class="scroll-buttons">
                    <button class="prev-button scroll-button">
                        <span class="material-symbols-rounded">
                            chevron_left
                        </span>
                    </button>
                    <button class="next-button scroll-button">
                        <span class="material-symbols-rounded">
                            chevron_right
                        </span>
                    </button>
                </div>
            </div>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display_category', [$category]) ?>
                </div>
            </div>
        </section>
        <section>
            <h2 class="packets-title"><?= __('Catégories') ?></h2>
            <div class="categories">
                <?= $cell = $this->cell('Keywords::display', []) ?>
            </div>
        </section>
        <?= $this->element('landing_footer') ?>
    </div>
</main>
