<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-3xl font-bold text-center mt-10">Masukan Data Barang</h1>
    <div class="flex justify-center flex-col items-center">
    <form action="" method="POST" class="flex justify-center flex-col w-6/12">
        <div class="flex justify-center gap-10 mt-10">
            <div>
                <label for="nama_barang" class="mb-2">Nama barang</label>
                <input name="nama_barang" id="nama_barang" class="form-control form-control-lg" type="text" placeholder="" aria-label=".form-control-lg example" value="<?= $_POST['nama_barang'] ?? ''?>">
            </div>
            <div>
                <label for="harga" class="mb-2">Harga</label>
                <input name="harga_barang" id="harga" class="form-control form-control-lg" type="text" placeholder="" aria-label=".form-control-lg example" value="<?= $_POST['harga_barang'] ?? ''?>">
            </div>
            <div>
                <label for="jumlah" class="mb-2">Jumlah</label>
                <input name="jumlah_barang" id="jumlah" class="form-control form-control-lg" type="text" placeholder="" aria-label=".form-control-lg example" value="<?= $_POST['jumlah_barang'] ?? ''?>">
            </div>
        </div>
        <div>
            <button type="submit" name="tambah" class="btn btn-primary mt-3"><i class="bi bi-cart"></i> Tambah</button>
            <?php 
                if(isset($_GET['lengkap'])){
                    echo '<a href="bayar.php" class="btn btn-success mt-3">bayar</a>';
                }
            ?>
        </div>
    </div>
    </form>

    <?php
        if(!isset($_SESSION['data_barang'])){
            $_SESSION['data_barang'] = [];
        }

        if(isset($_POST['tambah'])){
            if(@$_POST['nama_barang'] && @$_POST['harga_barang'] && @$_POST['jumlah_barang']){
                $BarangSama = -1;
                foreach ($_SESSION['data_barang'] as $key => $item) {
                    if ($item['nama'] === $_POST['nama_barang']) {
                        $BarangSama = $key;
                        break;
                    }
                }
                if ($BarangSama != -1) {
                    $_SESSION['data_barang'][$BarangSama]['jumlah'] += $_POST['jumlah_barang'];
                    $_SESSION['data_barang'][$BarangSama]['total'] += $_POST['harga_barang'] * $_POST['jumlah_barang'];
                    header('location: index.php?lengkap');
                } else {
                    $barang = [
                        'nama' => $_POST['nama_barang'],
                        'harga' => $_POST['harga_barang'],
                        'jumlah' => $_POST['jumlah_barang'],
                        'total' => $_POST['harga_barang'] * $_POST['jumlah_barang']
                    ];
                    array_push($_SESSION['data_barang'], $barang);
                    header('location: index.php?lengkap=');
                }
            }else{
                echo '<div class="flex justify-center">';
                echo '<div class="alert alert-danger mt-3 w-6/12">Data Harus Di isi semua</div>';
                echo '</div>';
            }
        }
    ?>

    <div class="flex justify-center flex-col items-center mb-10">
    <div class="items-center w-6/12">
        <h1 class="mt-10 mb-7">List Barang</h1>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">jumlah</th>
                                <th scope="col" class="px-6 py-3">Total</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($_SESSION['data_barang'])): ?>
                            <?php $no = 1; ?>
                            <?php foreach($_SESSION['data_barang'] as $key => $value): ?>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <td class="px-6 py-3"><?= $no; ?></td>
                                <td class="px-6 py-3"><?= $value['nama']; ?></td>
                                <td class="px-6 py-3"><?= "Rp " . number_format($value['harga'], 0, ',', '.'); ?></td>
                                <td class="px-6 py-3"><?= $value['jumlah']; ?></td>
                                <td class="px-6 py-3"><?= "Rp " . number_format($value['total'], 0, ',', '.'); ?></td>
                                <td class="px-6 py-3"><a href="index.php?delete=<?= $key; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="text-red-500 font-medium underline text-xl"><i class="bi bi-trash"></i></a> <a href="detail.php?index=<?= $key; ?>" class="text-blue-500 font-medium underline text-xl"><i class="bi bi-info-square"></i></a>  <a href="edit.php?index=<?= $key; ?>" class="text-yellow-500 font-medium underline text-xl"><i class="bi bi-pencil-square"></i></a></td>
                            </tr>
                            <?php $no++; ?>
                            <?php endforeach; ?>
                            <tr>
                        <td colspan="5" class="px-6 py-3">Total barang</td>
                        <td class="px-6 py-3">
                            <?php 
                                $jumlah = 0;
                                foreach($_SESSION['data_barang'] as $key => $value){
                                    $jumlah += $value['jumlah'];
                                }
                                echo $jumlah;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="px-6 py-3">Total Harga</td>
                        <td class="px-6 py-3">
                            <?php 
                                $total = 0;
                                foreach($_SESSION['data_barang'] as $key => $value){
                                    $total += $value['total'];
                                }
                                echo "Rp " . number_format($total, 0, ',', '.');
                            ?>
                        </td>
                    </tr>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="alert alert-danger">Tidak ada data</div>
                <?php 
                    if(isset($_GET['lengkap'])){
                        header('location: index.php');
                    }
                ?>
        <?php endif; ?>

        <?php
        if(isset($_GET['delete'])){
            unset($_SESSION['data_barang'][$_GET['delete']]);
            echo '<script>window.location="index.php?lengkap";</script>';
            exit;
        }
        ?>
    </div>
    </div>
</body>
</html>