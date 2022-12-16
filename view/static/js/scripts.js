/*!
    * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.search; // because the 'href' property of the DOM element is the absolute path
    const params = new URLSearchParams(path)
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.search === path) {
                $(this).addClass("active");
                let tituloPagina = document.getElementById('tituloPagina');
                tituloPagina.innerHTML = "Argosal | "+params.get('pagina');
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);
