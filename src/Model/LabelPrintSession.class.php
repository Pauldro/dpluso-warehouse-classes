<?php
	use Dplus\Base\ThrowErrorTrait;
	use Dplus\Base\MagicMethodTraits;
	use Dplus\Base\CreateFromObjectArrayTraits;
	use Dplus\Base\CreateClassArrayTraits;

	/**
	  * Class for Saving Bin Label Information for printing
	  * Based off the itemcartonlabel Table
	*/
	 class LabelPrintSession extends ModelClass {
		use ThrowErrorTrait;
		use MagicMethodTraits;
		use CreateFromObjectArrayTraits;
		use CreateClassArrayTraits;

		/**
		 * Session Identifier
		 * @var string
		*/
		protected $sessionid;

		/**
		 * Date YYYYMMDD
		 * @var int
		*/
		protected $date;

		/**
		 * Time HHMMSS
		 * @var int
		*/
		protected $time;

		/**
		 * Item ID
		 * @var string
		 */
		protected $itemid;

		/**
		 * Warehouse ID
		 * @var string
		 */
		protected $whse;

		/**
		 * Item Lot / Serial Number
		 * @var string
		 */
		protected $lotserial;

		/**
		 * Bin ID
		 * @var string
		 */
		protected $bin;

		/**
		 * Label Type to use for Box
		 * @var string
		 */
		protected $label_box;

		/**
		 * Printer ID to use for Box
		 * @var string
		 */
		protected $printer_box;

		/**
		 * Number of boxes
		 * @var string
		 */
		protected $qty_box;

		/**
		 * Number of box Labels to Print
		 * @var string
		 */
		protected $nbr_box_labels;

		/**
		 * Label Type to use for Master Pack
		 * @var string
		 */
		protected $label_master;

		/**
		 * Printer ID to use for Master Pack
		 * @var string
		 */
		protected $printer_master;

		/**
		 * Number of Master Packs
		 * @var string
		 */
		protected $qty_master;

		/**
		 * Number of Master Pack Labels to Print
		 * @var string
		 */
		protected $nbr_master_labels;

		/**
		 * Returns if a itemcartonlabel record exists
		 * @param  string $sessionID  Session Identifier
		 * @param  bool   $debug      Run in debug? If so, return SQL Query
		 * @return bool               Is there a itemcartonlabel record for this session?
		 */
		static function exists($sessionID, $debug = false) {
			return does_itemcartonlabel_session_exist($sessionID, $debug);
		}

		/**
		 * Returns instance of this class from itemcartonlabel table
		 * @param  string $sessionID  Session Identifier
		 * @param  bool   $debug      Run in debug? If so, return SQL Query
		 * @return LabelPrintSession
		 */
		static function load($sessionID, $debug = false) {
			return get_itemcartonlabel_session($sessionID, $debug);
		}

		/**
		 * Updates / Inserts a record the itemcartonlabel table with Instance values
		 * @param  bool $debug  Run in debug? If so, return SQL Query
		 * @return bool         Was Record able to be saved?
		 */
		public function save($debug = false) {
			if (self::exists($this->sessionid)) {
				$this->update($debug);
			} else {
				$this->create($debug);
			}
		}

		/**
		 * Inserts a record the itemcartonlabel table with Instance values
		 * @param  bool $debug  Run in debug? If so, return SQL Query
		 * @return bool         Was Record able to be inserted?
		 */
		public function create($debug = false) {
			return insert_itemcartonlabel_session($this->sessionid, $this, $debug);
		}

		/**
		 * Updates a record the itemcartonlabel table with Instance values
		 * @param  bool $debug  Run in debug? If so, return SQL Query
		 * @return bool         Was Record able to be updated?
		 */
		public function update($debug = false) {
			return update_itemcartonlabel_session($this->sessionid, $this, $debug);
		}

		/**
		 * Mainly called by the _toArray() function which makes an array
		 * based of the properties of the class, but this function filters the array
		 * to remove keys that are not in the database
		 * This is used by database classes for update
		 * @param  array $array array of the class properties
		 * @return array        with certain keys removed
		 */
		public static function remove_nondbkeys($array) {
			return $array;
		}
	}
