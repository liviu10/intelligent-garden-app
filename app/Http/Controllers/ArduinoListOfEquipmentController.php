<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\ArduinoListOfEquipment;

class ArduinoListOfEquipmentController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    /**
     * Defined the variables that will be used to
     * get the model and table name as well as the table columns.
     */
    public function __construct()
    {
        $this->modelName           = new ArduinoListOfEquipment();
        $this->tableName           = $this->modelName->getTable();
        $this->tableAllColumns     = Schema::getColumnListing($this->tableName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $displayAllRecords = $this->modelName->where('equipment_is_active', '=', 1)->paginate(6);
        return view('pages.list-of-equipments.index', compact('displayAllRecords'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.list-of-equipments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'equipment_id'          => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:15|unique:arduino_list_of_equipments',
            'equipment_description' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'equipment_notes'       => 'required|regex:/^[a-zA-Z0-9_+-\/\*\=\{\}\[\]\(\) ]+$/u|max:255',
        ]);
        $insertSingleRecord = $this->modelName->create([
            'equipment_id'          => $request->get('equipment_id'),
            'equipment_description' => $request->get('equipment_description'),
            'equipment_notes'       => $request->get('equipment_notes'),
            'equipment_is_active'   => '1',
        ]);
        return redirect()->route('list-of-equipments.index')->with('success', 'The record(s) you have entered in the database was(were) created and stored successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $displaySingleRecord = $this->modelName
        ->select(
            'id',
            'equipment_id',
            'equipment_description',
            'equipment_notes',
        )
        ->where('equipment_is_active', '=', 1)
        ->find($id);
        return view('pages.list-of-equipments.show', compact('displaySingleRecord'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editSingleRecord = $this->modelName
        ->select(
            'id',
            'equipment_id',
            'equipment_description',
            'equipment_notes',
        )
        ->where('equipment_is_active', '=', 1)
        ->find($id);
        return view('pages.list-of-equipments.edit', compact('editSingleRecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'equipment_description' => 'required|max:255',
            'equipment_notes'       => 'required|max:255',
        ]);
        $editSingleRecord = $this->modelName->find($request->id);
        $editSingleRecord->update([
            'equipment_description' => $request->get('equipment_description'),
            'equipment_notes'       => $request->get('equipment_notes'),
            'equipment_is_active'   => '1',
        ]);
        return redirect()->route('list-of-equipments.index')->with('success', 'The record(s) you have entered in the database was(were) modified successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $displaySingleRecord = $this->modelName->select('id')->where('equipment_is_active', '=', 1)->find($id);
        $deleteSingleRecord = $this->modelName->find($id)->delete();
        return redirect()->route('list-of-equipments.index')->with('success', 'The record you have selected was successfully deleted!');
    }
}