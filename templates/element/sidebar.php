<div class="sidebar">
    <div class="sidebar-container">
        <div class="logo"></div>
        <ul>
            <li class="page-redirect" data-redirection="/explore/p">
                <span class="material-symbols-rounded">
                    explore
                </span>
            </li>
            <li class="page-redirect" data-redirection="/home">
                <span class="material-symbols-rounded" style="font-variation-settings: 'FILL';">
                    home
                </span>
            </li>
            <li class="page-redirect" data-redirection="/market">
                <span class="material-symbols-rounded" style="font-variation-settings: 'FILL';">
                    local_mall
                </span>
            </li>
            <li class="page-redirect modal-btn" data-modal="turbo-modal">
                <span class="material-symbols-rounded">
                    rocket_launch
                </span>
            </li>
            <?php if(!$is_logged) : ?>
                <li class="modal-btn" data-modal="login-modal">
                    <span class="material-symbols-rounded" style="font-variation-settings: 'FILL';">
                        person
                    </span>
                </li>
            <?php else: ?>
                <li class="page-redirect" data-redirection="/dashboard">
                    <span class="material-symbols-rounded" style="font-variation-settings: 'FILL';">
                        person
                    </span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>