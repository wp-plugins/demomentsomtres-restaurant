=== DeMomentSomTres Restaurant ===
Contributors: marcqueralt
Tags: custom post type, restaurant, dishes
Donate link: http://demomentsomtres.com/english/wordpress-plugins/demomentsomtres-restaurant/
Version: 1.2
Requires at least: 3.5
License: GPLv2 or later

DeMomentSomTres Restaurants is specifically designed to Restaurants, Bars and cafeterias to show their menus in an easy way.

== Description ==

DeMomentSomTres Restaurants is specifically designed to Restaurants, Bars and cafeterias in order to show their menus in an easy to mantain way.

It manages publish date and also expiry date allowing you to plan activity.

To help to standardize and help day menu management, a dishlist template has been added. Button added to tinyMCE editor and also administration page.

You can get more information about the component at the [this plugin author's website](http://DeMomentSomTres.com/english/wordpress-plugin-restaurant/ "This plugin page at DeMomentSomTres website")

= Features =

* Dishlist: you can show as many dishes and plates.
* Specific taxonomy type `dishlist type`: the dish lists can be grouped under an specific taxonomy. So you can have daily menu, vegetarian menus...
* Shortcode to show last contents of a taxonomy: the short code is designed to show a group of the most recent menus in a dishlist type. It was designed in order to show the current menu in the home page.
* Shortcodes to mark Ecological, Proximity and Price. This shortcodes has been integrated to the editor in order to make things easy.

= History & raison d'être =

On may 2013 DeMomentSomTres was asked to build a web for [a small restaurant in Argentona (Barcelona) called La Fonda del Casal](http://www.lafondadelcasal.cat "An example of web using the DeMomentSomTres Restaurant WordPress Plugin").

Our experience building websites for small restaurants showed us the need to have a plugin to make them easy to manage their menus and meals lists. They needed an easy way to publish that but we needed it not inside the blog. A custom type was required. 
They also needed a way to show the day menu in the frontpage without rewriting it. The shortcode was born. And this shortcode allowed us to put all the menus of diferent types together in a single page but that can be managed as many: wines, salads, meals... [Test it at Fonda del Casal Restaurant](http://www.lafondadelcasal.cat/plats "Live test menu").

== Installation ==

It can be installed as any other WordPress plugin. It doesn't have any special requirements.

== Frequently Asked Questions ==

= How do I show the last menu of a certain type inside a post or page =

You can use the shortcode `[demomentsomtres-restaurant-dish-list type=id count=N hidden_titles title_format="h3"]` to show the N current dish lists of type id inside the post or page. 

* Type id is required. 
* Count is assumed to be 1 if not present. 
* If you want to hide the titles the parameter hidden_titles must be present.
* You can define the HTML tag for titles using title_format. If no value provided it is assumed to be h3.

= Why there's no widget to show the menus lists =

The plugin [Recent Posts Widget Extended](http://wordpress.org/plugins/recent-posts-widget-extended/) is enough for our needs and is highly customizable. As we don't like to reinvent the wheel, we did not code any widget.

= Additional shortcodes =

There'are the following additional shortcodes with the following features:

* [ECO]: inserts an `<i class="icon-eco">Ecological</i>` element.
* [PROX]: inserts an `<i class="icon-prox">Proximity</i>` element.
* [P XXX]: inserts an `<div class="price">XXX</div>` element.

= How do I show all the public dish lists =

You can call the restaurant archive to show the contents on an archive basis.

= How to customize the message on expired dish lists =

To customize expiry message you can use css class `.demomentsomtres-restaurant-expired`.

== Changelog ==

= 1.2 =
* Dishlist template added in administration and tinymce button

= 1.1.0 =

* an archive view of dishlists avoiding them to be always hidden in order to avoid 404 errors and help SEO positioning.
* validity range showed at the top of posts and excerpt.

= 1.0.0 =

Initial release