<?php
/*
Plugin Name: Category/Archive Indexing
Plugin URI: http://www.learncpp.com/wordpress/category_archive_indexing_plugin/
Description: Allows user to make category and archive pages show a listing of the posts rather than the actual posts.
Version: 1.0
Author: Alex Pomeranz
Author URI: http://www.learncpp.com
*/

function CAI_Header($headerStyleStart='<h2>', $headerStyleEnd='</h2>')
{
if (is_category())
{
	echo $headerStyleStart . 'Category: '; single_cat_title(); echo $headerStyleEnd . '<br>';
/*	echo '<p>' . category_description(the_category_ID(false)) . '</p>'; */
}
elseif (class_exists('SimpleTagging') && STP_IsTagView())
{
	global $STagging;
	echo $headerStyleStart . 'Tag: ' . $STagging->search_tag . $headerStyleEnd . '<br>';
}
elseif (is_month())
{
	echo $headerStyleStart . 'Archive: '; single_month_title(' ', true); echo $headerStyleEnd . '<br>';
} 
elseif (is_year())
{
	echo $headerStyleStart . 'Archive: '; get_query_var('year'); echo $headerStyleEnd . '<br>';
} 
elseif (is_search())
{
	echo $headerStyleStart . 'Search results' . $headerStyleEnd . '<br>';
} 

}

function CAI_SetNumberOfPosts($limit)
{
global $wp_query;
$wp_query->query_vars["posts_per_page"] = $limit;
$wp_query->get_posts();
}

function CAI_DisplayLink($beforeLink='', $afterLink='<br>')
{
	if (is_date()) { the_time('F jS, Y'); echo '&nbsp;&nbsp;'; }
	echo $beforeLink . '<a href="';  the_permalink(); echo '">'; the_title(); echo '</a>' . $afterLink;
}


?>