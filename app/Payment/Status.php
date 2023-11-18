<?php

namespace App\Payment;

class Status {
    public $transaction_id, $ref, $amount, $code, $success, $message;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

}
