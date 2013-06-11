<?php

class SalesReturn extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'sales_id' => 'required',
		'returnDate' => 'required'
	);
}