<?php

class ProductMaster extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'productPrice' => 'required'
	);
}