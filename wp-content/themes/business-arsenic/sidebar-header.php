<?php theme_print_sidebar('header-widget-area'); ?>


    <div class="art-shapes">
        
            </div>






<?php if (theme_get_option('theme_use_default_menu')) { wp_nav_menu( array('theme_location' => 'primary-menu') );} else { ?><nav class="art-nav">
    <?php
	echo theme_get_menu(array(
			'source' => theme_get_option('theme_menu_source'),
			'depth' => theme_get_option('theme_menu_depth'),
			'menu' => 'primary-menu',
			'class' => 'art-hmenu'
		)
	);
	get_sidebar('nav'); 
?> 
    </nav><?php } ?>

                    
