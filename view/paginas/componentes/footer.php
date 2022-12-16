                    </div>
                </main>                
        </div>
        <script>
            if (localStorage.getItem('dark-mode') == 'true') {
                document.documentElement.classList.add('dark-theme-variables')
                let almrda = document.querySelector(".almrda");
                almrda.innerHTML = "<div class='warning d-flex justify-content-center align-items-center'><ion-icon name='sunny-outline'></ion-icon></div>"
            }

            // console.log(localStorage.getItem('dark-mode'));

        </script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="view/static/js/scripts.js"></script>
        <script src="view/static/js/script.js"></script>
</body>
</html>