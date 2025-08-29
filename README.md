# The Insertr

WordPress dynamic keyword insertion plugin.

## Prerequisites

- **PHP Version**: >= 8.2.0
- **WordPress Version**: >= 5.0

## Installation

1. Download the latest release as a `.zip` file.
2. Go to your WordPress admin panel and navigate to Plugins > Add New.
3. Click on 'Upload Plugin' and choose the downloaded `.zip` file.
4. Click 'Install Now' and then 'Activate' the plugin.

## Description

The Insertr allows marketers and site owners to dynamically insert words and phrases into landing pages. Control your parameters using a shortcode and simple query string in the page URL. A fallback can be entered for cases where the URL does not contain the expected query string. Options are available for uppercase, lowercase, and title case text.

## Usage

To use the plugin, add the following shortcode where you wish to insert a dynamic word or phrase:

`[insertr key="{urlParameter}" fallback="{fallbackWord}"]`

- **key**: The URL parameter you'd like to use.
- **fallback**: The fallback word to be displayed if the URL does not contain a query string using the URL parameter you've defined.

### Advanced Usage

You can specify the case of the inserted word using the `case` attribute. Options are `upper`, `lower`, and `title`. For example:

- `[insertr key="keyword" fallback="PPC Agency" case="upper"]` will display the word in uppercase.
- `[insertr key="keyword" fallback="PPC Agency" case="lower"]` will display the word in lowercase.
- `[insertr key="keyword" fallback="PPC Agency" case="title"]` will display the word in title case.

## Support

For support, please visit the [support forum](https://wordpress.org/support/plugin/the-insertr) or contact us at [support@herdl.com](mailto:support@herdl.com).

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Contributors

- **Alex Blackham** - *Developer and Maintainer* - [B3none](https://github.com/b3none)
- **Mat Moses** - *Logo creation* - [mooonthemove](https://instagram.com/mooonthemove)

See also the list of [contributors](https://github.com/herdl/the-insertr/contributors) who participated in this project.
