<a href="{{ route('farm.more', ['id' => $data['id']]) }}" class="btn btn-primary btn-sm" style="margin-top: 5px;">Lihat</a>
<a href="{{ route('farm.edit', ['farm' => $data['id']]) }}" class="btn btn-warning btn-sm" style="margin-top: 5px;">Ubah</a>
<button href="{{ route('farm.destroy', ['farm' => $data['id']]) }}" class="btn btn-danger btn-sm" id="delete" style="margin-top: 5px;">Hapus</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $('button#delete').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah kamu yakin hapus data ini?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
            if (result.value) {
                document.getElementById('deleteForm').action = href;
                document.getElementById('deleteForm').submit();

                Swal.fire(
                'Terhapus!',
                'Data kamu berhasil dihapus.',
                'success'
                )
            }
        })
    })
</script>