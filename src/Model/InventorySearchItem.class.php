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
         * Current Bin
         * @var string
         */
        protected $bin;

        /**
         * Current Bin Qty
         * @var int
         */
        protected $qty;
        
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
            'itemID'    => 'itemid',
            'serialnbr' => 'lotserial',
            'lotnbr'    => 'lotserial',
            'binID'     => 'bin'
        );
        
        /**
         * Item Type and the property / alias name that represents it
         * @var array
         */
        public static $itemtype_properties = array(
            'L' => 'lotnbr',
            'S' => 'serialnbr',
            'N' => 'itemid'
        );
        
        /**
         * Array of Item Types and their description
         *
         * @var array
         */
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
        
        /**
         * Returns the property needed to access the item's identifier
         * based on its item type
         * e.g. Lot Number / Serial Number / Item ID
         * @return string
         */
        public function get_itemtypeproperty() {
            return self::$itemtype_properties[$this->itemtype];
        }
        
        /**
         * Returns the description needed for this item based on its itemtype
         * @return string
         */
        public function get_itemtypepropertydesc() {
            return self::$itemtype_propertydesc[$this->itemtype];
        }
        
        /**
         * Returns item's identifer based on item type
         * e.g. Lot Number / Serial Number / Item ID
         * @return string
         */
        public function get_itemidentifier() {
            if ($this->is_serialized() || $this->is_lotted()) {
                return $this->lotserial;
            } else {
                return $this->itemid;
            }
        }
        
        /**
         * Loads an object of this class with the provided (Lot | Serial) Number
         * @param string $sessionID    Session Identifier
         * @param string $lotserial    Lot Number | Serial Number
         * @param bool   $debug        Run in debug? If so, return SQL Query
         * @return InventorySearchItem
         */
        static function load_from_lotserial($sessionID, $lotserial, $debug = false) {
            return get_invsearchitem_lotserial($sessionID, $lotserial, $debug);
        }

        /**
         * Returns the number of records that match the (Lot | Serial) Number and if needed bin ID
         * @param string $sessionID   Session Identifier
         * @param string $lotserial   Lot Number | Serial Number
         * @param string $binID       Bin ID
         * @param bool   $debug       Run in debug? If so, return SQL Query
         * @return int
         */
        static function count_from_lotserial($sessionID, $lotserial, $binID = '', $debug = false) {
            return count_invsearch_lotserial($sessionID, $lotserial, $binID, $debug);
        }

        /**
         * Loads an object of this class with the provided item ID from the provided Bin
         * @param string $sessionID Session Identifier
         * @param string $itemID    Item ID
         * @param string $binID     Bin ID
         * @param bool   $debug     Run in debug? If so, return SQL Query
         * @return InventorySearchItem
         */
        static function load_from_itemid($sessionID, $itemID, $binID = '', $debug = false) {
            return get_invsearchitem_itemid($sessionID, $itemID, $binID, $debug);
        }

        /**
         * Returns the number of records that match the item ID and if needed bin ID
         * @param string $sessionID Session Identifier
         * @param string $itemID    Item ID
         * @param string $binID     Bin ID
         * @param bool   $debug     Run in debug? If so, return SQL Query
         * @return int
         */
        static function count_from_itemid($sessionID, $itemID, $binID = '', $debug = false) {
            return count_invsearch_itemid($sessionID, $itemID, $binID, $debug);
        }

        /**
         * Returns an array of InventorySearch Items that were found
         * @param string $sessionID Session Identifier
         * @param bool   $debug     Run in debug? If so, return SQL Query
         * @return array
         */
        static function get_all($sessionID, $debug = false) {
            return get_invsearchitems($sessionID, $debug);
        }

        /**
         * Returns the number of all the records found regardless of Item Type, and Identifier
         * @param string $sessionID Session Identifier
         * @param bool   $debug     Run in debug? If so, return SQL Query
         * @return int
         */
        static function count_all($sessionID, $debug = false) {
            return count_invsearch($sessionID, $debug);
        }

         /**
         * Returns the first record found in the DB
         * // NOTE Should ONLY be used if there's one record in the table
         * @param string $sessionID Session Identifier
         * @param bool   $debug     Run in debug? If so, return SQL Query
         * @return InventorySearchItem
         */
        static function load_first($sessionID, $debug = false) {
            return get_firstinvsearchitem($sessionID, $debug);
        }
    }
