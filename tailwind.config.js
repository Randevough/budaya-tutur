/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Option A: Obsidian (Deep Peat Dark)
        obsidian: {
          950: '#0c0b0a', // deepest shadow
          900: '#121110', // main dark ground
          850: '#161413', // secondary dark surface
          800: '#1c1a18', // dark card surface
          700: '#2c2825', // dark hairline border
          600: '#423c37', // prominent dark border
        },
        // Option A: Linen (Unbleached Archival Paper)
        linen: {
          50: '#fdfbf7',  // pure light surface
          100: '#f8f5f0', // main light ground (exhibition paper)
          200: '#f2ece2', // warm paper card / quote block
          300: '#e3ddd3', // bookbinding hairline border
          400: '#d0c8bb', // input borders
        },
        // Option A: Ink & Bone Typography
        ink: {
          950: '#0c0b0a', // deepest pitch ink
          900: '#181615', // deep peat ink (primary text on light)
          800: '#2e2a27', // dark headings
          700: '#3e3934', // rich dark charcoal
          600: '#5c554e', // secondary body text on light
          500: '#7a736a', // muted metadata on light
          400: '#968e85', // muted metadata on dark
          300: '#b8b0a5', // tertiary text on dark
          200: '#ded7cc', // secondary text on dark
          100: '#f4f0ea', // bone linen (primary text on dark)
        }
      },
      fontFamily: {
        serif: ['"Mencken Std Head"', '"Cinzel"', '"Playfair Display"', 'Georgia', 'serif'],
        sans: ['"Aktiv Grotesk Condensed"', '"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
