<?php

class SalesReturnDetail extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'product_id' => 'required',
		'quantity' => 'required'
	);
}