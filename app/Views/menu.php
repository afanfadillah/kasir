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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Tambah Menu -->
<div class="modal fade" id="tambahmenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="menu" method="post" enctype="multipart/form-data">
    <div class="modal-body">
      <div class="form-group">
        <label for="kategoriproduk">Kategori Menu</label>
        <select class="form-control" id="kategoriproduk" name="kategoriProduk">
          <option>Pilih Kategori</option>
          <?php foreach ($kategori as $key => $value):?>
          <option value="<?= $value->idKategori ?>,<?= $value->slugKategori ?>"><?= $value->namaKategori ?></option>
          <?php endforeach?>
        </select>
      </div>
      <div class="form-group">
        <label for="skuproduk">Sku</label>
        <input type="text" class="form-control" id="skuproduk" placeholder="xx-001" name="skuProduk">
      </div>
      <div class="form-group">
        <label for="namaproduk">Nama Menu</label>
        <input type="text" class="form-control" id="namaproduk" placeholder="isi nama menu" name="namaProduk">
      </div>
      <div class="form-group">
        <label for="hargaproduk">Harga Menu</label>
        <input type="number" class="form-control" id="hargaproduk" placeholder="isi harga menu" name="hargaProduk">
      </div>
      <div class="form-group">
        <label for="gambarproduk">Gambar Menu</label>
        <input type="file" class="form-control-file" id="gambarproduk" name="gambarProduk">
      </div>
    </div>
      
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
          </form>
    </div>
  </div>
</div>

<!-- View Gambar -->
<?php foreach ($produk as $key => $value) :?> 
<div class="modal fade" id="viewGambar<?= $value->idProduk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gambar Menu <?= $value->namaProduk ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
    <div class="modal-body">
      <img src="<?= base_url('assets/img/'.$value->slugKategori.'/'.$value->gambarProduk) ?>" class="card-img-top" alt="<?= $value->namaProduk ?>">
    </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endforeach?>

<!--  Delete Menu -->
<?php foreach ($produk as $key => $value) :?> 
<div class="modal fade" id="hapusmenu<?= $value->idProduk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Menu <?= $value->namaProduk ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="menu/<?= $value->idProduk ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="infoGambar" value="<?= $value->slugKategori ?>,<?= $value->gambarProduk ?>">
    <div class="modal-body">
      Apakah Anda Yakin Ingin Menghapus Menu <strong><?= $value->namaProduk ?></strong>
</div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Oke</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach?>

<!--  Edit Menu -->
<?php foreach ($produk as $key => $valueEdit) :?> 
<div class="modal fade" id="editmenu<?= $valueEdit->idProduk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Menu <?= $valueEdit->namaProduk ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="menu/<?= $valueEdit->idProduk ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="infoGambar" value="<?= $valueEdit->slugKategori ?>,<?= $valueEdit->gambarProduk ?>">
    <div class="modal-body">
      <div class="form-group">
        <label for="kategoriproduk">Kategori Menu</label>
        <select class="form-control" id="kategoriproduk" name="kategoriProduk">
          <option>Pilih Kategori</option>
          <?php foreach ($kategori as $key => $value):?>
          <option value="<?= $value->idKategori ?>,<?= $value->slugKategori ?>" <?= $value->idKategori == $valueEdit->kategoriProduk ? 'selected' : ''?>><?= $value->namaKategori ?></option>
          <?php endforeach?>
        </select>
      </div>
      <div class="form-group">
        <label for="skuproduk">Sku</label>
        <input type="text" class="form-control" id="skuproduk" placeholder="xx-001" name="skuProduk" value="<?= $valueEdit->skuProduk?>">
      </div>
      <div class="form-group">
        <label for="namaproduk">Nama Menu</label>
        <input type="text" class="form-control" id="namaproduk" placeholder="isi nama menu" name="namaProduk" value="<?= $valueEdit->namaProduk?>">
      </div>
      <div class="form-group">
        <label for="hargaproduk">Harga Menu</label>
        <input type="number" class="form-control" id="hargaproduk" placeholder="isi harga menu" name="hargaProduk" value="<?= $valueEdit->hargaProduk?>">
      </div>
      <div class="form-group">
        <label for="gambarproduk">Gambar Menu</label>
        <input type="file" class="form-control-file" id="gambarproduk" name="gambarProduk" value="<?= $valueEdit->gambarProduk?>">
      </div>
    </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Oke</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach?>

<?= view('layouts/layoutFooter'); ?>
  <?= $this->endSection(); ?>

