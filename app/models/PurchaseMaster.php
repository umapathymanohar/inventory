<?php

class PurchaseMaster extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'purchaseTotalPrice' => 'required'
	);
}