<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Detail Absensi Karyawan</title>
</head>
<body>
      <table class="table table-bordered table-striped b-t b-light">
        <thead>
        	<tr>
        		<td rowspan="2">TGL</td>
        		<td rowspan="2">HARI</td>
        		<td rowspan="2">JAM MASUK</td>
        		<td rowspan="2">JAM KELUAR</td>
        		<td rowspan="1" colspan="6">{{ $karyawan }}</td>
        	</tr>
        	<tr>
        		<td>HADIR</td>
        		<td>IZIN</td>
        		<td>SAKIT</td>
        		<td>ALFA</td>
        		<td>DINAS</td>
        		<td>KETERANGAN</td>
        	</tr>
        </thead>
        <tbody>
        	@foreach($items as $month)
	        	@if($month['hari'] == 'Saturday' || $month['hari'] == 'Sunday')
				<tr>
					<td>{{ $month['tgl'] }}</td>
					<td>{{ $month['hari'] }}</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				@else
				<tr>
					<td>{{ $month['tgl'] }}</td>
					<td>{{ $month['hari'] }}</td>
					<td>{{ $month['jam_masuk'] }}</td>
					<td>{{ $month['jam_keluar'] }}</td>
					<td>{{ $month['hadir'] }}</td>
					<td>{{ $month['izin'] }}</td>
					<td>{{ $month['sakit'] }}</td>
					<td>{{ $month['alfa'] }}</td>
					<td>{{ $month['dinas'] }}</td>
					<td>
						@if($month['jam_masuk'] == null)
							Belum Dilakukan Absen/Tidak Melakukan Absen
						@else
							{{ $month['keterangan'] }}
						@endif
					</td>
				</tr>
				@endif
			@endforeach
        </tbody>
      </table>
</body>
</html>