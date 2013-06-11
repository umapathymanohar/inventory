<?php

class SalesReturnsController extends BaseController {

    /**
     * Salesreturn Repository
     *
     * @var Salesreturn
     */
    protected $salesreturn;

    public function __construct(Salesreturn $salesreturn)
    {
        $this->salesreturn = $salesreturn;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $salesreturns = $this->salesreturn->all();

        return View::make('salesreturns.index', compact('salesreturns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('salesreturns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Salesreturn::$rules);

        if ($validation->passes())
        {
            $this->salesreturn->create($input);

            return Redirect::route('salesreturns.index');
        }

        return Redirect::route('salesreturns.create')
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
        $salesreturn = $this->salesreturn->findOrFail($id);

        return View::make('salesreturns.show', compact('salesreturn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $salesreturn = $this->salesreturn->find($id);

        if (is_null($salesreturn))
        {
            return Redirect::route('salesreturns.index');
        }

        return View::make('salesreturns.edit', compact('salesreturn'));
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
        $validation = Validator::make($input, Salesreturn::$rules);

        if ($validation->passes())
        {
            $salesreturn = $this->salesreturn->find($id);
            $salesreturn->update($input);

            return Redirect::route('salesreturns.show', $id);
        }

        return Redirect::route('salesreturns.edit', $id)
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
        $this->salesreturn->find($id)->delete();

        return Redirect::route('salesreturns.index');
    }

}