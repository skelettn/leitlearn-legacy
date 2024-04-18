import {api} from "../api.js";
import {updateMarketResults} from "./search.js";

export const initDecks = () => {
    fetchDecksFromMarket();
};
const fetchDecksFromMarket = () => {
    $('#market_search').on('input', async function () {
        let query = $(this).val();
        if ($.trim(query) !== '') {
            let data;
            try {
                data = await api('/api/explore/get/', query);
                updateMarketResults(data);
            } catch (error) {
                console.error('Une erreur est survenue lors de la récupération des paquets :', error);
            }
        }
    });
}

/**
 * Dashboard Refreshed
 */
const $filters = $('.refresh .filters');
const $deckElements = $('.deck');

if ($filters.length) {
    $filters.find('.filter').click(function () {
        $filters.find('.filter.active').removeClass('active');
        $(this).addClass('active');

        const filterAction = $(this).data('filter-action');

        if (filterAction === 'all') {
            $deckElements.show();
        } else if (filterAction === 'ai') {
            $deckElements.hide();
            $deckElements.filter('[data-deck-ai="1"]').show();
        } else {
            $deckElements.hide();
            $deckElements.filter(`[data-deck-status="${filterAction}"]`).show();
        }
    });
}