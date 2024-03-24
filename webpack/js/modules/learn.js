export const initSessions = () => {
        handleBtnValidClick();
        handleBtnFailClick();
    }

let active_flashcard = document.querySelector('.card.active');

/**
 * Gestion des énèvements si le bouton 'validé' est clické.
 */
function handleBtnValidClick()
{
    let btn_valid = document.getElementById('btn-valid');
    if (btn_valid) {
        btn_valid.addEventListener('click', function () {
            removeCardActiveAndFlipToNext();
            updateProgressBar();
        });
    }
}

/**
 * Gestion des énèvements si le bouton 'échec' est clické.
 */
function handleBtnFailClick()
{
    let btn_fail = document.getElementById('btn-fail');
    if (btn_fail) {
        btn_fail.addEventListener('click', function () {
            addElementBeforeFinish();
        });
    }
}

/**
 * Supprime la flashcard active et passe à l'autre flashcard.
 */
function removeCardActiveAndFlipToNext()
{
    if (active_flashcard && !active_flashcard.classList.contains('finish')) {
        active_flashcard.remove();
        flipToNextCard();
    }
}

/**
 * Ajoute la flashcard à la fin du jeu.
 */
function addElementBeforeFinish()
{
    let game_visu = document.getElementById('game-visu-session');
    let element = active_flashcard;
    element.classList.remove('active');
    let finish = document.getElementsByClassName('finish')[0];
    finish.parentNode.insertBefore(element, finish);
    let new_first_flashcard = game_visu.children[1];
    new_first_flashcard.classList.add('active');
    active_flashcard = new_first_flashcard;
}

/**
 * Bascule vers la carte suivante en la marquant comme active.
 */
function flipToNextCard()
{
    let newActiveCard = document.querySelector('.card');
    if (newActiveCard) {
        newActiveCard.classList.add('active');
        active_flashcard = newActiveCard;
    }
}

/**
 * Met à jour la barre de progression en fonction du nombre de cartes correctes.
 */
function updateProgressBar()
{
    let correct_flashcards_count = 0;
    let flashcards_count = document.getElementById('game-visu-session').childElementCount - 2;
    correct_flashcards_count++;
    const progressBar = document.getElementById('progressBar-session');
    progressBar.value = (correct_flashcards_count / flashcards_count) * 100;
    if (correct_flashcards_count === flashcards_count) {
        //boum();
    }
}

/**
 * Fait une animation conffeti à la fin de la session de jeu.
 */
function boum()
{
    const defaults = {
        spread: 360,
        ticks: 100,
        gravity: 0,
        decay: 0.94,
        startVelocity: 30,
    };

    function shoot()
    {
        confetti({
            ...defaults,
            particleCount: 30,
            scalar: 1.2,
            shapes: ["circle", "square"],
            colors: ["#a864fd", "#29cdff", "#78ff44", "#ff718d", "#fdff6a"],
        });
        confetti({
            ...defaults,
            particleCount: 20,
            scalar: 2,
            shapes: ["emoji"],
            shapeOptions: {
                emoji: {
                    value: ["🥳", "🌈", "🎉"],
                },
            },
        });
    }
    setTimeout(shoot, 0);
    setTimeout(shoot, 100);
    setTimeout(shoot, 200);
}