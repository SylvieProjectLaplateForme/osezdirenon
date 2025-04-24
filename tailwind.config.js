import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    // 💥 Ici on dit à Tailwind de NE PAS supprimer ces classes dynamiques
    safelist: [
        "bg-yellow-500",
        "bg-blue-500",
        "bg-pink-500",
        "bg-red-500",
        "bg-green-500",
        "bg-purple-600",
        "text-white",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
    
    plugins: [
        require('@tailwindcss/typography'),
    ],
    
};
