/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./views/**/*.php",
    "./index.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Nunito Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'mono': ['Roboto Mono', 'ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
      },
      colors: {
        'airtek-primary': '#7030A0',    // Color principal (morado)
        'airtek-secondary': '#82DFF4',  // Color secundario (azul claro)
        'airtek-accent': '#FF0000',     // Color de acento (rojo)
      },
    },
  },
  plugins: [
    require("daisyui")
  ],
  daisyui: {
    themes: ["light", "dark", "corporate", "business", "emerald", "cyberpunk", "valentine", "halloween", "garden", "forest", "aqua", "lofi", "pastel", "fantasy", "wireframe", "black", "luxury", "dracula", "cmyk", "autumn", "acid", "lemonade", "night", "coffee", "winter"],
  },
  safelist: [
    'my-2',
    'my-1',
    'my-3',
    'my-4',
    'my-5',
    'my-6',
    'my-8',
    'my-10',
    'my-12',
    'my-16',
    'my-20',
    'my-24',
    'my-32',
    'my-40',
    'my-48',
    'my-56',
    'my-64',
    'my-auto',
    'my-px',
    'my-0.5',
    'my-1.5',
    'my-2.5',
    'my-3.5',
    'my-4.5',
    'my-5.5',
    'my-6.5',
    'my-7.5',
    'my-8.5',
    'my-9.5',
    'my-10.5',
    'my-11.5',
    'my-12.5',
    'my-14',
    'my-16',
    'my-20',
    'my-24',
    'my-28',
    'my-32',
    'my-36',
    'my-40',
    'my-44',
    'my-48',
    'my-52',
    'my-56',
    'my-60',
    'my-64',
    'my-72',
    'my-80',
    'my-96',
  ],
} 