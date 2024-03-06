import { api } from '../api.js';
export const initModals = () => {
    modalEventHandler();
    fetchPacketDataThenUpdateModal(); // Récupération des infos d'un paquet cliqué
};

const modalEventHandler = () => {
    // Gestion des modals
    const $modalBtns = $(".modal-btn");
    const $modals = $(".modal");
    const $closeBtns = $(".modal-close");

    $modalBtns.on("click", function () {
        const modalId = $(this).data("modal");
        const $modal = $("#" + modalId);

        $modals.removeClass("show");
        $modal.addClass("show");
    });

    $closeBtns.on("click", function () {
        const index = $closeBtns.index(this);
        $modals.eq(index).removeClass("show");
    });

    $(window).on("click", function (event) {
        $modals.each(function () {
            if ($(event.target).is($(this))) {
                $(this).removeClass("show");
            }
        });
    });
};

const fetchPacketDataThenUpdateModal = () => {
    $('.paquet-item').click(async function () {
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
    var modalTitle = $('#modal-title');
    var modalDetailDescription = $('#modal-detail-description');
    var packetId = $('#modal-detail-packet-id');
    var keywordsContainer = $('#modal-detail-keys').empty();
    var flashcardsTable = $('#modal-detail-flashcards').empty();
    var selectedPacket = $('#modal-detail-selected-packet').empty();
    var creatorPacket = $('#modal-detail-creator');

    // Mise à jour des éléments du modal
    modalTitle.text(data.name);
    modalDetailDescription.text(data.description);
    packetId.val(data.id);

    // Attribution mots clés du paquet
    if (data.keywords && data.keywords.length > 0) {
        var keywordElements = $.map(data.keywords, function (keyword, index) {
            return $('<strong>').addClass('key').attr('id', 'modal-key' + (index + 1)).text(keyword.word);
        });

        keywordsContainer.append(keywordElements);
    }

    // Attribution des nouvelles valeurs pour un paquet
    if (data.flashcards && data.flashcards.length > 0) {
        var flashcardElements = $.map(data.flashcards, function (flashcard, index) {
            return $('<div>').addClass('flashcard').append(
                $('<div>').addClass('question').text(flashcard.question),
                $('<div>').addClass('answer').append(
                    $('<div>').addClass('content show').text(flashcard.answer)
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
    var userPackets = data.user_packets;
    if (userPackets && userPackets.length > 0) {
        var packetOptions = $.map(userPackets, function (userPacket) {
            return $('<option>').attr('value', userPacket.id).text(userPacket.name);
        });

        selectedPacket.append(packetOptions);
    }

    // Mise à jour des informations du créateur
    var creator = data.creator;
    creatorPacket.find('strong').text(creator.username);
    creatorPacket.find('img').attr('src', '/img/user_profile_pic/' + creator.profile_picture);
};

