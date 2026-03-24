<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
  <div class="col-12 col-md-8 col-lg-5">
    <div class="card shadow-sm border-0">
      <div class="card-body p-4">
        <h1 class="h3 mb-2"><?php echo lang('Auth.login_heading'); ?></h1>
        <p class="text-muted mb-4"><?php echo lang('Auth.login_subheading'); ?></p>

        <?php if (! empty($message)): ?>
          <div id="infoMessage"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php echo form_open('auth/login'); ?>

        <div class="mb-3">
          <?php echo form_label(lang('Auth.login_identity_label'), 'identity', ['class' => 'form-label']); ?>
          <?php echo form_input(array_merge($identity, ['class' => 'form-control'])); ?>
        </div>

        <div class="mb-3">
          <?php echo form_label(lang('Auth.login_password_label'), 'password', ['class' => 'form-label']); ?>
          <?php echo form_input(array_merge($password, ['class' => 'form-control'])); ?>
        </div>

        <div class="d-grid">
          <?php echo form_submit('submit', lang('Auth.login_submit_btn'), ['class' => 'btn btn-primary']); ?>
        </div>

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>