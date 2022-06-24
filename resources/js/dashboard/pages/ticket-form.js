import '@ckeditor/ckeditor5-build-classic';

document.querySelectorAll('.js-wysiwyg').forEach(textareaElement => {
    ClassicEditor.create(textareaElement);
})
