module.exports = {
  mode: 'jit',
  content: [
    './*/*.php',
    './**/*.php',
    './resources/css/*.css',
    './resources/js/*.js',
    './safelist.txt',
  ],
  theme: {
    extend: {
      screens: {
        '2xl': '1450px',
      },
      colors: {
        primary: '#b30537',
        secondary: '#404b52',
        'dark-gray': '#333333',
        '–': '#D9D9D9',
        'light-gray': '#F5F5F5',
      },
      fontFamily: {
        sans: ['Raleway', 'sans-serif'],
      },
      boxShadow: {
        standard: '2px 2px 16px rgba(0, 0, 0, 0.1)',
        bottom: '0px 15px 10px -15px rgba(0, 0, 0, 0.2)',
      },
    },
  },
  plugins: [
    function ({ addComponents }) {
      addComponents({
        '.container': {
          maxWidth: '100%',
          '@screen sm': {
            maxWidth: '640px',
          },
          '@screen md': {
            maxWidth: '768px',
          },
          '@screen lg': {
            maxWidth: '1024px',
          },
          '@screen xl': {
            maxWidth: '1280px',
          },
          '@screen 2xl': {
            maxWidth: '1410px',
          },
        },
      });
    },
  ],
};
