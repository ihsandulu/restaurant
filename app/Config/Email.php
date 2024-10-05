<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
	//Ubah variabel pada Email.php dengan variabel berikut:

	/* public $protocol = "smtp";
	public $SMTPHost = "smtp.hostinger.com"; 
	public $SMTPUser = "admin@ragamconcept.online";
	public $SMTPPass = "Ragam123456**"; 
	public $SMTPPort = 465;
	public $SMTPCrypto = "ssl";
	public $mailType = "html"; */

	
	public $protocol = "smtp";
	public $SMTPHost = "smtp.hostinger.com"; 
	public $SMTPUser = "booking@bataviaapartments.co.id";
	public $SMTPPass = "Ragam123456**"; 
	public $SMTPPort = 465;
	public $SMTPCrypto = "ssl";
	public $mailType = "html";

	/* public $protocol = "smtp";
	public $SMTPHost = "smtp.gmail.com";
	public $SMTPUser = "suluhbatavia@gmail.com";
	public $SMTPPass = "Suluh123!@#";
	public $SMTPPort = 587;
	public $SMTPCrypto = "tls";
	public $mailType = "html";		
	public $fromName = "Admin";
	public $fromEmail = "suluhbatavia@gmail.com";	
	public $charset = "UTF-8"; */
	// public EMAIL_CLIENT_SECRET = "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";  
	// public EMAIL_AUTH = "xoauth2";

	


	/* public $protocol;
	public $SMTPHost; 
	public $SMTPUser;
	public $SMTPPass; 
	public $SMTPPort;
	public $SMTPCrypto;
	public $mailType;	
	public $fromName;
	public $fromEmail;	
	public $charset; */

	
	// EMAIL_CLIENT_SECRET = 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  
	// EMAIL_AUTH = xoauth2

	/* public function __construct()
    {
        parent::__construct();	
        $this->protocol = getenv('EMAIL_PROTOCOL') ?? $_ENV['EMAIL_PROTOCOL'] ?? 'smtp';
        $this->SMTPHost  = getenv('EMAIL_HOST') ?? $_ENV['EMAIL_HOST'] ?? 'smtp.hostinger.com';
        $this->SMTPUser  = getenv('EMAIL_USERNAME') ?? $_ENV['EMAIL_USERNAME'] ?? 'booking@bataviaapartments.co.id';
        $this->SMTPPass  = getenv('EMAIL_PASSWORD') ?? $_ENV['EMAIL_PASSWORD'] ?? '5Ahlussunnah6!@#';
        $this->SMTPPort  = getenv('EMAIL_PORT') ?? $_ENV['EMAIL_PORT'] ?? '465';
        $this->SMTPCrypto  = getenv('EMAIL_CRYPTO') ?? $_ENV['EMAIL_CRYPTO'] ?? 'ssl';
        $this->mailType  = getenv('EMAIL_MAILTYPE') ?? $_ENV['EMAIL_MAILTYPE'] ?? 'html';
        $this->fromName  = getenv('EMAIL_FROM_NAME') ?? $_ENV['EMAIL_FROM_NAME'] ?? 'Admin';
        $this->fromEmail  = getenv('EMAIL_FROM') ?? $_ENV['EMAIL_FROM'] ?? 'booking@bataviaapartments.co.id';
        $this->charset  = getenv('EMAIL_CHARSET') ?? $_ENV['EMAIL_CHARSET'] ?? 'UTF-8';
    } */

	/**
	 * @var string
	 */
	// public $fromEmail;

	/**
	 * @var string
	 */
	// public $fromName;

	/**
	 * @var string
	 */
	public $recipients;

	/**
	 * The "user agent"
	 *
	 * @var string
	 */
	public $userAgent = 'CodeIgniter';

	/**
	 * The mail sending protocol: mail, sendmail, smtp
	 *
	 * @var string
	 */
	// public $protocol = 'mail';

	/**
	 * The server path to Sendmail.
	 *
	 * @var string
	 */
	public $mailPath = '/usr/sbin/sendmail';

	/**
	 * SMTP Server Address
	 *
	 * @var string
	 */
	// public $SMTPHost;

	/**
	 * SMTP Username
	 *
	 * @var string
	 */
	// public $SMTPUser;

	/**
	 * SMTP Password
	 *
	 * @var string
	 */
	// public $SMTPPass;

	/**
	 * SMTP Port
	 *
	 * @var integer
	 */
	// public $SMTPPort = 25;

	/**
	 * SMTP Timeout (in seconds)
	 *
	 * @var integer
	 */
	public $SMTPTimeout = 60;

	/**
	 * Enable persistent SMTP connections
	 *
	 * @var boolean
	 */
	public $SMTPKeepAlive = false;

	/**
	 * SMTP Encryption. Either tls or ssl
	 *
	 * @var string
	 */
	// public $SMTPCrypto = 'tls';

	/**
	 * Enable word-wrap
	 *
	 * @var boolean
	 */
	public $wordWrap = true;

	/**
	 * Character count to wrap at
	 *
	 * @var integer
	 */
	public $wrapChars = 76;

	/**
	 * Type of mail, either 'text' or 'html'
	 *
	 * @var string
	 */
	// public $mailType = 'text';

	/**
	 * Character set (utf-8, iso-8859-1, etc.)
	 *
	 * @var string
	 */
	// public $charset = 'UTF-8';

	/**
	 * Whether to validate the email address
	 *
	 * @var boolean
	 */
	public $validate = false;

	/**
	 * Email Priority. 1 = highest. 5 = lowest. 3 = normal
	 *
	 * @var integer
	 */
	public $priority = 3;

	/**
	 * Newline character. (Use “\r\n” to comply with RFC 822)
	 *
	 * @var string
	 */
	public $CRLF = "\r\n";

	/**
	 * Newline character. (Use “\r\n” to comply with RFC 822)
	 *
	 * @var string
	 */
	public $newline = "\r\n";

	/**
	 * Enable BCC Batch Mode.
	 *
	 * @var boolean
	 */
	public $BCCBatchMode = false;

	/**
	 * Number of emails in each BCC batch
	 *
	 * @var integer
	 */
	public $BCCBatchSize = 200;

	/**
	 * Enable notify message from server
	 *
	 * @var boolean
	 */
	public $DSN = false;

}
