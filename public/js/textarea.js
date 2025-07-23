function autoResizeTextarea(el) {
    el.style.height = 'var(--height-field)';
    el.style.height = el.scrollHeight + 'px'; // set to content height
}

document.addEventListener('DOMContentLoaded', function () {
    const textareas = document.querySelectorAll('textarea');

    textareas.forEach((textarea) => {
        autoResizeTextarea(textarea); 

        textarea.addEventListener('input', function () {
            autoResizeTextarea(this); 
        });
    });
});