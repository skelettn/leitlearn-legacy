export const initEventHandlers = () => {
    if ($('.ia').length === 0) {
        $('.dynamic-redirect').addClass('no-ia');
    }

    redirectionsEvent();
    snackbarEventHandler();
    leitlearnLoadingEvent();
    searchEvents();
    tabsEventHandler();
    animateFormButtons();
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
        let loaderWrapper = $(".loading-wrapper");
        loaderWrapper.hide();
    });
}

const searchEvents = () => {
    let input = document.getElementById('market_search');
    let results = document.querySelector('.search-results');

    if (input) {
        input.addEventListener('focus', function () {
            results.classList.add('active');
        });

        input.addEventListener('blur', function (event) {
            if (!results.contains(event.relatedTarget)) {
                results.classList.remove('active');
            }
        });

        results.addEventListener('mousedown', function (event) {
            event.preventDefault();
        });
    }
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
export function setupScrollMenu($scrollMenu)
{
    const $content = $scrollMenu.find('.scroll-content');
    const $prevButton = $scrollMenu.closest('.section-packets').find('.prev-button');
    const $nextButton = $scrollMenu.closest('.section-packets').find('.next-button');
    let scrollPosition = 0;


    $prevButton.on('click', function () {
        scrollPosition -= 200; // Changer la valeur de défilement selon votre préférence
        if (scrollPosition < 0) {
            scrollPosition = 0;
        }
        updateScrollPosition();
    });

    $nextButton.on('click', function () {
        scrollPosition += 200;
        if (scrollPosition > $content[0].scrollWidth - $content[0].clientWidth) {
            scrollPosition = $content[0].scrollWidth - $content[0].clientWidth;
        }
        updateScrollPosition();
    });

    function updateScrollPosition()
    {
        $content.css('transform', `translateX(-${scrollPosition}px)`);
    }
}


const animateFormButtons = () => {
    const LOADER_DURATION = 3000;

    $(document).on('click', '.loader-button', function (event) {
        event.preventDefault();

        const $form = $(this).closest('form');
        const $button = $(this);
        const $input = $button.find('input[type="submit"]');
        const $loader = $button.find('.loader');

        if (validateForm($form)) {
            $input.val(' ');
            $loader.show();
            $form.submit();
        } else {
            alert("Veuillez remplir tous les champs requis.");
        }
    });

    const validateForm = ($form) => {
        let isValid = true;

        $form.find("[required]").each(function () {
            if ($(this).val() === "") {
                isValid = false;
                return false;
            }
        });

        return isValid;
    };
};

let settingLang = document.getElementById('setting-lang');

if (settingLang) {
    settingLang.addEventListener('change', function () {
        let selectedValue = this.value;
        window.location.href = '/lang/change/' + selectedValue;
    });
}
