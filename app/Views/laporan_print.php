<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>
<body>
  

    <table class="table table-bordered" >
      
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=0; $grantotal=0; foreach ($transaksi as $key => $value):?>
          <tr>
            <td><?=++$no?></td>
            <td><?=$value->namaProduk?></td>
            <td><?= number_to_currency($value->hargaProduk,'Rp.','id_ID',2) ?></td>
            <td><?=$value->jumlah?></td>
            <td><?= number_to_currency((int)$value->hargaProduk * (int)$value->jumlah,'Rp.','id_ID',2) ?></td>
            
            
          </tr>
          <?php $grantotal = $grantotal + ((int)$value->hargaProduk * (int)$value->jumlah);?>
          <?php endforeach?>
          <tr>
            <th colspan="4">Grand Total</th>
            <th><?= number_to_currency($grantotal,'Rp.','id_ID',2) ?></th>
          </tr>
        </tbody>
      </table>
      <script>
        window.addEventListener('load',window.print());
      </script>
  </body>
</html>

