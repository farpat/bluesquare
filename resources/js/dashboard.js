import '../css/dashboard.scss';
import 'vite/dynamic-import-polyfill';
import 'bootstrap';

console.log('%c😀 dashboard.js loaded!',
    'font-size: 16px; background-color:#2c3e50; color:#ecf0f1');

const scriptToLoad = document.body.dataset.scriptToLoad;
if (scriptToLoad !== '') {
    console.log(
        `%c➡️ Loading ./dashboard/pages/${scriptToLoad} ...`,
        'background-color:#2c3e50; color:#ecf0f1',
    );

    let onImport = function () {
        console.log(
            `%c./dashboard/pages/${scriptToLoad} loaded! ⬅️`,
            'background-color:#2c3e50; color:#ecf0f1',
        );
    };

    if (scriptToLoad.endsWith('.jsx')) {
        import(`./dashboard/pages/${scriptToLoad.substring(0, scriptToLoad.length - 4)}.jsx`).then(onImport);
    }
    else {
        import(`./dashboard/pages/${scriptToLoad}.js`).then(onImport);
    }
}
