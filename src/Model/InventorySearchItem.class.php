<?php
    class InventorySearchItem {
        use \Dplus\Base\ThrowErrorTrait;
		use \Dplus\Base\MagicMethodTraits;
		use \Dplus\Base\CreateFromObjectArrayTraits;
        use \Dplus\Base\CreateClassArrayTraits;
        
        /**
         * Session Identifier
         * @var string
         */
        protected $sessionid;

        /**
         * Item ID / Item Nbr
         * @var string
         */
        protected $itemid;

         /**
         * Cross Reference Item ID / Nbr / Barcode
         * @var string
         */
        protected $xitemid;

        /**
         * Cross Reference Origin
         * item = Item Master
         * cust = Customer Item Cross Reference
         * vend = Vendor Item Cross Reference
         * seri = Serial Master
         * lotm = Lot Item Master
         * upcx = UPC Item Master
         *
         * @var string
         */
        protected $xorigin;

        /**
         * Item Type
         * N = Normal
         * S = Serialized
         * L = Lotted
         * P = Price Only
         * @var string
         */
        protected $itemtype;

        /**
         * Lot Number / Serial Number
         * Item Type   Value
         * L           Lot Number
         * S           Serial Number
         * @var string
         */
        protected $lotserial;

        /**
         * Description 1
         * @var string
         */
        protected $desc1;

        /**
         * Description 1
         * @var string
         */
        protected $desc2;
        
        /**
         * Primary Bin
         * @var string
         */
        protected $primarybin;

        /**
         * Date
         * @var int
         */
        protected $date;

         /**
         * Date
         * @var int
         */
        protected $time;


        /**
         * Aliases for Class Properties
         * @var array
         */
        protected $fieldaliases = array(
            'qty'       => 'unitqty',
            'itemID'    => 'itemid',
            'serialnbr' => 'lotserial',
            'lotnbr'    => 'lotserial'
        );
        
        
        public static $itemtype_properties = array(
            'L' => 'lotnbr',
            'S' => 'serialnbr',
            'N' => 'itemid'
        );
        
        public static $itemtype_propertydesc = array(
            'L' => 'lot number',
            'S' => 'serial number',
            'N' => 'item id'
        );

        /**
         * Returns if Item is a serialized item
         * @return bool
         */
        public function is_serialized() {
            return $this->itemtype == 'S';
        }

        /**
         * Returns if Item is a lotted item
         * @return bool
         */
        public function is_lotted() {
            return $this->itemtype == 'L';
        }

        /**
         * Returns if Item is a Normal Inventory item
         * @return bool
         */
        public function is_normal() {
            return $this->itemtype == 'N';
        }

        /**
         * Returns if Item is a Normal Inventory item
         * @return bool
         */
        public function is_priceonly() {
            return $this->itemtype == 'P';
        }
        
        public function get_itemtypeproperty() {
            return self::$itemtype_properties[$this->itemtype];
        }
        
        public function get_itemtypepropertydesc() {
            return self::$itemtype_propertydesc[$this->itemtype];
        }
        
        public function get_itemidentifier() {
            if ($this->is_serialized() || $this->is_lotted()) {
                return $this->lotserial;
            } else {
                return $this->itemid;
            }
        }
        
        /**
         * Loads an object of this class with the provided lot number
         * @param string $sessionID Session Identifier
         * @param string $lotnbr    Lot Number
         * @param bool   $debug     Run in debug? If so, return SQL Query
         * @return InventorySearchItem
         */
        static function load_from_lotnbr($sessionID, $lotnbr, $debug = false) {
            return get_invsearchitem_lotserial($sessionID, $lotnbr, $debug);
        }
        
        /**
         * Loads an object of this class with the provided serial number
         * @param string $sessionID  Session Identifier
         * @param string $serialnbr  Serial Number
         * @param bool   $debug      Run in debug? If so, return SQL Query
         * @return InventorySearchItem
         */
        static function load_from_serialnbr($sessionID, $serialnbr, $debug = false) {
            return get_invsearchitem_lotserial($sessionID, $serialnbr, $debug);
        }
        

        /**
         * Loads an object of this class with the provided item ID
         * @param string $sessionID Session Identifier
         * @param string $itemid    Item ID
         * @param bool   $debug     Run in debug? If so, return SQL Query
         * @return InventorySearchItem
         */
        static function load_from_itemid($sessionID, $itemID, $debug = false) {
            return get_invsearchitem_itemid($sessionID, $itemID, $debug);
        }
    }
