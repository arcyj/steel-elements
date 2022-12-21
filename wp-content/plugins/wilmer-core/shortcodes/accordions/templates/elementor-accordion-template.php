<<?php echo esc_attr($title_tag); ?> class="mkdf-accordion-title" <?php echo wilmer_mikado_get_inline_style($title_styles); ?>>
<span class="mkdf-tab-title"><?php echo esc_html($title); ?></span>
<span class="mkdf-accordion-mark">
		<span class="mkdf_icon_plus icon_plus"></span>
		<span class="mkdf_icon_minus icon_minus-06"></span>
	</span>
</<?php echo esc_attr($title_tag); ?>>
<div class="mkdf-accordion-content">
    <div class="mkdf-accordion-content-inner">
        <?php echo wilmer_mikado_get_module_part($text); ?>
    </div>
</div>