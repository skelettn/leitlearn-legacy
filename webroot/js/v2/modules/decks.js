import {api} from "../api.js";
import {updateExploreResults} from "./explore.js";

export const initDecks = () => {
    fetchDecksFromExplore();
};

const fetchDecksFromExplore = () => {
    const explore_container_data = $('.explore-packets').data('category');
    $('.explore_input').on('input', async function () {
        var query = $(this).val();
        if($.trim(query) !== '') {
            let data;
            try {
                if (!explore_container_data || $.trim(explore_container_data) === '') {
                    data = await api('/api/explore/get/', query);
                } else {
                    console.log(explore_container_data);
                    data = await api('/api/explore/get/', query, explore_container_data);
                }
                updateExploreResults(data);
            } catch (error) {
                console.error('Une erreur est survenue lors de la récupération des paquets :', error);
            }
        }
    });
}