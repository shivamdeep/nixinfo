=== MyADManager ===
Contributors: rowoot
Plugin URI: http://www.visionmasterdesigns.com/wordpress-plugins/myadmanager/
Author URI: http://www.visionmasterdesigns.com/
Donate link: http://www.visionmasterdesigns.com/
Tags: ads, 125x125, ad management, advertisement, paypal, automatic
Requires at least: 2.5
Tested up to: 2.6.3
Stable tag: 0.9.3

Manages 125x125 ADs.Automatic activation and deactivation of ads.Ads can bought directly,accepts payments via Paypal.No middle men required.


== Description ==

I created this plugin because, I was tired of registering my site with millions of ad marketing/management websites, which were not only complete waste of time but money as well. I have noticed a lot of such websites which "claim to help us manage our ad-space", but in the end they end up putting their own ads (from which they earn) and also take a share of our earnings. So I present to you MyAdManager. There are many plugins to manage 125x125 ads, but the most unique feature of this plugin is that it automates ALL the procedures, including buying of Ads through PayPal and displaying them in your website automatically. It uses the PayPal IPN (Instant Payment Notification) feature.

MyAdManager docks easily into your Wordpress Administrator Page. You`ll notice a new tab called 'MyAdManager' being created in the front page

This scenario will give you a clear idea on how MyADManager Engine Works :

* If you want to display 2 ads horizontally, 3 ads vertically, you`ll have a total of 6 AD-Slots. You can add maximum 6 OUTSIDE ads in this case, although you can add how much ever HOME ads you want.

* If you have 6 OUTSIDE ads in the inventory (all within the expiry date), all 6 AD-Slots will be occupied by them (since they are paid ads, and have higher priority over HOME ads). These ADS will be displayed in random slots for every request to avoid AD-blindness, and to give every OUTSIDE AD equal space and exposure.

* Now if 1 OUTSIDE AD gets deactivated (expired or you have deactivated it), you will have 5 AD-Slots occupied with OUTSIDE ads, while 1 AD-Slot is free. Now if you have created any HOME ads, the most recently created HOME ad will be displayed till there is a new OUTSIDE AD.

* If another OUTSIDE AD expires, another HOME ad will be displayed if available. If there is no HOME ad available, then that AD-Slot will be empty.


Features:

* Ability to design how you want your ads to be displayed. i.e How many ads horizontally and how many vertically. This also determines your maximum AD-Slots.

* 2 Types of ADs - Outside, Home

* Home Ads - These type of ads don`t expire. They are displayed when there are not enough OUTSIDE ads to be displayed in the AD-Slots. These ads can only be created via the Admin Panel. NOTE: These ADs don`t rotate. If you want ads to rotate, make them as OUTSIDE Ads.

* Outisde Ads - Everytime someone buys adspace on your website, an OUTSIDE Ad is created by default. These types of ads have valid expiry dates, After the expiry date, it`ll get deactivated automatically. Outside Ads can also be created via the Admin Panel.

* ADs can be bought directly from your website. No need for any middle men or any middle websites. Payment is payed and processed via Paypal. As soon as the payment is confirmed via Paypal IPN, the AD is automatically added to the Ad-Inventory, and immediately will be LIVE. If you don`t want to use this feature, you can simply disable it via the Admin Panel.

* Admin Interface to de-activate, activate and delete ADs

* Logs of every successful transaction. Everytime an Ad-Slot is sold, a record is made.

* You can also determine, how long your ad-space should be sold for. It can be sold for a week or for a month (different prices ofcourse). Everything can be customized in the Admin Panel. If you don`t want to sell your ad-space for a week, you can simply disable it.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Either Place `<?php if ( function_exists('myadmanager_show') ) myadmanager_show(); ?>` in your sidebar or wherever you want to display the ADS.
4. Else activate the MyADManager Widget.
5. [Optional] If you want to display the 'Buy Ad' form, you can do so by adding `[myadmanager_show_form]` to your desired page or post.

== Frequently Asked Questions ==

= Why don`t the ADS I added rotate ? =

Only Outside ADs rotate. Home Ads are displayed after the OUTSIDE ads. If you want the Ads you added to rotate, Make them as Outside Ads. (Outside Ads also expire after specific time limit)

= How do you define margin for each AD ? =

Now you can directly define margin space for each AD via MyADManager Admin Panel->Options.

= I don`t want to give out my ad-space for seven days ! But the Buy Ad form shows 7days and 30days ? What to do =

Simple, Goto MyAdManager Admin Panel -> Options. Disable 7Day payment Option.

= Can I add the Buy AD form anywhere ? How can I add it ? =

You can add the form in your post/page by simply adding `[myadmanager_show_form]` using the visual editor to your post/page. I would suggest you to create a page called Advertising and then add the form in that. You can also add information about your website in that page. Then you can point all your links of 'Buy Ad-Space' to that page.

= Does the plugin add no-follow to the ad links ? =

Yes it does.

You can add the form in your post/page by simply adding `[myadmanager_show_form]` using the visual editor to your post/page. I would suggest you to create a page called Advertising and then add the form in that. You can also add information about your website in that page. Then you can point all your links of 'Buy Ad-Space' to that page.

= What are form.template.html and confirm-order.template.html files ? =

They are template files. As the name suggests form.template.html is the layout how your Buy Ad Form will look. Please take care of the variables, DO NOT edit the variables.
Secondly, confirm-order.template.html is the page that is displayed after the Buy Ad form is filled, just to give the customer all details to verify his requirements and other variables.
Thirdly, myadmanager.css defines styles for these pages as well as how ads are displayed


== Known Issues ==
* If you have WP Super Cache installed on your blog, ads may not be rotated on every new request. This issue is being addressed and will be sorted out in the upcoming updates of the plugin.


== Screenshots ==

1. The Main page which shows all the ads available in the database. It also shows information on which is active and which is not. You can also add new ads from this page.
2. The settings page. here you have to define the cost for your adspace, enable/disable to show the **Buy Ads Form** etc.
3. Buy Form. It can be modified using the template.

== Upgrading to 0.9.x ==

Try to use the automatic Wordpess updater, if that doesn't work. Please Deactivate the plugin, upload the latest version and reactivate it.

== Acknowledgments ==
Here's a link to [Visionmasterdesigns.com](http://Visionmasterdesigns.com/ "IT is here...") to see the live demo at work.

Thanks to [Micah Carrick](http://www.micahcarrick.com) since I have used his PHP Paypal IPN Integration Class to help me out with this plugin.