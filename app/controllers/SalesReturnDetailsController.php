<?php

class SalesReturnDetailsController extends BaseController {

    /**
     * Salesreturndetail Repository
     *
     * @var Salesreturndetail
     */
    protected $salesreturndetail;

    public function __construct(Salesreturndetail $salesreturndetail)
    {
        $this->salesreturndetail = $salesreturndetail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $salesreturndetails = $this->salesreturndetail->all();

        return View::make('salesreturndetails.index', compact('salesreturndetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('salesreturndetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Salesreturndetail::$rules);

        if ($validation->passes())
        {
            $this->salesreturndetail->create($input);

            return Redirect::route('salesreturndetails.index');
        }

        return Redirect::route('salesreturndetails.create')
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
        $salesreturndetail = $this->salesreturndetail->findOrFail($id);

        return View::make('salesreturndetails.show', compact('salesreturndetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $salesreturndetail = $this->salesreturndetail->find($id);

        if (is_null($salesreturndetail))
        {
            return Redirect::route('salesreturndetails.index');
        }

        return View::make('salesreturndetails.edit', compact('salesreturndetail'));
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
        $validation = Validator::make($input, Salesreturndetail::$rules);

        if ($validation->passes())
        {
            $salesreturndetail = $this->salesreturndetail->find($id);
            $salesreturndetail->update($input);

            return Redirect::route('salesreturndetails.show', $id);
        }

        return Redirect::route('salesreturndetails.edit', $id)
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
        $this->salesreturndetail->find($id)->delete();

        return Redirect::route('salesreturndetails.index');
    }

}