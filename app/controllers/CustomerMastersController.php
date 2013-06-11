<?php

class CustomerMastersController extends BaseController {

    /**
     * Customermaster Repository
     *
     * @var Customermaster
     */
    protected $customermaster;

    public function __construct(Customermaster $customermaster)
    {
        $this->customermaster = $customermaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $customermasters = $this->customermaster->all();

        return View::make('customermasters.index', compact('customermasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('customermasters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Customermaster::$rules);

        if ($validation->passes())
        {
            $this->customermaster->create($input);

            return Redirect::route('customermasters.index');
        }

        return Redirect::route('customermasters.create')
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
        $customermaster = $this->customermaster->findOrFail($id);

        return View::make('customermasters.show', compact('customermaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $customermaster = $this->customermaster->find($id);

        if (is_null($customermaster))
        {
            return Redirect::route('customermasters.index');
        }

        return View::make('customermasters.edit', compact('customermaster'));
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
        $validation = Validator::make($input, Customermaster::$rules);

        if ($validation->passes())
        {
            $customermaster = $this->customermaster->find($id);
            $customermaster->update($input);

            return Redirect::route('customermasters.show', $id);
        }

        return Redirect::route('customermasters.edit', $id)
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
        $this->customermaster->find($id)->delete();

        return Redirect::route('customermasters.index');
    }

}