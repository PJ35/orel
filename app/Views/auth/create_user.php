<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                  <div class="card-body p-4">
                        <h1 class="h3 mb-2"><?php echo lang('Auth.create_user_heading'); ?></h1>
                        <p class="text-muted mb-4"><?php echo lang('Auth.create_user_subheading'); ?></p>

                        <?php if (isset($message) && trim(strip_tags((string) $message)) !== ''): ?>
                              <div id="infoMessage" class="alert alert-info"><?php echo $message; ?></div>
                        <?php endif; ?>

                        <?php echo form_open('auth/create_user'); ?>

                        <?php if ($identity_column !== 'email'): ?>
                              <div class="mb-3">
                                    <?php echo form_label(lang('Auth.create_user_identity_label'), 'identity', ['class' => 'form-label']); ?>
                                    <?php echo form_input(array_merge($identity, ['class' => 'form-control'])); ?>
                                    <?php if (\Config\Services::validation()->getError('identity')): ?>
                                          <div class="text-danger small mt-1"><?php echo \Config\Services::validation()->getError('identity'); ?></div>
                                    <?php endif; ?>
                              </div>
                        <?php endif; ?>

                        <div class="mb-3">
                              <?php echo form_label(lang('Auth.create_user_email_label'), 'email', ['class' => 'form-label']); ?>
                              <?php echo form_input(array_merge($email, ['class' => 'form-control'])); ?>
                        </div>

                        <div class="mb-3">
                              <?php echo form_label(lang('Auth.create_user_password_label'), 'password', ['class' => 'form-label']); ?>
                              <?php echo form_input(array_merge($password, ['class' => 'form-control'])); ?>
                        </div>

                        <div class="mb-3">
                              <?php echo form_label(lang('Auth.create_user_password_confirm_label'), 'password_confirm', ['class' => 'form-label']); ?>
                              <?php echo form_input(array_merge($password_confirm, ['class' => 'form-control'])); ?>
                        </div>

                        <div class="d-grid">
                              <?php echo form_submit('submit', lang('Auth.create_user_submit_btn'), ['class' => 'btn btn-primary']); ?>
                        </div>

                        <?php echo form_close(); ?>
                  </div>
            </div>
      </div>
</div>
<?= $this->endSection() ?>
