const path = require('path');

module.exports = {
    entry: './webpack/js/app.js', // Point d'entrée de votre application JavaScript
    output: {
        path: path.resolve(__dirname, 'webroot/js'), // Répertoire de sortie dans webroot/js
        filename: 'bundle.js' // Nom du fichier de sortie
    }
};