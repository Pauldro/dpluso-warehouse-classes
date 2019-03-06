<?php
	namespace Dplus\Warehouse;

	/**
	 * External Libraries
	 */
	use Purl\Url;

	/**
	 * Internal Libraries
	 */
	use Dplus\ProcessWire\DplusWire;
	use Dplus\Base\ThrowErrorTrait;
	use Dplus\Base\MagicMethodTraits;

	/**
	 * Class for providing Functions Necessary for Label Printing
	 */
	class LabelPrinting {
		use ThrowErrorTrait;
		use MagicMethodTraits;

		/**
		 * Returns URL to request initalize label print for Item
		 * @param  string $itemID       Item ID
		 * @param  string $itemproperty Item Property ex. itemid, lotnbr, serialnbr
		 * @param  string $identifier   Item Property value ex. Item's Lot Serial / Item ID
		 * @return string               Request Initialize Item Label Print
		 */
		public function get_request_labelprintinitURL($itemID, $itemproperty, $identifier) {
			$url = new Url(DplusWire::wire('config')->pages->inventory_printitemlabel);
			$url->query->set('itemID', $itemID);
			$url->query->set($itemproperty, $identifier);
			return $url->getUrl();
		}
	}
