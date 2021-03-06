<?php
/**
 * Wire add form body
 *
 * @uses $vars['post']
 */

elgg_load_js('elgg.thewire');

$post = elgg_extract('post', $vars);
$char_limit = (int)elgg_get_plugin_setting('limit', 'thewire');

$text = elgg_echo('post');
if ($post) {
	$text = elgg_echo('reply');
}
$chars_left = elgg_echo('thewire:charleft');

$parent_input = '';
if ($post) {
	$parent_input = elgg_view('input/hidden', array(
		'name' => 'parent_guid',
		'value' => $post->guid,
	));
}

$count_down = "<span>$char_limit</span> $chars_left";
$num_lines = 3;
if ($char_limit == 0) {
	$num_lines = 3;
	$count_down = '';
} else if ($char_limit > 140) {
	$num_lines = 3;
}

$post_input = elgg_view('input/plaintext', array(
	'name' => 'body',
	'class' => 'mtm',
    
	'id' => 'thewire-textarea',
	'rows' => $num_lines,
	'data-max-length' => $char_limit,
));

$submit_button = elgg_view('input/submit', array(
	'value' => $text,
	'id' => 'thewire-submit-button',
    'class' => 'btn-primary mrgn-tp-sm',
));

echo <<<HTML
<label for="thewire-textarea">Create a Wire Post:</label>
	$post_input
<div id="thewire-characters-remaining">
	$count_down
</div>
<div class="elgg-foot mts mrgn-bttm-md mrgn-tp-sm">
	$parent_input
	$submit_button
</div>
HTML;
