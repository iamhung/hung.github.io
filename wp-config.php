<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'nvh2k' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'L#1rvHeD]d&u<wgd5}?4Rb&-f/Bw~KQCBzcxOG!P&f*3cQ1HNaisz$BXnq]+2ofa' );
define( 'SECURE_AUTH_KEY',  'dlvF&8QX@$g -q9~3L_?,8 +sAwLH+;s~;K/8Z-5R_jT:EdWL]$JpBO1{kh^~^sL' );
define( 'LOGGED_IN_KEY',    'g7^aVo}($<A*8Zz&io`mw =zHW>WGu#Iu2j~z5%9t]-l0-OC+6sNOo;D)D~Bq9O`' );
define( 'NONCE_KEY',        'Mq.<xR#B?)k*,Rd6K~bG)-EE:cZ2eE>E<|ljALW7v(t%+!XRV|{I<6aq}jG-DLPE' );
define( 'AUTH_SALT',        'v)e9lVs!&3sW/-?`!vf!A-lZ+QvH-5zoqVl.r2bXAU`}[@R;=LeuJI^gPXM HH_Z' );
define( 'SECURE_AUTH_SALT', '-r-Nf5Z<uf_ p|^ekm3UL@1.OA/.|HaM5M8_YiLQ]<M.@ VEQYu;0BS3 gaZJX{,' );
define( 'LOGGED_IN_SALT',   'B7cX]fJ5XBs::~U5fo|ggt9k9!d Nt@#$,c+%@QQB?kP<B;m3}*r_s:_QC. h9W@' );
define( 'NONCE_SALT',       'XD|5t0%/{(8]Ic (f|t4cU9_qdEeh64%QdNVc3.-O`[Sy&ey1]C8+YP!+w38?2Y=' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
