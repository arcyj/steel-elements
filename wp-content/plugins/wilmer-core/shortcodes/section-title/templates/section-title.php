<div class="mkdf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wilmer_mikado_get_inline_style($holder_styles); ?>>
	<div class="mkdf-st-inner">
        <?php if(!empty($intro_title)) { ?>
            <<?php echo esc_attr($intro_title_tag); ?> class="mkdf-st-intro-title" <?php echo wilmer_mikado_get_inline_style($intro_title_styles); ?>>
                <?php echo wp_kses($intro_title, array('br' => true, 'span' => array('class' => true))); ?>
            </<?php echo esc_attr($intro_title_tag); ?>>
        <?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-st-title" <?php echo wilmer_mikado_get_inline_style($title_styles); ?>>
				<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<<?php echo esc_attr($text_tag); ?> class="mkdf-st-text" <?php echo wilmer_mikado_get_inline_style($text_styles); ?>>
				<?php echo wp_kses($text, array('br' => true)); ?>
			</<?php echo esc_attr($text_tag); ?>>
		<?php } ?>
	</div>
</div>