<?php
$this->assign('title', 'Marché');
?>
<main>
    <div class="container">
        <section class="section-paquet">
            <h2 class="paquet-title">Tendances</h2>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display', ['trend']) ?>
                </div>
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
        </section>
        <section class="section-paquet">
            <h2 class="paquet-title">Généré avec l'IA</h2>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display', ['ai']) ?>
                </div>
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
        </section>
        <section class="section-paquet">
            <h2 class="paquet-title">Les plus importés</h2>
            <div class="scroll-menu">
                <div class="scroll-content">
                    <?= $cell = $this->cell('Packets::display', ['import']) ?>
                </div>
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
        </section>
        <section class="section-paquet">
            <div class="packets">
                <h2>Paquets publics</h2>
                <div class="content">
                    <?= $cell = $this->cell('Packets::display', ['public']) ?>
                </div>
            </div>
        </section>
        <div class="landing-container">
            <?= $this->element('landing_footer') ?>
        </div>
    </div>
</main>
