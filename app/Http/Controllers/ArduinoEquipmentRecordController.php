<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\ArduinoEquipmentRecord;
use App\Models\ArduinoListOfEquipment;

class ArduinoEquipmentRecordController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    protected $modelNameListOfEquipment;
    protected $tableNameListOfEquipment;
    protected $tableAllColumnsListOfEquipment;

    /**
     * Defined the variables that will be used to
     * get the model and table name as well as the table columns.
     */
    public function __construct()
    {
        $this->modelName           = new ArduinoEquipmentRecord();
        $this->tableName           = $this->modelName->getTable();
        $this->tableAllColumns     = Schema::getColumnListing($this->tableName);

        $this->modelNameListOfEquipment       = new ArduinoListOfEquipment();
        $this->tableNameListOfEquipment       = $this->modelNameListOfEquipment->getTable();
        $this->tableAllColumnsListOfEquipment = Schema::getColumnListing($this->tableNameListOfEquipment);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $displayAllEquipments = $this->modelNameListOfEquipment->select('id', 'equipment_id', 'equipment_description')->get()->toArray();
        $displayAllRecords = $this->modelName
        //->where('equipment_is_active', '=', '')
        ->paginate(20)
        ->onEachSide(2);
        return view('pages.equipment-records.index', compact('displayAllRecords', 'displayAllEquipments'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.equipment-records.create');
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
            //'arduino_list_of_equipment_id'  => 'required|regex:/^[0-9]+$/u',
            'equipment_value'               => 'required|max:255',
        ]);
        $insertSingleRecord = $this->modelName->create([
            //'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
            'equipment_value'              => $request->get('equipment_value'),
        ]);
        return redirect()->route('equipment-records.index')->with('success', 'The record(s) you have entered in the database was(were) created and stored successfully!');
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
            'arduino_list_of_equipment_id',
            'equipment_value',
        )
        //->where('equipment_is_active', '=', 1)
        ->find($id);
        return view('pages.equipment-records.show', compact('displaySingleRecord'));
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
            'arduino_list_of_equipment_id',
            'equipment_value',
        )
        //->where('equipment_is_active', '=', 1)
        ->find($id);
        return view('pages.equipment-records.edit', compact('editSingleRecord'));
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
            'arduino_list_of_equipment_id' => 'required|max:255',
            'equipment_value'              => 'required|max:255',
        ]);
        $editSingleRecord = $this->modelName->find($request->id);
        $editSingleRecord->update([
            'arduino_list_of_equipment_id' => $request->get('equipment_description'),
            'equipment_value'              => $request->get('equipment_notes'),
        ]);
        return redirect()->route('equipment-records.index')->with('success', 'The record(s) you have entered in the database was(were) modified successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $displaySingleRecord = $this->modelName->select('id')->find($id);
        $deleteSingleRecord = $this->modelName->find($id)->delete();
        return redirect()->route('equipment-records.index')->with('success', 'The record you have selected was successfully deleted!');
    }
}