export const api = async (url, value, second = null) => {
    let response;
    try {
        let query;
        if($.trim(second) !== '') {
            query = `${url}${value}/${second}`;
        } else {
            query = `${url}${value}`;
        }

        const response = await fetch(query);

        const data = await response.json();
        return data;
    } catch (error) {
        console.error(`Erreur lors de l'appel à l'API`, error);
        throw error;
    }
};