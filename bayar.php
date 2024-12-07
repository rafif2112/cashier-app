<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-3xl font-bold text-center mt-10">Bayar sekarang</h1>
    <div class="flex justify-center flex-col items-center mt-10">
    <form action="bayar.php?success" method="POST" class="flex justify-center flex-col w-6/12">
        <label for="uang">Masukan nominal uang</label>
        <input required name="uang" id="uang" class="form-control form-control-lg" type="text" placeholder="" aria-label=".form-control-lg example">

        <h1 class="mt-3 mb-3">Total Yang Harus Dibayarkan : 
            <?php
                $total = 0;
                foreach($_SESSION['data_barang'] as $key => $value){
                    $total += $value['total'];
                }
                echo "Rp " . number_format($total, 0, ',', '.');
            ?>
        </h1>

        <?php 
            if(!isset($_GET['success'])){
                echo '<button type="submit" name="bayar" class="btn btn-success mb-2">Bayar</button>';
            }
        ?>

        <?php 
            if(!isset($_GET['success'])){
                echo '<a href="index.php?lengkap" class="btn btn-danger">Kembali</a>';
            }
        ?>
        
    </form>
    </div>

    <?php if(isset($_POST['bayar'])): ?>
        <?php $uang = $_POST['uang']; ?>
        <?php if($uang >= $total): ?>
            <?php $kembalian = $uang - $total; ?>
                <div class="flex justify-center items-center">
                    <a href="destroy.php" class="btn btn-danger w-6/12">Kembali</a>
                </div>
                <h1 class="text-3xl text-center mt-10">Bukti Pembayaran</h1>

                <div class="flex items-center flex-col mt-10">
                    <div class="flex justify-center flex-col w-6/12">
                        <div>No Transaksi : <?= "#". mt_rand(0, 99999999); ?></div>
                        <div class="mb-10">Bulan, tanggal : <?= "#". date('M d Y'); ?></div>

                        <table class="table">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </tr>
                            <?php foreach($_SESSION['data_barang'] as $key => $value): ?>
                            <tr>
                                <td><?= $value['nama']; ?></td>
                                <td><?= "Rp " . number_format($value['harga'], 0, ',', '.') . " x " . $value['jumlah']; ?></td>
                                <td><?= "Rp " . number_format($value['harga'] * $value['jumlah'], 0, ',', '.') ;?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>Uang Yang Dibayarkan</td>
                                <td></td>
                                <td><?= "Rp " . number_format($uang, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td><?= "Rp " . number_format($total, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td>kembalian</td>
                                <td></td>
                                <td><?= "Rp " . number_format($kembalian, 0, ',', '.'); ?></td>
                            </tr>
                        </table>

                        <p class="text-center mt-10 mb-10">Terima Kasih telah berbelanja di toko kami 😊</p>
                    </div>
                </div>

        <?php else : ?>
            <div class="flex justify-center">
                <div class="alert alert-danger w-6/12 mt-4">Uang Tidak Cukup</div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>