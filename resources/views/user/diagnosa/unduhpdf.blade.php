<table>
     @foreach($diagnosas as $diagnosa)
        <tbody>
            <tr>
                <td>Tanggal Konsultasi</td>
                <td>{{ $diagnosa->created_at }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>{{ $diagnosa->user->nama }}</td>
            </tr>
            <tr>
                <td>Diagnosa Penyakit</td>
                <td>{{ $diagnosa->penyakit->nama }}</td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>{{ $diagnosa->penyakit->deskripsi }}</td>
            </tr>
            <tr>
                <td>Solusi</td>
                <td>{{ $diagnosa->penyakit->solusi }}</td>
            </tr>
        </tbody>
    @endforeach
</table>