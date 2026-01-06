import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './modules/**/Presentation/Views/**/*.blade.php',
        './vendor/masmerise/livewire-toaster/resources/views/*.blade.php', // 👈
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                headline: ["Space Grotesk"]
            },
            colors: {
                accent: "#007f80",
                foreground: "#020817",
                primary: "#1d3986",
                secondary: "#f1f5f9",
                background: "#ffffff",
                muted: "#64748b",
                contact: "#f8fafc",
                input: "#e2e8f0",
                // primary-foreground

            }
        },
    },

    plugins: [forms],
};
