<?php

class ProductMastersController extends BaseController {

    /**
     * Productmaster Repository
     *
     * @var Productmaster
     */
    protected $productmaster;

    public function __construct(Productmaster $productmaster)
    {
        $this->productmaster = $productmaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $productmasters = $this->productmaster->all();

        return View::make('productmasters.index', compact('productmasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('productmasters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Productmaster::$rules);

        if ($validation->passes())
        {
            $this->productmaster->create($input);

            return Redirect::route('productmasters.index');
        }

        return Redirect::route('productmasters.create')
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
        $productmaster = $this->productmaster->findOrFail($id);

        return View::make('productmasters.show', compact('productmaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $productmaster = $this->productmaster->find($id);

        if (is_null($productmaster))
        {
            return Redirect::route('productmasters.index');
        }

        return View::make('productmasters.edit', compact('productmaster'));
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
        $validation = Validator::make($input, Productmaster::$rules);

        if ($validation->passes())
        {
            $productmaster = $this->productmaster->find($id);
            $productmaster->update($input);

            return Redirect::route('productmasters.show', $id);
        }

        return Redirect::route('productmasters.edit', $id)
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
        $this->productmaster->find($id)->delete();

        return Redirect::route('productmasters.index');
    }

}