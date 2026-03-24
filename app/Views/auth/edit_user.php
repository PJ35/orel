<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h1 class="h3 mb-2"><?php echo lang('Auth.edit_user_heading'); ?></h1>
                <p class="text-muted mb-4"><?php echo lang('Auth.edit_user_subheading'); ?></p>

                <?php if (isset($message) && trim(strip_tags((string) $message)) !== ''): ?>
                    <div id="infoMessage" class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>

                <?php echo form_open(uri_string()); ?>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <?php echo form_label(lang('Auth.edit_user_password_label'), 'password', ['class' => 'form-label']); ?>
                        <?php echo form_input(array_merge($password, ['class' => 'form-control'])); ?>
                    </div>

                    <div class="col-12 col-md-6">
                        <?php echo form_label(lang('Auth.edit_user_password_confirm_label'), 'password_confirm', ['class' => 'form-label']); ?>
                        <?php echo form_input(array_merge($password_confirm, ['class' => 'form-control'])); ?>
                    </div>
                </div>

                <?php if ($ionAuth->isAdmin()): ?>
                    <hr class="my-4" />
                    <h2 class="h5 mb-3"><?php echo lang('Auth.edit_user_groups_heading'); ?></h2>
                    <div class="row g-2">
                    <?php foreach ($groups as $group): ?>
                        <?php
                            $gID = $group['id'];
                            $checked = false;
                            foreach ($currentGroups as $grp) {
                                if ($gID == $grp->id) {
                                    $checked = true;
                                    break;
                                }
                            }
                        ?>
                        <div class="col-12 col-md-6">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="groups[]"
                                    id="group_<?php echo $group['id']; ?>"
                                    value="<?php echo $group['id']; ?>"
                                    <?php echo $checked ? 'checked' : ''; ?>
                                />
                                <label class="form-check-label" for="group_<?php echo $group['id']; ?>">
                                    <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php echo form_hidden('id', $user->id); ?>

                <div class="d-grid d-md-flex justify-content-md-end mt-4">
                    <?php echo form_submit('submit', lang('Auth.edit_user_submit_btn'), ['class' => 'btn btn-primary']); ?>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>