# The Insertr

WordPress dynamic keyword insertion plugin.

## Prerequisites

- **PHP Version**: >= 8.2.0
- **WordPress Version**: >= 6.3

## Installation

1. Download the latest release as a `.zip` file.
2. Go to your WordPress admin panel and navigate to Plugins > Add New.
3. Click on 'Upload Plugin' and choose the downloaded `.zip` file.
4. Click 'Install Now' and then 'Activate' the plugin.

## Description

The Insertr allows marketers and site owners to dynamically insert words and phrases into landing pages. Control your parameters using a shortcode and simple query string in the page URL. A fallback can be entered for cases where the URL does not contain the expected query string. Options are available for uppercase, lowercase, and title case text.

Works with the block editor (Gutenberg), classic editor, and ACF shortcode fields. Use the **Insertr** block in Gutenberg or the `[insertr]` shortcode anywhere shortcodes are processed.

## Usage

**Block editor (Gutenberg):** Add the "Insertr" block from the block inserter (Text category). Configure the URL parameter (key), fallback text, and case in the block sidebar.

**Shortcode:** Add the following shortcode where you wish to insert a dynamic word or phrase (classic editor, Shortcode block, or ACF shortcode fields):

`[insertr key="{urlParameter}" fallback="{fallbackWord}"]`

- **key**: The URL parameter you'd like to use.
- **fallback**: The fallback word to be displayed if the URL does not contain a query string using the URL parameter you've defined.

### Advanced Usage

You can specify the case of the inserted word using the `case` attribute. Options are `upper`, `lower`, and `title`. For example:

- `[insertr key="keyword" fallback="PPC Agency" case="upper"]` will display the word in uppercase.
- `[insertr key="keyword" fallback="PPC Agency" case="lower"]` will display the word in lowercase.
- `[insertr key="keyword" fallback="PPC Agency" case="title"]` will display the word in title case.

## Releasing to WordPress.org

To publish a new version to the [WordPress.org plugin directory](https://en-gb.wordpress.org/plugins/the-insertr/):

1. Update `readme.txt`: set **Stable tag** to the new version (e.g. `1.6.0`), **Tested up to**, and changelog.
2. Checkout or update the plugin’s SVN repo: `svn co https://plugins.svn.wordpress.org/the-insertr the-insertr-svn` (or `svn up`).
3. Copy the plugin files (the-insertr.php, readme.txt, build/, index.php, optionally LICENSE.md) into the SVN **trunk**.
4. Run `svn add` for any new paths, `svn delete` for any removed paths.
5. Create the release tag: `svn cp trunk tags/X.Y.Z` (e.g. `tags/1.6.0`).
6. Commit: `svn commit -m "Release X.Y.Z: description"` and authenticate with your WordPress.org credentials when prompted.

Full step-by-step instructions, prerequisites, and examples are in [DEPLOY.md](DEPLOY.md).

## Support

For support, please visit the [support forum](https://wordpress.org/support/plugin/the-insertr).

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Contributors

- **Alex Blackham** - *Developer and Maintainer* - [B3none](https://github.com/b3none)
- **Mat Moses** - *Logo creation* - [mooonthemove](https://instagram.com/mooonthemove)

See also the list of [contributors](https://github.com/herdl/the-insertr/contributors) who participated in this project.
