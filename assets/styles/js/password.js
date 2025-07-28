import $ from 'jquery';

$(document).on('click', '[data-action="hide_show"]', function () {
    let $eye = $(this);
    const id = $eye.prev().attr('id');
    const passwordField = $('#' + id);
    const fieldType = passwordField.prop('type');
    if (fieldType === 'password') {
        passwordField.prop('type', 'text');
    } else {
        passwordField.prop('type', 'password');
    }
});
