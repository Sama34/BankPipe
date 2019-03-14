<?php

namespace BankPipe\Update;

use BankPipe\Helper\Utilities;
use BankPipe\Items\Items;
use BankPipe\Items\Orders;

class Update
{
	use \BankPipe\Helper\MybbTrait;

	private $version;
	private $oldVersion;
	private $shadePlugins;
	private $info;

	public function __construct()
	{
		$this->traitConstruct(['cache']);

		$this->info = bankpipe_info();
		$this->shadePlugins = $this->cache->read('shade_plugins');
		$this->oldVersion = $this->shadePlugins[$this->info['name']]['version'];
		$this->version = $this->info['version'];

		if ($this->checkUpdate() and $this->mybb->input['update'] == 'bankpipe') {
			$this->update();
		}
	}

	private function checkUpdate()
	{
		if (version_compare($this->oldVersion, $this->version, "<")) {

			if ($this->mybb->input['update']) {
				return true;
			} else {
				flash_message($this->lang->bankpipe_error_needtoupdate, "error");
			}

		}

		return false;
	}

	private function update()
	{
    	global $PL;

		$newSettings = $dropSettings = [];
		$updateTemplates = 0;

		// Get the gid
		$query = $this->db->simple_select("settinggroups", "gid", "name='bankpipe'");
		$gid   = (int) $this->db->fetch_field($query, "gid");
		
		// beta 2
		if (version_compare($this->oldVersion, 'beta 2', "<")) {

			$newSettings[] = [
				"name" => "bankpipe_admin_notification",
				"title" => $this->db->escape_string($this->lang->setting_bankpipe_admin_notification),
				"description" => $this->db->escape_string($this->lang->setting_bankpipe_admin_notification_desc),
				"optionscode" => "text",
				"value" => '',
				"disporder" => 11,
				"gid" => $gid
			];

			$newSettings[] = [
				"name" => "bankpipe_admin_notification_method",
				"title" => $this->db->escape_string($this->lang->setting_bankpipe_admin_notification_method),
				"description" => $this->db->escape_string($this->lang->setting_bankpipe_admin_notification_method_desc),
				"optionscode" => "select
pm=Private message
email=Email",
				"value" => 'pm',
				"disporder" => 12,
				"gid" => $gid
			];

			if (!$this->db->field_exists('price', 'bankpipe_payments')) {
				$this->db->add_column('bankpipe_payments', 'price', 'decimal(6,2) NOT NULL AFTER `email`');
			}

			// Update the price table to hold the current prices
			$query = $this->db->simple_select('bankpipe_items', 'bid, price');
			while ($item = $this->db->fetch_array($query)) {
				$this->db->update_query('bankpipe_payments', ['price' => $item['price']], 'bid = ' . (int) $item['bid']);
			}

		}

		// beta 3
		if (version_compare($this->oldVersion, 'beta 3', "<")) {

			if (!$this->db->table_exists('bankpipe_downloadlogs')) {

				$collation = $this->db->build_create_table_collation();

				$this->db->write_query("
				CREATE TABLE " . TABLE_PREFIX . "bankpipe_downloadlogs (
					lid int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					pid int(10) NOT NULL DEFAULT '0',
					uid int(10) NOT NULL DEFAULT '0',
					aid int(10) NOT NULL DEFAULT '0',
					title text,
					date int(10) NOT NULL DEFAULT '0'
		        ) ENGINE=MyISAM{$collation};
				");

			}
			if (!$this->db->table_exists('bankpipe_discounts')) {

				$collation = $this->db->build_create_table_collation();

				$this->db->write_query("
				CREATE TABLE " . TABLE_PREFIX . "bankpipe_discounts (
					did int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					bids text,
					uids text,
					gids text,
					code text,
					value int(10) NOT NULL DEFAULT '0',
					type tinyint(1) NOT NULL DEFAULT '0',
					date int(10) NOT NULL DEFAULT '0',
					expires int(10) UNSIGNED NOT NULL DEFAULT '0',
					stackable tinyint(1) NOT NULL DEFAULT '0'
		        ) ENGINE=MyISAM{$collation};
				");

			}

			if (!$this->db->field_exists('country', 'bankpipe_payments')) {
				$this->db->add_column('bankpipe_payments', 'country', 'varchar(8) NOT NULL DEFAULT \'\' AFTER `payer_id`');
			}

			if ($this->db->field_exists('bid', 'bankpipe_log')) {
				$this->db->rename_column('bankpipe_log', 'bid', 'bids', 'text');
			}

			$newSettings[] = [
				"name" => "bankpipe_cart_mode",
				"title" => $this->db->escape_string($this->lang->setting_bankpipe_cart_mode),
				"description" => $this->db->escape_string($this->lang->setting_bankpipe_cart_mode_desc),
				"optionscode" => "yesno",
				"value" => 1,
				"disporder" => 13,
				"gid" => $gid
			];

			$newSettings[] = [
				"name" => "bankpipe_required_fields",
				"title" => $this->db->escape_string($this->lang->setting_bankpipe_required_fields),
				"description" => $this->db->escape_string($this->lang->setting_bankpipe_required_fields_desc),
				"optionscode" => "text",
				"value" => '',
				"disporder" => 14,
				"gid" => $gid
			];

			$updateTemplates = 1;

		}

		// beta 4
		if (version_compare($this->oldVersion, 'beta 4', "<")) {

			if (!$this->db->field_exists('name', 'bankpipe_discounts')) {
				$this->db->add_column('bankpipe_discounts', 'name', 'varchar(128) DEFAULT NULL AFTER `gids`');
			}

		}

		// beta 5
		if (version_compare($this->oldVersion, 'beta 5', "<")) {

			if (!$this->db->field_exists('email', 'bankpipe_items')) {
				$this->db->add_column('bankpipe_items', 'email', 'TEXT AFTER `aid`');
			}

			$updateTemplates = 1;

		}

		// beta 6
		if (version_compare($this->oldVersion, 'beta 6', "<")) {
		
			$newSettings[] = [
				"name" => "bankpipe_notification_cc",
				"title" => $this->db->escape_string($this->lang->setting_bankpipe_notification_cc),
				"description" => $this->db->escape_string($this->lang->setting_bankpipe_notification_cc_desc),
				"optionscode" => "text",
				"value" => '',
				"disporder" => 11,
				"gid" => $gid
			];
		
			$newSettings[] = [
				"name" => "bankpipe_admin_notification_sender",
				"title" => $this->db->escape_string($this->lang->setting_bankpipe_admin_notification_sender),
				"description" => $this->db->escape_string($this->lang->setting_bankpipe_admin_notification_sender_desc),
				"optionscode" => "text",
				"value" => '',
				"disporder" => 13,
				"gid" => $gid
			];
		    
		    // Update logs type
		    $types = [
		        'created' => Orders::CREATE,
		        'refund' => Orders::REFUND,
		        'executed' => Orders::SUCCESS,
		        'error' => Orders::ERROR,
		        'pending' => Orders::PENDING
            ];
		    foreach ($types as $type => $new) {
    		    
    		    $this->db->update_query('bankpipe_log', [
        		    'type' => $new
    		    ], "type = '" . $type . "'");
    		    
		    }
		    
			$this->db->modify_column('bankpipe_log', 'type', "tinyint(1) NOT NULL");
			
			if (!$this->db->field_exists('type', 'bankpipe_items')) {
				$this->db->add_column('bankpipe_items', 'type', 'tinyint(1) NOT NULL AFTER `expirygid`');
			}
			
			if (!$this->db->field_exists('fee', 'bankpipe_payments')) {
				$this->db->add_column('bankpipe_payments', 'fee', 'decimal(6,2) NOT NULL AFTER `active`');
			}
			
			if (!$this->db->field_exists('currency', 'bankpipe_payments')) {
				$this->db->add_column('bankpipe_payments', 'currency', 'varchar(3) NOT NULL AFTER `fee`');
			}
			
			if (!$this->db->field_exists('discounts', 'bankpipe_payments')) {
				$this->db->add_column('bankpipe_payments', 'discounts', 'text AFTER `currency`');
			}
			
			if (!$this->db->field_exists('type', 'bankpipe_payments')) {
				$this->db->add_column('bankpipe_payments', 'type', 'tinyint(1) NOT NULL AFTER `discounts`');
			}
		    
		    // Update items type
		    $this->db->update_query('bankpipe_items', [
    		    'type' => Items::SUBSCRIPTION
		    ], "gid <> 0");
		    
		    $this->db->update_query('bankpipe_items', [
    		    'type' => Items::ATTACHMENT
		    ], "gid = 0");
			
			// Update payments type
		    $this->db->update_query('bankpipe_payments', [
    		    'type' => Orders::SUCCESS
		    ], "payment_id <> ''");
			
		    $this->db->update_query('bankpipe_payments', [
    		    'type' => Orders::MANUAL
		    ], "payment_id = ''");
			
			// Update payments currency
		    $this->db->update_query('bankpipe_payments', [
    		    'currency' => $this->mybb->settings['bankpipe_currency']
		    ]);

			$updateTemplates = 1;

		}

		if ($newSettings) {
			$this->db->insert_query_multiple('settings', $newSettings);
		}

		if ($dropSettings) {
			$this->db->delete_query('settings', "name IN ('bankpipe_". implode("','bankpipe_", $dropSettings) ."')");
		}

		rebuild_settings();

		if ($updateTemplates) {

			$PL or require_once PLUGINLIBRARY;

			// Update templates
			$dir       = new \DirectoryIterator(dirname(dirname(dirname(__FILE__))) . '/inc/plugins/BankPipe/templates');
			$templates = [];
			foreach ($dir as $file) {
				if (!$file->isDot() and !$file->isDir() and pathinfo($file->getFilename(), PATHINFO_EXTENSION) == 'html') {
					$templates[$file->getBasename('.html')] = file_get_contents($file->getPathName());
				}
			}

			$PL->templates('bankpipe', 'BankPipe', $templates);

		}

		// Update the current version number and redirect
		$this->shadePlugins[$this->info['name']]['version'] = $this->version;

		$this->cache->update('shade_plugins', $this->shadePlugins);

		flash_message($this->lang->sprintf($this->lang->bankpipe_success_updated, $this->oldVersion, $this->version), "success");
		admin_redirect('index.php');
	}
}