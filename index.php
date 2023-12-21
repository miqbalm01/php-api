<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Iqbal</title>
</head>


<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
            Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="data.php" method="GET">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>