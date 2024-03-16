import {api} from "../api.js";
import {updateMarketResults} from "./search.js";

export const initDecks = () => {
    fetchDecksFromMarket();
};

const fetchDecksFromMarket = () => {
    $('#market_search').on('input', async function () {
        let query = $(this).val();
        if($.trim(query) !== '') {
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