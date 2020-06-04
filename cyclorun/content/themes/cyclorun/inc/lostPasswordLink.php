<?php

// function for lost password link
function lost_password_link( $formbottom ) {
	$formbottom .= '<a href="' . wp_lostpassword_url() . '">Mot de passe perdu</a>';
	return $formbottom;
}

add_filter('login_form_bottom', 'lost_password_link');