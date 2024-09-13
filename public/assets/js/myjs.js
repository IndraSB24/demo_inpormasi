$(document).ready(function() {
    //  Sweet Alert
    const flashData = $('.flash-data').data('flashdata');
    //const title = $('title').text();

    if (flashData) {
        Swal.fire({
            title: '',
            text: flashData,
            icon: 'success'
        });
    }
})