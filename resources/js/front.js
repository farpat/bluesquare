import '../css/front.scss';
import 'vite/dynamic-import-polyfill';
import 'bootstrap';

console.log('%c😀 front.js loaded!', 'font-size: 16px; background-color:#2c3e50; color:#ecf0f1');

const scriptToLoad = document.body.dataset.scriptToLoad;
if (scriptToLoad !== '') {
        import(`./front/pages/${scriptToLoad}.js`);
}
