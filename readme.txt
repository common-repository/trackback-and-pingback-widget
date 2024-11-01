=== Trackback and Pingback Widget ===
Contributors: Michael Uno, miunosoft
Donate link: http://michaeluno.jp/en/donate
Tags: widget, widgets, sidebar, trackback, trackbacks, pingback, pingbacks, comment, comments, plugin, miunosoft
Requires at least: 3.0
Tested up to: 3.7.1
Stable tag: 1.0.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Displays trackbacks and pingbacks which belong to the currently displayed page in a widget.

== Description ==

Does your theme's comment section mix with comments, trackbacks and pingbacks? If you want to create a separate section for tackbacks and pingbacks, this will be useful for you. 

This plugin adds a widget which displays trackbacks and pingbacks of the currently displayed page. It will be invisible if there is no trackback or pingback for the page.


<h4>Features</h4>
* **Order** - sets whether new ones come first or old ones ome first.
* **Date** - sets whether item date will be inserted or not.
* **Style** - sets the enclosing HTML tag from either ol, ul, or div.
* **Type** - sets the comment type from either Pingbacks and Trackbacks, Pingbacks, Trackbacks, Comments, or All.

= Remarks =
This is not for displaying trackbacks and pingbacks from all pages and posts. Optionally comments can be displayed.
  
== Installation ==

= Install = 

1. Upload **`trackback-and-pingback-widget.php`** and other files compressed in the zip folder to the **`/wp-content/plugins/`** directory.,
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Usage ==
= How to Use = 
1. Go to Appearance > Widgets. You'll see a new widget named **Trackback and Pingback Widget**.,
2. Add widgets to it.,


== Frequently Asked Questions ==

= How do I customize the style? =
You can add your rules in your theme's *style.css* to the classes named **.widget-area .commentlist .pingback**. 
e.g. 
`.widget-area .commentlist .pingback {
	margin-bottom: 0px;
	word-wrap: break-word;
}
.widget-area .commentlist {
	margin-bottom: 24px;
	margin-bottom: 1.7142857145rem;
}`

== Screenshots ==

1. ***Adding the Widget***
2. ***Display Example***


== Changelog ==

= 1.0.2.1 - 12/25/2013 =
* Added: the Spanish localization file.

= 1.0.2 - 12/18/2013 =
* Added: the Japanese localization file.
* Added: a language file and localization support.
* Added: an option to decide whether the Not found message should be displayed or not.
* Tweaked: the function to count the comments.

= 1.0.1.1 - 02/23/2013 =
* Fixed: a warning: undefined index, title, which occurred in the debug mode.

= 1.0.1 - 01/24/2013 =
* Added: the ability that regular comments can be shown.
* Added: the style and type options.

= 1.0.0 - 01/05/2013 =
* Initial Release
