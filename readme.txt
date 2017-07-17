=== MT Game Server Status ===
Contributors: mitchbrooks
Donate link: https://mitchbrooks.co.uk
Requires at least: 3.0.1
Tested up to: 4.7.4
Stable tag: 1.0.2
Version: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a plugin which checks and updates templates on the relevant server info.

== Description ==

This plugin uses multiple short codes and a custom post type in order to display the added server info, you can use the shortcodes [mt_get_servers] and [mt_get_servers_table] these will then automatically link up to the custom post type

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/mt-game-server-status` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= I have installed the plugin but nothing has changed =

Check in the admin menu for servers then add your servers and add either shortcode:
[mt_get_servers] or [mt_get_servers_table]

== Screenshots ==

1. /assets/screenshot-1.png
2. /assets/screenshot-2.png
3. /assets/screenshot-3.png

== Changelog ==

= 1.0.2 =
* Plugin launches stable build.

== Upgrade Notice ==

= 1.0.2 =
Upgrade plugin as soon as there is an update as this will keep your site secure.

== Features ==

Unordered list:

* Fully integrated with multiple games
* Access to query ports
* Custom Post type
* Several display templates
* Built fully on hooks and loops
