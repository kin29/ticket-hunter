<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use Kin29\TicketHunter\Exception\LogicException;

class TicketHunter
{
    use Format;

    public $arrVendorObj = [];

    public function __construct(array $arrVendorName)
    {
        foreach ($arrVendorName as $vendorName) {
            $className = __NAMESPACE__ . '\\Seller\\' . $vendorName;
            if (!class_exists($className)) {
                throw new LogicException("Class \"{$className}\" not found\n");
            }
            $this->arrVendorObj[$vendorName] = new $className;
        }
    }

    public function getList(string $keyWord) : array
    {
        $vendorList = [];
        foreach ($this->arrVendorObj as $name => $obj) {
            $vendorList[$name] = $obj->setKeyword($keyWord)->getList();
        }

        return $vendorList;
    }
}
