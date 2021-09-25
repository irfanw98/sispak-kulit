<table>
	<thead>
		<tr>
            <th>Nomor</th>
			<th>Tanggal Konsultasi</th>
			<th>Nama Lengkap</th>
			<th>Diagnosa Penyakit</th>
		</tr>
	</thead>
	<tbody>
        @foreach($laporans as $laporan)
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $laporan->created_at }}</td>
			<td>{{ $laporan->user->nama }}</td>
			<td>{{ $laporan->penyakit->nama }}</td>
		</tr>
        @endforeach
	</tbody>
</table>