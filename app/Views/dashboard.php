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
        <div class="callout callout-info d-flex align-items-center justify-content-between">
          <h1 class="harga">Total : <?= number_to_currency($total,'Rp.','id_ID',2) ?></h1>
          <button type="submit" class="btn btn-success ml-auto" onclick="bayar('<?= user()->email?>')">Bayar</button>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php foreach ($kategori as $key => $value):?>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <a href="/kasir?kat=<?=$value->idKategori ?>" style="color:inherit">
            <div class="small-box bg-<?= $value->colourKategori ?>">
              <div class="inner">
                

                <h2><?= $value->namaKategori ?></h2>
                <p>klik di sini</p>
              </div>
              <div class="icon">
                <i class="fas <?= $value->iconKategori ?>"></i>
              </div>
            </div>
          </a>
          </div>
          <?php endforeach?>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                Menu
              </div>
              <div class="card-body">
                <div class="row">
                  <?php foreach ($produk as $key => $value):?>
                  <div class="col-md-4" onclick="addKeranjang(<?=$value->idProduk ?>)">
                    <div class="card">
                      <img src="<?= base_url('assets/img/'.$value->slugKategori.'/'.$value->gambarProduk) ?>" class="card-img-top" alt="<?= $value->namaProduk ?>" style="height:12rem;">
                      <div class="card-body">
                        <h5 class="card-title"><?= $value->namaProduk ?></h5>
                        <p class="card-text"><?= number_to_currency($value->hargaProduk,'Rp.','id_ID',2) ?></p>
                      </div>
                    </div>
                  </div>
                  <?php endforeach?>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                Keranjang
              </div>
              <div class="card-body">
                <div id="itemKeranjang">
                  <?php foreach ($keranjang as $key => $value):?>
                    <div class="callout callout-info" id="itemProduk<?= $value->idProduk?>">
                      <div class="row">
                      <div class="col-2 center">
                      <h3><span class="badge badge-primary"><?= $value->jumlah?></span></h3>
                      </div>
                      <div class="col-7">
                      <h5><?= $value->namaProduk?></h5>
                      <p><?= number_to_currency((float)$value->hargaProduk,'IDR','id_ID') ?></p>
                      </div>
                      <div class="col-3">
                      <button type="button" class="btn btn-danger" onclick="hapusKeranjang(<?= $value->idProduk?>)"><i class="fas fa-trash"></i></button>
                      </div>
                      </div>
                    </div>
                  <?php endforeach?>
                </div>
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
  <!-- Modal -->
  <div class="modal fade" id="modalbayar" tabindex="-1" aria-labelledby="modalbayarLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="/kasir/pembayaran" method="post">
              <div class="modal-header">
                  <h5 class="modal-title" id="modalbayarLabel">Pembayaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <input type="number" name="cash" class="form-control">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
          </div>
      </div>
  </div>
  <?= view('layouts/layoutFooter'); ?>
  <?= $this->endSection(); ?>

  