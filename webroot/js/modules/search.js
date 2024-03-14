export const initSearch = () => {

};

/**
 * Met à jour la recherche avec les nouveaux éléments
 *
 * @param {Object} data - Informations de recherche
 *
 * @returns {void}
 */
export function updateMarketResults(data) {
    let search_results = $(".search-results");
    search_results.empty();

    if (data.length === 0) {
        let noResultElement = $('<span></span>').text('Aucun résultat trouvé');
        search_results.append(noResultElement);
        return;
    }

    $.each(data, function (index, packet) {
        let search_packet = $('<div class="result packet-item modal-btn" data-modal="detail-modal" data-paquet-id="'+ packet.id +'">'+ packet.name +'</div>');

        search_results.append(search_packet);
    });
}
