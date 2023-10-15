<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kedai Afan | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <?=$this->renderSection('content'); ?>
  

  
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/js/pages/dashboard.js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
<script>
function addKeranjang(idProduk){
  $.ajax({
    url:"/kasir",
    type:"POST",
    data:{
      'idProduk':idProduk,
    },
    success: function(response){
      // console.log(response);
      $('#itemKeranjang').empty();
            let total = 0;
            JSON.parse(response)['data'].map((item, idx) => {
              total = total + parseInt(item.jumlah) * parseInt(item.hargaProduk)
              hargaCurrency = new Intl.NumberFormat('id-ID', {
                  style: 'currency',
                  currency: 'IDR',
              }).format(item.hargaProduk).replace(/,00$/, '')
              let ele = '';
              ele += '<div class="callout callout-info" id="itemProduk' + item.idProduk + '">'
              ele += '<div class="row">'
              ele += '<div class="col-2 center">'
              ele += '<h3><span class="badge badge-primary">' + item.jumlah + '</span></h3>'
              ele += '</div>'
              ele += '<div class="col-7">'
              ele += '<h5>' + item.namaProduk + '</h5>'
              ele += '<p>' + hargaCurrency + '</p>'
              ele += '</div>'
              ele += '<div class="col-3">'
              ele += '<button type="button" class="btn btn-danger" onclick="hapusKeranjang(' + item.idProduk + ')"><i class="fas fa-trash"></i></button>'
              ele += '</div>'
              ele += '</div>'
              ele += ' </div>'
              $('#itemKeranjang').append(ele);

              $('.harga').empty();
              let formatCurrency = new Intl.NumberFormat('id-ID',{
                style: 'currency',
                currency: 'IDR',
              }).format(total).replace(/,00$/,'')
              $('.harga').append('Total : '+ formatCurrency);
          });
    },
    error: function(response){
      console.log(response);
    },
  });
  }
  function hapusKeranjang(idProduk){
    $.ajax({
      url:"/kasir/keranjang",
      type:"POST",
      data: {
        'idProduk' : idProduk
      },
      success: function(response){
        // console.log(JSON.parse(response));
        let total = 0;
        JSON.parse(response)['data'].map((item,idx)=>{
          total = total + parseInt(item.jumlah) * parseInt(item.hargaProduk)
        });

        let ele = document.getElementById('itemProduk'+idProduk)
        ele.remove()

        $('.harga').empty();
              let formatCurrency = new Intl.NumberFormat('id-ID',{
                style: 'currency',
                currency: 'IDR',
              }).format(total).replace(/,00$/,'')
              $('.harga').append('Total : '+ formatCurrency);
      },
      error: function(xhr, status, error){
        console.log('error:',status,xhr);
      }
    });
  }
  
  function bayar(user){
    $.ajax({
      url:"/kasir/bayar",
      type:"POST",
      data: {
        'user' : user
      },
      success: function(response){
        if (JSON.parse(response)['status']){
          // show models
          $('#modalbayar').modal('show')
        }else{
          alert('keranjang masih kosong')
        }
      },
        error: function(xhr, status, error){
          console.log('error:',status,xhr);
        }
      });
    }

  

  
</script>
</body>
</html>
