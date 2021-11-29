const flashData = $('.flash-data').data('flashdata');

if (flashData) {

    Swal({
        position: 'top',
        type: 'error',
        title: 'Oops...',
        text: flashData
    })

}

const flashData2 = $('.flash-data2').data('flashdata');

if (flashData2) {

    Swal({
        position: 'top',
        type: 'success',
        title: '',
        text: flashData2
    })

}

// tombol-hapus
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin',
        text: "data akan dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

});
// tombol-hapus