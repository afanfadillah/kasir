<?= $this->extend('layouts/layoutHome'); ?>

<?= $this->section('content'); ?>

<?= view('layouts/layoutSidebar'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="card">
  <h5 class="card-header">Laporan</h5>
  <div class="card-body">

    <a href="/print" class="btn btn-success">Print</a>
    <p/>
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
    </div>
    
</div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<?= view('layouts/layoutFooter'); ?>
  <?= $this->endSection(); ?>

