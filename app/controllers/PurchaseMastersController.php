<?php

class PurchaseMastersController extends BaseController {

    /**
     * Purchasemaster Repository
     *
     * @var Purchasemaster
     */
    protected $purchasemaster;

    public function __construct(Purchasemaster $purchasemaster)
    {
        $this->purchasemaster = $purchasemaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $purchasemasters = $this->purchasemaster->all();

        return View::make('purchasemasters.index', compact('purchasemasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('purchasemasters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Purchasemaster::$rules);

        if ($validation->passes())
        {
            $this->purchasemaster->create($input);

            return Redirect::route('purchasemasters.index');
        }

        return Redirect::route('purchasemasters.create')
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
        $purchasemaster = $this->purchasemaster->findOrFail($id);

        return View::make('purchasemasters.show', compact('purchasemaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $purchasemaster = $this->purchasemaster->find($id);

        if (is_null($purchasemaster))
        {
            return Redirect::route('purchasemasters.index');
        }

        return View::make('purchasemasters.edit', compact('purchasemaster'));
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
        $validation = Validator::make($input, Purchasemaster::$rules);

        if ($validation->passes())
        {
            $purchasemaster = $this->purchasemaster->find($id);
            $purchasemaster->update($input);

            return Redirect::route('purchasemasters.show', $id);
        }

        return Redirect::route('purchasemasters.edit', $id)
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
        $this->purchasemaster->find($id)->delete();

        return Redirect::route('purchasemasters.index');
    }

}