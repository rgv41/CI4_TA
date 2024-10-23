document.addEventListener('DOMContentLoaded', function () {
    const idObjectiveSelect = document.getElementById('id_objective');
    const objectiveUserInfo = document.getElementById('objective-user-info');

    // Mengupdate informasi user saat objective dipilih
    idObjectiveSelect.addEventListener('change', function () {
        const selectedObjective = this.options[this.selectedIndex];
        const userName = selectedObjective.getAttribute('data-user-name');
        objectiveUserInfo.textContent = userName ? `Nama User: ${userName}` : '';
    });



    // Form submission with SweetAlert
    const form = document.querySelector('#createKeyResult');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menambahkan key result ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Berhasil menambahkan key result ini.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Gagal menambahkan key result ini.',
                    icon: 'error'
                });
            }
        });
    });
});
