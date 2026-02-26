// tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/preline/dist/*.js", // Add this line
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms"), // Add this line
        require("preline/plugin"), // Add this line
    ],
};
