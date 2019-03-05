<?php
    /**
     * Class for Extracting Bin Locations for Items
     * Based off the binfo Table
     */
    class LabelPrintSession extends ModelClass {
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
         * Date YYYYMMDD
         * @var int
         */
        protected $date;
        
        /**
         * Time HHMMSS
         * @var int
         */
        protected $time;
        
	   protected $itemid;
	   
	   protected $whse;

	   protected $lotserial;

	   protected $bin;

	   protected $label_box;

	   protected $printer_box;
	   
	   protected $qty_box;

	   protected $nbr_box_labels;

	   protected $label_master;

	   protected $printer_master;

	   protected $qty_master;

	   protected $nbr_master_labels;
	}