# Mita-verkosto

Superior WordPress starter theme with modern build tools by **[Aucor](https://www.aucor.fi)**. 100+ hours of development over 2 years to make the greatest starting point for WordPress site.

**For who**: Developers building superb WordPress sites

**A few buzz-words**: Gulp, Yarn, SVG, SASS, Browsersync, a11y, l18n, Polylang, Schema.org

![aucor-starter](https://user-images.githubusercontent.com/9577084/28660986-d73568b2-72bd-11e7-899a-3eabe2be674b.png)

## Table of contents

1. [Directory structure](#1-directory-structure)
2. [Setup](#2-setup)
    1. [Project setup](#21-project-setup)
    2. [Developer setup](#22-developer-setup)
    3. [Start working](#23-start-working)
3. [Styles](#3-styles)
    1. [Directory structure](#31-directory-structure)
    2. [Workflow](#32-workflow)
    3. [Adding new files](#33-adding-new-files)
    4. [Tips](#34-tips)
4. [Scripts](#4-scripts)
    1. [Directory structure](#41-directory-structure)
    2. [Workflow](#42-workflow)
    3. [Adding new files](#43-adding-new-files)
5. [SVG and Images](#5-svg-and-images)
    1. [SVG sprite](#51-svg-sprite)
    2. [Single SVG images](#52-single-svg-images)
    3. [Images](#53-images)
6. [Template tags](#6-template-tags)
    1. [Get SVG from SVG sprite](#61-get-svg-from-svg-sprite)
    2. [Social share buttons](#62-social-share-buttons)
    3. [Numeric posts navigation](#63-numeric-posts-navigation)
    4. [Sub-pages navigation \(pretendable\)](#64-sub-pages-navigation-pretendable)
    5. [Posted on](#65-posted-on)
    6. [Entry footer](#66-entry-footer)
    7. [Menu toggle btn](#67-menu-toggle-btn)
7. [Includes](#7-includes)
    1. [Localization \(Polylang\)](#71-localization-polylang)
    2. [Menus](#72-menus)
    3. [WP Settings](#73-wp-settings)
    4. [Remove commenting](#74-remove-commenting)
    5. [Hide users](#75-hide-users)
    6. [WP Login](#76-wp-login)
8. [Menus](#8-menus)
    1. [Primary menu](#81-primary-menu)
    2. [Social menu](#82-social-menu)
    3. [Navigation skeleton](#83-navigation-skeleton)
9. [Editorconfig](#9-editorconfig)
10. [Plugin](#10-plugin)

## 1. Directory structure

Direcrory structure is a mixture between [_underscores](http://underscores.me/) (template structure) and [Sage](https://roots.io/sage/) (Gulp and assets).

`/assets/` includes all JS, SASS, images, SVG and fonts

`/dist/` has processed, combined and optimized assets ready to be included to theme

`/inc/` has all php files that are not part of template structure

`/partials/` has small templates like menus and contents of pages and search results

`/template-tags/` has small template functions to be used in templates

## 2. Setup

### 2.1 Project setup

Project setup is done once in project's lifetime. Do it before modifying anything.

![Project setup with setup.sh](https://user-images.githubusercontent.com/9577084/28662834-236bda4e-72c4-11e7-98db-67b25a289b4f.png)

1. Download this repository
2. Extract into /wp-content/themes/ and rename for project as `sitename`
3. Run setup wizard in theme root with bash `sh setup.sh`
    1. **Site name** (Default: "Mita-verkosto")
    2. **Unique id** for your theme. Use only a-z and _. The shorter the better 3-4 characters is the best. (Default: mita)
    3. **Local development url** is used by Browsersync and can be changed in `/assets/manifest.json` (Default: https://mita.local)
4. Go to "Developer setup"

### 2.2 Developer setup

Every developer does this before first time working with the project.

1. Open terminal and navigate to `/wp-content/themes/sitename`
2. Run `yarn install` (fetches all node packages for build tools) (no yarn? download: https://yarnpkg.com/en/docs/install)
3. Go to "Start working"

**Protip**: If you don't have Gulp installed locally run `npm install --global gulp-cli`.

### 2.3 Start working

Do this everythime you start to work with the theme.

1. Open terminal and navigate to `/wp-content/themes/sitename`
2. Run `gulp watch` to activate build process in background. You'll get development proxy at http://localhost:3000 where changes to code will be updated automatically to browser (no need to reload).
3. To quit press `ctrl` + `c`

**Protip**: You can also run just `gulp` to build all the resources.

## 3. Styles

Styles are written in SASS in `/assets/styles`. There's four separate stylesheets that are compiled automatically to `dist/styles`.

  * `main.scss` front-end styles of website
  * `admin.scss` styles for admin views
  * `editor.scss` text styles for WP text editor
  * `wp-login.scss` styles for login screen

### 3.1 Directory structure

  * `/_global/` universal styles
      * `_variables.scss` colors, fonts, breakpoints
      * `_mixins.scss` a few [SASS mixins](http://sass-lang.com/guide) for wrapping content, reseting styles and a11y
      * `_normalize.scss` reset base styles for all browsers
      * `_typography.scss` text styles for titles, lists, images, tables etc.
      * `_print.scss` printing styles, hiding elements, page margins
  * `/elements/` component styles
      * `_menu-toggle.scss` hamburger menu button
      * `_menu-primary.scss` primary menu styles for desktop and mobile
      * `_menu-social.scss` social media icon menu styles
      * `_numeric-posts-nav.scss` styles for pagination
      * `_social-share.scss` social share buttons
  * `/templates/` template styles
      * `_header.scss` header styles (without primary menu)
      * `_footer.scss` footer styles
      * `_page.scss` styles for pages
      * `_front-page.scss` styles for front page
  * `@node_modules` vendor packages
      * `breakpoint-sass` [awesome functions](http://breakpoint-sass.com/) for breakpoints
      * `singularitygs` [grid system](https://github.com/at-import/Singularity) with SASS (to be replaced with CSS grid)
      * `sass-toolkit` great collection of [SASS mixins](https://github.com/at-import/toolkit)

### 3.2 Workflow

  * When you begin working, start the gulp with `gulp watch`
  * You get Browsersync URL at `https://localhost:3000` (check yours in console). Here the styles will automatically reload when you save your changes.
  * If you make a syntax error, a console will send you a notification and tell where the error is. If Gulp stops running, start it again with `gulp watch`.
  * The Gulp updates `/assets/last-edited.json` timestamps for styles and WP assets use it. This means that cache busting is done automatically.
  * There's Autoprefixer that adds prefixes automatically. (If you have to support very old browsers, set browsers in gulpfile.js)
  * In browser developer tools shows what styles is located in which SASS partial file (SASS Maps)

### 3.3 Adding new files

  1. Make a new file like `/assets/styles/templates/_single.scss`
  2. Go edit `main.scss`
  3. Import the new file with `@import "templates/single";`

### 3.4 Tips

 * Setup responsive font sizes by setting fonts in percentages in `html` and change html font size with media queries. All elements use `rem` for font sizes so all the font size changes happen in html.
 * Don't hesitate to create variables if you have repeating values. Put all variable definitions in `_variables.scss` or at the beginning of the file.
 * Build mobile-first: more `min-width`, less `max-width`.

## 4. Scripts

By default, you get [external SVG polyfill svgxuse](https://github.com/Keyamoon/svgxuse), [jQuery-free fitvids](https://www.npmjs.com/package/fitvids) and our framework for navigation (navigation.js).

### 4.1 Directory structure

The script have very simple structure.

  * `/components/` directory for small components
      * `navigation.js` navigation functionality
  * `main.js` main js file

### 4.2 Workflow

  * When you begin working, start the gulp with `gulp watch`
  * You get Browsersync URL at `https://localhost:3000` (check yours in console). Here the styles will automatically reload when you save your changes.
  * If you make a syntax error, a console will send you a notification and tell where the error is. If Gulp stops running, start it again with `gulp watch`.
  * The Gulp updates `/assets/last-edited.json` timestamps for styles and WP assets use it. This means that cache busting is done automatically.

### 4.3 Adding new files

#### 4.3.1 Add script from file

Put file in `/assets/scripts/components/my_script.js`. Add script to main.js (or some other file) in `/assets/manifest.json`:

```json

"main.js": {
   "files": [
     "scripts/components/my_script.js"
  ]
}
```

**Combine scripts in one file:**
```json

"main.js": {
   "files": [
     "scripts/vendor/wow.js",
     "scripts/components/my_script.js"
  ]
}
```

#### 4.3.2 Add script with yarn (node_modules)

First, go to [npmjs.com](https://www.npmjs.com/) and find if your library is avaialble. Add your library in `package.json` devDependencies. Run `yarn upgrade`.

Include the script in `/assets/manifest.json`.

```json

"main.js": {
  "files": [
    "../node_modules/fitvids/fitvids.js",
    "scripts/main.js"
  ]
}
```

**Protip:** Add this library also to `.jshintignore` and Gulp won't check the syntax.


#### 4.3.2 Add script with bower (bower_components)

Always prefer Yarn if it's available. Bower often includes libraries that you don't need or they are duplicates to your own.

Add script to `/bower.json` and run `bower install`. Include library in `/assets/manifest.json`.


```json

"jquery.js": {
  "bower": ["jquery"]
}
```

## 5. SVG and Images

Gulp will automatically minify images and combine SVG images in one sprite.

### 5.1 SVG sprite

Put all icons to `/assets/sprite/` and Gulp will combine and minify them into `/dist/sprite/sprite.svg`.

In PHP you can get these images with (more exmples in Template tags):

```php
<?php echo mita_get_svg('facebook'); ?>
```

### 5.2 Single SVG images

You can also place more complex (multi-colored) SVGs in `/assets/images/` and Gulp will compress them. They can be found in `/dist/images/`

### 5.3 Images

Put your static images in `/assets/images/` and Gulp will compress them a bit. Refer images in `/dist/images/`.

## 6. Template tags

Template tags `/template-tags/` includes functions to be used in templates. Here's what you get by default. Notice that function prefix is changed to whatever you choose it to be in setup.

### 6.1 Get SVG from SVG sprite

Function: `mita_get_svg($icon, $args = array())`

Theme includes one big SVG sprite `/assets/images/icons.svg` that has by default a caret (dropdown arrow) and a few social icons. Add your own svg icons in `/assets/sprite/` and Gulp will add them to this sprite with id from filename.

Example: Print out SVG `/assets/sprite/facebook.svg`
```php
<?php echo mita_get_svg('facebook'); ?>
```

Example: Print out SVG `/assets/sprite/facebook.svg` with options
```php
<?php

$args = array(
  'wrap'        => true, // Wrap in <span>
  'class'       => '',
  'title'       => '',
  'desc'        => '',
  'aria_hidden' => true, // Hide from screen readers.
);

echo mita_get_svg('facebook', $args);
```

### 6.2 Social share buttons
Function: `mita_social_share_buttons()`

Displays share buttons (Facebook, Twitter, LinkedIn) with link to their sharer.
```php
<?php mita_social_share_buttons(); ?>
```

### 6.3 Numeric posts navigation
Function: `mita_numeric_posts_nav($custom_query = null, $custom_paged_var = null)`

Displays numeric navigation instead of normal "next page, last page" navigation. Can be used with a custom query. You can even change the pagination variable if you need to.

Main query:
```php
if( have_posts() )
  while ( have_posts() ) : the_post();
    ...
  endwhile;
  mita_numeric_posts_nav();
endif;
```

Custom query:
```php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 10,
  'paged' => $paged,
);
$loop = new WP_Query( $args );
if( $loop->have_posts() )
  while ( $loop->have_posts() ) : $loop->the_post();
    ...
  endwhile;
  mita_numeric_posts_nav($loop);
endif;
```

Custom query with your own pagination variable "current_page"
```php
$paged = (isset($_GET['current_page']) && !empty($_GET['current_page'])) ? absint($_GET['current_page']) : 1;
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 10,
  'paged' => $paged,
);
$loop = new WP_Query( $args );
if( $loop->have_posts() )
  while ( $loop->have_posts() ) : $loop->the_post();
    ...
  endwhile;
  mita_numeric_posts_nav($loop, 'current_page');
endif;
```

### 6.4 Sub-pages navigation (pretendable)
Function: `mita_sub_pages_navigation()`

Displays sub-pages for current page in list. If you need to pretend that single post is somewhere in the hierarchy, use global variable pretend_id to display current view to be in certain place in hierarchy

Usage:
```php
<?php mita_sub_pages_navigation(); ?>
```

Pretend to be someone else (place it before calling this function):
```php
// single-post.php etc.
global $pretend_id;
$pretend_id = 123; // highlight this item as "current_page_item"
```
### 6.5 Posted on
Function: `mita_posted_on()`

Display date when post was published.

### 6.6 Entry footer
Function: `mita_entry_footer()`

Display categories and tags of single post.

### 6.7 Menu toggle btn
Function: `mita_menu_toggle_btn($id, $args = array())`

Display hamburger button for menu.

### 6.8 Search
Function: `mita_search_form($id, $args = array())`

Display easily customizable search form.

## 7. Includes

### 7.1 Localization (Polylang)

File: `/inc/localization.php`

Do you have a minute to talk about localization? Good.

We don't really like .po files as they are confusing for customers, their build process is weird and are prone to errors, it's hard to change the "original" text later on and they are slowish to load. What we do like is [Polylang](https://polylang.pro/). If we are running a multi-lingual site, we want to use Polylang's String Translation to translate the strings in theme.

But we don't stop at using just Polylang. It's generally a little pain to have to register all the strings for your theme and it's very easy to forget to add something. We created our own wrapper function to give you error messages for missing string in WP_DEBUG mode.

**But what if I'm only making site in one language?** Well you can be a lazy developer and hardcode things but is that a way to live a life? You can prepare for multiple languages from the start by using these functions and registering your strings already. These functions (and bunch of Polylang's) will work **even if you don't use Polylang**.

#### 7.1.1 Registering your strings

Start off by registering some strings.

  * All your strings are registered at `/inc/localization.php` (static pieces of text in theme)
  * You give a unique context (key) and the default text (value) for string. Example `"Header: Greeting" => "Hello"`

By default you have a few strings there. They are in Finnish by default. You can change them to English by copying and pasting following (we should make this into setup process...)

```php
// Menu
'Menu: Button label'                => 'Menu',
'Menu: Primary Menu'                => 'Primary menu',
'Menu: Social Menu'                 => 'Social media channels',

// 404
'404: Page not found'               => 'Page not found',
'404: Page not found description'   => 'The page might have been deleted or moved to different location. Use the search below to find what you are looking for.',

// Search
'Search: Title'                      => 'Search: ',
'Search: Nothing found'              => 'No search results',
'Search: Nothing found description'  => 'No search results found. Try different words.',

// Accessibility
'Accessibility: Skip to content'     => 'Skip to content',

// Navigation
'Navigation: Previous'               => 'Previous',
'Navigation: Next'                   => 'Next',

// Social
'Social share: Title'                => 'Share on social media',
'Social share: Facebook'             => 'Facebook',
'Social share: Twitter'              => 'Twitter',
'Social share: LinkedIn'             => 'LinkedIn',

// Taxonomies
'Taxonomies: Keywords'               => 'Keywords',
'Taxonomies: Categories'             => 'Categories',

```

You can change these default texts (values) right here and they will update on templates. If you have Polylang installed, these strings will appear automatically on String Translations.

#### 7.1.2 Using the strings

There are two ways to get translated string

  1. By key (Social share: Title)
  2. By value (Share on social media)

All the default strings are fetched by key. In that way you can go on and replace the default values on `/inc/localization.php` without having to search and replace anything anywhere.

##### 7.1.2.1 Getting string by key

**Return string by key:**

Function: `ask__($key, $lang = null)`

Example: `ask__('Social share: Title')` => 'Share on social media' (or translated version)

**Echo string by key:**

Function: `ask_e($key, $lang = null)`

Example: `ask_e('Social share: Title')` => 'Share on social media' (or translated version)

**Protip:** If you are unsure of what the final text may really be, it's smart to use strings by key. If it makes sense, you can use values by key for everything. Polylang doesn't have it's own "return string by key" but we got your back.

##### 7.1.2.2 Getting string by value

**Return string by value:**

Function: `asv__($key, $lang = null)`

Example: `asv__('Share on social media')` => 'Share on social media' (or translated version)

**Echo string by value:**

Function: `asv_e($key, $lang = null)`

Example: `asv_e('Share on social media')` => 'Share on social media' (or translated version)

**Protip:** This is the "normal" Polylang way of getting your translated strings. The downside is that if the default text you propose will be radically changed in String Translation the code might be hard to read (it will work nevertheless).


#### 7.1.3 Debugging your strings

Debugging is the greatest benefit of using our string localization functions instead of Polylang defaults. If you have `WP_DEBUG` set to `true` in `wp-config.php` (which you should while developing), you will get error messages if you forget things. So example:

  * You add to header.php `ask_e('Header: Greeting')`
  * You forget to add this string to `/inc/localization.php`
  * You get error message and PHP error log entry that you tried to use `ask_e('Header: Greeting')` in this file on that line without registering the string

So there's really no excuse to forget to register your strings no more.

### 7.2 Menus

File `/inc/menus.php`

Functions and filters for menus.

#### 7.2.1 Carets for primary menu (dropdown icon)

By default we add small SVG carets for menu items that have children in primary menu.

#### 7.2.2 Social icons for social menu

We add social icons SVG to menu items in social menu. There's a few most used supported already (like Twitter, Facebook, Youtube, LinkedIn) but you can add your very easily there.

### 7.3 WP Settings

File: `/inc/wp-settings.php`

WordPress settings tweaks.

#### 7.3.1 Editor

 * Show 2nd row of rich text editor tools by default
 * Set default settings for galleries (link to file, medium size, 2 columns)

#### 7.3.2 Admin

 * Remove update nags for non admins
 * Remove color scheme picker
 * Clean up contact methods
 * Remove customizer from admin bar
 * Remove themes and customizer from admin sidebar for non-admins
 * Force default image link type to none
 * Limit revisions to 10
 * Remove meta box for post_meta (performs very slow SQL query)
 * Send comment notification only to author, not site admin

#### 7.3.3 Front-end
 * Replace excerpt dots with "..."
 * Make excerpt length 25 words
 * Add Schema.org markup for menu items
 * Remove emoji polyfill

#### 7.3.4 Dashboard

 * Remove all default dashboard widgets

####  7.3.5 Plugins
* Lower Yoast metabox
* Remove Yoast notifications
* Remove "SEO" section from admin bar
* Grant access to Redirection plugin to users that can publish pages (admins and editors)
* Reset Gravity Forms tabindex for better a11y
* Move Gravity Forms scripts to footer
* Hide ACF options from non-admins

### 7.4 Remove commenting

File: `/inc/remove-commenting.php`

Removes the whole commenting feature with all headers and admin views.

**Protip:** Disable this file if the theme actually uses comments.

### 7.5 Hide users

File: `/inc/hide-users.php`

Hides users' identities from site, RSS and REST API:

* User's name => site name
* User link => link to front page
* Hide user routes from REST API

**Protip:** Disable this file if the theme needs users to be visible for blog etc.

### 7.6 WP Login

* Include our (empty) stylesheet by `/assets/styles/wp-login.scss`
* Change title to site's title
* Change WP logo link url to siteurl

## 8. Menus

By default the starter theme has two menu locations: Primary menu and Social menu.

### 8.1 Primary menu

Theme location: `primary`

Theme's main navigation in header that is build to handle multiple levels.


### 8.2 Social menu

Theme location: `social`

Optional menu for organization's social media accounts.

How to use:
 * Include template part somewhere `<?php get_template_part('template-parts/menu-social'); ?>`
 * Create a new menu in WP admin
 * Add custom link items with url to account and title like "Facebook"
 * Menu item gets SVG icon that is based on url
 * Style menu as needed on `/assets/styles/elements/_menu-social.scss`

**Protip:** If you want to hide titles, do `@include visuallyhidden` for a11y.

### 8.3 Navigation skeleton

Starter includes rough navigation skeleton that is working out of box for 3 levels (or infinite amount if you put a little bit more CSS into it). Skeleton includes `/assets/scripts/components/navigation.js` and `/assets/styles/elements/_primary-menu.scss`. This menu works with mouse, touch and tabs. Accessibility is built-in!

Inside `main.js` there is the menu init and a few arguments:

```js
$('#primary-navigation').aucor_navigation({
  desktop_min_width:  501,            // min width in pixels (desktop-mode)
  menu_toggle:        '#menu-toggle'  // selector for toggle
});
```

**Protip:** The `desktop_min_width` option will disable or enable some ways to interact with the menu. For example the hover stuff is disabled on "mobile mode".

## 9. Editorconfig

Theme has an `.editorconfig` file that sets your code editor settings accordingly. Never used Editorconfig? [Download the extension](http://editorconfig.org/#download) to your editor. The settings will automatically be applied when you edit code when you have the extension.

Our settings:
```
indent_style = space
indent_size = 2
end_of_line = lf
charset = utf-8
trim_trailing_whitespace = true
insert_final_newline = true
```

## 10. Plugin

Where to put custom post types, custom taxonomies, shortcodes, security hardening, ACF fields etc? You should put them into plugin. We have our own starter plugin, but at the moment it is not open source.




