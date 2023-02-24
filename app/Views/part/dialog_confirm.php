<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.all.js"></script>

<script>
    function konfirmasi(pesan, link) {
        Swal.fire({
            title: 'Barberhouse',
            text: pesan,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
            }
        })
    }
</script>