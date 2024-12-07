<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-3xl font-bold text-center mt-10">Edit Data Barang</h1>
    <div class="d-flex justify-center items-center">
    <form action="" method="POST" class="flex justify-center flex-col w-6/12">
        <div>
            <label for="nama_barang" class="mb-2">Nama barang</label>
            <input name="nama_barang" id="nama_barang" class="form-control form-control-lg" type="text" placeholder="" aria-label=".form-control-lg example" value="<?= $_SESSION['data_barang'][$_GET['index']]['nama'] ;?>">
        </div>
        <div>
            <label for="harga" class="mb-2">Harga</label>
            <input name="harga_barang" id="harga" class="form-control form-control-lg" type="text" placeholder="" aria-label=".form-control-lg example" value="<?= $_SESSION['data_barang'][$_GET['index']]['harga'] ;?>">
        </div>
        <div>
            <label for="jumlah" class="mb-2">Jumlah</label>
            <input name="jumlah_barang" id="jumlah" class="form-control form-control-lg" type="text" placeholder="" aria-label=".form-control-lg example" value="<?= $_SESSION['data_barang'][$_GET['index']]['jumlah'] ;?>">
        </div>
        <div>
            <button type="submit" name="edit" class="btn btn-primary mt-3"><i class="bi bi-pencil"></i> Edit</button>
            <a href="index.php?lengkap" class="btn btn-danger mt-3">Batal</a>
        </div>
    </form>
    </div>
    <?php 
        if(isset($_POST['edit'])){
            $total = 0;
            foreach ($_SESSION['data_barang'] as $key => $value) {
                $total += $value['total'];
            }
            $_SESSION['data_barang'][$_GET['index']]['nama'] = $_POST['nama_barang'];
            $_SESSION['data_barang'][$_GET['index']]['harga'] = $_POST['harga_barang'];
            $_SESSION['data_barang'][$_GET['index']]['jumlah'] = $_POST['jumlah_barang'];
            $_SESSION['data_barang'][$_GET['index']]['total'] = $_POST['jumlah_barang'] * $_POST['harga_barang'];
            header('location: index.php?lengkap');
            exit;
        }
    ?>
</body>
</html>