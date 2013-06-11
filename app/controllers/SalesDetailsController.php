<?php

class SalesDetailsController extends BaseController {

    /**
     * Salesdetail Repository
     *
     * @var Salesdetail
     */
    protected $salesdetail;

    public function __construct(Salesdetail $salesdetail)
    {
        $this->salesdetail = $salesdetail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $salesdetails = $this->salesdetail->all();

        return View::make('salesdetails.index', compact('salesdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('salesdetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Salesdetail::$rules);

        if ($validation->passes())
        {
            $this->salesdetail->create($input);

            return Redirect::route('salesdetails.index');
        }

        return Redirect::route('salesdetails.create')
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
        $salesdetail = $this->salesdetail->findOrFail($id);

        return View::make('salesdetails.show', compact('salesdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $salesdetail = $this->salesdetail->find($id);

        if (is_null($salesdetail))
        {
            return Redirect::route('salesdetails.index');
        }

        return View::make('salesdetails.edit', compact('salesdetail'));
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
        $validation = Validator::make($input, Salesdetail::$rules);

        if ($validation->passes())
        {
            $salesdetail = $this->salesdetail->find($id);
            $salesdetail->update($input);

            return Redirect::route('salesdetails.show', $id);
        }

        return Redirect::route('salesdetails.edit', $id)
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
        $this->salesdetail->find($id)->delete();

        return Redirect::route('salesdetails.index');
    }

}