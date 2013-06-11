<?php

class StockMastersController extends BaseController {

    /**
     * Stockmaster Repository
     *
     * @var Stockmaster
     */
    protected $stockmaster;

    public function __construct(Stockmaster $stockmaster)
    {
        $this->stockmaster = $stockmaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $stockmasters = $this->stockmaster->all();

        return View::make('stockmasters.index', compact('stockmasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('stockmasters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Stockmaster::$rules);

        if ($validation->passes())
        {
            $this->stockmaster->create($input);

            return Redirect::route('stockmasters.index');
        }

        return Redirect::route('stockmasters.create')
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
        $stockmaster = $this->stockmaster->findOrFail($id);

        return View::make('stockmasters.show', compact('stockmaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $stockmaster = $this->stockmaster->find($id);

        if (is_null($stockmaster))
        {
            return Redirect::route('stockmasters.index');
        }

        return View::make('stockmasters.edit', compact('stockmaster'));
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
        $validation = Validator::make($input, Stockmaster::$rules);

        if ($validation->passes())
        {
            $stockmaster = $this->stockmaster->find($id);
            $stockmaster->update($input);

            return Redirect::route('stockmasters.show', $id);
        }

        return Redirect::route('stockmasters.edit', $id)
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
        $this->stockmaster->find($id)->delete();

        return Redirect::route('stockmasters.index');
    }

}