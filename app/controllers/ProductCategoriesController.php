<?php

class ProductCategoriesController extends BaseController {

    /**
     * Productcategory Repository
     *
     * @var Productcategory
     */
    protected $productcategory;

    public function __construct(Productcategory $productcategory)
    {
        $this->productcategory = $productcategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $productcategories = $this->productcategory->all();

        return View::make('productcategories.index', compact('productcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('productcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Productcategory::$rules);

        if ($validation->passes())
        {
            $this->productcategory->create($input);

            return Redirect::route('productcategories.index');
        }

        return Redirect::route('productcategories.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $productcategory = $this->productcategory->findOrFail($id);

        return View::make('productcategories.show', compact('productcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $productcategory = $this->productcategory->find($id);

        if (is_null($productcategory))
        {
            return Redirect::route('productcategories.index');
        }

        return View::make('productcategories.edit', compact('productcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Productcategory::$rules);

        if ($validation->passes())
        {
            $productcategory = $this->productcategory->find($id);
            $productcategory->update($input);

            return Redirect::route('productcategories.show', $id);
        }

        return Redirect::route('productcategories.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->productcategory->find($id)->delete();

        return Redirect::route('productcategories.index');
    }

}