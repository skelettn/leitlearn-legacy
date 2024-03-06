export const api = async (url, value, second = null) => {
    console.log(`${url}${value}/${second}`);
    let response;
    try {
        const response = await fetch(`${url}${value}/${second}`);
        if($.trim(second) === '') {
            const response = await fetch(`${url}${value}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(`Erreur lors de l'appel à l'API`, error);
        throw error;
    }
};