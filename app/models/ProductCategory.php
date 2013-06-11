<?php

class ProductCategory extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'productCategoryDescription' => 'required'
	);
}