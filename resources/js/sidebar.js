$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');

        $('#icono').toggleClass('fa-chevron-right fa-chevron-left');
    });
});
