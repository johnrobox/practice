<?php

class A
{
    public function Save()
    {
        echo "A save";
    }
}


class B
    extends A
{
    public function Save()
    {
        echo "B save";
        parent::Save();
    }
}
/*$b = new B();
$b->Save();*/
?>