# Releasing to WordPress.org plugin directory (SVN)

The Insertr is listed on the [WordPress.org plugin directory](https://en-gb.wordpress.org/plugins/the-insertr/). Use this guide to publish a new version via SVN.

## Prerequisites

- **WordPress.org account**: Commit access to the plugin’s SVN repo at `https://plugins.svn.wordpress.org/the-insertr/`.
- **SVN** installed locally (`svn` on the command line).
- **Credentials**: WordPress.org username and password, or [Application Password](https://wordpress.org/support/article/application-passwords/) for `svn commit` (required if you use 2FA).

## SVN layout

- **trunk**: Development version; copy the plugin files here.
- **tags/X.Y.Z**: Release version; create by copying trunk (e.g. `svn cp trunk tags/1.6.0`). The plugin page uses the **Stable tag** in `readme.txt` to decide which tag to offer as the stable download.
- **assets**: Optional; icons and banners for the plugin page.

## Steps (replace X.Y.Z with your release version, e.g. 1.6.0)

### 1. Align readme.txt with the release

In `readme.txt` in this repo:

- Set **Stable tag** to the release version (e.g. `Stable tag: 1.6.0`). This must match the tag folder name you create in step 6. (Do not set it to a WordPress version like 6.9.1; that goes in **Tested up to**.)
- Set **Tested up to** to the latest WordPress version you’ve tested with (e.g. `6.9.1`).
- Ensure the Changelog has an entry for this version (e.g. `= 1.6.0 =`).
- Optionally add an **Upgrade Notice** for this version under `== Upgrade Notice ==`.

### 2. Checkout or update the SVN repo

From a directory of your choice (e.g. a sibling to this plugin):

```bash
# First time:
svn co https://plugins.svn.wordpress.org/the-insertr the-insertr-svn
cd the-insertr-svn

# If you already have a checkout:
cd the-insertr-svn
svn up
```

### 3. Copy plugin files into trunk

From the SVN checkout directory, copy only the files that should be deployed. Use the plugin root path where you have this Git repo (e.g. `/path/to/the-insertr`).

**Include:**

| File or folder   | Notes                    |
|-------------------|--------------------------|
| `the-insertr.php` | Main plugin file         |
| `readme.txt`      | Required; Stable tag set |
| `build/`          | `block.json`, `insertr-block.js` |
| `index.php`       | Security stub            |
| `LICENSE.md`      | Optional                 |

**Exclude:** `.git/`, `.github/`, `.idea/`, `.docs/`, `tests/`, `.gitignore`, `CHANGELOG.md`, `README.md`, `CODE_OF_CONDUCT.md`, `DEPLOY.md`, plugin `assets/` (unless you are updating SVN `assets/` for the plugin page).

**Example (replace PLUGIN with your plugin path):**

```bash
PLUGIN="/path/to/the-insertr"   # e.g. full path to this repo
SVN_TRUNK="/path/to/the-insertr-svn/trunk"

cp "$PLUGIN/the-insertr.php" "$SVN_TRUNK/"
cp "$PLUGIN/readme.txt" "$SVN_TRUNK/"
cp "$PLUGIN/index.php" "$SVN_TRUNK/"
mkdir -p "$SVN_TRUNK/build"
cp "$PLUGIN/build/block.json" "$PLUGIN/build/insertr-block.js" "$SVN_TRUNK/build/"
cp "$PLUGIN/LICENSE.md" "$SVN_TRUNK/"
```

Or with rsync (then remove any files that shouldn’t be in the repo):

```bash
rsync -av --exclude='.git' --exclude='.github' --exclude='.idea' --exclude='.docs' --exclude='tests' --exclude='.gitignore' --exclude='CHANGELOG.md' --exclude='README.md' --exclude='CODE_OF_CONDUCT.md' --exclude='DEPLOY.md' --exclude='assets' "$PLUGIN/" "$SVN_TRUNK/"
```

### 4. Add new files and remove deleted ones in SVN

From the SVN checkout directory:

```bash
cd the-insertr-svn
svn status
```

- **New files** (e.g. `trunk/build/` or `trunk/LICENSE.md`):  
  `svn add trunk/build` and/or `svn add trunk/LICENSE.md` (and any other new paths).
- **Deleted files**:  
  `svn delete trunk/path/to/file` for any file you no longer deploy.

Then run `svn status` again and confirm the list looks correct before committing.

### 5. Create the release tag from trunk

Create a new tag so the release is available as `tags/X.Y.Z` (e.g. `tags/1.6.0`):

```bash
svn cp trunk tags/X.Y.Z
```

Example for 1.6.0:

```bash
svn cp trunk tags/1.6.0
```

Ensure `readme.txt` in trunk (and thus in the new tag) has **Stable tag: X.Y.Z** matching this tag name.

### 6. Commit to WordPress.org

```bash
svn status
svn commit -m "Release X.Y.Z: short description of changes"
```

Example:

```bash
svn commit -m "Release 1.6.0: Gutenberg block, ACF compatibility, frontend-safe plugin checks, basic HTML in fallback"
```

You will be prompted for your WordPress.org **username** and **password** (or Application Password). Commit access is under the account that owns the plugin (e.g. garethmorgans).

After a successful commit, WordPress.org will update the plugin page; the stable download will come from `tags/X.Y.Z` because of **Stable tag** in `readme.txt`.

## Summary checklist

1. Update `readme.txt`: **Stable tag: X.Y.Z**, **Tested up to**, changelog, and optional upgrade notice.
2. Checkout or update SVN: `svn co` or `svn up`.
3. Copy into trunk only the files to deploy (main PHP, readme.txt, build/, index.php, optional LICENSE.md).
4. `svn add` new paths, `svn delete` any removed paths.
5. Create tag: `svn cp trunk tags/X.Y.Z`.
6. `svn commit` with a clear message; authenticate with your WordPress.org credentials.

## Optional: ignore the SVN checkout in Git

To avoid committing the SVN working copy by mistake, add it to `.gitignore`:

```
the-insertr-svn/
```

Use the same directory name you used in `svn co` (e.g. `the-insertr-svn`).
