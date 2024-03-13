<?php
$this->assign('title', 'Apprenez grâce aux flashcards');
?>
<header>
    <div class="header-content">
        <div class="logo">
            <?= $this->Html->image('/img/leitlearn_2_logo_white.png', ['alt' => 'Leitlearn 2']) ?>
        </div>
        <div class="new leitlearn-2">
            <?= $this->Html->image('/img/leitlearn_2_logo.png', ['alt' => 'Leitlearn 2']) ?>
            2 est disponible
        </div>
        <h1 class="title">Vous avez le pouvoir d'apprendre.</h1>
        <p class="desc">Découvrez la plate-forme qui permet d'appendre efficacement gratuitement.</p>
        <?php if($is_logged) : ?>
            <?= $this->Html->link(
                '<button>
                Mon espace utilisateur
                <span class="material-symbols-rounded">arrow_forward</span>
            </button>',
                '/dashboard',
                ['escape' => false]
            ) ?>
        <?php else: ?>
            <button class="modal-btn" data-modal="login-modal">
                Commencer à apprendre
                <span class="material-symbols-rounded">arrow_forward</span>
            </button>
        <?php endif; ?>
    </div>
    <video autoplay muted loop id="header-video">
        <source src="/videos/header.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</header>

<main>
        <div class="fixed-infos">
            <div class="text">
                <span class="badge">new</span>
                Essayez <span class="text-ia">Leitlearn AI</span> et
                <span class="text-ia">Créez vos paquets</span>
                <?php echo ' <?xml version="1.0" encoding="utf-8"?> <svg fill="#FFFFFF" width="20px" height="20px" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M208,512a24.84,24.84,0,0,1-23.34-16l-39.84-103.6a16.06,16.06,0,0,0-9.19-9.19L32,343.34a25,25,0,0,1,0-46.68l103.6-39.84a16.06,16.06,0,0,0,9.19-9.19L184.66,144a25,25,0,0,1,46.68,0l39.84,103.6a16.06,16.06,0,0,0,9.19,9.19l103,39.63A25.49,25.49,0,0,1,400,320.52a24.82,24.82,0,0,1-16,22.82l-103.6,39.84a16.06,16.06,0,0,0-9.19,9.19L231.34,496A24.84,24.84,0,0,1,208,512Zm66.85-254.84h0Z"/><path d="M88,176a14.67,14.67,0,0,1-13.69-9.4L57.45,122.76a7.28,7.28,0,0,0-4.21-4.21L9.4,101.69a14.67,14.67,0,0,1,0-27.38L53.24,57.45a7.31,7.31,0,0,0,4.21-4.21L74.16,9.79A15,15,0,0,1,86.23.11,14.67,14.67,0,0,1,101.69,9.4l16.86,43.84a7.31,7.31,0,0,0,4.21,4.21L166.6,74.31a14.67,14.67,0,0,1,0,27.38l-43.84,16.86a7.28,7.28,0,0,0-4.21,4.21L101.69,166.6A14.67,14.67,0,0,1,88,176Z"/><path d="M400,256a16,16,0,0,1-14.93-10.26l-22.84-59.37a8,8,0,0,0-4.6-4.6l-59.37-22.84a16,16,0,0,1,0-29.86l59.37-22.84a8,8,0,0,0,4.6-4.6L384.9,42.68a16.45,16.45,0,0,1,13.17-10.57,16,16,0,0,1,16.86,10.15l22.84,59.37a8,8,0,0,0,4.6,4.6l59.37,22.84a16,16,0,0,1,0,29.86l-59.37,22.84a8,8,0,0,0-4.6,4.6l-22.84,59.37A16,16,0,0,1,400,256Z"/></svg> '; ?>
            </div>
        </div>
    <div class="container">
        <section class="section-packets">
            <div class="section-header">
                <h2 class="paquet-title">
                    Tendances
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
                    <?= $cell = $this->cell('Packets::display', ['trend']) ?>
                    <?= $this->Html->link('Voir plus', ['controller' => 'Market', 'action' => ''], ['class' => 'see-more']) ?>
                </div>
            </div>
        </section>
        <section class="section-packets">
            <div class="section-header">
                <h2 class="paquet-title">
                    Généré avec l'IA
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
                    <?= $cell = $this->cell('Packets::display', ['ai']) ?>
                    <?= $this->Html->link('Voir plus', ['controller' => 'Market', 'action' => ''], ['class' => 'see-more']) ?>
                </div>
            </div>
        </section>
        <section class="section-packets">
            <div class="section-header">
                <h2 class="paquet-title">
                    Les plus importés
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
                    <?= $cell = $this->cell('Packets::display', ['import']) ?>
                    <?= $this->Html->link('Voir plus', ['controller' => 'Market', 'action' => ''], ['class' => 'see-more']) ?>
                </div>
            </div>
        </section>
            <section class="section-feature new">
                <div class="content">
                    <div class="badge">Leitlearn AI</div>
                    <h2 class="title">Créez vos paquets <span>avec l'IA</span></h2>
                    <p class="desc">Générez vos flashcards puis créer votre paquet directement grâce à l'intelligence articielle de Leitlearn.</p>
                </div>
            </section>
            <section class="section-features">
                <div class="feature">
                    <div class="media market"></div>
                    <div class="content">
                        <h3 class="title">Parcourez notre <span class="pink">marché</span></h3>
                        <h6 class="desc">
                            Explorez notre Marché, une fonctionnalité qui permet à nos utilisateurs de partager, d'importer des paquets et des flashcards. Créez, échangez et découvrez une variété de ressources éducatives.
                        </h6>
                        <a href="/market" class="action pink">Parcourir</a>
                    </div>
                </div>
                <div class="feature">
                    <div class="media learn"></div>
                    <div class="content">
                        <h3 class="title">Apprenez grâce à <span class="yellow">Leitner</span></h3>
                        <h6 class="desc">
                            Découvrez notre mode Leitner, une approche innovante pour un apprentissage plus efficace. Notre plateforme offre un espace dédié où les utilisateurs peuvent réviser selon une répétition journalière.
                        </h6>
                        <a href="#" class="action yellow modal-btn" data-modal="register-modal">S'inscire</a>
                    </div>
                </div>
                <div class="feature">
                    <div class="media leitlearn-2"></div>
                    <div class="content">
                        <h3 class="title">Découvrez la mise à jour <span class="dashed">Leitlearn 2.0</span></h3>
                        <h6 class="desc">
                            Système d'amis, d'importation/d'exportation par CSV, des flashcards musiques et images, des meilleures performances et plus encore...
                        </h6>
                        <a href="/blog/announcing-leitlearn-2" class="action white">Décourvrir</a>
                    </div>
                </div>
            </section>
            <?= $this->element('landing_footer') ?>
        </div>
</main>