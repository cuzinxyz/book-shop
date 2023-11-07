const loaderContainer = document.querySelector('.load-relative');

window.addEventListener('load', () => {
    setTimeout(() => {
        loaderContainer.style.display = 'none';
        $("#app").addClass("animate__animated animate__fadeIn");
    }, 100);
});
