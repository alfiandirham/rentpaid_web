<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penyewa - {{$lokasi->lokasi}}</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    .text-center {
        text-align: center;
    }
</style>
<body>
<div class="text-center">
    <h5>DAFTAR PENYEWA</h5>
    <h5>{{ucwords($lokasi->lokasi)}}</h5>
    <h5></h5>
    <table border="1">
        <thead>
        <tr>
            <th>No Kartu</th>
            <th>Nama Penyewa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tenant AS $row)
            <tr>
                <td>{{$row->kode}}</td>
                <td>{{$row->penyewa->nama}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>

</html>
