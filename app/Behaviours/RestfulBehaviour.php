<?php

namespace App\Behaviours;

use Illuminate\Http\Request;

trait RestfulBehaviour
{
  protected $modelKlass;
  protected $modelAttributes = [];

  /**
   * Show all model as json.
   *
   * @return Response
   */
  public function index()
  {
    return $this->modelKlass::all();
  }

  /**
   * Retrieve model for the given ID.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    return $this->modelKlass::findOrFail($id);
  }

  /**
   * Create new model in the database.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $data = $request->only($this->modelAttributes);

    return $this->modelKlass::create($data);
  }

  /**
   * Updates a model in the database.
   *
   * @return Response
   */
  public function update($id, Request $request)
  {
    $data = $request->all();

    $model = $this->modelKlass::find($id);
    $model->update($data);

    return $model;
  }

  /**
   * Destroys a model in the database.
   *
   * @return Response
   */
  public function destroy($id)
  {
    $this->modelKlass::destroy($id);
    return response('ok', 200);
  }
}
