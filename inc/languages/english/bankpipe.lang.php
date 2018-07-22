<?php

$l['bankpipe'] = "BankPipe";
$l['bankpipe_error_missing_tokens'] = "BankPipe's configuration is not complete yet. Please configure BankPipe tokens before using it.";
$l['bankpipe_not_allowed_to_buy'] = "You are not allowed to buy this item";

// Nav
$l['bankpipe_nav'] = "Payments and subscriptions";
$l['bankpipe_nav_subscriptions'] = "Subscriptions";
$l['bankpipe_nav_purchases'] = "Purchases";
$l['bankpipe_nav_manage'] = "My items";
$l['bankpipe_nav_cart'] = "Cart";

// Edit attachment
$l['bankpipe_update'] = "Update";
$l['bankpipe_item_price'] = "Item price";

// Management
$l['bankpipe_manage_title'] = "Items management";
$l['bankpipe_manage_paypal_email'] = "PayPal email";
$l['bankpipe_manage_paypal_email_desc'] = "Enter your PayPal email where you will receive funds when users purchase your items. If blank and you have already set up paid items, they will lose their cost and will be available for free.";
$l['bankpipe_manage_settings_save'] = "Save settings";
$l['bankpipe_manage_cat_attachment'] = $l['bankpipe_profile_cat_attachment'] = $l['bankpipe_purchases_cat_attachment'] = "Attachment";
$l['bankpipe_manage_cat_size'] = "Size";
$l['bankpipe_manage_cat_post'] = "Post";
$l['bankpipe_manage_cat_cost'] = $l['bankpipe_purchases_cat_cost'] = $l['bankpipe_subscriptions_cat_cost'] = $l['bankpipe_profile_cat_cost'] = "Cost";
$l['bankpipe_manage_no_items'] = "You currently do not have any paid items set. To create a paid item, upload an attachment in a thread or post and add a price if possible. The attachment will be then available as a paid item and will be listed here. <b>In order to set up a paid item you must have a PayPal email.</b>.";

// Profile
$l['bankpipe_profile_no_purchases'] = "This user hasn't purchased any attachment at the moment.";
$l['bankpipe_profile_purchased_title'] = "Purchased items";
$l['bankpipe_profile_cat_purchased'] = $l['bankpipe_purchases_cat_purchased'] = "Purchased";

// Purchases
$l['bankpipe_purchases_title'] = "Purchases";
$l['bankpipe_purchases_no_purchases'] = "You haven't purchased any attachment at the moment. To purchase an attachment, press the Pay Now button alongside paid attachments.";
$l['bankpipe_purchases_expired'] = "Expired";
$l['bankpipe_purchases_refunded'] = "Refunded";

// Cart
$l['bankpipe_cart_title'] = "Cart";
$l['bankpipe_cart_header_attachment'] = "Attachment";
$l['bankpipe_cart_header_cost'] = "Cost";
$l['bankpipe_cart_header_discount'] = "Discount";
$l['bankpipe_cart_no_items'] = "You currently have no items in your shopping cart.";
$l['bankpipe_cart_price'] = "Price: ";
$l['bankpipe_cart_item_removed'] = "Item removed successfully";
$l['bankpipe_cart_item_removed_desc'] = "The selected item has been removed successfully from your cart.";
$l['bankpipe_cart_item_added'] = "Item added successfully";
$l['bankpipe_cart_item_added_desc'] = "The selected item has been added successfully to your cart.";
$l['bankpipe_cart_payee_different'] = "This item's payee is different from the one set for other items in your cart. PayPal can't handle multiple payees at once. Please either purchase or void the current cart to add this item to your cart.";
$l['bankpipe_discounts_promo_code'] = "Enter a promo code here";
$l['bankpipe_discounts_apply'] = "Apply";
$l['bankpipe_discounts_remove_code'] = "Remove code";

// Discounts
$l['bankpipe_discount_applied'] = "Discount applied successfully";
$l['bankpipe_discount_applied_desc'] = "The discount you have entered has been validated and applied successfully to your cart or subscriptions.";
$l['bankpipe_discounts_removed'] = "Discount removed successfully";
$l['bankpipe_discounts_removed_desc'] = "The selected discount has been removed successfully from your cart or subscriptions.";

// Subscriptions
$l['bankpipe_subscriptions_title'] = "Subscriptions";
$l['bankpipe_subscriptions_cat_subscription'] = "Subscription";
$l['bankpipe_subscriptions_cat_purchase'] = "Purchase";
$l['bankpipe_subscriptions_not_available'] = "There are currently no subscriptions available.";
$l['bankpipe_subscriptions_current_plan'] = "Current active plan";

// Notifications
$l['bankpipe_notification_purchase_title'] = "{1} has purchased some items for {2}";
$l['bankpipe_notification_purchase'] = "Dear manager or accountant,
[url={2}]{1}[/url] has spent [b]{4}[/b] by purchasing the following list of items:

[list]{3}[/list]

The money has already been sent to your PayPal account and should be available in some minutes.

Best regards,
{5}";

// Messages
$l['bankpipe_error_could_not_complete'] = "Your payment may have completed but the transaction (state: {1}) may have been put on hold for some reason. Therefore, you have not been granted access to what you were trying to purchase. Please get in touch with an administrator to solve this issue.<br><br>Thank you for your comprehension.";
$l['bankpipe_error_pending_payment'] = "Your payment is currently pending completion. At the current stages, we can't handle your payment automatically. Therefore, you have not been granted access to what you were trying to purchase. Please get in touch with an administrator to complete your purchase.<br><br>Thank you for your comprehension.";
$l['bankpipe_error_could_not_complete_refund'] = "There was an issue completing this refund (state: {1}). Please try again in some minutes, this could be due to PayPal temporary issues.";
$l['bankpipe_error_code_not_found'] = "This promo code does not appear to be valid.";
$l['bankpipe_error_code_expired'] = "This promo code has expired and is no longer valid.";
$l['bankpipe_error_code_not_allowed'] = "You are not allowed to apply this promo code.";
$l['bankpipe_error_code_not_allowed_stackable'] = "This promo code cannot be stacked to existing applied promo codes. Please remove the others and retry.";
$l['bankpipe_error_other_codes_not_allowed_stackable'] = "This promo code cannot be applied because a non-stackable code is already applied. Please remove it and retry.";
$l['bankpipe_error_code_already_applied'] = "This promo code has already been applied.";
$l['bankpipe_error_missing_required_field'] = "Some required fields are missing. Please ensure you have filled all the required fields before trying to purchase an item.";

$l['bankpipe_success_purchased_item'] = "You have successfully purchased {1}. If the page is not reloaded automatically, please reload it manually.";
$l['bankpipe_success_settings_edited'] = "Settings edited";
$l['bankpipe_success_settings_edited_desc'] = "Your items management settings have been edited successfully.";

// Misc
$l['bankpipe_discounts_applied'] = "Discounts applied: {1}";
$l['bankpipe_discount_previous_item'] = "Previous subscriptions discount";
$l['bankpipe_discount_previous_item_desc'] = "This discount has been applied because you have already purchased another subscription in the past.";
$l['bankpipe_discount_code_desc'] = "This discount code has been validated and applied to your total.";
$l['bankpipe_add_to_cart'] = "Add to cart";
$l['bankpipe_remove_from_cart'] = "Remove from cart";

$l['task_bankpipe_ran'] = 'BankPipe cleanup task has ran successfully.';