=== DeMomentSomTres Restaurant ===
Contributors: marcqueralt
Tags: custom post type, restaurant, dishes
Donate link: http://DeMomentSomTres.com
Version: 1.0
Requires at least: 3.5
Tested up to: 3.5.1
Stable tag: trunk
License: GPLv2 or later

DeMomentSomTres Restaurants is specifically designed to Restaurants, Bars and cafeterias in order to show their menus and dishes in an easy to mantain way.

== Description ==

DeMomentSomTres Restaurants is specifically designed to Restaurants, Bars and cafeterias in order to show their menus and dishes in an easy to mantain way.

It manages publish date and also expiry date.

== FAQ ==

=How do I show the last dish-list of a certain type inside a post or page=
You can use the shortcode [demomentsomtres-restaurant-dish-list type=id count=N hidden_titles title_format="h3" empty="Empty message"] to show the N current dish lists of type id inside the post or page. 
* Type id is required. 
* Count is assumed to be 1 if not present. 
* If you want to hide the titles the parameter hidden_titles must be present.
* Empty parameter allows to setup  a message when the answer is empty.
* You can define the HTML tag for titles using title_format. If no value provided it is assumed to be h3.

=Why there's no widget to show the dish lists=
The plugin [Recent Posts Widget Extended](http://wordpress.org/plugins/recent-posts-widget-extended/) is enough for our needs and is highly customizable. As we don't like to reinvent the wheel, we did not code any widget.

=Additional shortcodes=
There'are the following additional shortcodes with the following features:

* [ECO]: inserts an <i class="icon-eco">Ecological</i> element.
* [PROX]: inserts an <i class="icon-prox">Proximity</i> element.
* [P XXX]: inserts an <div class="price">XXX</div> element.

=How do I show all the public dish lists=
You can call the restaurant archive to show the contents on an archive basis.

== Installation ==

No special requirements.

== Changelog ==

TBD