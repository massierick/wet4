<?php

/**
 * Elgg module element
 *
 * @uses $vars['type']         The type of module (main, info, popup, aside, etc.)
 * @uses $vars['title']        Optional title text (do not pass header with this option)
 * @uses $vars['header']       Optional HTML content of the header
 * @uses $vars['body']         HTML content of the body
 * @uses $vars['footer']       Optional HTML content of the footer
 * @uses $vars['class']        Optional additional class for module
 * @uses $vars['id']           Optional id for module
 * @uses $vars['show_inner']   Optional flag to leave out inner div (default: false)
 
 
 2015/10/14-
 Added conditional check to see what page the module is loaded on and what type of module it is
 */


//check which page module will be rendering on for styling
$checkPage = elgg_get_context();

$type = elgg_extract('type', $vars, false);
$title = elgg_extract('title', $vars, '');
$body = elgg_extract('body', $vars, '');
$footer = elgg_extract('footer', $vars, '');
$show_inner = elgg_extract('show_inner', $vars, false);

$attrs = [
	'id' => elgg_extract('id', $vars),
	'class' => (array) elgg_extract('class', $vars, []),
];



/**
 *
 * Check which page and type of module are being rendered
 * If in tab on group profile, dont have normal style
 *
 */

if($checkPage == 'group_profile' && $type == 'GPmod'){
  
    if ($type) {
        $attrs['class'][] = "elgg-module-$type";
    }


    $body = elgg_format_element('div', ['class' => ''], $body);
    if ($footer) {
        $footer = elgg_format_element('div', ['class' => 'text-right'], $footer);
    }

    $contents = $header . $body . $footer;
    if ($show_inner) {
        $contents = elgg_format_element('div', ['class' => 'elgg-inner'], $contents);
    }

    echo elgg_format_element('div', $attrs, $contents);

} else { //Normal Style Below
    
    $attrs['class'][] = 'panel panel-custom';
    if ($type) {
        $attrs['class'][] = "elgg-module-$type";
    }

    $header = elgg_extract('header', $vars);
    if ($title) {
        $header = elgg_format_element('h2', ['class' => ''], $title);
    }

    if ($header !== null) {
        $header = elgg_format_element('div', ['class' => 'panel-heading clearfix'], $header);
    }
    $body = elgg_format_element('div', ['class' => 'panel-body'], $body);
    if ($footer) {
        $footer = elgg_format_element('div', ['class' => 'panel-footer text-right'], $footer);
    }

    $contents = $header . $body . $footer;
    if ($show_inner) {
        $contents = elgg_format_element('div', ['class' => 'elgg-inner'], $contents);
    }

    echo elgg_format_element('div', $attrs, $contents);

}