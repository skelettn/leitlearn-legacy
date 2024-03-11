<?php
$this->assign('title', 'Mon dashboard');
?>
<main class="dashboard-container">
    <?= $this->element('dashboard_fixed_mobile') ?>
    <div class="container dashboard">
        <section>
            <div class="section-header">
                <h1 class="part-title">Mes paquets</h1>
                <ul class="actions">
                    <li class="action active modal-btn" data-modal="create-packet">
                        Créer un paquet
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </li>
                    <li class="action modal-btn" data-modal="import-packet">
                        Importer un paquet
                        <span class="material-symbols-rounded">
                            upload_file
                        </span>
                    </li>
                </ul>
            </div>
            <div class="paquets">
                <?= $cell = $this->cell('Packets::display', ['my', $user_data["id"], 'dashboard']) ?>
            </div>
        </section>
        <section>
            <div class="section-header">
                <h1 class="part-title">Mes amis</h1>
                <ul class="actions">
                    <li class="action active modal-btn" data-modal="search-users">
                        Ajouter des amis
                        <span class="material-symbols-rounded">
                            person_add
                        </span>
                    </li>
                </ul>
            </div>
            <?= $this->cell('Friends::display') ?>
        </section>
        <section class="new">
            <h2 class="part-title">Découvrez les nouveautés</h2>
            <div class="features">
                <div class="feature">
                    <div class="media" style="background-image: url('/img/andre-hunter-AQ908FfdAMw-unsplash.jpg');"></div>
                    <div class="data">
                        <h4 class="title">Suivi</h4>
                        <p class="desc">Accédez à votre suivi d'avancement de chaque paquet directement dans la section statistique du paquet.</p>
                    </div>
                </div>
                <div class="feature">
                    <div class="media" style="background-image: url('/img/andre-hunter-AQ908FfdAMw-unsplash.jpg');"></div>
                    <div class="data">
                        <h4 class="title">Marché</h4>
                        <p class="desc">Explorez et utilisez les paquets et flashcards créés par d'autres utilisateurs sur votre espace personnel.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>