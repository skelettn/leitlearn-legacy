export const initEventHandlers = () => {
    if ($('.ia').length === 0) {
        $('.dynamic-redirect').addClass('no-ia');
    }

    redirectionsEvent();
    snackbarEventHandler();
    leitlearnLoadingEvent();
    tabsEventHandler();
};

const redirectionsEvent = () => {
    const $btnRedirection = $(".redirect");

    $(document).on('click', '.page-redirect[data-redirection]', function () {
        const redirectionURL = $(this).data('redirection');
        window.location.href = redirectionURL;
    });

    $(document).on("click", ".redirect", function () {
        $("html, body").animate({
            scrollTop: 0
        }, "smooth");
    });

    $(document).on("scroll", function () {
        if ($(window).scrollTop() > 50) {
            $btnRedirection.addClass("show");
        } else {
            $btnRedirection.removeClass("show");
        }
    });

    $('.scroll-menu').each(function () {
        setupScrollMenu($(this));
    });
}

const snackbarEventHandler = () => {
    const $snackbar = $("#snackbar");

    setTimeout(function () {
        if ($snackbar.hasClass("show")) {
            $snackbar.removeClass("show");
        }
    }, 2700);
}

const leitlearnLoadingEvent = () => {
    $(document).ready(function () {
        var loaderWrapper = $(".loading-wrapper");
        loaderWrapper.hide();
    });
}

const tabsEventHandler = () => {
    const $tabButtons = $(".switch-tab");
    const $tabs = $(".tab");

    $tabButtons.on("click", function () {
        $tabButtons.removeClass("active");
        $tabs.hide();

        $(this).addClass("active");

        const targetTabId = $(this).data("tab");
        const $targetTab = $("#" + targetTabId);

        if (targetTabId === "detail-tab-flashcards" || targetTabId === "dashboard-flashcards-tab") {
            $targetTab.show();
        } else {
            $targetTab.css("display", "flex");
        }
    });
}

/**
 * Configure un menu déroulant pour faire défiler son contenu horizontalement.
 *
 * @param {jQuery} $scrollMenu - Menu déroulant sous forme d'objet jQuery.
 */
export function setupScrollMenu($scrollMenu) {
    // Sélection des éléments nécessaires du menu déroulant
    const $content = $scrollMenu.find('.scroll-content');
    const $prevButton = $scrollMenu.find('.prev-button');
    const $nextButton = $scrollMenu.find('.next-button');
    let scrollPosition = 0; // Position actuelle de défilement

    // Gestionnaire de clic pour le bouton précédent
    $prevButton.on('click', function() {
        scrollPosition -= 500;
        if (scrollPosition < 0) {
            scrollPosition = 0;
        }
        updateScrollPosition();
    });

    // Gestionnaire de clic pour le bouton suivant
    $nextButton.on('click', function() {
        scrollPosition += 500;
        if (scrollPosition > $content[0].scrollWidth - $content[0].clientWidth) {
            scrollPosition = $content[0].scrollWidth - $content[0].clientWidth;
        }
        updateScrollPosition();
    });

    // Met à jour la position de défilement en fonction de la position actuelle
    function updateScrollPosition() {
        $content.css('transform', `translateX(-${scrollPosition}px)`);
    }
}