$(document).ready(function () {
    var sidebarVisible = localStorage.getItem('sidebar') == 'true'; // Get the value from localstorage
    $('#sidebar').toggleClass('sidebar-collapse', sidebarVisible); // Add class true: add, false: don't add

    $(".sidebar-toggle").on('click', function () {
        sidebarVisible = !sidebarVisible;
        localStorage.setItem('sidebar', sidebarVisible); // Save the visibility state in localstorage
        $("#sidebar").toggleClass('clicked');
    });
});