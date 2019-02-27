<?php

$output = '';
$output .= '<div class="epa-priceTable1">
                <div class="epa-priceTable1-header">';
if ( $icon_switcher == 'yes' ) {
	$output .= '<div class="epa_pricing_icon">
						<i class="' . $icon . '"></i>
					</div>';
}
$output .= '<h3 class="heading">' . $price_title . '</h3>
                    <span class="subtitle">' . $price_subtitle . '</span>
                </div>';
if ( $price_switcher == 'yes' ) {
	$output .= '<div class="price-value">
            <span class="month">' . $duration . '</span>
            <span class="amount"><span class="currency">' . $price_currecny . '</span>' . $price . '</span>
        </div>';
}
$output .= '<div class="pricing-content">
                    <ul>';
foreach ( $featured as $item ) {
	$output .= '<li><i class="' . esc_attr( $item['epa_pricing_list_item_icon'] ) . '"></i> ' . esc_attr( $item['epa_pricing_list_item_text'] ) . '</li>';
}

$output .= '</ul></div>';

if ( $button_switcher == 'yes' ) {
	$output .= '<a href="' . $settings['pricing_button_link']['url'] . '" ' . $target . $nofollow . ' class="read"><span class="epa_pricing_button">' . $button . '</span></a>';
}
if ( $badge_switcher == 'yes' ) {
	$output .= '<div class="ptsColBadge ptsColBadge-' . $badge_position . '-top"><div class="ptsColBadgeContent"><span>' . $badge . '</span></div></div>';
}
$output .= '</div>';