/**
 * Leitlearn AI
 *
 * Description:
 * Ce script gère les fonctionnalités principales du chatbot Leitlearn AI,
 *
 * Auteur: Leitlearn
 * Version: 2.0
 * Date de création: 10 Janvier 2024
 *
 * @license Usage privé uniquement. Toute utilisation, reproduction
 * ou distribution est strictement interdite sans autorisation préalable.
 *
 * -------------------------------------------------------------------------
 */

var csrfToken = document.body.dataset.csrfToken;
export const initAi = () => {
    $('#ai-create-submit').hide();

    eventOpeningAI();
    welcomeMessage();
    aiRequestApiEvent();
    aiSubmitEvent();
};

/**
 * Gère l'ouverture et la fermeture du modal de Leitlearn AI
 * @param {string} nom - Le nom de la personne à saluer.
 * @throws {Error} Si le nom n'est pas fourni.
 */
const eventOpeningAI = () => {
    const ia_open = $(".ia-open");
    const ia = $(".ia-chatbot");
    const ia_hide = $("#ia-hide");

    if (ia_open.length > 0 && ia_hide.length > 0 && ia.length > 0) {
        ia_open.on('click', function() {
            ia.addClass('show');
        });

        ia_hide.on('click', function() {
            ia.removeClass('show');
        });
    }
}

/**
 * Gestion de l'animation des messages
 * @param {string} element - Message à animer
 * @throws {Error} Aucun message n'a été fourni
 */
const animateMessage = (element) => {
    var message = $(element).text();
    $(element).empty();
    for (var i = 0; i < message.length; i++) {
        $(element).append('<span style="display: none;">' + message[i] + '</span>');
        $(element).find('span:last').delay(50 * i).fadeIn(50);
    }
}

/**
 * Création du message
 * @param {string} className - Classe du message
 * @param {boolean} isAI - Si le message est une réponse de l'IA
 * @param {string} text - Contenu du message
 * @throws {Error} Aucun message n'a été fourni
 */
const createMessage = (className, isAI, text) => {
    var messageContainer = $('<div>').addClass('message').addClass(className);
    var userSection = $('<div>').addClass('user');
    var profilePictureClass = isAI ? 'profile-picture user-ia' : 'profile-picture';
    var profilePicture = $('<div>').addClass(profilePictureClass);
    userSection.append(profilePicture);
    var contentSection = $('<div>').addClass('content message-animation').text(text);
    messageContainer.append(userSection);
    messageContainer.append(contentSection);

    return messageContainer;
}

/**
 * Création de la flashcard
 * @param {string} question - Question de la flashcard
 * @param {boolean} answer - Réponse de la flashcard
 * @throws {Error} Une erreur est survenue
 */
const createFlashcard = (question, answer) => {
    var messageContainer = $('<div>').addClass('ai-flashcard');
    var questionSection = $('<div>').addClass('ai-flashcard-content').addClass('ai-flashcard-question').text('Question: ' + question);
    var answerSection = $('<div>').addClass('ai-flashcard-content').addClass('ai-flashcard-answer').text('Answer: ' + answer);

    messageContainer.append(questionSection, answerSection);

    return messageContainer;
}

/**
 * Ajoute le message au chat
 * @param {string} messageElement - Message
 * @throws {Error} Aucun message n'a été fourni
 */
const appendMessageToChat = (messageElement) => {
    $('.chat').append(messageElement);
    animateMessage(messageElement.find('.content'));
}

const appendFlashcardToChat = (flashcard) => {
    $('.chat').append(flashcard);
}

/**
 * Envoie un message en attente de la réponse
 */
const waitingMessage = () => {
    var messageText = "...";
    var newMessageAI = createMessage('message-left', true, messageText);
    appendMessageToChat(newMessageAI);
}

const errorMessage = () => {
    var messageText = "Un problème est survenue avec votre demande, merci de recharger la page.";
    var newMessageAI = createMessage('message-left', true, messageText);
    appendMessageToChat(newMessageAI);
}

const welcomeMessage = () => {
    var messageText = "Bienvenue sur Leitlearn AI, indiquez-moi sur quel sujet vous souhaitez obtenir votre paquet (par exemple : Seconde Guerre Mondiale, Fonctions mathématiques...)";
    var newMessageAI = createMessage('message-left', true, messageText);
    appendMessageToChat(newMessageAI);
}

const aiRequestApiEvent = () => {
    $("#ai-request-submit").click(function(event) {
        event.preventDefault();
        var aiRequestValue = $("#ai-request").val();
        var aiRequestNumber = $("#ai-number-requested").val();
        var userMessageText = "Je veux " + aiRequestNumber + " flashcards pour le sujet : " + aiRequestValue;
        var newUserMessage = createMessage('message-right', false, userMessageText);
        appendMessageToChat(newUserMessage);

        $('#ai-input-group').hide();
        $('#ai-request-submit').hide();
        $('#ai-create-submit').show();
        $('#ai-create-submit').prop('disabled', true);

        setTimeout(waitingMessage, 4000);

        var formData = {
            _csrfToken: csrfToken,
            message: aiRequestValue,
            nbFlashcard: aiRequestNumber
        };


        if (aiRequestNumber <= 10) {
            $.ajax({
                type: "POST",
                url: "/ai/request",
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response && response.length > 0) {
                        function displayResponses() {
                            $.each(response, function(index, element) {
                                var flashcard = createFlashcard(element.Question, element.Answer);
                                appendFlashcardToChat(flashcard);
                                $('#ai-create-submit').prop('disabled', false);
                            });
                        }
                        setTimeout(displayResponses, 5000);
                    } else {
                        errorMessage();
                    }
                },
                error: function(response) {},
            });
        } else {
            errorMessage();
        }
    });
}

const aiSubmitEvent = () => {
    $("#ai-create-submit").click(function(event) {
        var tableFlashcard = [];
        var aiFlashcards = $('[class^="ai-flashcard"]');

        aiFlashcards.each(function(index, flashcard) {
            var question = $(flashcard).find('.ai-flashcard-question').text().trim();
            var answer = $(flashcard).find('.ai-flashcard-answer').text().trim();
            question = question.replace('Question:', '').trim();
            answer = answer.replace('Answer:', '').trim();

            if (question !== "" && answer !== "") {
                var flashcardObject = {
                    question: question,
                    answer: answer
                };
                tableFlashcard.push(flashcardObject);
            }
        });

        var inputValue = $("#ai-request").val();
        var dataToSend = {
            _csrfToken: csrfToken,
            flashcardsArray: JSON.stringify(tableFlashcard),
            input: inputValue
        };

        $.ajax({
            type: "POST",
            url: "/ai/response",
            data: dataToSend,
            success: function(response) {
                window.location.href = "/dashboard";
            },
        });
    });
}