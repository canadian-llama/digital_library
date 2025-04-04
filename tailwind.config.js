import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class", // Explicitly set to 'class' instead of 'media'
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                desertsand: "#F87060",
                darkblue: "#102542", // Primary dark blue
                emerald: "#06D6A0",
                snow: "#FCF7F8",
                madder: "#A31621",
                bora: "#EAECC6",
                skyline: "#2BC0E4",
                steelgray: {
                    100: "#F87060",
                    200: "#102542",
                },
                primary: "#FF6363",
                secondary: {
                    100: "#E2E2D5",
                    200: "#888883",
                },

                // New Colors
                coral: "#FF6F61", // Soft red-orange
                lavender: "#B497BD", // Light purple
                aquamarine: "#7FFFD4", // Light blue-green
                gold: "#FFD700", // Warm yellow
                plum: "#8E4585", // Deep purple
                slateblue: "#6A5ACD", // Muted blue-purple
                peach: "#FFDAB9", // Soft peach
                teal: "#008080", // Deep teal
                indigo: "#4B0082", // Deep indigo
                mint: "#98FF98", // Light green
                rose: "#FF007F", // Deep pink
                charcoal: "#36454F", // Dark blue-gray
                ruby: "#9B111E", // Deep red
                amber: "#FFBF00", // Bright yellow-orange
                cyan: "#00FFFF", // Bright cyan
                chartreuse: "#7FFF00", // Bright yellow-green
                fuchsia: "#FF00FF", // Bright pink
                lavenderblush: "#FFF0F5", // Very light purple
                peachpuff: "#FFDAB9", // Light peach
                periwinkle: "#CCCCFF", // Soft light blue
                orchid: "#DA70D6", // Soft purple-pink
            },
        },
    },
    plugins: [forms],
};
