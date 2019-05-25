<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

class TicketHunter
{
    use Format;

    public $arrVendorObj = [];

    public function __construct(array $arrVendorName, string $keyWord)
    {
        foreach ($arrVendorName as $vendorName) {
            $className = __NAMESPACE__ . '\\Seller\\' . $vendorName;
            $this->arrVendorObj[$vendorName] = new $className($keyWord);
        }
    }

    public function getList() : array
    {
        foreach ($this->arrVendorObj as $name => $obj) {
            $vendorList[$name] = $obj->getList();
        }

        return $vendorList;
    }
}
