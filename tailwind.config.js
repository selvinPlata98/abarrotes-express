/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./src/**/*.{html,js}",
        './pages/**/*.{html,js}',
        './components/**/*.{html,js}',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        'node_modules/preline/dist/*.js',
    ],
    theme: {
        container: {
            center: true,
            padding: '1rem',
        },
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
        },
        fontFamily: {
            manrope: ['Manrope', 'sans-serif'],
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            white: '#ffffff',
            black: '#010717',
            primary: '#ffff00',
            gray: {
                lighter: '#FAF7F3',
                light: '#323232',
                dark: '#010717',
                txt: '#4c4d56',
                line: '#E5E5E5',
            },
        },
    },
    plugins: [
        require('preline/plugin'),
    ],
};


