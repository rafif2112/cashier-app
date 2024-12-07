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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-3xl font-bold text-center mt-10 mb-7">Detail Barang</h1>
    <div class="flex justify-center">
    <div class="flex flex-col justify-center w-6/12">
        <form action="" method="POST" class="flex justify-center flex-col">
            <label for="disabled-input" class="block mb-2 text-xl font-medium text-gray-900">Nama Barang</label>       
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-3 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed" value="<?= $_SESSION['data_barang'][$_GET['index']]['nama'] ?>" disabled>

            <label for="disabled-input-2" class="block mb-2 text-xl font-medium text-gray-900">Harga</label>
            <input type="text" id="disabled-input-2" aria-label="disabled input 2" class="mb-3 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed" value="<?= $_SESSION['data_barang'][$_GET['index']]['harga'] ?>" readonly>

            <label for="disabled-input-2" class="block mb-2 text-xl font-medium text-gray-900">Jumlah</label>
            <input type="text" id="disabled-input-2" aria-label="disabled input 2" class="mb-3 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed" value="<?= $_SESSION['data_barang'][$_GET['index']]['jumlah'] ?>" readonly>

            <label for="disabled-input-2" class="block mb-2 text-xl font-medium text-gray-900">Total</label>
            <input type="text" id="disabled-input-2" aria-label="disabled input 2" class="mb-3 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed" value="<?= $_SESSION['data_barang'][$_GET['index']]['total'] ?>" readonly>
        </form>
        <a href="index.php?lengkap" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    </div>
</body>
</html>