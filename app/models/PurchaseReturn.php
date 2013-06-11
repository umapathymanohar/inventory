<?php

class PurchaseReturn extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'purchase_id' => 'required',
		'returnDate' => 'required'
	);
}