<?php
    /**
    * 
    */
    class Demo
    {
        private $name;
        echo 'to this !';

        public function sayHello() {
            echo 'Hello '.$this->getName().'!';
        }

        public function getName() {
            return $this->$_name;
        }

        public function setName($name) {
            if (!is_string($name) || strlen($name) == 0) {
                throw new Exception("Invalid name value!");
            }

            $this->$_name = $name;
        }
        
        function __construct(argument)
        {
            # code...
        }
    }
?>