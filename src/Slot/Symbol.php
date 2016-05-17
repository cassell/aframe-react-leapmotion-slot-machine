<?php
namespace Cassell\Casino\Slot;

class Symbol
{
    private $name = "";

    /**
     * Symbol constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
