<?= $this->extend('layouts/layoutLogin'); ?>
<?= $this->section('login'); ?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><?=lang('Auth.loginTitle')?></a>
    </div>
    <div class="card-body">
      <?= view('Myth\Auth\Views\_message_block') ?>
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?= url_to('login') ?>" method="post">
						<?= csrf_field() ?>
            <?php if ($config->validFields === ['email']): ?>
        <div class="input-group mb-3">
          <input type="email" name="login" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.email')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php else: ?>
          <div class="input-group mb-3">
          <input type="text" name="login" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.emailOrUsername')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" placeholder="<?=lang('Auth.password')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <?php if ($config->allowRemembering): ?>
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <?php endif; ?>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
      <!-- /.social-auth-links -->

      <?php if ($config->activeResetter): ?>
      <p class="mb-1">
        <a href="<?= url_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a>
      </p>
      <?php endif; ?>
      <?php if ($config->allowRegistration) : ?>
      <p class="mb-0">
        <a href="<?= url_to('register') ?>" class="text-center"><?=lang('Auth.needAnAccount')?></a>
      </p>
      <?php endif; ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<?= $this->endSection(); ?>