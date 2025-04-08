/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
      extend: {
        fontFamily: {
          poppins: ["Archivo", "sans-serif"],
          main: ["Michroma", "sans-serif"],
        },
        colors: {
          brown: "#9F6D38",
          "brown-800": "#8f5b23",
          yellow: "#F6EFE2",
          primary: '#E37D10',
        },
        borderRadius: {
          'none': '0px',
          'sm': '4px',
          DEFAULT: '8px',
          'md': '12px',
          'lg': '16px',
          'xl': '20px',
          '2xl': '24px',
          '3xl': '32px',
          'full': '9999px',
          'button': '8px'
        },
        container: {
          center: true,
          padding: {
            DEFAULT: "1rem",
          },
          screens: {
            sm: "600px",
            md: "728px",
            lg: "984px",
            xl: "1250px",
            "2xl": "1360px",
          },
        },
        height: {
          '15': "3.75rem",
          18: "4.5rem",
        },
        fontSize: {
          xs: "0.813rem",
          xss: "0.57rem",
          "4xl": "2.5rem",
        },
        letterSpacing: {
          2: ".2em",
          3: ".3em",
        },
        zIndex: {
          100: "100",
          90: "90",
        },
        lineHeight: {
          'lh-1.2': '1.2',
          'lh-1.3': '1.3',
          'lh-1.4': '1.4',
        },
        size: {
          '15': "3.75rem",
        }
      },
    },
    plugins: [],
  };
