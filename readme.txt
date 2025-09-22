=== The Insertr ===
Contributors: b3none, garethmorgans
Donate link: https://herdl.com/
Tags: keyword, dynamic keyword insertion, dynamic insertion, ads, ad manager, google ads, keyword insertion, DKI, PPC, SEO
Requires at least: 6.3
Tested up to: 6.8.2
Stable tag: 6.8.2
Requires PHP: 8.2.0
License: MIT
License URI: https://github.com/herdl/the-insertr/blob/master/LICENSE.md

WordPress dynamic keyword insertion plugin.

== Description ==

The Insertr allows marketers and site owners to dynamically insert words and phrases into landing pages. Control your parameters using a shortcode and simple query string in the page URL.

A fallback can be entered for cases where the URL does not contain the expected query string. Options are available for uppercase, lowercase and title case text.

== Installation ==

You can download the latest release as a `.zip` then head over to your site to install this manually.

Once this plugin has been approved on the WordPress marketplace we will update the repository with a link.

== Usage ==

Add the following shortcode where you wish to insert a dynamic word or phrase:

[insertr key="{urlParameter}" fallback="{fallbackWord}"]

In the shortcode, the "key" option contains the URL parameter you’d like to use.

The "fallback" option contains the fallback word to be displayed if the URL does not contain a query string using the URL parameter you’ve defined.

For example:

We’ll set the URL parameter to be "keyword" which we’ll assign a value for in the URL. Our fallback word will be "PPC Agency" if the correct query string isn’t used.

[insertr key="keyword" fallback="PPC Agency"]

Our link for the page will use a query string with the parameter set above, "keyword", and the value we’d like to use - in this case we want to dynamically insert "digital agency".

herdl.com?keyword=digital%20agency

When this URL is used to visit our landing page, all instances of the shortcode will display "digital agency". If the query string is not used, all instances of the shortcode will display "ppc agency".

For reference, "%20" is the URL encoded value for a space.

== Advanced Usage ==

You can use multiple shortcodes on the page to dynamically insert different words and phrases. This will require you to use multiple query parameters that are separated by an ampersand, "&", as shown below.

For example:

[insertr key="keyword" fallback="PPC Agency"]

[insertr key="other" fallback="PPC Management"]

herdl.com?keyword=digital%20agency&other=digital%20experts

In the example above, the first shortcode will display "digital agency" and the second shortcode will display "digital experts".

You can also set the letter case using an additional option in the shortcode for uppercase, lowercase and title case. This will determine the letter case of the dynamically inserted words and also the fallback words.

For example:

[insertr key="keyword" fallback="PPC Agency" case="upper"]

herdl.com?keyword=digital%20agency

This would display the inserted words in uppercase:
"DIGITAL AGENCY"

[insertr key="keyword" fallback="PPC Agency" case="lower"]

herdl.com?keyword=digital%20agency

This would display the inserted words in lowercase:
"digital agency"

[insertr key="keyword" fallback="PPC Agency" case="title"]

herdl.com?keyword=digital%20agency

This would display the inserted words in title case:

"Digital Agency"

== Frequently Asked Questions ==

There are currently no frequently asked questions for this project.

== Upgrade Notice ==

There are currently no upgrade notices for this project.

 == Screenshots ==

1. There are no screenshots available for this project.

== Changelog ==
= 1.5.2 - 2025-09-22 =
* Changed: Updated plugin docs

= 1.5.1 - 2025-09-01 =
* Changed: Ensured compatibility checks for both free and pro versions of ACF and SEO plugins.
* Changed: Removed nonce implementation as it was not needed.
* Changed: Updated plugin documentation.
* Changed: Organised code for better readability and maintainability.

= 1.5.0 - 2025-08-29 =
* Added: Enhanced security by validating and sanitising all user inputs.
* Added: Implemented robust error handling and logging mechanisms.
* Changed: Refactored code for improved readability and maintainability.
* Added: Ensured compatibility with ACF.
* Added: Support for shortcodes in SEO plugins like Yoast, Rank Math, AIOSEO, and SEOPress.
* Changed: Updated documentation.

= 1.4.0 - 2020-01-23 =
* Added ability to specify fallback case with a default of lowercase.

= 1.3.0 - 2019-12-19 =
* Added ability to use shortcodes on ACF and Yoast SEO.

= 1.2.0 - 2019-12-13 =
* Removed redundant comments.

= 1.1.0 =
* Use the correct WordPress escaping and sanitisation functions.

= 1.0.0 - 2019-12-09 =
* Initial release.
