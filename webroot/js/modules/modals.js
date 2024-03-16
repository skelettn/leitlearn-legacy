import { api } from '../api.js';
export const initModals = () => {
    modalEventHandler();
    fetchPacketDataThenUpdateModal();
    fetchFlashcardDataThenUpdateModal();
};

const modalEventHandler = () => {
    const $body = $("body");

    $body.on("click", ".modal-btn", function () {
        const modalId = $(this).data("modal");
        const $modal = $("#" + modalId);

        $(".modal").removeClass("show");
        $modal.addClass("show");
    });

    $body.on("click", ".modal-close", function () {
        const index = $(".modal-close").index(this);
        $(".modal").eq(index).removeClass("show");
    });

    $body.on("click", function (event) {
        $(".modal").each(function () {
            if ($(event.target).is($(this))) {
                $(this).removeClass("show");
            }
        });
    });
};

const fetchPacketDataThenUpdateModal = () => {
    const $body = $("body");

    $body.on("click", ".packet-item", async function () {
        const paquet = $(this);
        const paquetId = paquet.data('paquet-id');

        try {
            const data = await api('/api/market/get/', paquetId);
            updateModalContent(data);
            $('#detail-modal').addClass('show');
        } catch (error) {
            console.error('Une erreur est survenue lors de la gestion du modal :', error);
        }
    });
}

const updateModalContent = (data) => {
    // Caching des sélecteurs jQuery
    let modalTitle = $('#modal-title');
    let modalDetailDescription = $('#modal-detail-description');
    let packetId = $('#modal-detail-packet-id');
    let keywordsContainer = $('#modal-detail-keys').empty();
    let flashcardsTable = $('#modal-detail-flashcards').empty();
    let selectedPacket = $('#modal-detail-selected-packet').empty();
    let creatorPacket = $('#modal-detail-creator');

    // Mise à jour des éléments du modal
    modalTitle.text(data.name);
    modalDetailDescription.text(data.description);
    packetId.val(data.id);

    // Attribution mots clés du paquet
    if (data.keywords && data.keywords.length > 0) {
        let keywordElements = $.map(data.keywords, function (keyword, index) {
            return $('<strong>').addClass('key').attr('id', 'modal-key' + (index + 1)).text(keyword.word);
        });

        keywordsContainer.append(keywordElements);
    }

    // Attribution des nouvelles valeurs pour un paquet
    if (data.flashcards && data.flashcards.length > 0) {
        let flashcardElements = $.map(data.flashcards, function (flashcard, index) {
            return $('<div>').addClass('flashcard').append(
                $('<div>').addClass('question').html(flashcard.question),
                $('<div>').addClass('answer').append(
                    $('<div>').addClass('content show').html(flashcard.answer)
                ),
                $('<div>').addClass('import-actions').append(
                    $('<div>').addClass('action').append(
                        $('<input>').attr({
                            'type': 'checkbox',
                            'name': 'flashcards[]',
                            'value': flashcard.id,
                            'id': 'flashcards' + (index + 1)
                        })
                    )
                )
            );
        });

        flashcardsTable.append(flashcardElements);
    }

    // Récupérations des paquets de l'utilisateur
    let userPackets = data.user_packets;
    if (userPackets && userPackets.length > 0) {
        let packetOptions = $.map(userPackets, function (userPacket) {
            return $('<option>').attr('value', userPacket.id).text(userPacket.name);
        });

        selectedPacket.append(packetOptions);
    }

    // Mise à jour des informations du créateur
    let creator = data.creator;
    creatorPacket.find('strong').text(creator.username);
    creatorPacket.find('img').attr('src', '/img/user_profile_pic/' + creator.profile_picture);
};


const fetchFlashcardDataThenUpdateModal = () => {
    $('.flashcard-item').click(async function () {
        const flashcard = $(this);
        const flashcardId = flashcard.data('flashcard-id');

        try {
            const data = await api('/api/flashcard/get/', flashcardId);
            console.log(data);
            $('#modify-flashcard').addClass('show');
            updateModalFlashcardContent(data);
        } catch (error) {
            console.error('Une erreur est survenue lors de la gestion du modal :', error);
        }
    });
}

const updateModalFlashcardContent = (data) => {
    let editor_front = document.getElementById('editor-modify-flashcard-front');
    let editor_back = document.getElementById('editor-modify-flashcard-back');
    let  text_area_front = editor_front.getElementsByClassName('ql-editor')[0];
    let  text_area_back = editor_back.getElementsByClassName('ql-editor')[0];
    let input_flashcard_id = document.querySelector('input[name="flashcard_id"]');
    text_area_front.innerHTML = data.question;
    text_area_back.innerHTML = data.answer;
    input_flashcard_id.value = data.id;
}