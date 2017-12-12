document.addEventListener('DOMContentLoaded', function(e) {

    $('#logbook .log-picker').on('change', function () {
        $(this).submit();
    });

    $('#logbook .dossier .expandable').click(function() {
        $(this).toggleClass('open');
        $('#' + $(this).data('display')).toggle();
    });
    
    $('#delete-log, #delete-all-log').click(function() {
        return confirm('Are you sure?');
    });

});