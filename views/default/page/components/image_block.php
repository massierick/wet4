<?php
/**
 * Elgg image block pattern
 *
 * Common pattern where there is an image, icon, media object to the left
 * and a descriptive block of text to the right.
 * 
 * ---------------------------------------------------------------
 * |          |                                      |    alt    |
 * |  image   |               body                   |   image   |
 * |  block   |               block                  |   block   |
 * |          |                                      | (optional)|
 * ---------------------------------------------------------------
 *
 * @uses $vars['body']        HTML content of the body block
 * @uses $vars['image']       HTML content of the image block
 * @uses $vars['image_alt']   HTML content of the alternate image block
 * @uses $vars['class']       Optional additional class for media element
 * @uses $vars['id']          Optional id for the media element
 */

$body = elgg_extract('body', $vars, '');
$image = elgg_extract('image', $vars, '');
$alt_image = elgg_extract('image_alt', $vars, '');

$class = 'col-xs-12 mrgn-tp-sm ';
$additional_class = elgg_extract('class', $vars, '');
if ($additional_class) {
	$class = "$class $additional_class";
}

$id = '';
if (isset($vars['id'])) {
	$id = "id=\"{$vars['id']}\"";
}


$body = "<div class=\"mrgn-tp-sm col-sm-10\">$body</div>";

if ($image) {
	$image = "<div class=\"mrgn-tp-sm col-sm-2\">$image</div>";
}

if ($alt_image) {
	$alt_image = "<div class=\"elgg-image-alt\">$alt_image</div>";
}
//elgg body appends the edit comment text box thing
echo <<<HTML
<div class="$class clearfix mrgn-bttm-md" $id>
	$image$alt_image$body
    <div class=" elgg-body clearfix edit-comment">
    
    </div>
</div>
HTML;
