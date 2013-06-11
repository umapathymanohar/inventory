<?php

class TestingsController extends BaseController {

    /**
     * Testing Repository
     *
     * @var Testing
     */
    protected $testing;

    public function __construct(Testing $testing)
    {
        $this->testing = $testing;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $testings = $this->testing->all();

        return View::make('testings.index', compact('testings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('testings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Testing::$rules);

        if ($validation->passes())
        {
            $this->testing->create($input);

            return Redirect::route('testings.index');
        }

        return Redirect::route('testings.create')
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
        $testing = $this->testing->findOrFail($id);

        return View::make('testings.show', compact('testing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $testing = $this->testing->find($id);

        if (is_null($testing))
        {
            return Redirect::route('testings.index');
        }

        return View::make('testings.edit', compact('testing'));
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
        $validation = Validator::make($input, Testing::$rules);

        if ($validation->passes())
        {
            $testing = $this->testing->find($id);
            $testing->update($input);

            return Redirect::route('testings.show', $id);
        }

        return Redirect::route('testings.edit', $id)
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
        $this->testing->find($id)->delete();

        return Redirect::route('testings.index');
    }

}