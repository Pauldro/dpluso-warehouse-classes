<?php
    class WarehouseConfig {
        use \Dplus\Base\ThrowErrorTrait;
		use \Dplus\Base\MagicMethodTraits;
		use \Dplus\Base\CreateFromObjectArrayTraits;
        use \Dplus\Base\CreateClassArrayTraits;
        
        /**
         * Warehouse ID
         * @var string 2 char
         */
        protected $whseID;

        /**
         * Warehouse Name
         * @var string
         */
        protected $whsename;

        /**
         * Warehouse Address
         * @var string
         */
        protected $whseadr;

        /**
         * Warehouse Address 2
         * @var string
         */
        protected $whseadr2;

        /**
         * Warehouse City
         * @var string
         */
        protected $whsecity;

        /**
         * Warehouse State
         * @var string
         */
        protected $whsestat;

        /**
         * Warehouse Zipcode
         * @var string
         */
        protected $whsezipcode;

        /**
         * Warehouse Country
         * @var string
         */
        protected $whsectry;

        /**
         * Does Warehouse Use Handhelds
         *
         * @var string Y | N
         */
        protected $whseusehandheld;

        /**
         * Is Warehouse for Cash Customers?
         * @var string
         */
        protected $whsecashcust;

        /**
         * Is Warehouse for detail picking?
         * @var string
         */
        protected $whsepickdtl;

        /**
         * Warehouse Production Bin
         * @var string
         */
        protected $whseprodbin;

        /**
         * Warehouse Phone
         * @var string
         */
        protected $whsephone;

        /**
         * Warehouse Phone Extension
         * @var string
         */
        protected $whsephoneext;

        /**
         * Warehouse Fax
         * @var string
         */
        protected $whsefax;

        /**
         * Warehouse Email
         * @var string
         */
        protected $whseemailadr;

        /**
         * Warehouse QC Bin
         * @var string
         */
        protected $whseqcrgabin;

        /**
         * RF Printer 1
         * @var string
         */
        protected $whserfprinter1;

        /**
         * RF Printer 2
         * @var string
         */
        protected $whserfprinter2;

        /**
         * RF Printer 3
         * @var string
         */
        protected $whserfprinter3;

        /**
         * RF Printer 4
         * @var string
         */
        protected $whserfprinter4;

        /**
         * RF Printer 5
         * @var string
         */
        protected $whserfprinter5;

        /**
         * Warehouse ?
         * @var string
         */
        protected $whseprofwhse;

        /**
         * Warehouse ?
         * @var string
         */
        protected $whseasetwhse;

        /**
         * Is warehouse for consignments?
         * @var string Y | N
         */
        protected $whseconsignwhse;

        /**
         * Which Warehouse Supplys this Warehouse
         * @var string 
         */
        protected $whsesupplywhse;

        /**
         * Are Bins Ranged or Listed
         * L Listed | R Ranged
         * @var string 
         */
        protected $whsebinrangelist;
        
        /**
         * Aliases for properties
         *
         * @var array
         */
        protected $fieldaliases =  array(
            'id'             => 'whseid',
            'name'           => 'whsename',
            'address'        => 'whseadr',
            'address2'       => 'whseadr2',
            'city'           => 'whsecity',
            'state'          => 'whsestat',
            'zipcode'        => 'whsezipcode',
            'country'        => 'whsectry',
            'usehandheld'    => 'whseusehandheld',
            'cashcustomer'   => 'whsecashcust',
            'can_pickdetail' => 'whsepickdtl',
            'productionbin'  => 'whseprodbin',
            'phone'          => 'whsephone',
            'extension'      => 'whsephoneext',
            'fax'            => 'whsefax',
            'email'          => 'whseemailadr',
            'qcbin'          => 'whseqcrgabin',
            'rfprinter1'     => 'whserfprinter1',
            'rfprinter2'     => 'whserfprinter2',
            'rfprinter3'     => 'whserfprinter3',
            'rfprinter4'     => 'whserfprinter4',
            'rfprinter5'     => 'whserfprinter5',
            'profwhse'       => 'whseprofwhse',
            'asetwhse'       => 'whseasetwhse',
            'is_consignment' => 'whseconsignwhse',
            'supplywhse'     => 'whsesupplywhse',
            'binrange'       => 'whsebinrangelist'
        );

        /**
         * Returns if Bins are Ranged
         * @return bool
         */
        public function are_binsranged() {
            return $this->whsebinrangelist == 'R';
        }

        /**
         * Returns if Bins are Listed
         * @return bool
         */
        public function are_binslisted() {
            return $this->whsebinrangelist == 'L';
        }

        /**
         * Returns bin range
         *
         * @param bool $debug Run in debug? If so, return SQL Query
         * @return WarehouseBin
         */
        public function get_binrange($debug = false) {
            return WarehouseBin::get_binrange($this->whseid, $debug);
        }

        /**
         * Returns bin list
         *
         * @param bool $debug Run in debug? If so, return SQL Query
         * @return array WhseBin
         */
        public function get_binlist($debug = false) {
            return WarehouseBin::get_binlist($this->whseid, $debug);
        }

        /**
         * Returns WhseConfig
         * @param string $whseID
         * @param bool   $debug   Run in debug? If so, return SQL Query
         * @return WarehouseConfig
         */
        static function load($whseID, $debug = false) {
            return get_whsetbl($whseID, $debug);
        }
    }

    /**
     * Class for Warehouse Bins
     * If the Bins are ranged then there's only one record in the table, and the from through values are needed
     * If the bins are listed then there are multiple records with the frombins being the bin id, 
     */
    class WarehouseBin {
        /**
         * Warehouse ID
         *
         * @var string
         */
        protected $warehouse;

        /**
         * Range Start
         *
         * @var string
         */
        protected $binfrom;

        /**
         * Range End
         *
         * @var string
         */
        protected $binthru;

        /**
         * Bin Type
         *
         * @var string
         */
        protected $bintype;

        /**
         * Bin Area
         *
         * @var string
         */
        protected $binarea;

        /**
         * Bin Description
         *
         * @var string
         */
        protected $bindesc;

        /**
         * Property Aliases
         *
         * @var string
         */
        protected $fieldaliases = array(
            'whseid'  => 'warehouse',
            'whseID'  => 'warehouse',
            'from'    => 'binfrom',
            'through' => 'binthrough',
            'type'    => 'bintype',
            'area'    => 'binarea',
            'desc'    => 'bindesc',
        );

        /**
         * Returns bin range
         * @param bool $whseID Warehouse ID
         * @param bool $debug  Run in debug? If so, return SQL Query
         * @return WhseBin
         */
        static function get_binrange($whseID, $debug = false) {
            return get_bnctl_range($whseID, $debug);
        }

        /**
         * Returns bin list
         * @param bool $whseID Warehouse ID
         * @param bool $debug  Run in debug? If so, return SQL Query
         * @return array WhseBin
         */
        static function get_binlist($whseID, $debug = false) {
            return get_bnctl_list($whseID, $debug);
        }
    }
