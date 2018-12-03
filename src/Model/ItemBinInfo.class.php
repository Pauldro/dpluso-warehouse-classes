<?php
    /**
     * Class for Extracting Bin Locations for Items
     * Based off the binfo Table
     */
    class ItemBinInfo extends ModelClass {
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
         * Warehouse Code
         * @var string
         */
        protected $whse;

        /**
         * Item ID
         * @var string
         */
        protected $itemid;

         /**
         * Lot Number / Serial Number
         * @var string
         */
        protected $lotserial;

        /**
         * Lot Reference
         * @var string
         */
        protected $lotref;

        /**
         * Bin ID
         * @var string
         */
        protected $bin;

        /**
         * Bin Qty
         * @var int
         */
        protected $qty;

        /**
         * Date Updated
         * @var int
         */
        protected $date;

        /**
         * Time Updated
         * @var int
         */
        protected $time;

        /**
         * Property aliases
         * @var array
         */
        protected $fieldaliases = array(
            'id'    => 'bin',
            'binid' => 'bin',
            'binID' => 'bin'
        );

        /**
         * Returns an array of ItemBinInfo pertaining to all the bins that 
         * store this Item ID
         * @param  string $sessionID  Session Identifier
         * @param  string $itemID     Item ID to Locate 
         * @param  bool   $debug      Run in debug? If so, return SQL Query
         * @return array
         */
        static function find_by_itemid($sessionID, $itemID, $debug = false) {
            return get_bininfo_itemid($sessionID, $itemID, $debug);
        }

        /**
         * Returns an array of ItemBinInfo pertaining to all the bins that 
         * store this Lot Number
         * @param  string $sessionID  Session Identifier
         * @param  string $lotnbr     Lot Number to Locate 
         * @param  bool   $debug      Run in debug? If so, return SQL Query
         * @return array
         */
        static function find_by_lotnbr($sessionID, $lotnbr, $debug = false) {
            return get_bininfo_lotserial($sessionID, $lotnbr, $debug);
        }

        /**
         * Returns an Instance of ItemBinInfo pertaining to the location of this Serial Number
         * // NOTE Returns 1 in array because Serialized Items are individual
         * @param  string $sessionID   Session Identifier
         * @param  string $serialnbr   Serial Number to Locate 
         * @param  bool   $debug       Run in debug? If so, return SQL Query
         * @return array
         */
        static function find_by_serialnbr($sessionID, $serialnbr, $debug = false) {
            return get_bininfo_lotserial($sessionID, $serialnbr, $debug);
        }
        
        /**
         * REturns an array of this class pertaining to all the bins that contain this item
         * @param  string              $sessionID Session Identifier
         * @param  InventorySearchItem $item      Item to find bins for
         * @param  bool                $debug     Run in debug? If so, return SQL Query
         * @return array                          Bins that contain this item
         */
        static function find_by_item($sessionID, InventorySearchItem $item, $debug = false) {
            if ($item->is_lotted()) {
                return self::find_by_lotnbr($sessionID, $item->lotserial, $debug);
            } elseif ($item->is_serialized()) {
                return self::find_by_serialnbr($sessionID, $item->lotserial, $debug);
            } else {
                return self::find_by_itemid($sessionID, $item->itemid, $debug);
            }
        }
    }
