<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Karyawan</th>
			<th>Divisi</th>
			<th>Jenis Kelamin</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			@foreach($karyawans as $value)
			<td>{{ $value->id }}</td>
			<td>{{ $value->nama }}</td>
			<td>{{ $value->divisi }}</td>
			<td>{{ $value->jenis_kelamin }}</td>
			<td>{{ $value->status }}</td>
			@endforeach
		</tr>
	</tbody>
</table>
