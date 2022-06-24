export default {
    entry: {
        'front.js': 'resources/js/front.js',
        'dashboard.js': 'resources/js/dashboard.js',
    },
    output: 'public/assets',
    refresh: ['resources/views/**/*.php'],
};
