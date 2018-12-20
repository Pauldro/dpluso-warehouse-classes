<?php
    namespace Dplus\Warehouse;

    use Dplus\ProcessWire\DplusWire;
    use Purl\Url;

    /**
	 * Use Statements for Model Classes which are non-namespaced
	 */
    use InventorySearchItem;
    
    /**
     * Class for Providing functions necessary for Bin Reassignment
     */
    class Binr {
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
            $url = new Url(DplusWire::wire('config')->pages->binr);
            $url->query->set($itemproperty, $identifier);
            return $url->getUrl();
        }
        
        /**
         * Returns Item Url to request bins for the items
         * @param InventorySearchItem $item       Item
         * @return string
         */
        public function get_item_binsURL(InventorySearchItem $item) {
            $url = new Url(DplusWire::wire('config')->pages->menu_binr);
            $url->path->add('redir');
            $url->query->set('action','search-item-bins');
            $url->query->set('itemID', $item->itemid);
            $url->query->set($item->get_itemtypeproperty(), $item->get_itemidentifier());
            $url->query->set('binID', $item->bin);
            $url->query->set('page', DplusWire::wire('page')->fullURL->getUrl());
            return $url->getUrl();
        }
    }
