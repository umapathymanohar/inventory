<?php

class PurchaseReturnsController extends BaseController {

    /**
     * Purchasereturn Repository
     *
     * @var Purchasereturn
     */
    protected $purchasereturn;

    public function __construct(Purchasereturn $purchasereturn)
    {
        $this->purchasereturn = $purchasereturn;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $purchasereturns = $this->purchasereturn->all();

        return View::make('purchasereturns.index', compact('purchasereturns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('purchasereturns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Purchasereturn::$rules);

        if ($validation->passes())
        {
            $this->purchasereturn->create($input);

            return Redirect::route('purchasereturns.index');
        }

        return Redirect::route('purchasereturns.create')
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
        $purchasereturn = $this->purchasereturn->findOrFail($id);

        return View::make('purchasereturns.show', compact('purchasereturn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $purchasereturn = $this->purchasereturn->find($id);

        if (is_null($purchasereturn))
        {
            return Redirect::route('purchasereturns.index');
        }

        return View::make('purchasereturns.edit', compact('purchasereturn'));
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
        $validation = Validator::make($input, Purchasereturn::$rules);

        if ($validation->passes())
        {
            $purchasereturn = $this->purchasereturn->find($id);
            $purchasereturn->update($input);

            return Redirect::route('purchasereturns.show', $id);
        }

        return Redirect::route('purchasereturns.edit', $id)
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
        $this->purchasereturn->find($id)->delete();

        return Redirect::route('purchasereturns.index');
    }

}