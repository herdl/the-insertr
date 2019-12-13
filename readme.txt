=== The Insertr ===
Contributors: b3none
Donate link: https://herdl.com/
Tags: keyword, ppc, dynamic keyword inserter, herdl
Requires at least: 2.9
Tested up to: 5.2
Stable tag: 5.2
Requires PHP: 7.0.0
License: MIT
License URI: https://github.com/herdl/the-insertr/blob/master/LICENSE.md

Wordpress dynamic keyword insertion plugin.

== Description ==

The Herdl dynamic keyword insertion plugin, The Insertr, dynamically inserts a keyword onto your page using a simple URL query string to determine the keyword and a shortcode for placement.

The placement of the word or phrase is determined by the location of the short code. In the case where a word is not specified a fallback Keyword or phrase is placed instead.

== Installation ==

You can download the latest release as a `.zip` then head over to your site to install this manually.

Once this plugin has been approved on the WordPress marketplace we will update the repository with a link.

== Usage ==

Short code to be used: [insertr key=”{desiredword}” fallback=”{fallback}”] where ‘desiredword’ is the word to be placed, and ‘fallback’ is the word to appear if no keyword is specified.

For the Keyword to be placed on your page, you must also add the following parameter to your URL: ?keyword={example} Where ‘example’ is the word you want to placed.

If your URL already has parameters (E.g – there is already a ? in the URL) add &keyword={keyword} to the end of the string.

== Frequently Asked Questions ==

There are currently no frequently asked questions for this project.

== Upgrade Notice ==

There are currently no upgrade notices for this project.

 == Screenshots ==

1. There are no screenshots available for this project.

== Changelog ==

= 1.2.0 =
* Add ability to use short codes on ACF and YoastSEO

= 1.1.0 =
* Use the correct WordPress escaping and sanitisation functions.

= 1.0.0 =
* Initial release.
