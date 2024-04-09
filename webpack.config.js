const path = require('path');

module.exports = {
    entry: './webpack/index.js', // Point d'entrée de votre application JavaScript
    mode: 'production', // ou 'production'
    output: {
        path: path.resolve(__dirname, 'webroot/js'), // Répertoire de sortie dans webroot/js
        filename: 'bundle.js' // Nom du fichier de sortie
    },
    devServer: {
        static: {
            directory: path.join(__dirname, 'webroot/js'),
        },
        compress: true,
        port: 9000,
        hot: true,
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            }
        ]
    },
    performance : {
        hints : false
    }
};