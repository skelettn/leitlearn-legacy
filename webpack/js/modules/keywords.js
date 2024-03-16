export const initKeywords = () => {
    searchKeywords();
}

const searchKeywords = () => {
    let searchInput = $(".search-keywords");
    let id = window.location.pathname.split('/').pop();

    searchInput.on('input', function() {
        let searchText = $(this).val().toLowerCase();
        $('.keywords').each(function() {
            let keywordText = $(this).find('span').text().toLowerCase();
            if (keywordText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
}