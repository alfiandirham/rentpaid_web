<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentpaid - Daftar Penyewa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 29px;
            width: 900px;
            height: 1144px;
            font-family: "Nunito Sans";
        }
        h2{
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 13px;
            color: #000000;
            margin-bottom: 27px;
        }
        h6{
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 13px;
            color: #000000;
            margin-bottom: 96px;
        }
    </style>
</head>

<body>
    <div class="col">
        <h2 class="text-center">Daftar Penyewa</h2>
        <h6 class="text-center">{{$lokasi->lokasi}}</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>No Kartu</td>
                    <td>Nama Penyewa</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($sewa as $item)
                <tr>
                    <td>{{$item->kode}}</td>
                    <td>{{$pesewa->where('id', $item->penyewa_id)->first()->nama}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
