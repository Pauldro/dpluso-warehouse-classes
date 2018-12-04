<?php
    use Dplus\ProcessWire\DplusWire;

    class BinrSession {
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
         * Login ID
         * @var string
         */
        protected $loginid;

        /**
         * Warehouse ID
         * @var string
         */
        protected $whseid;

        /**
         * Item ID
         *
         * @var string
         */
        protected $itemid;

        /**
         * Item Type
         * @var string
         */
        protected $itemtype;

        /**
         * Lot / Serial Number
         * @var string
         */
        protected $lotserial;

        /**
         * From Bin ID
         * @var string
         */
        protected $frombin;

        /**
         * Quantity in From Bin
         * @var int
         */
        protected $frombinqty;

        /**
         * To Bin ID
         * @var string
         */
        protected $tobin;

         /**
         * Quantity in To Bin
         * @var int
         */
        protected $tobinqty;

        /**
         * BINR function
         * BINR | PUTAWAY
         * @var string
         */
        protected $function;

        /**
         * Status Message
         * @var string
         */
        protected $status;

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
         * Returns Item Url to page
         * @param string $itemproperty Item Property ex. itemid, lotnbr, serialnbr
         * @param string $identifier
         * @return string
         */
        static function get_binritemURL($itemproperty, $identifier) {
            $url = new Purl\Url(DplusWire::wire('config')->pages->binr);
            $url->query->set($itemproperty, $identifier);
            return $url->getUrl();
        }
        
        /**
         * Returns Item Url to page
         * @param string $itemID       Item ID
         * @param string $itemproperty Item Property ex. itemid, lotnbr, serialnbr
         * @param string $identifier
         * @return string
         */
        static function get_binritembinsURL($itemID, $itemproperty, $identifier) {
            $url = new Purl\Url(DplusWire::wire('config')->pages->menu_binr);
            $url->path->add('redir');
            $url->query->set('action','search-item-bins');
            $url->query->set('itemID', $itemID);
            $url->query->set($itemproperty, $identifier);
            $url->query->set('page', DplusWire::wire('page')->fullURL->getUrl());
            return $url->getUrl();
        }

        /**
         * Returns if there's a Binr session Record in the database
         * @param  string $sessionID Session Identifier
         * @param  bool   $debug     Run in debug? If so return SQL Query
         * @return bool
         */
        static function does_exist($sessionID, $debug = false) {
            return does_binrsessionexist($sessionID, $debug);
        }

        /**
         * Returns BinrSession
         * @param  string $sessionID Session Identifier
         * @param  bool   $debug     Run in debug? If so return SQL Query
         * @return BinrSession
         */
        static function load($sessionID, $debug = false) {
            return get_binrsession($sessionID, $debug);
        }
    }
