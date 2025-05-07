import forms from '@tailwindcss/forms';
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
              container: {
                    center: true,
                    padding: "2rem",
                    screens: {
                        "2xl": "1400px",
                    },
                },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dashboardPrimary: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                },
                //  primary: "#4F46E5",
                primary: {
                    DEFAULT: "rgb(20, 184, 166)",
                    foreground: "rgb(250, 250, 250)",
                },
                primary: {
    50: '#ecfdf5',
    100: '#d1fae5',
    200: '#a7f3d0',
    300: '#6ee7b7',
    400: '#34d399',
    500: '#10b981', // <-- This is the missing `primary-500`
    600: '#059669',
    700: '#047857',
    800: '#065f46',
    900: '#064e3b',
},
                secondary: "#10B981",
                border: "rgb(229, 231, 235)",
                input: "rgb(229, 231, 235)",
                ring: "rgb(10, 10, 10)",
                background: "rgb(255, 255, 255)",
                foreground: "rgb(10, 10, 10)",
                secondary: {
                    DEFAULT: "rgb(245, 245, 245)",
                    foreground: "rgb(23, 23, 23)",
                },
                destructive: {
                    DEFAULT: "rgb(239, 68, 68)",
                    foreground: "rgb(250, 250, 250)",
                },
                muted: {
                    DEFAULT: "rgb(245, 245, 245)",
                    foreground: "rgb(115, 115, 115)",
                },
                accent: {
                    DEFAULT: "rgb(245, 245, 245)",
                    foreground: "rgb(23, 23, 23)",
                },
                popover: {
                    DEFAULT: "rgb(255, 255, 255)",
                    foreground: "rgb(10, 10, 10)",
                },
                card: {
                    DEFAULT: "rgb(255, 255, 255)",
                    foreground: "rgb(10, 10, 10)",
                },
            },
            borderRadius: {
                lg: "0.5rem",
                md: "0.3rem",
                sm: "0.1rem",
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in',
                'slide-up': 'slideUp 0.5s ease-out',
            },
            dashboardAnimation: {
                'gradient': 'gradient 8s linear infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                gradient: {
                    '0%, 100%': {
                        'background-size': '200% 200%',
                        'background-position': 'left center'
                    },
                    '50%': {
                        'background-size': '200% 200%',
                        'background-position': 'right center'
                    },
                },
            },
        },
    },

    plugins: [forms],
};
