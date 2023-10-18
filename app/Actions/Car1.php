<?php
 namespace App\Actions;


 class Car1 {

    private $gas,$amount;

    public function __construct(Gas $gas,$amount)
    {
        $this->gas = $gas;
        $this->amount=$amount;
    }

    public function start()
    {
        return "Car 1 started successfully.".$this->amount;
    }

 }
