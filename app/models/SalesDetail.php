<?php

class SalesDetail extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'itemPrice' => 'required'
	);
}