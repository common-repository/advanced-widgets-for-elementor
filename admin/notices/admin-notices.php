<?php 
add_action('admin_notices','awe_for_elemetor_admin_notice');
function awe_for_elemetor_admin_notice(){
	//delete_option('notice_dissmissed');
	if (get_option("notice_dissmissed")) {
		return;
	}
	$notice_container = 
	<<<EOD
	<div class="notice is-dismissible %s uniqueclass">
	<p>%s</p>
	</div>
EOD;
	$notice = "Thanks for using Advanced Widges For Elementor";
	printf($notice_container, "notice-info", $notice);

}

