export const fetchCategoryIcon = (query) => {
    const categoryData = {
        'Mathematiques': {
            icon: 'function',
            primaryColor: '#0074D9',
            secondaryColor: '#B3E0FF'
        },
        'Langues': {
            icon: 'translate',
            primaryColor: '#2ECC40',
            secondaryColor: '#DFF9E2'
        },
        'Histoire': {
            icon: 'history_edu',
            primaryColor: '#FF4136',
            secondaryColor: '#FFC3B0'
        },
        'Geographie': {
            icon: 'public',
            primaryColor: '#FF851B',
            secondaryColor: '#FFD8B2'
        },
        'Litterature': {
            icon: 'book',
            primaryColor: '#B10DC9',
            secondaryColor: '#E8CEF7'
        },
        'Arts': {
            icon: 'palette',
            primaryColor: '#FFDC00',
            secondaryColor: '#FFF8C6'
        },
        'Musique': {
            icon: 'music_note',
            primaryColor: '#FF6300',
            secondaryColor: '#FFD1B2'
        },
        'Sociales': {
            icon: 'groups',
            primaryColor: '#7D3C98',
            secondaryColor: '#D8B4E2'
        },
        'Programmation': {
            icon: 'code',
            primaryColor: '#39CCCC',
            secondaryColor: '#B2EBF2'
        },
        'Psychologie': {
            icon: 'psychology',
            primaryColor: '#001F3F',
            secondaryColor: '#428BCA'
        },
        'Philosophie': {
            icon: 'light',
            primaryColor: '#4B0082',
            secondaryColor: '#9678D3'
        },
        'Economie': {
            icon: 'account_balance',
            primaryColor: '#FF851B',
            secondaryColor: '#FFD8B2'
        },
        'Biologie': {
            icon: 'biotech',
            primaryColor: '#39CCCC',
            secondaryColor: '#B2EBF2'
        },
        'Chimie': {
            icon: 'science',
            primaryColor: '#FFDC00',
            secondaryColor: '#FFF8C6'
        },
        'Cuisine': {
            icon: 'skillet',
            primaryColor: '#FF6300',
            secondaryColor: '#FFD1B2'
        },
        'Sante': {
            icon: 'spa',
            primaryColor: '#39CCCC',
            secondaryColor: '#B2EBF2'
        },
        'Sport': {
            icon: 'fitness_center',
            primaryColor: '#001F3F',
            secondaryColor: '#428BCA'
        },
        'Technologie': {
            icon: 'devices',
            primaryColor: '#34495E',
            secondaryColor: '#BDC3C7'
        },
        'Cinema': {
            icon: 'movie',
            primaryColor: '#B10DC9',
            secondaryColor: '#E8CEF7'
        },
        'Science': {
            icon: 'genetics',
            primaryColor: '#8E44AD',
            secondaryColor: '#D8B4E2'
        },
    };


    return categoryData[query] || null; // Return null for unknown categories
}