import {fetchCategoryIcon} from "../utils/categories.js";

export const initExplore = () => {
    initCategories();
};

const initCategories = () => {
    var exploreCategories = $(".explore-category");

    exploreCategories.each(function(index, element) {
        var categoryName = $(element).find(".name").text();
        var iconElement = $(element).find(".icon");
        var iconData = fetchCategoryIcon(categoryName);

        iconElement.css("background", iconData.secondaryColor);
        iconElement.css("color", iconData.primaryColor);
        iconElement.find(".material-symbols-rounded").html(iconData.icon);

    });
}

/**
 * Met à jour la recherche avec les nouveaux éléments
 *
 * @param {Object} data - Informations de recherche
 *
 * @returns {void}
 */
export function updateExploreResults(data) {
    var explore_packets = $(".explore-packets");
    explore_packets.empty();

    if (data.length === 0) {
        var noResultElement = $('<span class="no-results"></span>').text('Aucun résultat trouvé');
        explore_packets.append(noResultElement);
        return;
    }

    $.each(data, function (index, packet) {
        var explore_packet = $('<div class="explore-packet page-redirect" data-redirection="/packets/view/' + packet.id + '">');

        var packetTitle = $('<div class="packet-title"></div>').text(packet.name);
        var packetInfos = $('<div class="packet-infos"></div>');

        var categories = $('<div class="categories"></div>');

        $.each(packet.keywords, function (i, category) {
            var categoryElement = $('<div class="category"></div>').append(
                '<span class="material-symbols-rounded" style="color: ' + fetchCategoryIcon(category.word).primaryColor + ';background: ' + fetchCategoryIcon(category.word).secondaryColor + ';">'
                + fetchCategoryIcon(category.word).icon +
                '</span>'
            );
            categories.append(categoryElement);
        });

        var strongElement = $('<strong></strong>').text(packet.cardCount + ' cartes · ' + packet.importation_count + ' importations');
        var viewPacket = $('<div class="view-packet"></div>').append('<span class="material-symbols-rounded">open_in_new</span>');

        packetInfos.append(categories, strongElement);
        explore_packet.append(packetTitle, packetInfos, viewPacket);

        explore_packets.append(explore_packet);
    });
}