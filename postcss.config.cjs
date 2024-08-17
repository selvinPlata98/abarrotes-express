module.exports = {
    plugins: [
        require('postcss-import'),
        require('tailwindcss'),
        require('postcss-preset-env')({
            stage: 1,
            features: {
                'focus-within-pseudo-class': false
            }
        })
    ]
};
