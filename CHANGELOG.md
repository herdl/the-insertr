# Changelog

## [1.6.0] - 2026-03-05
### Added
- Gutenberg (Insertr) block for the block editor with sidebar controls for key, fallback, and case.
- Frontend-safe plugin detection for ACF and SEO integrations.

### Changed
- Plugin checks for ACF/SEO now work on the frontend (no reliance on admin-only `is_plugin_active()`).
- Shortcode and ACF support unchanged; block is additive for WordPress 5.0+.

## [1.5.1] - 2025-09-01
### Changed
- Ensured compatibility checks for both free and pro versions of ACF and SEO plugins.
- Removed nonce implementation as it was not needed.
- Updated plugin documentation.
- Organized code for better readability and maintainability.

## [1.5.0] - 2025-08-29
### Added
- Enhanced security by validating and sanitizing all user inputs.
- Implemented robust error handling and logging mechanisms.
- Refactored code for improved readability and maintainability.
- Ensured compatibility with ACF.
- Added support for shortcodes in SEO plugins like Yoast, Rank Math, AIOSEO, and SEOPress.
- Updated documentation.

## [1.4.0] - 2020-01-23
- Added ability to specify fallback case with a default of lowercase.

## [1.3.0] - 2019-12-19
- Add ability to use shortcodes on ACF and Yoast SEO

## [1.2.0] - 2019-12-13
- Remove redundant comments

## [1.1.0]
- Use the correct WordPress escaping and sanitisation functions.


## [1.0.0] - 2019-12-09
- Initial release.
