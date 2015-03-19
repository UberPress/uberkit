<?php

namespace UK\Util;

abstract class BitwiseFlag
{
    protected $_flags = 0;

    protected function isFlagSet($flag)
    {
        return (($this->_flags & $flag) == $flag);
    }

    protected function setFlag($flag, $value = true)
    {
        if($value)
            $this->_flags |= $flag;
        else
            $this->_flags &= ~$flag;
    }
}
