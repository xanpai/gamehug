const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './config/*.php',
    ],

    darkMode: 'class',
    theme: {
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: '1.5rem',
                },
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                moontank: ['MOONTANK', 'sans-serif'],
            },
            screens: {
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
                '3xl': '1930px',
                '4xl': '2048px',
                '5xl': '3840px', 
            },
            maxWidth: {
                '100': '100rem',  // This adds a new max-width of 100rem
                '9xl': '120rem',
            },
            letterSpacing: {
                tighter: '-.015em',
                tight: '-.010rem',
                normal: '0',
                wide: '.025em',
                wider: '.05em',
            },
            fontSize: {
                xxs: '10px'
            },
            aspectRatio: {
                auto: 'auto',
                poster: '2 / 3',
                square: '1 / 1',
                video: '16 / 9',
                slide: '3 / 1'
            },
            colors: {
                primary: {
                    50: "rgb(var(--color-primary-50) / <alpha-value>)",
                    100: "rgb(var(--color-primary-100) / <alpha-value>)",
                    200: "rgb(var(--color-primary-200) / <alpha-value>)",
                    300: "rgb(var(--color-primary-300) / <alpha-value>)",
                    400: "rgb(var(--color-primary-400) / <alpha-value>)",
                    500: "rgb(var(--color-primary-500) / <alpha-value>)",
                    600: "rgb(var(--color-primary-600) / <alpha-value>)",
                    700: "rgb(var(--color-primary-700) / <alpha-value>)",
                    800: "rgb(var(--color-primary-800) / <alpha-value>)",
                    900: "rgb(var(--color-primary-900) / <alpha-value>)",
                },
                gray: {
                    50: "rgb(var(--color-gray-50) / <alpha-value>)",
                    100: "rgb(var(--color-gray-100) / <alpha-value>)",
                    200: "rgb(var(--color-gray-200) / <alpha-value>)",
                    300: "rgb(var(--color-gray-300) / <alpha-value>)",
                    400: "rgb(var(--color-gray-400) / <alpha-value>)",
                    500: "rgb(var(--color-gray-500) / <alpha-value>)",
                    600: "rgb(var(--color-gray-600) / <alpha-value>)",
                    700: "rgb(var(--color-gray-700) / <alpha-value>)",
                    800: "rgb(var(--color-gray-800) / <alpha-value>)",
                    900: "rgb(var(--color-gray-900) / <alpha-value>)",
                    950: "rgb(var(--color-gray-950) / <alpha-value>)",
                },
            },
            keyframes: {
                loading: {
                    '0%': { left: '-100%' },
                    '50%': { left: '100%' },
                    '100%': { left: '-100%' },
                },
                glow: {
                    '0%, 100%': { boxShadow: '0 0 5px #10B981, 0 0 10px #10B981' },
                    '50%': { boxShadow: '0 0 20px #10B981, 0 0 30px #10B981' },
                },
                pulse: {
                    '0%, 100%': { opacity: 1 },
                    '50%': { opacity: 0.5 },
                },
            },
            animation: {
                loading: 'loading 2s linear infinite',
                glow: 'glow 2s ease-in-out infinite',
                pulse: 'pulse 2s infinite ease-in-out',
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar')({nocompatible: true})
    ],
};
