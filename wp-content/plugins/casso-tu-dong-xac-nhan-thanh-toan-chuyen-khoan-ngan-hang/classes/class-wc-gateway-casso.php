<?php
/**
 * Class WC_Gateway_Casso file.
 *
 * @package WooCommerce\Gateways
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Thanh Toán Casso.
 *
 * Provides a Bank Transfer Payment Gateway. Based on code by Mike Pepper.
 *
 * @class       WC_Gateway_Casso
 * @extends     WC_Payment_Gateway
 * @version     2.1.0
 * @package     WooCommerce\Classes\Payment
 */
class WC_Gateway_Casso extends WC_Payment_Gateway {

	/**
	 * Array of locales
	 *
	 * @var array
	 */
	public $locale;

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {

		$this->id                 = 'casso';
		$this->icon               = apply_filters( 'woocommerce_bacs_icon', '' );
		$this->has_fields         = false;
		$this->method_title       = __( 'Chuyển khoản ngân hàng 24/7', 'woocommerce' );
		$this->method_description = __( 'Thực hiện thanh toán bằng hình thức chuyển khoản qua ngân hàng. Hệ thống tự động xác nhận thanh toán đơn hàng sau khi chuyển khoản hoàn tất', 'woocommerce' );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables.
		$this->title        = $this->get_option( 'title' );
		$this->description  = $this->get_option( 'description' );
		$this->instructions = $this->get_option( 'instructions' );

		$this->secure_token = $this->get_option('secure_token');
		if (strlen ($this->secure_token) <= 0 ){
			$random_str = self::generate_random_string(16);
			$this->update_option("secure_token", $random_str,$autoload=true);
		}

		$this->update_option("webhook", $this->get_webhook_url(), $autoload=true);

		// BACS account fields shown on the thanks page and in emails.
		$this->account_details = get_option(
			'woocommerce_bacs_accounts',
			array(
				array(
					'account_name'   => $this->get_option( 'account_name' ),
					'account_number' => $this->get_option( 'account_number' ),
					'bank_name'      => $this->get_option( 'bank_name' ),
				),
			)
		);
		// $statuses = wc_get_order_statuses();
		// $this->update_option('order_status_after_paid',$statuses['wc-default'], $autoload=true);
		// Actions.
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'save_account_details' ) );
		add_action( 'woocommerce_thankyou_casso', array( $this, 'thankyou_page_casso' ) );

		// Customer Emails.
		add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );
		add_action( 'woocommerce_api_'.self::$webhook_route, array( $this, 'casso_payment_handler') );
	}
	static private $webhook_route = "bank_transfer_handler";

	function parse_order_id($des){
		//TODO : Rewrite this function.
		//phân biệt
		if ($this->get_option( 'case_insensitive' )=='yes') {
			$re = '/'.$this->get_option( 'transaction_prefix' ).'\d+/m';
		}else{
			$re = '/'.$this->get_option( 'transaction_prefix' ).'\d+/mi';
		}

		preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);

		if (count($matches) == 0 )
			return null;
		// Print the entire match result
		$orderCode = $matches[0][0];
		
		$prefixLength = strlen($this->get_option( 'transaction_prefix' ));

		$orderId = intval(substr($orderCode, $prefixLength ));
		return $orderId ;

	}

	//ham de get url
	static function get_webhook_url() {
		return WC()->api_request_url( self::$webhook_route );
	}
	static function generate_random_string($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function getHeader(){
		$headers = array();

        $copy_server = array(
            'CONTENT_TYPE'   => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5'    => 'Content-Md5',
        );

        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }

        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }

        return $headers;
	}

	public function casso_payment_handler() {
		$txtBody = file_get_contents('php://input');
		$jsonBody = json_decode($txtBody); //convert JSON into array
		if (!$txtBody || !$jsonBody){
			echo "thieu body";
			die();
		}
		if ($jsonBody->error != 0){
			echo "co loi xay ra";
			die();
		}

		//TODO  CHECK secure-token (SE). 
		$header=$this->getHeader();
		$token=$header["Secure-Token"];
		if (strcasecmp($token, $this->secure_token ) !== 0) {
			echo "thieu secure_token hoac sai secure_token";
			die();
		}
		foreach ($jsonBody->data as $key => $transaction) {
			$des = $transaction ->description;
			$order_id = $this->parse_order_id($des);
			if (is_null($order_id)) {
				echo ("Không tìm thấy mã đơn hàng từ nội dung giao dịch : " . $des. "\n");
				continue;
			}
			echo ("Bắt đầu xử lý đơn hàng với mã giao dịch " . $order_id. "...\n");

			$order = wc_get_order( $order_id );
			if (!$order){
				continue;
			}
			//echo(var_dump(wc_get_order_statuses()));
			$money = $order->get_total();
			$paid = $transaction->amount;
			$today =date_create(date("Y-m-d"));
			$date_transaction = date_create($transaction->when);
			$interval = date_diff($today, $date_transaction);
			if ($interval->format('%R%a')<-2) {
				# code...
				echo(' Giao dịch quá cũ, không xử lý');
				die();
			}
			$total = number_format($transaction->amount, 0);
			$order_note = "Casso thông báo nhận <b>{$total}</b> VND, nội dung <B>{$des}</B> chuyển vào <b>STK {$transaction->subAccId}</b>";
			$order->add_order_note($order_note);

			// $order_note_overpay = "Casso thông báo <b>{$total}</b> VND, nội dung <b>$des</b> chuyển khoản dư vào <b>STK {$transaction->subAccId}</b>";
			$acceptable_difference = abs($this->get_option("acceptable_difference"));
			if ( $paid < $money  - $acceptable_difference ){
				$order->add_order_note("Đơn hàng bị thanh toán thiếu nên chưa hoàn tất");
				$status_after_underpaid = $this->get_option( 'order_status_after_underpaid' );

				if ( $status_after_underpaid && $status_after_underpaid != "wc-default") {
					$status = substr($this->get_option( 'order_status_after_underpaid' ),3);
					$order->update_status($status);
				}
			
			} else {

				$order->payment_complete();
				wc_reduce_stock_levels($order_id);
				$status_after_paid = $this->get_option( 'order_status_after_paid' );
					
				if ($status_after_paid && $status_after_paid !="wc-default") {
					$order->update_status($status_after_paid);
				}
				
				//NEU THANH TOAN DU THI GHI THEM 1 cai NOTE 
				if ($paid > $money + $acceptable_difference){
					$order->add_order_note("Đơn hàng đã thanh toán dư");
				}

			}
			echo ("Xử lý giao dịch  " . $order_id. " thành công\n");

		}
		die();
	}
	
	/**
	 * Initialise Casso Settings Form Fields.
	 */
	public function init_form_fields() {

		$this->form_fields = array(
			'enabled'         => array(
				'title'   => __( 'Enable/Disable', 'woocommerce' ),
				'type'    => 'checkbox',
				'label'   => __( 'Enable bank transfer', 'woocommerce' ),
				'default' => 'no',
			),
			'title'           => array(
				'title'       => __( 'Title', 'woocommerce' ),
				'type'        => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
				'default'     => "Chuyển khoản ngân hàng 24/7",
				'desc_tip'    => true,
			),
			'description'     => array(
				'title'       => __( 'Description', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your checkout.', 'woocommerce' ),
				'default'     => "Thực hiện thanh toán chuyển khoản vào tài khoản ngân hàng của chúng tôi. Vui lòng điền Mã đơn hàng của bạn trong phần Nội dung thanh toán. Đơn hàng của bạn sẽ đươc xác nhận tự động ngay sau khi tài khoản ngân hàng của chúng tôi nhận được tiền.",
				'desc_tip'    => true,
			),
			'instructions'    => array(
				'title'       => __( 'Instructions', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'instructions', 'woocommerce' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'account_details' => array(
				'type' => 'account_details',
			),
			'webhook'    => array(
				'title'       => __( 'Webhook URL', 'woocommerce' ),
				'type'        => 'text',
				'description' => 'Webhook URL',
				'default'     => $this->get_webhook_url(),
				'desc_tip'    => true,
				'required' => 'true',
				'css'		  => "pointer-events: none; "
			),
			'secure_token'    => array(
				'title'       => __( 'Key Bảo Mật', 'woocommerce' ),
				'type'        => 'text',
				'description' => 'Key bảo mật',
				'default'     => '',
				'required' => 'true',
				'desc_tip'    => true,
			),
			'transaction_prefix'    => array(
				'title'       => __( 'Tiền tố giao dịch', 'woocommerce' ),
				'type'        => 'text',
				'description' => 'Tiền tố điền trước mã đơn hàng để tạo mã cho khách hàng chuyển tiền',
				'default'     => 'DH',
				'required' => 'true',
				'desc_tip'    => true,
			),
			'case_insensitive' =>array(
				'title'   => __('Bật Phân biệt chữ hoa / chữ thường','woocommerce'),
				'type'    => 'checkbox',
				'description' => __( 'Bật phân biệt chữ hoa / chữ thường', 'woocommerce' ), 
				'default' => 'no',
				'desc_tip'    => true,
			),
			'acceptable_difference'    => array(
				'title'       => __( 'Chênh lệch chấp nhận', 'woocommerce' ),
				'type'        => 'text',
				'description' => "Số tiền chuyển thiếu tối đa mà hệ thống vẫn chấp nhận để xác nhận đã thanh toán",
				'default'     => '10000',
				'required' => 'true',
				'desc_tip'    => true,
			),
			'order_status_after_paid'           => array(
				'title'      =>__('Trạng thái sau khi thanh toán đủ hoặc dư'),
				'type'        => 'select',
				'description' => __( 'Vui lòng chọn một trạng thái sau khi thanh toán đủ hoặc dư.', 'woocommerce' ),
				'default'     => 'wc-default',
				'class'       => 'status_type wc-enhanced-select',
				'options'     => $this->casso_get_order_statuses_after_paid(),
				'desc_tip'    => true,

			),
			'order_status_after_underpaid'           => array(
				'title'      =>__('Trạng thái nếu thanh toán thiếu'),
				'type'        => 'select',
				'description' => __( 'Vui lòng chọn một trạng thái sau khi thanh toán thiếu.', 'woocommerce' ),
				'default'     => 'wc-underpaid',
				'class'       => 'status_type wc-enhanced-select',
				'options'     => $this->casso_get_order_statuses_after_underpaid(),
				'desc_tip'    => true,

			),
		);

	}

	//danh sach lua chon trang thai sau khi paid.
	public function casso_get_order_statuses_after_paid() {
		$wooDefaultStatuses = array(
			"wc-pending", 
			"wc-processing",
			"wc-on-hold", 
			// "wc-completed",
			"wc-cancelled",
			"wc-refunded",
			"wc-failed",
			// "wc-paid",
			"wc-underpaid"
		);

		$statuses =  wc_get_order_statuses();
		$statuses['wc-default'] = "Mặc định";



		for ($i = 0; $i < count($wooDefaultStatuses); $i++)
		{
			$statusName = $wooDefaultStatuses[$i];
			if( isset( $statuses[$statusName]))
			{
				unset( $statuses[$statusName] );
			}
		}
		// $this->update_option('order_status_after_paid',$statuses['wc-default'], $autoload=true);
		return $statuses;

	}

	public function casso_get_order_statuses_after_underpaid() {

		$wooDefaultStatuses = array(
			"wc-pending", 
			// "wc-processing",
			"wc-on-hold", 
			"wc-completed",
			"wc-cancelled",
			"wc-refunded",
			"wc-failed",
			"wc-paid",
			// "wc-underpaid"
		);

		$statuses =  wc_get_order_statuses();
		$statuses['wc-default'] = "Mặc định";



		for ($i = 0; $i < count($wooDefaultStatuses); $i++)
		{
			$statusName = $wooDefaultStatuses[$i];
			if( isset( $statuses[$statusName]))
			{
				unset( $statuses[$statusName] );
			}
		}
		// $this->update_option('order_status_after_paid',$statuses['wc-default'], $autoload=true);
		return $statuses;

	}


	/**
	 * Generate account details html.
	 *
	 * @return string
	 */
	public function generate_account_details_html() {

		ob_start();

		$country = WC()->countries->get_base_country();
		$locale  = $this->get_country_locale();

		// Get sortcode label in the $locale array and use appropriate one.
		$sortcode = isset( $locale[ $country ]['sortcode']['label'] ) ? $locale[ $country ]['sortcode']['label'] : __( 'Sort code', 'woocommerce' );

		?>
<tr valign="top">
    <th scope="row" class="titledesc"><?php esc_html_e( 'Account details:', 'woocommerce' ); ?></th>
    <td class="forminp" id="bacs_accounts">
        <div class="wc_input_table_wrapper">
            <table class="widefat wc_input_table sortable" cellspacing="0">
                <thead>
                    <tr>
                        <th class="sort">&nbsp;</th>
                        <th><?php esc_html_e( 'Account name', 'woocommerce' ); ?></th>
                        <th><?php esc_html_e( 'Account number', 'woocommerce' ); ?></th>
                        <th><?php esc_html_e( 'Bank name', 'woocommerce' ); ?></th>
                    </tr>
                </thead>
                <tbody class="accounts">
                    <?php
							$i = -1;
							if ( $this->account_details ) {
								foreach ( $this->account_details as $account ) {
									$i++;

									echo '<tr class="account">
										<td class="sort"></td>
										<td><input type="text" value="' . esc_attr( wp_unslash( $account['account_name'] ) ) . '" name="bacs_account_name[' . esc_attr( $i ) . ']" /></td>
										<td><input type="text" value="' . esc_attr( $account['account_number'] ) . '" name="bacs_account_number[' . esc_attr( $i ) . ']" /></td>
										<td><input type="text" value="' . esc_attr( wp_unslash( $account['bank_name'] ) ) . '" name="bacs_bank_name[' . esc_attr( $i ) . ']" /></td>
									</tr>';
								}
							}
							?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7"><a href="#"
                                class="add button"><?php esc_html_e( '+ Add account', 'woocommerce' ); ?></a> <a
                                href="#"
                                class="remove_rows button"><?php esc_html_e( 'Remove selected account(s)', 'woocommerce' ); ?></a>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script type="text/javascript">
        jQuery(function() {
            jQuery('#bacs_accounts').on('click', 'a.add', function() {

                var size = jQuery('#bacs_accounts').find('tbody .account').length;

                jQuery('<tr class="account">\
									<td class="sort"></td>\
									<td><input type="text" name="bacs_account_name[' + size + ']" /></td>\
									<td><input type="text" name="bacs_account_number[' + size + ']" /></td>\
									<td><input type="text" name="bacs_bank_name[' + size + ']" /></td>\
								</tr>').appendTo('#bacs_accounts table tbody');

                return false;
            });
        });
        </script>
    </td>
</tr>
<?php
		return ob_get_clean();

	}

	/**
	 * Save account details table.
	 */
	public function save_account_details() {

		$accounts = array();

		// phpcs:disable WordPress.Security.NonceVerification.Missing -- Nonce verification already handled in WC_Admin_Settings::save()
		if ( isset( $_POST['bacs_account_name'] ) && isset( $_POST['bacs_account_number'] ) && isset( $_POST['bacs_bank_name'] )) {

			$account_names   = wc_clean( wp_unslash( $_POST['bacs_account_name'] ) );
			$account_numbers = wc_clean( wp_unslash( $_POST['bacs_account_number'] ) );
			$bank_names      = wc_clean( wp_unslash( $_POST['bacs_bank_name'] ) );

			foreach ( $account_names as $i => $name ) {
				if ( ! isset( $account_names[ $i ] ) ) {
					continue;
				}

				$accounts[] = array(
					'account_name'   => $account_names[ $i ],
					'account_number' => $account_numbers[ $i ],
					'bank_name'      => $bank_names[ $i ]
				);
			}
		}
		// phpcs:enable

		update_option( 'woocommerce_bacs_accounts', $accounts );
	}

	/**
	 * Output for the order received page.
	 *
	 * @param int $order_id Order ID.
	 */
	public function thankyou_page_casso( $order_id ) {

		if ( $this->instructions ) {
			echo wp_kses_post( wpautop( wptexturize( wp_kses_post( $this->instructions ) ) ) );
		}
		$this->bank_details( $order_id );

	}

	/**
	 * Add content to the WC emails.
	 *
	 * @param WC_Order $order Order object.
	 * @param bool     $sent_to_admin Sent to admin.
	 * @param bool     $plain_text Email format: plain text or HTML.
	 */
	public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {

		if ( ! $sent_to_admin && 'casso' === $order->get_payment_method() && $order->has_status( 'on-hold' ) ) {
			if ( $this->instructions ) {
				echo wp_kses_post( wpautop( wptexturize( $this->instructions ) ) . PHP_EOL );
			}
			$this->bank_details( $order->get_id() );
		}

	}

	/**
	 * Get bank details and place into a list format.
	 *
	 * @param int $order_id Order ID.
	 */
	private function bank_details( $order_id = '' ) {

		if ( empty( $this->account_details ) ) {
			return;
		}

		// Get order and store in $order.
		$order = wc_get_order( $order_id );
		$to=$order->get_billing_email();
		$subject='Thanh Toán đơn hàng';
		
		// Get the order country and country $locale.
		$country = $order->get_billing_country();
		$locale  = $this->get_country_locale();
		// Get sortcode label in the $locale array and use appropriate one.
		$sortcode = isset( $locale[ $country ]['sortcode']['label'] ) ? $locale[ $country ]['sortcode']['label'] : __( 'Sort code', 'woocommerce' );

		$bacs_accounts = apply_filters( 'woocommerce_bacs_accounts', $this->account_details, $order_id );
		if ( ! empty( $bacs_accounts ) ) {
			$account_html = '';
			$has_details  = false;

			foreach ( $bacs_accounts as $bacs_account ) {
				$bacs_account = (object) $bacs_account;

				if ( $bacs_account->account_name ) {
					$account_html .= '<h4 class="wc-bacs-bank-details-account-name" style="padding: 8px 16px;background: #eee;">' . wp_kses_post( wp_unslash( $bacs_account->account_name ) ) . ':</h4>' . PHP_EOL;
				}

				$account_html .= '<ul class="wc-bacs-bank-details order_details bacs_details" style="margin:0px">' . PHP_EOL;
				// BACS account fields shown on the thanks page and in emails.
				$account_fields = apply_filters(
					'woocommerce_bacs_account_fields',
					array(
						'bank_name'      => array(
							'label' => __( 'Bank', 'woocommerce' ),
							'value' => $bacs_account->bank_name,
						),
						'account_number' => array(
							'label' => __( 'Account number', 'woocommerce' ),
							'value' => $bacs_account->account_number,
						),
						'amount'            => array(
							'label' => __( 'Số tiền', 'woocommerce' ),
							'value' => number_format($order->get_total(), 0),
						),
						'content'            => array(
							'label' => __( 'Nội dung', 'woocommerce' ),
							'value' =>$this->get_option( 'transaction_prefix' ).''.$order_id,
						),
					),
					$order_id
				);

				foreach ( $account_fields as $field_key => $field ) {
					if ( ! empty( $field['value'] ) ) {
						$account_html .= '<li class="' . esc_attr( $field_key ) . '">' . wp_kses_post( $field['label'] ) . ': <strong style="color:#15ab64!important">' . wp_kses_post( wptexturize( $field['value'] ) ) . '</strong></li>' . PHP_EOL;
						$has_details   = true;
					}
				}

				$account_html .= '</ul>';
			}
			$account_html .= '<h6 class="wc-bacs-bank-details-account-name" style="padding: 8px 16px;background: #66ff999e;color:#333;margin-top:16px"> Vui lòng chuyển khoản đúng nội dung "'.$this->get_option( 'transaction_prefix' ).''.$order_id.'" để hệ thống tự động xác nhận thanh toán.</h6>' . PHP_EOL;
			if ( $has_details ) {
				echo '<section class="woocommerce-bacs-bank-details"><h2 class="wc-bacs-bank-details-heading">' . esc_html__( 'Our bank details', 'woocommerce' ) . '</h2>' . wp_kses_post( PHP_EOL . $account_html ) . '</section>';
			}
		}

	}
	

	/**
	 * Process the payment and return the result.
	 *
	 * @param int $order_id Order ID.
	 * @return array
	 */
	public function process_payment( $order_id ) {

		$order = wc_get_order( $order_id );

		if ( $order->get_total() > 0 ) {
			// Mark as on-hold (we're awaiting the payment).
			$order->update_status( apply_filters( 'woocommerce_bacs_process_payment_order_status', 'on-hold', $order ), __( 'Awaiting BACS payment', 'woocommerce' ) );
		} else {
			$order->payment_complete();
		}

		// Remove cart.
		WC()->cart->empty_cart();

		// Return thankyou redirect.
		return array(
			'result'   => 'success',
			'redirect' => $this->get_return_url( $order ),
		);

	}

	/**
	 * Get country locale if localized.
	 *
	 * @return array
	 */
	public function get_country_locale() {

		if ( empty( $this->locale ) ) {

			// Locale information to be used - only those that are not 'Sort Code'.
			$this->locale = apply_filters(
				'woocommerce_get_bacs_locale',
				array(
					'AU' => array(
						'sortcode' => array(
							'label' => __( 'BSB', 'woocommerce' ),
						),
					),
					'CA' => array(
						'sortcode' => array(
							'label' => __( 'Bank transit number', 'woocommerce' ),
						),
					),
					'IN' => array(
						'sortcode' => array(
							'label' => __( 'IFSC', 'woocommerce' ),
						),
					),
					'IT' => array(
						'sortcode' => array(
							'label' => __( 'Branch sort', 'woocommerce' ),
						),
					),
					'NZ' => array(
						'sortcode' => array(
							'label' => __( 'Bank code', 'woocommerce' ),
						),
					),
					'SE' => array(
						'sortcode' => array(
							'label' => __( 'Bank code', 'woocommerce' ),
						),
					),
					'US' => array(
						'sortcode' => array(
							'label' => __( 'Routing number', 'woocommerce' ),
						),
					),
					'ZA' => array(
						'sortcode' => array(
							'label' => __( 'Branch code', 'woocommerce' ),
						),
					),
				)
			);

		}

		return $this->locale;

	}
}