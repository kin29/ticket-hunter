<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use Kin29\TicketHunter\Exception\LogicException;

class TicketHunter
{
    use Format;

    public $arrVendorObj = [];

    public function __construct(array $arrVendorName, string $keyWord)
    {
        foreach ($arrVendorName as $vendorName) {
            $className = __NAMESPACE__ . '\\Seller\\' . $vendorName;
            if (!class_exists($className)) {
                throw new LogicException("Class \"{$className}\" not found\n");
            }
            $this->arrVendorObj[$vendorName] = new $className($keyWord);
        }
    }

    public function getList() : array
    {
        $vendorList = [];
        foreach ($this->arrVendorObj as $name => $obj) {
            $vendorList[$name] = $obj->getList();
        }

        return $vendorList;
    }
}
