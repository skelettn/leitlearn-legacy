export const fetchCategoryIcon = (query) => {
    const categoryData = {
        'Mathematiques': {
            icon: 'function',
            primaryColor: '#3498DB', // Bleu
            secondaryColor: '#AED6F1' // Bleu clair
        },
        'Langues': {
            icon: 'function',
            primaryColor: '#17A589', // Vert emeraude
            secondaryColor: '#82E0AA' // Vert clair
        },
        'Histoire': {
            icon: 'function',
            primaryColor: '#884EA0', // Violet
            secondaryColor: '#D2B4DE' // Violet clair
        },
        'Geographie': {
            icon: 'function',
            primaryColor: '#F39C12', // Orange
            secondaryColor: '#FAD02E' // Jaune clair
        },
        'Litterature': {
            icon: 'function',
            primaryColor: '#E74C3C', // Rouge
            secondaryColor: '#F5B7B1' // Rouge clair
        },
        'Arts': {
            icon: 'function',
            primaryColor: '#E67E22', // Orange
            secondaryColor: '#FAD02E' // Jaune clair
        },
        'Musique': {
            icon: 'function',
            primaryColor: '#D35400', // Rouge orange
            secondaryColor: '#F5B7B1' // Rouge clair
        },
        'Sociales': {
            icon: 'function',
            primaryColor: '#9B59B6', // Violet
            secondaryColor: '#D2B4DE' // Violet clair
        },
        'Programmation': {
            icon: 'function',
            primaryColor: '#27AE60', // Vert emeraude
            secondaryColor: '#82E0AA' // Vert clair
        },
        'Psychologie': {
            icon: 'function',
            primaryColor: '#1F618D', // Bleu fonce
            secondaryColor: '#3498DB' // Bleu clair
        },
        'Philosophie': {
            icon: 'function',
            primaryColor: '#9B59B6', // Violet
            secondaryColor: '#D2B4DE' // Violet clair
        },
        'Economie': {
            icon: 'function',
            primaryColor: '#F39C12', // Orange
            secondaryColor: '#FAD02E' // Jaune clair
        },
        'Biologie': {
            icon: 'function',
            primaryColor: '#27AE60', // Vert emeraude
            secondaryColor: '#82E0AA' // Vert clair
        },
        'Chimie': {
            icon: 'function',
            primaryColor: '#E67E22', // Orange
            secondaryColor: '#FAD02E' // Jaune clair
        },
        'Cuisine': {
            icon: 'function',
            primaryColor: '#D35400', // Rouge orange
            secondaryColor: '#F5B7B1' // Rouge clair
        },
        'Sante': {
            icon: 'function',
            primaryColor: '#27AE60', // Vert emeraude
            secondaryColor: '#82E0AA' // Vert clair
        },
        'Sport': {
            icon: 'function',
            primaryColor: '#1F618D', // Bleu fonce
            secondaryColor: '#3498DB' // Bleu clair
        },
        'Technologie': {
            icon: 'function',
            primaryColor: '#34495E', // Gris bleu
            secondaryColor: '#BDC3C7' // Gris clair
        },
        'Cinema': {
            icon: 'function',
            primaryColor: '#E74C3C', // Rouge
            secondaryColor: '#F5B7B1' // Rouge clair
        },
        'Science': {
            icon: 'genetics',
            primaryColor: '#8E44AD', // Pourpre
            secondaryColor: '#D2B4DE' // Violet clair
        },
    };


    return categoryData[query] || null; // Return null for unknown categories
}