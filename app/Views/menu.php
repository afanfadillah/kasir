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
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Informasi</strong> <?=session()->getFlashdata('success')?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div><?php endif ?>
            <div class="card">
  <h5 class="card-header">Daftar Menu</h5>
  <div class="card-body">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmenu">Tambah</button>
    <p/>
    <table class="table table-bordered">
  <thead style="text-align: center;">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Menu</th>
      <th scope="col">Harga</th>
      <th scope="col">Kategori</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
<?php $no=1; foreach ($produk as $key => $value):?>

    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td><?= $value->namaProduk ?></td>
      <td><?= number_to_currency($value->hargaProduk,'Rp.','id_ID',2) ?></td>
      <td><?= $value->namaKategori ?></td>
      <td style="text-align: center;">
        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#viewGambar<?= $value->idProduk ?>"><i class="fas fa-eye"></i></button>
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#editmenu<?= $value->idProduk ?>"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#hapusmenu<?= $value->idProduk ?>"><i class="fas fa-trash"></i></button>
      </td>
    </tr>
<?php endforeach?>
  </tbody>
</table>
   
  </div>
</div>
           
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= view('layouts/layoutFooter'); ?>
  <?= $this->endSection(); ?>
