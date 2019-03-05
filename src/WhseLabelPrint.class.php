<?php
	namespace Dplus\Warehouse;

	class WhseLabelPrint {
		use \Dplus\Base\ThrowErrorTrait;
		use \Dplus\Base\MagicMethodTraits;
		use \Dplus\Base\CreateFromObjectArrayTraits;
		use \Dplus\Base\CreateClassArrayTraits;
		
		/**
         * Returns Item Url to page
         * @param string $itemproperty Item Property ex. itemid, lotnbr, serialnbr
         * @param string $identifier
         * @return string
         */
        public function get_itemURL($itemproperty, $identifier) {
            $url = new Url(DplusWire::wire('config')->pages->inventory_printitemlabel);
            $url->query->set($itemproperty, $identifier);
            return $url->getUrl();
        }
	}