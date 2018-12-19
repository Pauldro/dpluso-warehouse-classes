<?php
	namespace Dplus\Warehouse;

	use Purl\Url;
	use Dplus\ProcessWire\DplusWire;
	
	/**
	 * Use Statements for Model Classes which are non-namespaced
	 */
	use WhseSession, InventorySearchItem;

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
		
		/**
		 * Sets the $item
		 * @param InventorySearchItem $item
		 */
		public function set_item(InventorySearchItem $item) {
			$this->item = $item;
		}
		
		/**
		 * Sets the $item
		 * @param string $binID
		 */
		public function set_bin($binID) {
			$this->binID = $binID;
		}
		
		/**
		 * Constructor
		 * @param string $sessionID Session Identifier
		 * @param Url    $pageurl   Page URL
		 */
		public function __construct($sessionID, Url $pageurl) {
			$this->url = new Url($pageurl->getUrl());
			$this->sessionID = $sessionID;
		}
		
		
		public function get_choose_itemURL($itemproperty, $identifier) {
			$url = new Url(DplusWire::wire('config')->pages->inventory_physicalcount);
			$url->query->set('binID', $this->binID);
            $url->query->set($itemproperty, $identifier);
            return $url->getUrl();
		}
	}
