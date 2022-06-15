<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Export Peramalan.xls");
include 'koneksi.php';
mysqli_query($conn, 'DELETE FROM peramalan');
$sql2 = mysqli_query($conn, "SELECT data_produk.id_produk,data_produk.nama_produk FROM data_produk"); // memanggil data produk
while ($c = mysqli_fetch_array($sql2)) {
    $a = 0.1;
    $sql = mysqli_query($conn, "SELECT SUM(lembar) AS lembar, YEAR(tggl_transaksi) as tahun FROM data_penjualan WHERE 
 id_produk='$c[id_produk]' GROUP BY YEAR(tggl_transaksi) LIMIT 5"); // memanggil jumlah data penjualan berdasarkan bulan dan tahun

    $arrsementara = array(); //inisialisasi array
    $periode = array();  //inisialisasi array
    while ($row = mysqli_fetch_array($sql)) {
        array_push($arrsementara, $row['lembar']); // menginput data penjualan per bulan kedalam array untuk proses perhitungan selanjutnya
        array_push($periode, $row['tahun']);
        $tahun = $row['tahun'];
    }
    array_push($periode, $tahun + 1);
    // print_r($periode);
    $tmpRmse = array();
    $tmpRamal2 = array();
    $tmpfore = array();
    for ($loop = 0; $loop < 9; $loop++) {
        $dataramal = array(); // inisialisasi peramalan bulan pertama=0 dan peramalan bulan ke dua=datapenjualan bulan pertama
        // $sql = mysqli_query($conn, "INSERT into peramalan values('$c[id_produk]','$periode[0]','0')"); //insert data peramalan bulan 1 ke database
        // $sql = mysqli_query($conn, "INSERT into peramalan values('$c[id_produk]','$periode[1]','$arrsementara[0]')"); //insert data peramalan tahun 2 ke database
        $error = array(); // menghitung nilai error perbulan
        $error2 = array();  // menghitung nilai error^2 perbulan
        // $ramal = $arrsementara[0];
        $datatmp = array();
        $datakonstanta = array('0');
        $dataslope = array();
        $dataforecast = array('0', $arrsementara[0]);
        // $data2 = $arrsementara[1];
        $tampung = array();
        $tampung2 = array();

        $nsb1 = 0; //Nilai sebelum nya
        $nsb2 = 0;

        $arrayData = array();

        for ($i = 0; $i < count($periode); $i++) {
            if ($i <= 1) {
                $x1 = $arrsementara[$i];  //mendapatkan nilai penjualan tahun 3 dan seterusnya
                $peramalan1 = ($a * $x1) + (1 - $a) * $arrsementara[0];
                $peramalan2 = ($a * $peramalan1) + (1 - $a) * $arrsementara[0];
                array_push($tampung, $peramalan1);
            } else {
                if (isset($arrsementara[$i])) {
                    $x1 = $arrsementara[$i];  //mendapatkan nilai penjualan tahun 3 dan seterusnya
                    $peramalan1 = ($a * $x1) + (1 - $a) * $nsb1;
                    $peramalan2 = ($a * $peramalan1) + (1 - $a) * $nsb2;
                }
            }

            $nsb1 = $peramalan1;
            $nsb2 = $peramalan2;

            $konstanta = 2 * ($peramalan1) - $peramalan2; //perhitungan konstanta
            $slope = ($a / (1 - $a)) * ($peramalan1 - $peramalan2); //perhitungan slope
            $forecast = $konstanta + $slope; //perhitungan forecast
            array_push($datatmp, $peramalan1); //simpan data peramalan 1 ke array
            array_push($dataramal, $peramalan2); //simpan data peramalan 2 ke array
            array_push($datakonstanta, $konstanta);
            array_push($dataslope, $slope);
            array_push($dataforecast, $forecast);
            if ($i < count($arrsementara)) {
                $err = $arrsementara[$i] - $dataforecast[$i + 1]; //menghitung nilai error pertahun
                $err2 = pow($err, 2); //menghitung nilai error^2 pertahun
                array_push($error, $err); //simpan nilai error ke array
                array_push($error2, $err2); //simpan nilai error^2 ke array
            }
        }

        array_push($tmpRamal2, $dataramal);
        array_push($tmpfore, $dataforecast);
        // print_r($tmpfore);
        $jml_err = array_sum($error2); // menjumlahkan semua nilai error pertahun
        ?>

        <h2><?php
            echo $c['nama_produk'] . "($a)" ?></h2>
        <table style="width:50%" border="1">
            <tr>
                <th class="text-center" width="100">Periode (Tahun)</th>
                <th class="text-center" width="100">Penjualan</th>
                <th class="text-center" width="100">S't</th><!-- Peramalan pertama -->
                <th class="text-center" width="100">S''t</th><!-- Peramalan Kedua -->
                <th class="text-center" width="100">at</th><!-- konstanta -->
                <th class="text-center" width="100">bt</th><!-- Slope -->
                <th class="text-center" width="100">ft</th><!-- forecast -->
                <th class="text-center" width="100">etr</th><!-- error -->
                <th class="text-center" width="100">et2</th><!-- error -->
            </tr>
            <?php
            $jumlah = 0;
            $jumlah2 = 0;
            foreach ($dataramal as $key => $value) {
                echo "<tr>";
                echo "<td>" . ($periode[$key]) . "</td>"; //data 1
                if ($key >= count($arrsementara)) {
                    echo "<td>-</td>"; //data 2
                } else {
                    echo "<td>" . $arrsementara[$key] . "</td>"; //data 2
                }
                echo "<td>" . round($datatmp[$key], 1) . "</td>"; //data 3
                echo "<td>" . round($value, 1) . "</td>"; //data 4
                if ($key == 0) {
                    echo "<td>-</td>"; //data 5
                    echo "<td>-</td>"; //data 6
                    echo "<td>-</td>"; //data 7
                    echo "<td>-</td>"; //data 8
                    // echo "<td>-</td>"; //data 9
                    echo "<td>-</td>"; //data 10
                    // echo "<td>-</td>"; //data 11
                } elseif ($key > count($error)) {
                    echo "<td>-</td>"; //data 5
                    echo "<td>-</td>"; //data 6
                    echo "<td>-</td>"; //data 7
                    echo "<td>-</td>"; //data 8
                    // echo "<td>-</td>"; //data 9
                    echo "<td>-</td>"; //data 10
                    // echo "<td>-</td>"; //data 11
                } else {
                    echo "<td>" . round($datakonstanta[$key + 1], 1) . "</td>"; //data 5
                    echo "<td>" . round($dataslope[$key], 1) . "</td>"; //data 5
                    if ($dataforecast[$key + 1] == $arrsementara[0]) {
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                    } else {
                        echo "<td>" . round($dataforecast[$key + 1], 1) . "</td>"; //data 6
                        echo "<td>" . $error[$key - 1] . "</td>"; //data 7
                        // echo "<td>" . abs($error[$key - 1]) . "</td>"; //data 8
                        echo "<td>" . $error2[$key - 1] . "</td>"; //data 9
                    }
                    // $d = (abs($error[$key - 1]) / $arrsementara[$key - 1]) * 100;
                }
                echo "</tr>";
                if (isset($error2[$key - 2])) {
                    $jumlah = $error2[$key - 2] + $error2[$key - 1];
                }
                $rmse = $jumlah / 2;
            }
            array_push($tmpRmse, $rmse);
            echo "<tr>";
            echo "<td colspan='8'><b>Jumlah</b></td>";
            echo "<td>" . $jumlah . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='8'><b>MSE<b></td>";
            echo "<td>" . round($rmse, 0) . "</td>";
            echo "</tr>";

            echo "</table>";
            $a += 0.1;
        }

        $min = 9999999999999999999999999;
        $minKey = 0;
        foreach ($tmpRmse as $key => $value) {
            if ($value < $min) {
                $min = $value;
                $minKey = $key;
            }
        }
        $tmp12 = 0;
        $tmptggl = 0;
        $tmpfore1 = 0;
        $d = mysqli_num_rows($sql2);
        foreach ($periode as $key => $data) {
            $tmpfore1 = round($tmpfore[$minKey][$d + 1], 1);
            $tmptggl = $periode[$key] . '-00-00';
            if (count($periode) - 1 == $key && $tmpRamal2[$minKey][$key] == $tmpRamal2[$minKey][$key - 1]) {
                $tmp12 = $tmpfore1;
            } else {
                $tmp12 = $tmpRamal2[$minKey][$key];
            }
            if (isset($arrsementara[$key])) {
                $datat = $arrsementara[$key];
            } else {
                $datat = 0;
            }
            mysqli_query($conn, "INSERT INTO peramalan VALUES ('','$c[id_produk]','$tmptggl','$datat','$tmp12')");
            echo $tmp12 . " ";
        }
        echo "Prediksi Penjualan tahun " . $periode[$key] . " selanjutnya = " . $tmpfore1;
    }
    ?>