const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        // './node_modules/vue3-carousel/dist/*.css',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'food': "url('./dev_assets/i-like-food.svg')",
            },
            aspectRatio: {
                '3/2': '3 / 2',
                '2/3': '2 / 3',
                '4/3': '4 / 3',
                '3/4': '3 / 4',
                '16/9': '16 / 9',
                '9/16': '9 / 16',
            },
            animatedSettings: {
                animatedSpeed: 400,
                classes: ['fadeInUp','fadeOutDown','slideInUp', 'slideOutDown']
            }
        },
    },

    plugins: [
        //require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('daisyui'),
        require('tailwindcss-animatecss')
    ],

    daisyui: {
        themes: [
          {
            primary: {
                "primary": "#9C4146",
                "secondary": "#775657",
                "accent": "#400009",
                "neutral": "#FFDADB",
                "base-100": "#FFFFFF",
                "info": "#3ABFF8",
                "success": "#36D399",
                "warning": "#FBBD23",
                "error": "#F87272",
                "--rounded-box": "1rem", // border radius rounded-box utility class, used in card and other large boxes
                "--rounded-btn": "0.5rem", // border radius rounded-btn utility class, used in buttons and similar element
                "--rounded-badge": "1.9rem", // border radius rounded-badge utility class, used in badges and similar
                "--animation-btn": "0.25s", // duration of animation when you click on button
                "--animation-input": "0.2s", // duration of animation for inputs like checkbox, toggle, radio, etc
                "--btn-text-case": "uppercase", // set default text transform for buttons
                "--btn-focus-scale": "0.95", // scale transform of button when you focus on it
                "--border-btn": "1px", // border width of buttons
                "--tab-border": "1px", // border width of tabs
                "--tab-radius": "0.5rem", // border radius of tabs
            },
          },
        ],
      },
};
