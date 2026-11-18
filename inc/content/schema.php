<?php

// Extra schema.org types for THIS client site.
//
// The page's JSON-LD comes from The SEO Framework (TSF), which the parent theme
// ships: one <script> with an @graph of WebSite, WebPage, BreadcrumbList and the
// Organization (or Person), which the parent fills from Theme Settings > SEO >
// Organization Details. It stops there on purpose. Anything industry-specific
// (Product, FAQPage, Recipe, Event, a LocalBusiness per branch) is a
// per-project addition, which means here.
//
// Add a type by appending an entity to TSF's graph with TSF's own filter,
// `the_seo_framework_schema_graph_data` ($graph: a sequential list of entities;
// $args: the query, or null when TSF works it out from the current request).
// Keep the add_filter() call at the top level: it only stores the callback, and
// nothing runs until TSF builds the graph. Never call a devbase_* function at the
// top level of this file (the parent is not loaded yet).
//
// Nothing here runs while TSF is off (Theme Settings > Miscellaneous > SEO) or
// while another SEO plugin is active: the filter is then simply never applied.
//
// Settings for a type go on an options page of their own, registered under
// Theme Settings with acf_add_options_sub_page() on acf/init. A field group on
// it makes it a section of the Theme Settings screen by itself (parent README,
// "Settings"). Read values with get_field( 'x', 'option' ).
//
// The old `devbase/schema/tabs` filter and the Schema Markup page are gone from
// the parent (1.37.0); a callback on that filter is never called.

add_filter( 'the_seo_framework_schema_graph_data', function ( $graph, $args = null ) {
	if ( ! is_array( $graph ) ) {
		return $graph;
	}

	// Example: an FAQPage on the page whose slug is "faq", from a repeater.
	//
	// if ( is_page( 'faq' ) ) {
	//     $questions = array();
	//
	//     foreach ( (array) get_field( 'faq_items' ) as $item ) {
	//         $questions[] = array(
	//             '@type'          => 'Question',
	//             'name'           => wp_strip_all_tags( $item['question'] ),
	//             'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_kses_post( $item['answer'] ) ),
	//         );
	//     }
	//
	//     if ( $questions ) {
	//         $graph[] = array( '@type' => 'FAQPage', 'mainEntity' => $questions );
	//     }
	// }

	return $graph;
}, 30, 2 );
