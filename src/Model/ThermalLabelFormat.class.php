<?php
	use Dplus\Base\ThrowErrorTrait;
	use Dplus\Base\MagicMethodTraits;
	use Dplus\Base\CreateFromObjectArrayTraits;
	use Dplus\Base\CreateClassArrayTraits;

	/**
	 * Class for a Record in the thermalformatlabell table for Whse Printers
	 */
	class ThermalLabelFormat {
		use ThrowErrorTrait;
		use MagicMethodTraits;
		use CreateFromObjectArrayTraits;
		use CreateClassArrayTraits;

		/**
		 * Label ID
		 *
		 * @var string
		 */
		protected $id;

		/**
		 * Label Description
		 *
		 * @var string
		 */
		protected $desc;

		/**
		 * Label Width
		 * // NOTE IN inches
		 * @var float
		 */
		protected $width;

		/**
		 * Label Length
		 * // NOTE IN inches
		 * @var float
		 */
		protected $length;
		
		/**
		 * Returns a list of Thermal Label Formats
		 * @param  bool   $debug Run in debug? If so return SQL Query
		 * @return mixed         Array <ThermalLabelFormat> | SQL Query
		 */
		static function find_formats($debug = false) {
			return find_thermalformatlabel_formats($debug);
		}

		/**
		 * Returns a Thermal Printer Label Format
		 * @param  string $formatID Thermal Printer format ID
		 * @param  bool   $debug    Run in debug? If so return SQL Query
		 * @return mixed            Array <ThermalLabelFormat> | SQL Query
		 */
		static function load($formatID, $debug = false) {
			return get_thermalformatlabel_format($formatID, $debug);
		}
	}