# 0.10.0 - Release Date: 26/02/2017 #
* Improvement: Admin Options UI
* Update: FontAwesome to 4.7.0
* Fix: Removed Open Sans Declarations in CSS for WordPress 4.6 Compatibility
* Fix: Renamed Markdown_Parser base function to __construct() for PHP 7 Compatibility
* Fix: Renamed WPAlchemy_MetaBox base function to __construct() for PHP 7 Compatibility

# 0.9.0 - Release Date: 23/07/2016 #
* Add: Admin Body Class (.uberkit) to UberKit Option Pages
* Improvment: Admin Option UI (CSS)
* Improvment: Check if WP_DEBUG is active and load minified or unminified stylesheets
* Improvment: Add Notice if deprecated functions encore_meta or encore_options are still getting used
* Various: Further minor improvments

# 0.8.9 - Release Date: 20/03/2016 #
* Improved Admin Option UI

# 0.8.8 - Release Date: 17/03/2016 #
* Updated FontAwesome to 4.5.0
* Improved folder structure (3rd party assets are now within the 'vendor' folder) and moved various 3rd party scripts
* Removed outdated files

# 0.8.7 - Release Date: 17/03/2016 #
* Added functions.admin.php
* Added uk_get_wp_admin_color_scheme() function (to get the current active color scheme color codes)
* Added uk_color_scheme() function (to output custom css to complement with the current active color scheme)

# 0.8.6 - Release Date: 15/03/2016 #
* Fixed FontAwesome and Socicon to load local instead of CDN (this is currently not possible due to loading mechanism)

# 0.8.5 - Release Date: 15/03/2016 #
* Added: Flexboxgrid.css
* Improved: HTML Field
* Improved: Option Page Styling

# 0.8.4 - Release Date: 15/03/2016 #
* Update: Option Page Styles
* Update: Option Page View (Markup)
* Fixed: JS Bug in option.min.js which caused weird behaviour on Option Pages
* Improved: Minified CSS
* Depreceated: FontAwesome (local)
* Depreceated: SocIcon (local)
* Depreceated: Colorpicker (local)

# 0.8.3 - Release Date: 12/03/2016 #
* Update: Datepicker Theme

# 0.8.2 - Release Date: 07/03/2016 #
* Updated Socicon (3.0.1)
* Fixed Socicon Field Type not loading select2

# 0.8.1 - Release Date: 27/02/2016 #
* Updated jQuery Bootstrap Colorpicker (2.3.0)
* Updated Font Awesome (4.5.0)
* Minor Improvments

# 0.8.0 - Release Date: 14/11/2015 #
* Added Applets Core Functionality
* Added color_shade() helper function
* Added str_to_rgb() helper function
* Added rgb_to_str() helper function
* Improved Widget Settings Accordion

# 0.7.0 #
* Improved Loading Animation (CSS Animation instead of GIF)
* New core.css which contains base styles accross options and metaboxes
* Updated Bootstrap Colorpicker and FontAwesome
* Changed source of Bootstrap Colorpicker and FontAwesome to be loaded from CDN instead of local
* Removed unnecessary image files (vp_sprite.png, ajax-loader.gif,..)
* Further Minor Improvments

# 0.6.0 #
* Added Styling for Premium Fields
* Added Validation Rule for Premium Fields
* Added Live Title Function to Group Fields
* Reworked Option & Metabox Styles
* Removed auto scroll on metabox field groups (#annoying)

# 0.5.0 #
* Major Improvments
* Combined all previous Frameworks (ANEX, ANEX Legacy, AmplifyWP, Encore) and cleaned up
* Add Widget Base Class
* Fixed styling for option slider
* Revamped Admin UI (Slider, Checkboxes, Checkimage, Radio Inputs and Radio Images) and streamlined appearance in Options, Meta and Widget Settings
* Added uk_sort_array_by_position() helper function
* Added uk_sort_array_by_array() helper function
* Added uk_options_build_array() helper function
* Added uk_options_post_types() helper function

# 0.4.0 #
* Added uk_option() function
* Added uk_meta() fuction

# 0.1.0 #
* Initial release