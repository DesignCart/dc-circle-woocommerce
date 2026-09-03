=== DC Circle ===
Contributors: giraffex
Tags: e-commerce, woocommerce, custom-colors, custom-menu, translation-ready
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Custom WooCommerce theme for DC Circle shops by Design Cart.

== Description ==

DC Circle is a bespoke WooCommerce theme built by Design Cart (Paweł Nosko).

== Installation ==

1. Upload the `dc-circle` theme folder to `/wp-content/themes/`.
2. Activate the theme through the Appearance menu in WordPress.
3. Configure theme options in the Customizer.

== External services ==

This theme does not load third-party assets from external CDNs. Stylesheets, scripts, icon fonts, and web fonts are bundled with the theme package.

If you install optional plugins (for example Newsletter, YITH Wishlist, or payment gateways), those plugins may connect to their own external services according to their documentation.

== Frequently Asked Questions ==

= Does this theme require WooCommerce? =

Yes. WooCommerce should be installed and active for shop templates and product features. The theme remains usable without WooCommerce (no fatal errors).

== Changelog ==

= 1.0.3 =
* Fix fatal error when WooCommerce is inactive (guard is_product and WC templates).
* Fix duplicate HTML IDs for cart toggle and search field.
* Add languages/ folder and dc-circle.pot; translate mini-cart remove icon alt text.
* Remove broken CSS (orphan rules and missing background image URLs).
* Clarify screenshot image source URLs in readme.txt.
* Add block styles, block pattern, custom-header and custom-background support.
* Update WooCommerce template @version headers for WC 10.8 compatibility.

= 1.0.2 =
* Fix Theme Check: remove non-GPL Unsplash references from screenshot image credits.

= 1.0.1 =
* Accessibility: skip link, content link underlines, visible keyboard focus.
* Add LICENSE and resource credits.
* Remove redundant lazy-loading attributes.

= 1.0.0 =
* Initial release.

== Resources ==

= Bundled libraries =

* Bootstrap 5.3.3
  Copyright (c) 2011-2024 The Bootstrap Authors
  License: MIT
  Source: https://getbootstrap.com/

* Font Awesome Free 6.5.0
  Copyright (c) Fonticons, Inc.
  License: Icons — CC BY 4.0; Fonts — SIL OFL 1.1; Code — MIT
  Source: https://fontawesome.com/

* Owl Carousel 2.3.4
  Copyright (c) 2014 Owl
  License: MIT
  Source: https://owlcarousel2.github.io/OwlCarousel2/

* Swiper 11.0.0
  Copyright (c) 2014-2023 Vladimir Kharlampidi
  License: MIT
  Source: https://swiperjs.com/

* Montserrat font
  Copyright (c) Julieta Ulanovsky and other contributors
  License: SIL Open Font License 1.1
  Source: https://fonts.google.com/specimen/Montserrat

= Screenshot images =

* screenshot.png – hero banner image
  Created with generative AI by Design Cart (Paweł Nosko)
  Source URL: https://www.designcart.pl/laboratorium/231-dc-circle-darmowy-szablon-dla-woocommerce.html
  License: GPLv2 or later

* screenshot.png – product images shown in the New arrivals section
  Created with generative AI by Design Cart (Paweł Nosko)
  Source URL: https://www.designcart.pl/laboratorium/231-dc-circle-darmowy-szablon-dla-woocommerce.html
  License: GPLv2 or later

* screenshot.png – header logo mark
  Owned by Design Cart (Paweł Nosko)
  Source URL: https://www.designcart.pl/
  License: GPLv2 or later
