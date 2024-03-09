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

        if(packet.ia) {
            var categoryElement = $('<div class="category ai"></div>').append(
                '<span><svg fill="#FFFFFF" width="13px" height="13px" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M208,512a24.84,24.84,0,0,1-23.34-16l-39.84-103.6a16.06,16.06,0,0,0-9.19-9.19L32,343.34a25,25,0,0,1,0-46.68l103.6-39.84a16.06,16.06,0,0,0,9.19-9.19L184.66,144a25,25,0,0,1,46.68,0l39.84,103.6a16.06,16.06,0,0,0,9.19,9.19l103,39.63A25.49,25.49,0,0,1,400,320.52a24.82,24.82,0,0,1-16,22.82l-103.6,39.84a16.06,16.06,0,0,0-9.19,9.19L231.34,496A24.84,24.84,0,0,1,208,512Zm66.85-254.84h0Z"/><path d="M88,176a14.67,14.67,0,0,1-13.69-9.4L57.45,122.76a7.28,7.28,0,0,0-4.21-4.21L9.4,101.69a14.67,14.67,0,0,1,0-27.38L53.24,57.45a7.31,7.31,0,0,0,4.21-4.21L74.16,9.79A15,15,0,0,1,86.23.11,14.67,14.67,0,0,1,101.69,9.4l16.86,43.84a7.31,7.31,0,0,0,4.21,4.21L166.6,74.31a14.67,14.67,0,0,1,0,27.38l-43.84,16.86a7.28,7.28,0,0,0-4.21,4.21L101.69,166.6A14.67,14.67,0,0,1,88,176Z"/><path d="M400,256a16,16,0,0,1-14.93-10.26l-22.84-59.37a8,8,0,0,0-4.6-4.6l-59.37-22.84a16,16,0,0,1,0-29.86l59.37-22.84a8,8,0,0,0,4.6-4.6L384.9,42.68a16.45,16.45,0,0,1,13.17-10.57,16,16,0,0,1,16.86,10.15l22.84,59.37a8,8,0,0,0,4.6,4.6l59.37,22.84a16,16,0,0,1,0,29.86l-59.37,22.84a8,8,0,0,0-4.6,4.6l-22.84,59.37A16,16,0,0,1,400,256Z"/></svg></span>'
            );
            categories.append(categoryElement);
        }

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