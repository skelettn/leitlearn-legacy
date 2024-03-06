export const initKeywords = () => {
    searchKeywords();
}

const searchKeywords = () => {
    var searchInput = $(".search-keywords");
    var id = window.location.pathname.split('/').pop();

    searchInput.on('input', function() {
        var searchText = $(this).val().toLowerCase();
        $('.keywords').each(function() {
            var keywordText = $(this).find('span').text().toLowerCase();
            if (keywordText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
}