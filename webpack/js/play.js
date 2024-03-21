
/*

var checkboxText = $('#switch-17')[0];
var checkboxLeit = $('#switch-10')[0];
let flashcardsData;
let flashcardTable;
let correctFlashcardsCount = 0;
var idPacket;
let isLeitnerMode = true;
const divTextArea = $('#game-text-area');
const inputTextArea = $('#input-text-area');
const visuGame = $('#game-visu');
const button_retour = $('#btn-retour');
const btn_visu_next = $('#btn-visu-next');
const btn_visu_prev = $('#btn-visu-prev');
const btn_play_valid = $('#btn-valid');
const btn_play_echec = $('#btn-echec');
const btn_play_hidden = $('#hide-btn-play');
var checkboxText = $('#switch-17')[0];
var checkboxLeit = $('#switch-10')[0];

if (checkboxLeit) {
    if (checkboxLeit.checked) {
        isLeitnerMode = false;
        remainingTimeToP();
        loadGame();
        checkboxLeit.value = "true";
    }
    $(checkboxLeit).on('change', function () {
        if (checkboxLeit.checked) {
            isLeitnerMode = false;
            remainingTimeToP();
            checkboxLeit.value = "true";
            loadGame();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            isLeitnerMode = true;
            pToRemainingTime();
            checkboxLeit.value = "false";
            loadGame();
        }
    });
}

if (checkboxText) {
    if (checkboxText.checked) {
        divTextArea.css('display', 'flex');
        visuGame.style.width = "70%";
    }
    $(checkboxText).on('change', function () {
        if (checkboxText.checked) {
            divTextArea.css('display', 'flex');
            visuGame.css('width', '70%');

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            divTextArea.css('display', 'none');
            visuGame.css('width', '100%');
        }
    });
}
loadGame();


////////////////////////////////////////////////////////////////////


/**
 * Charge les données du paquet de cartes flash à partir de l'API,
 * filtre les données en mode Leitner, et initialise les événements de la souris.
 */
function loadGame()
{
    const currentPath = window.location.pathname;
    const pathSegments = currentPath.split('/');
    const paquetId = pathSegments[pathSegments.length - 1];

    if (paquetId) {
        idPacket = paquetId;

        $.ajax({
            url: '/market/get/' + paquetId,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                flashcardsData = data.flashcards;
                if (isLeitnerMode) {
                    flashcardsData = flashcardsData.filter((flashcard) => {
                        const today = new Date();
                        const appearanceDate = new Date(flashcard.modified);
                        return appearanceDate <= today;
                    });
                }
                mouseEvent();
            },
            error: function (error) {
                console.error('Erreur lors de la récupération des données :', error);
            }
        });
    }
}

/**
 * Initialise les événements de la souris pour les boutons de jeu.
 */
function mouseEvent()
{
    const button_play = $('#btn-play').eq(0);
    if (button_play) {
            $(button_play).on('click', function () {
                updateContent();
                prepareFlashcards(flashcardsData);
                flashcardTable = flashcardsData.slice();
            });
            $(button_retour).on('click', function () {
                goToDashboard();
            });
    }
}

/**
 * Met à jour le contenu de l'interface lorsqu'une partie est en cours.
 */
function updateContent()
{
    const button_play = $('#btn-play').eq(0);
    var hiddenContent = $('.play-hidden');
    var title = $('#title-game');
    title.css('display', "none");
    title.text("Jeu en cours");
    var btn2 = $('#hide-btn-play');
    if (btn2) {
        btn2.css('display', 'none');
    }
    button_play.css('display', 'none');
    btn_visu_next.css('display', 'none');
    btn_visu_prev.css('display', 'none');
    btn_play_valid.css('display', 'flex');
    btn_play_valid.css('margin-right', '100px');
    btn_play_echec.css('display', 'flex');
    hiddenContent.each(function (index, element) {
        $(element).css('display', 'none');
    });
}

/**
 * Redirige vers le tableau de bord et met à jour le statut de révision via une requête AJAX.
 */
function goToDashboard()
{

    if (divTextArea.css('display') === 'flex') {
        checkboxText.checked = true;
    } else {
        checkboxText.checked = false;
        checkboxLeit.checked = false;
    }
    location.reload();
}

/**
 * Incrémente les dossiers Leitner pour une carte donnée en mode Leitner.
 *
 * @param {number} flashcard_id - L'ID de la carte flash.
 */
function increaseLeitnerFoldersForFlashcard(flashcard_id)
{
    if (isLeitnerMode) {
        $.ajax({
            url: '/flashcards/increase/' + flashcard_id,
            method: 'GET',
            success: function (data) {},
            error: function (error) {}
        });
    }
}

/**
 * Retourne une carte en basculant la classe 'flipped'.
 *
 * @param {jQuery} card - Carte sous forme d'objet jQuery à retourner.
 */
function flipCard(card)
{
    $(card).toggleClass('flipped');
}

/**
 * Prépare les cartes flash pour le jeu en les affichant dans le conteneur de jeu.
 *
 * @param {Array} flashcardsData - Tableau de données des cartes flash.
 */
function prepareFlashcards(flashcardsData)
{
    const gameContainer = $('.game')[0];
    gameContainer.innerHTML = '';
    const progressBar = document.createElement('progress');
    progressBar.value = 0;
    progressBar.max = "100";
    gameContainer.appendChild(progressBar);
    let firstCard = true;
    flashcardsData.forEach((flashcard) => {
        const newCard = document.createElement('div');
        if (firstCard) {
            newCard.classList.add('card', 'active');
            $(newCard).on('click', function () {
                flipCard(this);
            });
            firstCard = false;
        } else {
            newCard.classList.add('card');
            $(newCard).on('click', function () {
                flipCard(this);
            });
        }
        const cardFront = document.createElement('div');
        cardFront.classList.add('card-front');
        const questionParagraph = document.createElement('p');
        questionParagraph.textContent = flashcard.question;
        cardFront.appendChild(questionParagraph);
        const cardBack = document.createElement('div');
        cardBack.classList.add('card-back');
        const answerParagraph = document.createElement('p');
        answerParagraph.textContent = flashcard.answer;
        cardBack.appendChild(answerParagraph);
        const infoDiv = document.createElement('div');
        infoDiv.classList.add('info');
        const infoParagraph = document.createElement('p');
        infoParagraph.innerHTML = 'Afficher la réponse <i class="fa-solid fa-arrow-pointer"></i>';
        infoDiv.appendChild(infoParagraph);
        newCard.appendChild(cardFront);
        newCard.appendChild(cardBack);
        newCard.appendChild(infoDiv);
        gameContainer.appendChild(newCard);
    });
    const finishCard = document.createElement('div');
    finishCard.classList.add('card', 'finish');
    $(finishCard).on('click', function () {
        flipCard(this);
    });
    const cardFrontFinish = document.createElement('div');
    cardFrontFinish.classList.add('card-front');
    const questionParagraphFinish = document.createElement('p');
    questionParagraphFinish.textContent = "Vous avez terminé 🎉 🥳";
    cardFrontFinish.appendChild(questionParagraphFinish);
    const cardBackFinish = document.createElement('div');
    cardBackFinish.classList.add('card-back');
    const answerParagraphFinish = document.createElement('p');
    answerParagraphFinish.textContent = "Vous avez terminé 🎉 🥳";
    cardBackFinish.appendChild(answerParagraphFinish);
    finishCard.appendChild(cardFrontFinish);
    finishCard.appendChild(cardBackFinish);
    gameContainer.appendChild(finishCard);
    const divBtn = document.createElement('div');
    divBtn.classList.add('actions-btn');
    gameContainer.appendChild(divBtn);
    const btnValid = document.createElement('div');
    btnValid.classList.add('action-btn', 'next', 'hidden');
    btnValid.id = 'btn-valid';
    btnValid.style.display = 'flex';
    var validSpan = document.createElement('span');
    validSpan.classList.add("material-symbols-rounded");
    validSpan.textContent = 'check';
    btnValid.appendChild(validSpan);
    $(btnValid).on('click', function () {
        handleBtnValidClick();
    });
    const btnEchec = document.createElement('div');
    btnEchec.classList.add('action-btn', 'next', 'hidden');
    btnEchec.id = 'btn-echec';
    btnEchec.style.display = 'flex';
    var failedSpan = document.createElement('span');
    failedSpan.classList.add("material-symbols-rounded");
    failedSpan.textContent = 'close';
    btnEchec.appendChild(failedSpan);
    $(btnEchec).on('click', function () {
        handleBtnEchecClick();
    });
    divBtn.appendChild(btnValid);
    divBtn.appendChild(btnEchec);
    gameContainer.appendChild(divBtn);
}

/**
 * Gère le clic sur le bouton "Échec" en retirant la carte active et en passant à la suivante.
 */
function handleBtnEchecClick()
{
    const activeCard = $('.card.active')[0];
    if (activeCard) {
        const activeFlashcardIndex = Array.from(activeCard.parentNode.children).indexOf(activeCard);
        if (flashcardTable.length !== 1) {
            flashcardTable.splice(activeFlashcardIndex - 1, 1);
            correctFlashcardsCount++;
            removeCardActiveAndFlipToNext();
            updateProgressBar();
        } else {
            if (checkboxText.checked) {
                visuGame.css('width', '100%');
            }
            removeCardActiveAndFlipToNext();
            correctFlashcardsCount++;
            updateProgressBar();
            hideActionButtons();
            boum();
            button_retour.css('display', 'flex');
            var title = $('#title-game');
            title.text("Session terminée");
        }
    }
}

/**
 * Gère le clic sur le bouton "Valider" en retirant la carte active, incrémentant les dossiers Leitner,
 * et passant à la carte suivante.
 */
function handleBtnValidClick()
{
    const activeCard = $('.card.active')[0];
    if (activeCard) {
        const activeFlashcardIndex = Array.from(activeCard.parentNode.children).indexOf(activeCard);
        var idFlashCard = flashcardTable[0]['id'];
        if (flashcardTable.length != 1) {
            const activeFlashcard = flashcardTable[activeFlashcardIndex - 1];
            increaseLeitnerFoldersForFlashcard(idFlashCard);
            flashcardTable.splice(activeFlashcardIndex - 1, 1);
            correctFlashcardsCount++;
            removeCardActiveAndFlipToNext();
            updateProgressBar();
        } else {
            if (checkboxText.checked) {
                visuGame.css('width', '100%');
            }
            removeCardActiveAndFlipToNext();
            correctFlashcardsCount++;
            increaseLeitnerFoldersForFlashcard(idFlashCard);
            updateProgressBar();
            hideActionButtons();
            boum();
            button_retour.css('display', 'flex');
            var title = $('#title-game');
            title.text("Jeu terminé");
        }
    }
}

/**
 * Met à jour la barre de progression en fonction du nombre de cartes correctes.
 */
function updateProgressBar()
{
    const progressBar = $('progress')[0];
    progressBar.value = (correctFlashcardsCount / flashcardsData.length) * 100;
}

/**
 * Masque les boutons d'action.
 */
function hideActionButtons()
{
    const btnValid = $('#btn-valid');
    const btnEchec = $('#btn-echec');
    if (btnValid && btnEchec) {
        btnValid.css('display', 'none');
        btnEchec.css('display', 'none');
    }
    divTextArea.css('display', 'none');
}

/**
 * Retire la carte active et passe à la suivante.
 */
function removeCardActiveAndFlipToNext()
{
    const activeCard = $('.card.active')[0];
    if (inputTextArea) {
        inputTextArea.val("");
    }
    if (activeCard) {
        activeCard.remove();
        flipToNextCard();
    }
}

/**
 * Bascule vers la carte suivante en la marquant comme active.
 */
function flipToNextCard()
{
    const newActiveCard = $('.card')[0];
    if (newActiveCard) {
        newActiveCard.classList.add('active');
    }
}

/**
 * Met à jour le jeu en réorganisant les cartes.
 */
function updateGame()
{
    const gameContainer = $('.game')[0];
    const activeCard = $('.card.active')[0];
    const lastElement = $('.finish')[0];
    if (activeCard && lastElement) {
        gameContainer.removeChild(activeCard);
        activeCard.classList.remove('active');
        activeCard.classList.remove('flipped');
        gameContainer.insertBefore(activeCard, lastElement);
    }
}

/**
 * Permet de gérer le bouton jouer si mode dans Leitner
 */
function remainingTimeToP()
{
    var updateTime = $('#remainingTime');
    var btnPlay = $('#btn-play');
    updateTime.addClass('hidden');
    btnPlay.removeClass('hidden');
}


/**
 * Permet de gérer le bouton jouer si mode sans Leitner
 */
function pToRemainingTime()
{
    var updateTime = $('#remainingTime');
    var btnPlay = $('#btn-play');
    btnPlay.addClass('hidden');
    updateTime.removeClass('hidden');
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