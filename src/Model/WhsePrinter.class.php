<?php
	use Dplus\Base\ThrowErrorTrait;
	use Dplus\Base\MagicMethodTraits;
	use Dplus\Base\CreateFromObjectArrayTraits;
	use Dplus\Base\CreateClassArrayTraits;

	/**
	 * Class for a Record in the prntctrl table for Whse Printers
	 */
	class WhsePrinter {
		use ThrowErrorTrait;
		use MagicMethodTraits;
		use CreateFromObjectArrayTraits;
		use CreateClassArrayTraits;

		/**
		 * Printer ID
		 *
		 * @var string
		 */
		protected $id;

		/**
		 * Printer Description
		 *
		 * @var string
		 */
		protected $desc;

		/**
		 * Warehouse ID
		 * @var string
		 */
		protected $whse;
		
		/**
		 * Returns a list of Printers from the prntctrl table
		 * @param  string $whseID  Warehouse ID to limit Printers
		 * @param  bool   $debug   Run in debug? If so return SQL Query
		 * @return mixed           Array <WhsePrinter> | SQL Query
		 */
		static function find_printers($whseID = '', $debug = false) {
			return find_prntctrl_printers($whseID, $debug);
		}

		/**
		 * Returns a Printer from the prntctrl table
		 * @param  string $printerID  Printer ID
		 * @param  string $whseID     Warehouse ID to limit Printer
		 * @param  bool   $debug      Run in debug? If so return SQL Query
		 * @return mixed              WhsePrinter | SQL Query
		 */
		static function load($printerID, $whseID, $debug = false) {
			return get_prntctrl_printer($printerID, $whseID, $debug);
		}
	}