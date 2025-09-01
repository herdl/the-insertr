=== The Insertr ===
Contributors: b3none, garethmorgans
Donate link: https://herdl.com/
Tags: keyword, dynamic keyword insertion, dynamic insertion, ads, ad manager, google ads, keyword insertion, DKI, PPC, SEO
Requires at least: 5.0
Tested up to: 6.3
Stable tag: 6.3
Requires PHP: 8.2.0
License: MIT
License URI: https://github.com/herdl/the-insertr/blob/master/LICENSE.md

WordPress dynamic keyword insertion plugin.

== Description ==

The Insertr allows marketers and site owners to dynamically insert words and phrases into landing pages. Control your parameters using a shortcode and simple query string in the page URL.

A fallback can be entered for cases where the URL does not contain the expected query string. Options are available for uppercase, lowercase and title case text.

== Installation ==

1. Download the latest release as a `.zip` file.
2. Go to your WordPress admin panel and navigate to Plugins > Add New.
3. Click on 'Upload Plugin' and choose the downloaded `.zip` file.
4. Click 'Install Now' and then 'Activate' the plugin.

== Usage ==

To use the plugin, add the following shortcode where you wish to insert a dynamic word or phrase:

[insertr key="urlParameter" fallback="fallbackWord"]

In the shortcode, the "key" option contains the URL parameter you'd like to use.

The "fallback" option contains the fallback word to be displayed if the URL does not contain a query string using the URL parameter you've defined.

For example:

We'll set the URL parameter to be "key" which we'll assign a value for in the URL. Our fallback word will be "PPC Agency" if the correct query string isn't used.

[insertr key="Digital Agency" fallback="PPC Agency"]

The link for the landing page will use a query string with the parameter set above, "key", and the value we'd like to use – in this case we want to dynamically insert "Digital Agency".

example.com?key="digital%20agency"

When this URL is used to visit the landing page, all instances of the shortcode will display "Digital Agency". If the query string is not used, all instances of the shortcode will display "PPC Agency".

For reference, "%20" is the URL encoded value for a space.

== Support ==

For support, please visit the [support forum](https://wordpress.org/support/plugin/the-insertr).
