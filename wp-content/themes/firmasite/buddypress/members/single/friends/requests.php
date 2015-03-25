<?php do_action( 'bp_before_member_friend_requests_content' ); ?>

<?php if ( bp_has_members( 'type=alphabetical&include=' . bp_get_friendship_requests() ) ) : ?>

	<ul id="friend-list" class="item-list list-unstyled" role="main">
		<?php while ( bp_members() ) : bp_the_member(); ?>

			<li id="friendship-<?php bp_friend_friendship_id(); ?>">
			 <div class="panel panel-default"><div class="panel-body">
            	<div class="item-avatar">
					<a href="<?php bp_member_link(); ?>"><?php bp_member_avatar(); ?></a>
				</div>

				<div class="item">
					<div class="item-title"><a href="<?php bp_member_link(); ?>" class="lead"><?php bp_member_name(); ?></a></div>
					<div class="item-meta"><span class="label label-default activity"><?php bp_member_last_active(); ?></span></div>
				</div>

				<?php do_action( 'bp_friend_requests_item' ); ?>

				<div class="action">
					<a class="btn btn-default btn-xs button accept" href="<?php bp_friend_accept_request_link(); ?>"><?php _e( 'Accept', 'firmasite' ); ?></a> &nbsp;
					<a class="btn btn-default btn-xs button reject" href="<?php bp_friend_reject_request_link(); ?>"><?php _e( 'Reject', 'firmasite' ); ?></a>

					<?php do_action( 'bp_friend_requests_item_action' ); ?>
				</div>
             </div></div>     
			</li>

		<?php endwhile; ?>
	</ul>

	<?php do_action( 'bp_friend_requests_content' ); ?>

	<div id="pag-bottom" class="pagination no-ajax">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div class="clearfix"></div><div id="message" class="info alert alert-info">
		<p><?php _e( 'You have no pending friendship requests.', 'firmasite' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_member_friend_requests_content' ); ?>