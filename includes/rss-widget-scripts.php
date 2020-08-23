<?php
	
    function rb_rssw_add_scripts(){
    wp_enqueue_style('rb-rssw-main-style' , plugins_url().'/rss-widget/css/style.css');
    
    wp_enqueue_script('rb-rssw-main-script' , plugins_url().'/rss-widget/js/main.js', array('jquery') );
}

add_action('wp_enqueue_scripts', 'rb_rssw_add_scripts');

	