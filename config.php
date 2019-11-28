<?php
   function autoload($c)
{
    include 'classes/' . $c . '.class.php';
}
spl_autoload_register('autoload');
   
?>