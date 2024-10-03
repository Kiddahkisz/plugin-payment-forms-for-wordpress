<?php
/**
 * The Invoice Email sent to the customer before payment.
 *
 * @package paystack\payment_forms
 */

namespace paystack\payment_forms;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Form Submit Class
 */
class Email_Receipt_Owner extends Email {

	/**
	 * The email heading
	 *
	 * @var string
	 */
	public $heading = '';

	/**
	 * The thank you message.
	 *
	 * @var string
	 */
	public $sitemessage = '';

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	function send_receipt_owner( $form_id, $currency, $amount, $name, $email, $code, $metadata ) {

		// Default Values
		$this->amount     = $amount;
		$this->currency   = $currency;
		$this->code       = $code;
		$this->name       = $name;
		$this->email      = stripslashes( $email );

		// Custom Values
		$this->subject     = 'You just received a payment';
		$this->heading     = get_post_meta( $form_id, '_heading', true );
		$this->sitemessage = get_post_meta( $form_id, '_message', true );

		$this->send();
	}

	public function get_html_body() {
		?>
		<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin:0;padding:0;min-width:100%;background-color:#fff">
			<div class="email_body" style="padding:32px 6px;text-align:center;background-color:#fff">
	
				<div class="email_container" style="display:inline-block;width:100%;vertical-align:top;text-align:center;margin:0 auto;max-width:588px;font-size:0!important">
					<table class="header" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
						<tbody>
							<tr>
								<td class="header_cell col-bottom-0" align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;border-top:4px solid;border-bottom:0 solid;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">
	
								</td>
							</tr>
						</tbody>
					</table>
					<table class="content" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
						<tbody>
							<tr>
								<td class="content_cell" align="center" valign="top" style="padding:0;text-align:center;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">
	
									<div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
	
										<div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
											<table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
												<tbody>
													<tr>
														<td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888">
															<p style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:16px;margin-bottom:24px">&nbsp; </p>
															<h5 style="font-family:Helvetica,Arial,sans-serif;margin-left:0;margin-right:0;margin-top:16px;margin-bottom:8px;padding:0;font-size:18px;line-height:26px;font-weight:bold;color:#383d42">You just received a payment</h5>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
	
									</div>
	
								</td>
							</tr>
						</tbody>
					</table>
					<table class="jumbotron" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
						<tbody>
							<tr>
								<td class="jumbotron_cell invoice_cell" align="center" valign="top" style="padding:0;text-align:center;background-color:#fafafa;font-size:0!important">
	
									<div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
	
										<div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:left">
											<table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
												<tbody>
													<tr>
														<td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#888;padding-top:0;padding-bottom:0">
															<table class="label" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
																<tbody>
																	<tr>
																		<td class="hspace" style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
																	</tr>
																	<tr>
																		<td class="hspace" style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
																	</tr>
																	<tr>
																		<td class="font_default" style="padding:3px 7px;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:2px;-webkit-border-radius:2px;border-radius:2px;white-space:nowrap;background-color:#666;color:#fff">Payment Details</td>
																	</tr>
																</tbody>
															</table>
															<p style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:8px;margin-bottom:16px">
																Amount <strong> : <?php echo esc_html($this->currency) . ' ' . number_format($this->amount); ?></strong><br>
																Email <strong> : <?php echo esc_html($this->email); ?></strong><br>
																<?php
																	$new = json_decode($this->metadata);
																if (array_key_exists("0", $new)) {
																	foreach ($new as $key => $item) {
																		if ($item->type == 'text') {
																			echo esc_html($item->display_name) . "<strong>  :" . $item->value . "</strong><br>";
																		} else {
																			echo esc_html($item->display_name) . "<strong>  : <a target='_blank' href='" . $item->value . "'>link</a></strong><br>";
																		}
																	}
																} else {
																	$text = '';
																	if (count($new) > 0) {
																		foreach ($new as $key => $item) {
																			echo esc_html($key) . "<strong>  :" . $item . "</strong><br />";
																		}
																	}
																} ?>
																Transaction code: <strong> <?php echo esc_html($this->code); ?></strong><br>
															</p>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
	
								</td>
							</tr>
						</tbody>
					</table>
					<table class="jumbotron" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
						<tbody>
							<tr>
								<td class="jumbotron_cell product_row" align="center" valign="top" style="padding:0 0 16px;text-align:center;background-color:#f2f2f5;border-left:4px solid;border-right:4px solid;border-top:1px solid;border-color:#d8dde4;font-size:0!important">
	
									<div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
	
										<div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
											<table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
												<tbody>
													<tr>
														<td class="column_cell font_default" align="center" valign="top" style="padding:16px 16px 0;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888">
															<small style="font-size:86%;font-weight:normal"><strong>Notice</strong><br>
																You're getting this email because someone made a payment of <?php $this->currency . ' ' . number_format($this->amount); ?> to <a href="<?php echo get_bloginfo('url') ?>" style="display:inline-block;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#2f68b4"><?php echo get_option('blogname'); ?></a>.</small>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
	
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="footer" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
						<tbody>
							<tr>
								<td class="footer_cell" align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;border-top:1px solid;border-bottom:4px solid;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">
									<div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
										<div class="col-13 col-bottom-0" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:390px">
											<table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
												<tbody>
													<tr>
														<td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
															<strong><?php echo get_option('blogname'); ?></strong><br>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="col-1 col-bottom-0" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:190px">
											<table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
												<tbody>
													<tr>
														<td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</body>
		<?php
	}
}