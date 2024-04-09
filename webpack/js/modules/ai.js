import {api} from "../api.js";

/**
 * Leitlearn AI
 *
 * Description:
 * Ce script gère les fonctionnalités principales du chatbot Leitlearn AI,
 *
 * Auteur: Kilian Peyron
 * Version: 2.0
 * Date de création: 9 mars 2024
 *
 * @license Usage privé uniquement. Toute utilisation, reproduction
 * ou distribution est strictement interdite sans autorisation préalable.
 *
 * -------------------------------------------------------------------------
 */
let csrfToken = document.body.dataset.csrfToken;

export const initAi = () => {
    aiRequestEvent();
};

const aiRequestEvent = async() => {
    $('#leitlearn_ai_submit').on("click", async function () {
        if ($('#leitlearn_ai_input').val().length > 0) {
            $(this).hide();  // Utilisez "this" pour faire référence à l'élément cliqué
            loadingEvent();
            let responses = await aiSendRequest();
            removeLoading();
            displayResponses(responses);
            displayActions();
        }
    });
}

async function aiSendRequest()
{
    let query = $('#leitlearn_ai_input').val();
    return await api('/api/ai/request/', query);
}

async function loadingEvent()
{
    for (let i = 1; i <= 5; i++) {
        const flashcard = createFlashcard("ai-skeleton", "ai-skeleton");
        $(".ai-flashcards").append(flashcard);

        setTimeout(function () {
            flashcard.addClass('show');
        }, 150);
    }

    const loadingMessage = createLoadingMessage();
    $('#ai-results').append(loadingMessage);
}

const removeLoading = () => {
    $('.ai-flashcard').each(function () {
        const flashcard = $(this);
        flashcard.removeClass('show');
        setTimeout(function () {
            flashcard.remove();
        }, 100);
    });
    $('.loading').remove();
}

const displayResponses = (response) => {
    $.each(response, function (index, element) {
        let flashcard = createFlashcard("question", "content show", element.Question, element.Answer);
        $(".ai-flashcards").append(flashcard);

        setTimeout(function () {
            flashcard.addClass('show');
        }, 150);
    });
}

const createFlashcard = (questionClass, answerClass, question = "", answer = "") => {
    const flashcard = $("<div>").addClass("flashcard ai-flashcard");

    const flashcard_question = $("<div>").addClass(questionClass).text(question);
    flashcard.append(flashcard_question);

    const flashcard_answer = $("<div>").addClass("answer " + answerClass).text(answer);
    flashcard.append(flashcard_answer);

    return flashcard;
}

const createLoadingMessage = () => {
    const loadingMessage = document.createElement('div');
    loadingMessage.classList.add('loading', 'show');
    loadingMessage.innerHTML = '<?xml version="1.0" encoding="utf-8"?><svg fill="#FFFFFF" width="25px" height="25px" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M208,512a24.84,24.84,0,0,1-23.34-16l-39.84-103.6a16.06,16.06,0,0,0-9.19-9.19L32,343.34a25,25,0,0,1,0-46.68l103.6-39.84a16.06,16.06,0,0,0,9.19-9.19L184.66,144a25,25,0,0,1,46.68,0l39.84,103.6a16.06,16.06,0,0,0,9.19,9.19l103,39.63A25.49,25.49,0,0,1,400,320.52a24.82,24.82,0,0,1-16,22.82l-103.6,39.84a16.06,16.06,0,0,0-9.19,9.19L231.34,496A24.84,24.84,0,0,1,208,512Zm66.85-254.84h0Z"/><path d="M88,176a14.67,14.67,0,0,1-13.69-9.4L57.45,122.76a7.28,7.28,0,0,0-4.21-4.21L9.4,101.69a14.67,14.67,0,0,1,0-27.38L53.24,57.45a7.31,7.31,0,0,0,4.21-4.21L74.16,9.79A15,15,0,0,1,86.23.11,14.67,14.67,0,0,1,101.69,9.4l16.86,43.84a7.31,7.31,0,0,0,4.21,4.21L166.6,74.31a14.67,14.67,0,0,1,0,27.38l-43.84,16.86a7.28,7.28,0,0,0-4.21,4.21L101.69,166.6A14.67,14.67,0,0,1,88,176Z"/><path d="M400,256a16,16,0,0,1-14.93-10.26l-22.84-59.37a8,8,0,0,0-4.6-4.6l-59.37-22.84a16,16,0,0,1,0-29.86l59.37-22.84a8,8,0,0,0,4.6-4.6L384.9,42.68a16.45,16.45,0,0,1,13.17-10.57,16,16,0,0,1,16.86,10.15l22.84,59.37a8,8,0,0,0,4.6,4.6l59.37,22.84a16,16,0,0,1,0,29.86l-59.37,22.84a8,8,0,0,0-4.6,4.6l-22.84,59.37A16,16,0,0,1,400,256Z"/></svg> Leitlearn Ai recherche des cartes pour vous...';

    return loadingMessage;
}

const displayActions = () => {
    const actions = $("<div>").addClass("actions");
    const reload = $("<div>").addClass("action update").html('<span class="material-symbols-rounded">restart_alt</span>');
    const keep = $("<div>").addClass("action keep").html('<span class="material-symbols-rounded">done</span>');

    $('#ai-results').append(actions);
    actions.append(reload, keep);

    reload.on("click", resetAndReload);
    keep.on("click", createDeck);
}

const resetAndReload = async() => {
    $('.ai-flashcards').empty();
    $('#ai-results .actions').remove();

    loadingEvent();
    let responses = await aiSendRequest();
    removeLoading();
    displayResponses(responses);
    displayActions();
};

const createDeck = () => {
    let flashcards = [];
    let aiFlashcards = $('.flashcards').children();

    aiFlashcards.each(function (index, flashcard) {
        let question = $(flashcard).find('.question').text().trim();
        let answer = $(flashcard).find('.content').text().trim();
        question = question.replace('question:', '').trim();
        answer = answer.replace('answer:', '').trim();

        if (question !== "" && answer !== "") {
            let flashcardObject = {
                question: question,
                answer: answer
            };
            flashcards.push(flashcardObject);
        }
    });

    let query = $('#leitlearn_ai_input').val();
    let data = {
        _csrfToken: csrfToken,
        flashcards: JSON.stringify(flashcards),
        query: query,
    };

    $.ajax({
        type: "POST",
        url: "/packets/aiResponse",
        data: data,
        success: function (response) {
            window.location.href = "/dashboard";
        },
    });
}