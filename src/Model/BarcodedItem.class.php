<?php
    /**
     * Class for dealing and getting information from Barcode Items
     */
    class BarcodedItem {
        use \Dplus\Base\ThrowErrorTrait;
		use \Dplus\Base\MagicMethodTraits;
		use \Dplus\Base\CreateFromObjectArrayTraits;
		use \Dplus\Base\CreateClassArrayTraits;
        
        /**
         * Barcode Number
         * @var string
         */
        protected $barcodenbr;
        
        /**
         * Item ID
         * @var string
         */
        protected $itemid;
        
        /**
         * Is this the Primary Item
         * @var string Y | N
         */
        protected $primary;
        
        /**
         * Qty For Barcode
         * @var int
         */
        protected $unitqty;
        
        /**
         * Unit of Measurement
         * @var string
         */
        protected $uom;
        
        /**
         * Aliases for Class Properties
         * @var array
         */
        protected $fieldaliases = array(
            'qty' => 'unitqty',
            'itemid' => 'itemnbr',
            'itemiID' => 'itemnbr'
        );
        
        /**
         * Returns if Item is Primary / base Item
         * @return bool Is Item Primary / base Item ?
         */
        public function is_primary() {
            return $this->primary == 'Y' ? true : false;
        }
        
        /**
         * Returns Barcoded Item
         * @param string $barcode  UPC / Barcode for Item
         * @param bool   $debug    Run in debug? If so return SQL Query
         * @return BarcodedItem
         */
        public static function load($barcode, $debug = false) {
            return get_barcodeditem($barcode, $debug);
        }
        
        /**
         * Returns ItemID for barcode
         * @param string $barcode UPC / Barcode for Item
         * @param bool   $debug   Run in debug? If so return SQL Query
         * @return void
         */
        public static function find_barcodeitemid($barcode, $debug = false) {
            return get_barcodeditemid($barcode, $debug);
        }
    }
