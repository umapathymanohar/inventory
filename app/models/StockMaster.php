<?php

class StockMaster extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'entryDate' => 'required'
	);
}