<?php do_action( 'wilmer_mikado_action_before_site_logo' ); ?>

<?php

$styles = array();

if($logo_text_color != '') {
    $styles[] =  'color: ' . $logo_text_color;
}

if($logo_font_size != '') {
    $styles[] =  'font-size: ' . wilmer_mikado_filter_px($logo_font_size) . 'px';
}

if($logo_bg_color != '') {
    $styles[] =  'background-color: ' . $logo_bg_color;
}

if($logo_text_side_padding != '') {
    $styles[] =  'padding: 0 ' . wilmer_mikado_filter_px($logo_text_side_padding) . 'px';
}

?>

    <div class="mkdf-logo-wrapper mkdf-text-logo-type">
        <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php wilmer_mikado_inline_style(implode('; ', $styles)); ?>>
            <?php if($logo_text !== '') { ?>
                <span class="mkdf-text-logo">
                    <?php print wilmer_mikado_get_formated_output($logo_text); ?>
                </span>
            <?php } ?>
        </a>
    </div>
<?php do_action( 'wilmer_mikado_action_after_site_logo' ); ?>