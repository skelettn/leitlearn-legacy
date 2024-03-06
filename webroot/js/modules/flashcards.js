export const initFlashcards = () => {
    changeCardEvent();
    flipCardEvent();
    hideFlashcardContentEvent();
};

const flipCardEvent = () => {
    $('.flipped-card').on('click', function () {
        flipCard(this);
    });
};

const changeCardEvent = () => {
    let $currentCardIndex = 0;
    const $cards = $('.game .card');
    const $progressBar = $('#progressBar');

    $('.change-card').on('click', function () {
        const indexChange = parseInt($(this).data("change-card"));
        const newIndex = $currentCardIndex + indexChange;

        if (newIndex >= 0 && newIndex < $cards.length) {
            changeCard($cards, $currentCardIndex, $progressBar, indexChange);
            $currentCardIndex = newIndex;
        }
    });
};

const hideFlashcardContentEvent = () => {
    $('.show-btn').on('click', function () {
        $(this).closest('.flashcard').find('.content').toggleClass('show');
    });
}

/**
 * Change la carte active parmi une liste de cartes et met à jour la barre de progression.
 *
 * @param {jQuery} $cards - Collection de cartes sous forme d'objet jQuery.
 * @param {number} currentCardIndex - Index de la carte active actuelle dans la collection.
 * @param {jQuery} $progressBar - Barre de progression sous forme d'objet jQuery.
 * @param {number} direction - Direction dans laquelle changer la carte (1 pour avancer, -1 pour reculer).
 */
const changeCard = ($cards, currentCardIndex, $progressBar, direction) => {
    $($cards[currentCardIndex]).removeClass('active flipped');
    currentCardIndex = (currentCardIndex + direction + $cards.length) % $cards.length;
    $($cards[currentCardIndex]).addClass('active');

    $cards.each(function(index, card) {
        if (index !== currentCardIndex) {
            $(card).removeClass('active');
        }
    });

    const progressValue = (currentCardIndex / ($cards.length - 1)) * 100;
    $progressBar.val(progressValue);
}

/**
 * Retourne une carte en basculant la classe 'flipped'.
 *
 * @param {jQuery} card - Carte sous forme d'objet jQuery à retourner.
 */
const flipCard = (card) => {
    $(card).toggleClass('flipped');
}