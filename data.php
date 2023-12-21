<!doctype html>
<html lang="en">
<?php $tahun = $_GET['tahun']; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Iqbal</title>
</head>
<?php 
    $url = 'http://tes-web.landa.id/intermediate/menu';
    $data = file_get_contents($url);
    $array_data = json_decode($data, true);
?>



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
                            <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" class="btn btn-secondary">Json Menu</a>
                            <a href="http://tes-web.landa.id/intermediate/transaksi?tahun=<?php echo $_GET['tahun']; ?>" target="_blank" class="btn btn-secondary">Json Transaksi</a>
                            <a href="#" class="btn btn-secondary">Download Example</a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <?php if($_GET['tahun']=='2021') { ?>
                            <?php 
                                // $url2 = 'http://tes-web.landa.id/intermediate/transaksi?tahun=2021';
                                // $data2 = file_get_contents($url2);
                                // $array_data2 = json_decode($data2, true);

                                $url2 = 'http://tes-web.landa.id/intermediate/transaksi?tahun=2021';
                                $data2 = file_get_contents($url2);

                                $array_data2 = json_decode($data2, true);

                                $total_per_menu_per_month = [];

                                foreach ($array_data2 as $data) {
                                    $tanggal = $data['tanggal'];
                                    $menu = $data['menu'];
                                    $total = $data['total'];

                                    $bulan = date('m', strtotime($tanggal));

                                    if (!isset($total_per_menu_per_month[$menu][$bulan])) {
                                        $total_per_menu_per_month[$menu][$bulan] = 0;
                                    }

                                    $total_per_menu_per_month[$menu][$bulan] += $total;
                                    $total_per_menu_per_month[$total][$bulan] += $total;
                                }

                            ?>
                            <table class="table table-hover table-bordered" style="margin: 0;">
                                <thead>
                                    <tr class="table-dark">
                                        <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                        <th colspan="12" style="text-align: center;">Periode Pada 2021
                                        </th>
                                        <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                                    </tr>
                                    <tr class="table-dark">
                                        <th style="text-align: center;width: 75px;">Jan</th>
                                        <th style="text-align: center;width: 75px;">Feb</th>
                                        <th style="text-align: center;width: 75px;">Mar</th>
                                        <th style="text-align: center;width: 75px;">Apr</th>
                                        <th style="text-align: center;width: 75px;">Mei</th>
                                        <th style="text-align: center;width: 75px;">Jun</th>
                                        <th style="text-align: center;width: 75px;">Jul</th>
                                        <th style="text-align: center;width: 75px;">Ags</th>
                                        <th style="text-align: center;width: 75px;">Sep</th>
                                        <th style="text-align: center;width: 75px;">Okt</th>
                                        <th style="text-align: center;width: 75px;">Nov</th>
                                        <th style="text-align: center;width: 75px;">Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                    </tr>
                                    <?php 
                                        foreach ($total_per_menu_per_month as $menu => $totals_per_month) {
                                             ?>
                                                <td><?php echo $menu; ?></td>
                                                
<!-- foreach ($total_per_menu_per_month as $menu => $totals_per_month) {
    echo "<h2>Total Menu: $menu</h2>";
    foreach ($totals_per_month as $bulan => $total) {
        $nama_bulan = date("F", mktime(0, 0, 0, $bulan, 1));
        echo "Bulan $nama_bulan: $total<br>";
    }
    echo "<br>";
} -->
                                                
                                                <?php 
                                                    foreach ($totals_per_month as $bulan => $total) { ?>
                                                        <td style="text-align: right;">
                                                        <?php 
                                                        $nama_bulan = date("F", mktime(0, 0, 0, $bulan, 1));
                                                        echo $total; ?>
                                                        </td>
                                                <?php }  ?>
                                                <td style="text-align: right;"><b>665,000</b></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    <tr>
                                        <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                                    </tr>
                                    <?php 
                                        foreach ($array_data as $post) {
                                            if ($post['kategori'] === "minuman") { ?>
                                                <td>
                                                    <?php echo $post['menu']; ?>
                                                </td>
                                                <?php 
                                                    foreach ($array_data2 as $post2) {
                                                        if ($post['menu'] == $post2['menu']) { ?>
                                                        <td style="text-align: right;">
                                                            <?php echo $post2['total'] ?>
                                                        </td>
                                                <?php } } ?>
                                                <td style="text-align: right;"><b>665,000</b></td>
                                            </tr>
                                            <?php
                                            }
                                        }
                                    ?>
                                    <tr class="table-dark">
                                        <td><b>Total</b></td>
                                        <td style="text-align: right;">
                                            <b>469,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>605,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>350,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>604,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>257,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>464,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>228,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>303,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>229,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>169,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>157,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>130,000</b>
                                        </td>
                                        <td style="text-align: right;"><b>3,965,000</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php }else if ($_GET['tahun']=='2022') { ?>
                            <table class="table table-hover table-bordered" style="margin: 0;">
                                <thead>
                                    <tr class="table-dark">
                                        <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                        <th colspan="12" style="text-align: center;">Periode Pada 2022
                                        </th>
                                        <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                                    </tr>
                                    <tr class="table-dark">
                                        <th style="text-align: center;width: 75px;">Jan</th>
                                        <th style="text-align: center;width: 75px;">Feb</th>
                                        <th style="text-align: center;width: 75px;">Mar</th>
                                        <th style="text-align: center;width: 75px;">Apr</th>
                                        <th style="text-align: center;width: 75px;">Mei</th>
                                        <th style="text-align: center;width: 75px;">Jun</th>
                                        <th style="text-align: center;width: 75px;">Jul</th>
                                        <th style="text-align: center;width: 75px;">Ags</th>
                                        <th style="text-align: center;width: 75px;">Sep</th>
                                        <th style="text-align: center;width: 75px;">Okt</th>
                                        <th style="text-align: center;width: 75px;">Nov</th>
                                        <th style="text-align: center;width: 75px;">Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                    </tr>
                                    <tr>
                                        <td>Nasi Goreng</td>
                                        <td style="text-align: right;">
                                            130,000
                                        </td>
                                        <td style="text-align: right;">
                                            170,000
                                        </td>
                                        <td style="text-align: right;">
                                            50,000
                                        </td>
                                        <td style="text-align: right;">
                                            100,000
                                        </td>
                                        <td style="text-align: right;">
                                        </td>
                                        <td style="text-align: right;">
                                            65,000
                                        </td>
                                        <td style="text-align: right;">
                                            10,000
                                        </td>
                                        <td style="text-align: right;">
                                            10,000
                                        </td>
                                        <td style="text-align: right;">
                                            50,000
                                        </td>
                                        <td style="text-align: right;">
                                            10,000
                                        </td>
                                        <td style="text-align: right;">
                                            40,000
                                        </td>
                                        <td style="text-align: right;">
                                            30,000
                                        </td>
                                        <td style="text-align: right;"><b>665,000</b></td>
                                    </tr>
                                    <tr>
                                        <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                                    </tr>
                                    <tr>
                                        <td>Teh Hijau</td>
                                        <td style="text-align: right;">
                                            60,000
                                        </td>
                                        <td style="text-align: right;">
                                            70,000
                                        </td>
                                        <td style="text-align: right;">
                                            90,000
                                        </td>
                                        <td style="text-align: right;">
                                            190,000
                                        </td>
                                        <td style="text-align: right;">
                                            10,000
                                        </td>
                                        <td style="text-align: right;">
                                            150,000
                                        </td>
                                        <td style="text-align: right;">
                                            40,000
                                        </td>
                                        <td style="text-align: right;">
                                            10,000
                                        </td>
                                        <td style="text-align: right;">
                                            40,000
                                        </td>
                                        <td style="text-align: right;">
                                        </td>
                                        <td style="text-align: right;">
                                            20,000
                                        </td>
                                        <td style="text-align: right;">
                                            30,000
                                        </td>
                                        <td style="text-align: right;"><b>710,000</b></td>
                                    </tr>
                                    <tr class="table-dark">
                                        <td><b>Total</b></td>
                                        <td style="text-align: right;">
                                            <b>469,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>605,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>350,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>604,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>257,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>464,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>228,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>303,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>229,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>169,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>157,000</b>
                                        </td>
                                        <td style="text-align: right;">
                                            <b>130,000</b>
                                        </td>
                                        <td style="text-align: right;"><b>3,965,000</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>
                        
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>



<?php
$url = 'http://tes-web.landa.id/intermediate/menu';
$data = file_get_contents($url);
$array_menu = json_decode($data, true);

$url2 = 'http://tes-web.landa.id/intermediate/transaksi?tahun=2021';
$data2 = file_get_contents($url2);
$array_trans = json_decode($data2, true);

$total_per_kategori = array(
    'makanan' => array(),
    'minuman' => array()
);

foreach ($array_trans as $transaksi) {
    $tanggal = date('Y-m', strtotime($transaksi['tanggal']));
    $kategori = '';
    foreach ($array_menu as $menu) {
        if ($menu['menu'] === $transaksi['menu']) {
            $kategori = $menu['kategori'];
            break;
        }
    }


    if (!isset($total_per_kategori[$kategori][$tanggal][$transaksi['menu']])) {
        $total_per_kategori[$kategori][$tanggal][$transaksi['menu']] = 0;
    }

    $total_per_kategori[$kategori][$tanggal][$transaksi['menu']] += $transaksi['total'];
}


foreach ($total_per_kategori as $kategori => $data_kategori) {
    echo "<h2>Kategori: $kategori</h2>";

    foreach ($data_kategori as $tanggal => $data_bulan) {
        echo "<h3>Bulan: $tanggal</h3>";

        foreach ($data_bulan as $menu => $total) {
            echo "$menu: $total<br>";
        }
        echo "<hr>";
    }
    echo "<br>";
}
?>
