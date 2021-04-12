module.exports = {
  theme: {
    extend: {
      colors: {
        black: "#27363b",
        "opaque-black": "rgba(39,54,59,0.7)",

        "primary-blue": "#81CDBC",
        "primary-dark": "#40333E",
        "soft-purple": "#645258",
        "primary-red": "#EF6060",
        white: "#ffffff",
        danger: "#ff4850",
        eggshell: "#edf0f2",
	"sunny-yellow": "#FFB121",

        "brand-purple": "#803EA0",
        "brand-soft-purple": "#B574D5",
        "brand-super-soft-purple": "#D0AEE2",
        "brand-dark-purple": "#430064",
        "brand-dark": "#27363B",
        "text-grey": "#6A6C6E",
        "light-grey": "#C3C6C9",
        "opaque-purple": "rgba(128,62,160,0.8)",

        "mid-grey": "#a2a2a2",

        darkorange: "darkorange",
        springgreen: "springgreen",
      },
      spacing: {
        80: "20rem",
        96: "24rem",
        "30-vw": "30vw",
        "max-content": "max-content",
      },
      maxHeight: {
        "75vh": "75vh",
      },
      inset: {
        16: "4rem",
        "1/2": "50%",
      },
      fontFamily: {
        display: [
          "Oswald",
          "system-ui",
          "-apple-system",
          "BlinkMacSystemFont",
          '"Segoe UI"',
          "Roboto",
          '"Helvetica Neue"',
          "Arial",
          '"Noto Sans"',
          "sans-serif",
          '"Apple Color Emoji"',
          '"Segoe UI Emoji"',
          '"Segoe UI Symbol"',
          '"Noto Color Emoji"',
        ],
        sans: [
          '"Noto Sans"',
          "system-ui",
          "-apple-system",
          "BlinkMacSystemFont",
          '"Segoe UI"',
          "Roboto",
          '"Helvetica Neue"',
          "Arial",
          "sans-serif",
          '"Apple Color Emoji"',
          '"Segoe UI Emoji"',
          '"Segoe UI Symbol"',
          '"Noto Color Emoji"',
        ],
        serif: [
          "Noto Serif",
          "Georgia",
          "Cambria",
          '"Times New Roman"',
          "Times",
          "serif",
        ],
      },
    },
  },
  variants: {
    display: ["responsive", "hover", "focus", "group-hover"],
  },
  plugins: [],
};
