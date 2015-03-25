<div class="modal firmasite-modal-static"><div class="modal-dialog"><div class="modal-content"><div class="modal-body">
<table class="table table-hover table-striped notifications">
	<thead>
		<tr>
			<th class="icon"></th>
			<th class="title"><?php _e( 'Notification', 'firmasite' ); ?></th>
			<th class="date"><?php _e( 'Date Received', 'firmasite' ); ?></th>
			<th class="actions"><?php _e( 'Actions',    'firmasite' ); ?></th>
		</tr>
	</thead>

	<tbody>

		<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>

			<tr>
				<td></td>
				<td><?php bp_the_notification_description();  ?></td>
				<td><?php bp_the_notification_time_since();   ?></td>
				<td><?php bp_the_notification_action_links(); ?></td>
			</tr>

		<?php endwhile; ?>

	</tbody>
</table>
</div></div></div></div>
