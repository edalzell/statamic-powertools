document.addEventListener('DOMContentLoaded', function (e) {

    $('#logbook .log-picker').on('change', function () {
        $(this).submit();
    });

    $('#logbook .dossier .expandable').click(function () {
        $(this).toggleClass('open');
        $('#' + $(this).data('display')).toggle();
    });

    $('#delete-log, #delete-all-log').click(function () {
        return confirm('Are you sure?');
    });

    $.fn.extend({
        disable: function (state) {
            return this.each(function () {
                var $this = $(this);
                $this.toggleClass('disabled', state);
            });
        }
    });

    // when one of `lock` buttons is pressed, disable all of them
    $('body').on('click', '.lock', function (event) {
        $('.lock').disable(true);
    });

    // don't allow a disabled one to be clicked
    $('body').on('click', 'a.disabled', function (event) {
        event.preventDefault();
    });
});