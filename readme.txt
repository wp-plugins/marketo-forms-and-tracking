=== Marketo Forms and Tracking ===
Contributors: hutchhouse
Tags: marketo, forms, marketing, lead, tracking
Requires at least: 3.8
Tested up to: 4.1.1
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Embedded forms in WYSIWYG's for Marketo, plus the munchkin.js tracking script.

== Description ==

Wordpress intergration for Marketo forms and the Marketo munchkin.js script. 
Adds the `[marketo-fat form="1234"]` shortcode with optional field prepopulation (missing on standard Marketo embedded forms) based on what the lead has already provided and an optional 
form popout. This plugin requires a Marketo account/instance and was developed by the folk at www.hutchhouse.com.

= Warning =
Having the same form twice on a page produces duplication of these forms in the page. This is a bug in Marketo. Please avoid doing this. 
You may have multiple forms with different ID's on the same page, this will work fine.

= Tracking =
Marketo Forms and Tracking uses Marketo's munchkin.js script to provide 
tracking throughout your lead's journey on your website. Using munchkin.js 
we can keep track of what data a visitor has already entered on your website 
so they don't have to fill out the same field twice. When the Account ID and 
Base Url are provided, munchkin.js will be loaded into the page for all users.

= Forms =
Forms can be inserted into the editor using a button next to the "Add Media" button.
Pressing this "Add Marketo Form" button will open a modal for you to enter a form ID.
Enter a form ID and click "Insert Form" to generate and insert a shortcode that looks 
something like `[marketo-fat form="1111"]`. When you view this page on the front end the 
form will be loaded.

= Popout =
This plugin comes packed with a popout feature. Enabling this feature adds 
a button to the bottom right corner of the browser window, when this is clicked
a marketo form appears for the lead to fill in. 

= Pre Populating Fields =
Requirments:
1. Marketo User Id	
2. Marketo End Point Url	
3. Marketo Sercet Key
When these details are saved, you can load in field data that the lead has already provided.

== Requirements ==

* Marketo Account
* Wordpress 3.8
* PHP 5.2
* PHP SOAP Extension (If using the pre populating fields functionality)

== Installation ==

1. Upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go the the Marketo settings page in the admin menu and enter Marketo account details.

== Screenshots ==

1. Options Page.
2. Adding a form to a WYSIWYG with a modal.
3. View of an inline form added to a WYSIWYG.
4. Popout hidden in twentyfourteen.
5. Popout visible in twentyfourteen.

== Changelog ==

= 1.0.2 =
* Tested with WP 4.1.1

= 1.0.1 =
* Tested with WP 4.0

= 1.0.0 =
* Initial Release.
