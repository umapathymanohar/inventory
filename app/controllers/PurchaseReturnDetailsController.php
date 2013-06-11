<?php

class PurchaseReturnDetailsController extends BaseController {

    /**
     * Purchasereturndetail Repository
     *
     * @var Purchasereturndetail
     */
    protected $purchasereturndetail;

    public function __construct(Purchasereturndetail $purchasereturndetail)
    {
        $this->purchasereturndetail = $purchasereturndetail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $purchasereturndetails = $this->purchasereturndetail->all();

        return View::make('purchasereturndetails.index', compact('purchasereturndetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('purchasereturndetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Purchasereturndetail::$rules);

        if ($validation->passes())
        {
            $this->purchasereturndetail->create($input);

            return Redirect::route('purchasereturndetails.index');
        }

        return Redirect::route('purchasereturndetails.create')
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
        $purchasereturndetail = $this->purchasereturndetail->findOrFail($id);

        return View::make('purchasereturndetails.show', compact('purchasereturndetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $purchasereturndetail = $this->purchasereturndetail->find($id);

        if (is_null($purchasereturndetail))
        {
            return Redirect::route('purchasereturndetails.index');
        }

        return View::make('purchasereturndetails.edit', compact('purchasereturndetail'));
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
        $validation = Validator::make($input, Purchasereturndetail::$rules);

        if ($validation->passes())
        {
            $purchasereturndetail = $this->purchasereturndetail->find($id);
            $purchasereturndetail->update($input);

            return Redirect::route('purchasereturndetails.show', $id);
        }

        return Redirect::route('purchasereturndetails.edit', $id)
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
        $this->purchasereturndetail->find($id)->delete();

        return Redirect::route('purchasereturndetails.index');
    }

}