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
    }
