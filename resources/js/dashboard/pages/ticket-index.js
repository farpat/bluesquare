const formElement = document.querySelector('.js-filter-form');
const selectElements = formElement.querySelectorAll('select');

selectElements.forEach(selectElement => {
    selectElement.addEventListener('change', function () {
        submitForm();
    });
});

function submitForm () {
    const formData = {};
    selectElements.forEach(selectElement => {
        const selectedOption = selectElement.selectedOptions[0];
        if (!selectedOption.dataset.empty) {
            formData[selectElement.name] = selectedOption.value;
        }
    });

    const params = new URLSearchParams(formData);
    const paramsInString = params.toString();
    window.location.href =
        window.location.href.substring(0, window.location.href.length - window.location.search.length)
        + (paramsInString !== '' ? '?' + paramsInString : '');
}
