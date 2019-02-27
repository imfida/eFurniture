<?php
// FLIP BOX STYLE SECTION
$output = '';
if ( $settings['flipbox_link_type'] == 'box' ) {
	$output .= '<a href="' . $flipbox_url . '" ' . $target . $nofollow . '>';
}
$output .= '<div class="epa-flipbox-wrapper epa-flipbox-' . $settings['epa_elementor_flipbox_style'] . '">
		<div class="flipbox-front-side" data-image="">
			<div class="flipbox-front-content">';
if ( $iconimg == "icon" ) {
	$output .= '<i class="' . $settings['epa_flipbox_icon'] . '"></i>';
}
if ( $iconimg == "img" ) {
	$output .= '<img src="' . $flipbox_front_image_url . '"/>';
}
$output .= '<h2>' . $fronttitle . '</h2>
				<p>' . $fronttext . '</p>
			</div>
			<div class="flip-front-overlay"></div>
		</div>
		<div class="flipbox-back-side" data-image="">
			<div class="flipbox-back-content">';
if ( $bkiconimg == "icon" ) {
	$output .= '<i id="flipbox_back_icon" class="' . $settings['epa_flipbox_icon_back'] . '"></i>';
}
if ( $bkiconimg == "img" ) {
	$output .= '<img src="' . $flipbox_back_image_url . '"/>';
}
if ( $settings['flipbox_link_type'] == 'title' ) {
	$output .= '<a href="' . $flipbox_url . '" ' . $target . $nofollow . '>';
}
$output .= '<h2>' . $backtitle . '</h2>';

if ( $settings['flipbox_link_type'] == 'title' ) {
	$output .= '</a>';
}


$output .= '<p>' . $backtext . '</p>';
if ( $settings['flipbox_link_type'] == "button" ) {

	$output .= '<div class="epa_flipbox_button"><a href="' . $flipbox_url . '"  ' . $target . $nofollow . '>';
	if ( $settings['button_icon_position'] == "before" ) {
		$output .= '<i class="' . $settings['button_icon'] . '"></i>';
	}
	$output .= '<span>' . $settings['flipbox_button_text'] . '</span>';
	if ( $settings['button_icon_position'] == "after" ) {
		$output .= '<i class="' . $settings['button_icon'] . '"></i>';
	}
	$output .= '</a></div>';
}

$output .= '</div>
			<div class="flip-back-overlay"></div>
		</div>
	</div>';
if ( $settings['flipbox_link_type'] == 'box' ) {
	$output .= '</a>';
}