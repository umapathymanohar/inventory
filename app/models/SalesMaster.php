<?php

class SalesMaster extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'saleTotalPrice' => 'required'
	);
}