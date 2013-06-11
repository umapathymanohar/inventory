<?php

class CustomerMaster extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'customerSTNumber' => 'required'
	);
}