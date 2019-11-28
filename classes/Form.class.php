<?php
class Form{
    public $method = "POST";
    public $action = "";
    public function __construct($method, $action){
        $this->method = $method;
        $this->action = $action;
    }
    function open_tag() {
        echo "<form method ='{$this->method}'  action ='{$this->action}'>";
    }
    public function input($type, $name = null, $placeholder = null, $value = null)
    {
        echo "<input type='{$type}' name='{$name}' placeholder='{$placeholder}' value='$value'>";
    }
    public function label($for, $value)
    {
        echo "<label for='{$for}'>{$value}</label>";
    }
    function close_tag(){
        echo "</form>";
    }
}