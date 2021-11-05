<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\ArduinoListOfEquipment;
use App\Models\ArduinoEquipmentRecord;

class PhRecordsController extends Controller
{
    protected $arduinoListOfEquipmentModelName;
    protected $arduinoListOfEquipmentTableName;
    protected $arduinoListOfEquipmentTableAllColumns;

    protected $arduinoEquipmentRecordModelName;
    protected $arduinoEquipmentRecordTableName;
    protected $arduinoEquipmentRecordTableAllColumns;

    protected $columnFilter;

    /**
     * Defined the variables that will be used to
     * get the model and table name as well as the table columns.
     */
    public function __construct()
    {
        $this->arduinoListOfEquipmentModelName       = new ArduinoListOfEquipment();
        $this->arduinoListOfEquipmentTableName       = $this->arduinoListOfEquipmentModelName->getTable();
        $this->arduinoListOfEquipmentTableAllColumns = Schema::getColumnListing($this->arduinoListOfEquipmentTableName);

        $this->arduinoEquipmentRecordModelName       = new ArduinoEquipmentRecord();
        $this->arduinoEquipmentRecordTableName       = $this->arduinoEquipmentRecordModelName->getTable();
        $this->arduinoEquipmentRecordTableAllColumns = Schema::getColumnListing($this->arduinoEquipmentRecordTableName);

        $this->columnFilter        = 'PH_SENSOR';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $displayAllRecords = $this->arduinoListOfEquipmentModelName
                            ->with([
                                'arduino_equipment_records' => function ($query) {
                                    $query->select('arduino_list_of_equipment_id', 'id', 'equipment_value', 'created_at', 'updated_at')
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(10);
                                }
                            ])
                            ->where('equipment_id', '=', $this->columnFilter)
                            ->paginate(10);
        return view('pages.ph-records.index', compact('displayAllRecords'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
