<?php

class SalesMastersController extends BaseController {

    /**
     * Salesmaster Repository
     *
     * @var Salesmaster
     */
    protected $salesmaster;

    public function __construct(Salesmaster $salesmaster)
    {
        $this->salesmaster = $salesmaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $salesmasters = $this->salesmaster->all();

        return View::make('salesmasters.index', compact('salesmasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('salesmasters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Salesmaster::$rules);

        if ($validation->passes())
        {
            $this->salesmaster->create($input);

            return Redirect::route('salesmasters.index');
        }

        return Redirect::route('salesmasters.create')
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
        $salesmaster = $this->salesmaster->findOrFail($id);

        return View::make('salesmasters.show', compact('salesmaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $salesmaster = $this->salesmaster->find($id);

        if (is_null($salesmaster))
        {
            return Redirect::route('salesmasters.index');
        }

        return View::make('salesmasters.edit', compact('salesmaster'));
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
        $validation = Validator::make($input, Salesmaster::$rules);

        if ($validation->passes())
        {
            $salesmaster = $this->salesmaster->find($id);
            $salesmaster->update($input);

            return Redirect::route('salesmasters.show', $id);
        }

        return Redirect::route('salesmasters.edit', $id)
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
        $this->salesmaster->find($id)->delete();

        return Redirect::route('salesmasters.index');
    }

}