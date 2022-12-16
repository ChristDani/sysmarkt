const buttonTheme = document.querySelector(".Buttone");
const almrda = document.querySelector(".almrda");

buttonTheme.addEventListener('click', (e) => {
    document.documentElement.classList.toggle('dark-theme-variables');


    if (document.documentElement.classList.contains('dark-theme-variables')) {
        almrda.innerHTML = "<div class='warning d-flex justify-content-center align-items-center'><ion-icon name='sunny-outline'></ion-icon></div>"
        localStorage.setItem("dark-mode", 'true');
    } else{
        almrda.innerHTML = "<div class='color d-flex justify-content-center align-items-center'><ion-icon name='moon-outline'></ion-icon></div>"
        localStorage.setItem("dark-mode", 'false');
    }
})
