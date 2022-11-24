let sidebar = document.querySelector('.sidebar');
let burgerIcon = sidebar.querySelector('.burger-icon > .fa-bars');

burgerIcon.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar--open');
});
