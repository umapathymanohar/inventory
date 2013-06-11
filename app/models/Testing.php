<?php

class Testing extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'name' => 'required'
	);
}