<?php 
#// BEGIN set display based on selected fields & user permission
class wpul_widget extends WP_Widget {

	function wpul_widget() {
		// Instantiate the parent object
			show_admin_bar(false); // Disable admin bar

		parent::__construct( false, 'WP UserLogin');
	}
function wpul_user_permissions($args){
	$wp_url = get_settings('siteurl');
        $check = get_option('wpul_settings');
        $welcome = $check['welcome'];
	$vals = explode(',',$args);
        global $current_user, $user_ID, $wp_admin_bar,$wpdb,$post;
        get_currentuserinfo();
	

        $comments_waiting = $wpdb->get_var($wpdb->prepare("SELECT count(comment_ID) FROM $wpdb->comments WHERE comment_approved = '0'"));
	$core = get_option('_site_transient_update_core');
	$plugins = get_option('_site_transient_update_plugins');
	$updates['plugins'] = $plugins->response;
	$updates['core'] = $core->updates['0']->response;
	$plugin_update = count($updates['plugins']);
	$link[] = ($check['dashboard'] == 'CHECKED' ? '<li><a class="btn btn-primary " href="'.admin_url().'">'.__('Dashboard').'</a></li>':'');
	$link[] = ($comments_waiting > 0) ? '<li><a class="btn btn-default " href="'.admin_url('edit-comments.php?comment_status=moderated').'"/">'.pluralize($comments_waiting,__('Comments'),__('Comment')).(' Pending').' <span class="badge badge-important">'.$comments_waiting.'</span></a></li>':'';
        $link[]= current_user_can('edit_posts') && (is_single() || is_page())?'<li><a href="'.get_edit_post_link($post->ID).'" class="btn btn-warning ">Edit This '.ucwords($post->post_type).'</a></li>':'';
        
        $postlabel = '<li><a data-toggle="collapse" data-target="#posts" class="btn btn-primary ">'.__('Posts').' <b class="caret"></b></a>
        <div id="posts" class="collapse">';
	$new = $check['newpost'] == 'CHECKED' && current_user_can('publish_posts') ? '<a href="'.admin_url('post-new.php').'" class="btn btn-default ">'.__('New Post').'</a>':'';
        $edit = $check['editpost'] == 'CHECKED' && current_user_can('edit_posts') ? '<a href="'.admin_url('edit.php').'" class="btn btn-default  ">'.__('Edit Posts').'</a>':'';
        $endcollapse = '</div></li>';
        $link[] = $postlabel.$new.$edit.$ethis.$endcollapse ;

	$themes = '<li><a data-toggle="collapse" data-target="#themes" class="btn btn-primary ">'.__('Appearance').' <b class="caret"></b></a><div id="themes" class="collapse">';
        $manage =$check['managetheme'] == "CHECKED" && current_user_can('update_themes')? '<a href="'.admin_url('themes.php').'" class="btn btn-default ">'.__('Manage Themes').'</a>':'';
	$installt = $check['installtheme'] == "CHECKED" && current_user_can('install_themes')? '<a href="'.admin_url('theme-install.php').'" class="btn btn-default  ">'.__('Install Themes').'</a>':'';
	$editt = $check['edittheme'] == "CHECKED" && current_user_can('editthemes')? '<li><a href="'.admin_url('theme-install.php').'" class="btn btn-default  ">'.__('Editor').'</a>':'';
        $link[] = $themes.$manage.$installt.$editt.'</div></li>';
        
	$plugins = '<li><a data-toggle="collapse" data-target="#plugins" class="btn  btn-primary">'.__('Plugins').' <b class="caret"></b></a><div id="plugins" class="collapse">';
        $update = '<a href="'.admin_url('plugins.php').'" class="btn btn-default ">'.__('Manage Plugins').'</a>';
	$installp = $check['install_plugins'] == "CHECKED" && current_user_can('install_plugins') ? '<a href="'.admin_url('plugins.php').'" class="btn btn-default ">'.__('Install Plugins').'</a>':'';
        $link[] = $plugins.$update.$installp.'</div></li>';
                
	$users = '<li><a data-toggle="collapse" data-target="#users" class="btn btn-primary ">'.__('Users').' <b class="caret"></b></a><div id="users" class="collapse">';
	$editu = $check['users'] == "CHECKED" &&  current_user_can('edit_users')?'<a href="'.admin_url('users.php').'" class="btn btn-default  ">'.__('All Users').'</a>':'';
	$eprofile = $check['profile'] == "CHECKED" &&  is_user_logged_in()?'<a href="'.admin_url('profile.php').'" class="btn btn-default  ">'.__('Edit Your Profile').'</a>':'';
	$vprofile = '<a href="'.home_url('?author='.$user_ID).'" class="btn btn-info ">'.__('View Your Profile','wp-userlogin').'</a>';
        $link[] = $users.$editu.$eprofile.$vprofile.'</div></li>';
        
        $link[] = $plugin_update > 0 && current_user_can('update_core') ? '<li><a href="'.admin_url('update-core.php').'" class="btn btn-danger ">'.$plugin_update.__(' Plugin ').pluralize($plugin_update,__('Updates'),__('Update')).__(' Available').'</a>':''; 
	$link[] = $updates['core'] == 'upgrade' && current_user_can('update_core')?'<li><a href="'.admin_url('update-core.php').'" class="btn btn-danger ">'.__('Core Update Available').'</a>':''; 
	$link[] = $check['options'] == "CHECKED" &&  current_user_can('manage_options')?'<li><a href="'.admin_url('options-general.php').'" class="btn btn-warning ">'.__('Settings').'</a></li>':'';
        $link[] = '<li><a href="'.admin_url('tools.php').'" class="btn btn-info">'.__('Your Available Tools').'</a></li>';
        $link[] = '<li><a href="'.admin_url('admin.php?page=wpul_options').'" class="btn btn-success">'.__('UserLogin').'</a></li>';
	$link[] = $check['logout'] == "CHECKED" && is_user_logged_in()?
            $check['redirect_out'] !== ''?'<li><a class="btn btn-danger " href="'.wp_logout_url(get_bloginfo('url').'/'.$check['redirect_out']).'">'.__('Logout').'</a></li>':'<li><a href="'.wp_logout_url($_SERVER['REQUEST_URI']).'" class="btn  btn-danger">'.__('Logout').'</a></li>':'';    
    if($check['welcomecheck'] == "CHECKED"){
        $firstname = !empty($current_user->user_firstname)?$current_user->user_firstname:$current_user->display_name;
        $lastname = !empty($current_user->user_lastname)? $current_user->user_lastname:$current_user->display_name;
        $fullname = !empty($current_user->user_firstname) && !empty($current_user->user_lastname)?$current_user->user_firstname.' '.$current_user->user_lastname:$current_user->display_name;

        $look = array(
            'user'=>$current_user->user_nicename,
            'login'=>$current_user->user_login,
            'email'=>$current_user->user_email,
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'fullname'=>$fullname,
            'id'=>$current_user->ID
        );
        $key = '';
        $val = '';
        list($key,$val) = explode('%',$welcome);
            $head = $welcome ? $key. $look[$val]:'';
        }
        $head = '<span id="welcome">'.$head.'</span>';
    $avatar = $check['avatar'] == "CHECKED"?get_avatar( $current_user->ID, '96', '', $look[$val] ):'';
preg_match("/src='(.*?)'/i",$avatar,$match);
    $avatar = '<img src="'.$match[1].'" class="img-circle">';
        $head = '<ul class="wpul_menu accordion list-unstyled" id="accordion2"><li>'.$avatar.'&nbsp;'.$head. '</li>';
        
 	$foot = wpul_optional_links()."</ul>";
$links = implode('',$link);
	return $head.$links.$foot;
}
	function widget( $args, $instance ) {
		// Widget output
		$check = get_option('wpul_settings');
		//~ print_r($check);	
		if(is_user_logged_in()){
			global $current_user;
			get_currentuserinfo();
		$title =$option['set_log'];	
		
            if ( current_user_can('activate_plugins')){
		for($i=0;$i<10;$i++){
			$options[] =$i;
		}
            }
	    if(current_user_can('edit_posts')){
		$options[] = 2;
		$options[] = 0;
	    }
            if(current_user_can('publish_posts')){
		for($i=3;$i<8;$i++){
			$options[] = $i;
		}
		$options[] .= 0;
	    }
            if(current_user_can('read') ){
                    $options[] = 0;
                    $options[] = 6;
                    $options[] = 7;
            }
	    $options = array_unique($options);
	    $options = implode(',',$options);
	    $options = $this->wpul_user_permissions($options);

		}else{
		$title = $option['set_nonlog'];
		if($option['redirect'] !== ''){
			$redir = get_bloginfo('url').'/'.$option['redirect'];
		}else{
			$redir = $_SERVER['REQUEST_URI'];
		}
                $after_widget = '<div class="clearfix"></div>';
			$outargs = array(
        'echo' => true,
        'redirect' => $redir, 
        'form_id' => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false );
			wp_login_form($outargs);
		}
		echo $before_title
		. $title
		. $after_title
		. $options
		.$after_widget;
		
	}



	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}
?>