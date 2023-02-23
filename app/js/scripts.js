/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 

window.addEventListener('DOMContentLoaded', event => {

    // Alternar a navegação lateral
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Descomente abaixo para persistir na barra lateral alternando entre as atualizações
         //if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
             //document.body.classList.toggle('sb-sidenav-toggled');
         //}
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

//Tabela do Painel criada com a bilblioteca Simple-DataTables
/*window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            searchable : true//Hablita a busca na tabela criada
        });
    }
});*/


