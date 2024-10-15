/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      keyframes: {
        'move-forever': {
          '0%': { transform: 'translate(-90px, 0%)' },
          '100%': { transform: 'translate(85px, 0%)' },
        },
      },
      animation: {
        'move-forever': 'move-forever 2s linear infinite',
        'move-slow': 'move-forever 6s linear infinite',
        'move-fast': 'move-forever 3s linear infinite',
      },
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}

