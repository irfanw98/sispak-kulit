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
        @foreach($diagnosas as $diagnosa)
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $diagnosa->created_at }}</td>
			<td>{{ $diagnosa->user->nama }}</td>
			<td>{{ $diagnosa->penyakit->nama }}</td>
		</tr>
        @endforeach
	</tbody>
</table>