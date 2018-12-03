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
         * Returns an array of ItemBinInfo pertaining to all the bins that 
         * store this Item ID
         * @param  string $sessionID  Session Identifier
         * @param  string $itemID     Item ID to Locate 
         * @param  bool   $debug      Run in debug? If so, return SQL Query
         * @return array
         */
        static function find_by_itemid($sessionID, $itemID, $debug) {
            return get_itembinfo_itemid($sessionID, $itemID, $debug);
        }

        /**
         * Returns an array of ItemBinInfo pertaining to all the bins that 
         * store this Lot Number
         * @param  string $sessionID  Session Identifier
         * @param  string $lotnbr     Lot Number to Locate 
         * @param  bool   $debug      Run in debug? If so, return SQL Query
         * @return array
         */
        static function find_by_lotnbr($sessionID, $lotnbr, $debug) {
            return get_itembinfo_lotnbr($sessionID, $lotnbr, $debug);
        }

        /**
         * Returns an Instance of ItemBinInfo pertaining to the location of this Serial Number
         * // NOTE Returns Single Object, because Serialized Items are individual
         * @param  string $sessionID   Session Identifier
         * @param  string $serialnbr   Serial Number to Locate 
         * @param  bool   $debug       Run in debug? If so, return SQL Query
         * @return array
         */
        static function get_by_serialnbr($sessionID, $serialnbr, $debug) {
            return get_itembinfo_serialnbr($sessionID, $serialnbr, $debug);
        }
    }
