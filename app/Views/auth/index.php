<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow-sm border-0">
	<div class="card-body p-4">
		<h1 class="h3 mb-2"><?php echo lang('Auth.index_heading'); ?></h1>
		<p class="text-muted mb-4"><?php echo lang('Auth.index_subheading'); ?></p>

		<?php if (! empty($message)): ?>
			<div id="infoMessage" class="alert alert-info"><?php echo $message; ?></div>
		<?php endif; ?>

		<div class="table-responsive">
			<table class="table table-striped table-hover align-middle mb-0">
				<thead class="table-light">
					<tr>
						<th><?php echo lang('Auth.index_email_th'); ?></th>
						<th><?php echo lang('Auth.index_action_th'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
						<td>
							<a class="btn btn-sm btn-outline-primary" href="<?php echo site_url('auth/edit_user/' . $user->id); ?>">
								<?php echo lang('Auth.index_edit_link'); ?>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?= $this->endSection() ?>