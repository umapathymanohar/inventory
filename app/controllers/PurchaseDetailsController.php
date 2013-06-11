<?php

class PurchaseDetailsController extends BaseController {

    /**
     * Purchasedetail Repository
     *
     * @var Purchasedetail
     */
    protected $purchasedetail;

    public function __construct(Purchasedetail $purchasedetail)
    {
        $this->purchasedetail = $purchasedetail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $purchasedetails = $this->purchasedetail->all();

        return View::make('purchasedetails.index', compact('purchasedetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('purchasedetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Purchasedetail::$rules);

        if ($validation->passes())
        {
            $this->purchasedetail->create($input);

            return Redirect::route('purchasedetails.index');
        }

        return Redirect::route('purchasedetails.create')
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
        $purchasedetail = $this->purchasedetail->findOrFail($id);

        return View::make('purchasedetails.show', compact('purchasedetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $purchasedetail = $this->purchasedetail->find($id);

        if (is_null($purchasedetail))
        {
            return Redirect::route('purchasedetails.index');
        }

        return View::make('purchasedetails.edit', compact('purchasedetail'));
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
        $validation = Validator::make($input, Purchasedetail::$rules);

        if ($validation->passes())
        {
            $purchasedetail = $this->purchasedetail->find($id);
            $purchasedetail->update($input);

            return Redirect::route('purchasedetails.show', $id);
        }

        return Redirect::route('purchasedetails.edit', $id)
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
        $this->purchasedetail->find($id)->delete();

        return Redirect::route('purchasedetails.index');
    }

}