<?php
    namespace Dplus\Warehouse;

    use Purl\Url;
    use Dplus\ProcessWire\DplusWire;
    
    /**
	 * Use Statements for Model Classes which are non-namespaced
	 */
    use Pick_SalesOrder, Pick_SalesOrderDetail, WhseSession;

    /**
     * Class for Displaying Orders to be Picked
     */
    class PhysicalCount {
        use \Dplus\Base\ThrowErrorTrait;
		use \Dplus\Base\MagicMethodTraits;
		use \Dplus\Base\CreateFromObjectArrayTraits;
		use \Dplus\Base\CreateClassArrayTraits;
       
        /**
         * Bin ID
         * @var string
         */
       protected $binID;

       /**
        * Item
        * @var InventorySearchItem
        */
       protected $item;


    }
