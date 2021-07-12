<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArduinoEquipmentRecord;
use App\Models\ArduinoListOfEquipment;
use App\Http\Resources\ArduinoEquipmentRecordResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class ArduinoEquipmentRecordApiController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    public function __construct()
    {
        $this->modelName              = [new ArduinoListOfEquipment(), new ArduinoEquipmentRecord()];
        $this->tableName              = [$this->modelName[0]->getTable(), $this->modelName[1]->getTable()];
        $this->tableAllColumns        = [Schema::getColumnListing($this->tableName[0]), Schema::getColumnListing($this->tableName[1])];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try 
        {
            $apiDisplayAllRecords = $this->modelName[1]->all();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'Notification Code'               => 'WARN_1',
                    'Notification Short Description'  => 'The table you are looking for does not have any records to display.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                $apiDisplayAllRecords = $this->modelName[1]
                                        ->join(
                                            $this->tableName[0], 
                                            $this->tableName[0]. '.' . $this->tableAllColumns[0][1], 
                                            '=', 
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][1]
                                        )
                                        ->select(
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][0],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][1],
                                            $this->tableName[0]. '.' . $this->tableAllColumns[0][2],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][2],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][3],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][4]
                                        )
                                        ->get();
                return response([
                    'data'                            => new ArduinoEquipmentRecordResource($apiDisplayAllRecords),
                    'Notification Code'               => 'INFO_1',
                    'Notification Short Description'  => 'The equipment record list (' . $apiDisplayAllRecords->count() . ' record(s)) was successfully fetched from the database which contains.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'Notification Code'               => 'ERR_1',
                    'Notification Short Description'  => 'The table you are looking for does not exist in the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 500);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            if (strtok($request->equipment_id, '_') === 'POMPA' AND $request->equipment_value !== 0 AND $request->equipment_value !== 1 OR is_string($request->equipment_value)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2_1',
                    'Notification Short Description'  => 'You are trying to save: ' . $request->equipment_id . ' with ' . $request->equipment_value . ' as a reading value. The accepted values are 0 (pump stopped) and 1 (pump started).',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            elseif ($request->equipment_id === 'SENZOR_NIVEL' AND $request->equipment_value !== 0 AND $request->equipment_value !== 1 AND $request->equipment_value !== 2 OR is_string($request->equipment_value)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2_2',
                    'Notification Short Description'  => 'You are trying to save: ' . $request->equipment_id . ' with ' . $request->equipment_value . ' as a reading value. The accepted values are 0 (critical level), 1 (low level) and 2 (normal level).',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            elseif ($request->equipment_id === 'SENZOR_PH' AND $request->equipment_value <= 0 OR $request->equipment_value >= 14 OR is_string($request->equipment_value)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2_3',
                    'Notification Short Description'  => 'You are trying to save: ' . $request->equipment_id . ' with ' . $request->equipment_value . ' as a reading value. The accepted values are between 0.00 (acidic ph) and 14.00 (alkaline ph).',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            else 
            {
                $apiInsertSingleRecord = $this->modelName[1]->create($request->all());
                return response([
                    'Notification Code'               => 'INFO_2',
                    'Notification Short Description'  => 'The equipment ' . $apiInsertSingleRecord->equipment_id . ' with the value: ' . $request->equipment_value . ' was successfully inserted in the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                    'data'                            => new ArduinoEquipmentRecordResource($apiInsertSingleRecord),
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '23000') 
            {
                if (empty($request->equipment_id) OR empty($request->equipment_value))
                {
                    return response([
                        'Notification Code'               => 'ERR_2',
                        'Notification Short Description'  => 'One or more field does not contain any information.',
                        'Notification Reference'          => '!!! Insert documentation link here !!!',
                    ], 406);
                }
            }
            elseif ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'Notification Code'               => 'ERR_1',
                    'Notification Short Description'  => 'The table you are looking for does not exist in the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 500);
            }
            elseif ($mysqlError->getCode() === 'HY000') 
            {
                return response([
                    'Notification Code'               => 'ERR_3',
                    'Notification Short Description'  => 'One or more field are missing from the JSON object.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            elseif ($mysqlError->getCode() === '22001') 
            {
                return response([
                    'Notification Code'               => 'ERR_4',
                    'Notification Short Description'  => 'The field equipment_id must have a maximum of 15 characters.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try 
        {
            $apiDisplayAllRecords = $this->modelName[1]->all();
            $apiDisplaySingleRecord = $this->modelName[1]->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'Notification Code'               => 'WARN_1',
                    'Notification Short Description'  => 'The table you are looking for does not have any records to display.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2',
                    'Notification Short Description'  => 'The equipment record you are looking for does not exist.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                $apiDisplaySingleRecord = $this->modelName[1]
                                        ->join(
                                            $this->tableName[0], 
                                            $this->tableName[0]. '.' . $this->tableAllColumns[0][1], 
                                            '=', 
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][1]
                                        )
                                        ->select(
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][0],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][1],
                                            $this->tableName[0]. '.' . $this->tableAllColumns[0][2],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][2],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][3],
                                            $this->tableName[1]. '.' . $this->tableAllColumns[1][4]
                                        )
                                        ->find($id);
                return response([
                    'Notification Code'               => 'INFO_1',
                    'Notification Short Description'  => 'The details of equipment ID ' . $apiDisplaySingleRecord['equipment_id'] . ' was successfully fetched from the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                    'data'                            => new ArduinoEquipmentRecordResource($apiDisplaySingleRecord),
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'Notification Code'               => 'ERR_1',
                    'Notification Short Description'  => 'The table you are looking for does not exist in the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 500);
            }
        }
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
        try 
        {
            if (strtok($request->equipment_id, '_') === 'POMPA' AND $request->equipment_value !== 0 AND $request->equipment_value !== 1 OR is_string($request->equipment_value)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2_1',
                    'Notification Short Description'  => 'You are trying to update: ' . $request->equipment_id . ' with ' . $request->equipment_value . ' as a reading value. The accepted values are 0 (pump stopped) and 1 (pump started).',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            elseif ($request->equipment_id === 'SENZOR_NIVEL' AND $request->equipment_value !== 0 AND $request->equipment_value !== 1 AND $request->equipment_value !== 2 OR is_string($request->equipment_value)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2_2',
                    'Notification Short Description'  => 'You are trying to update: ' . $request->equipment_id . ' with ' . $request->equipment_value . ' as a reading value. The accepted values are 0 (critical level), 1 (low level) and 2 (normal level).',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            elseif ($request->equipment_id === 'SENZOR_PH' AND $request->equipment_value <= 0 OR $request->equipment_value >= 14 OR is_string($request->equipment_value)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2_3',
                    'Notification Short Description'  => 'You are trying to update: ' . $request->equipment_id . ' with ' . $request->equipment_value . ' as a reading value. The accepted values are between 0.00 (acidic ph) and 14.00 (alkaline ph).',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            else 
            {
                $apiUpdateSingleRecord = $this->modelName[1]->find($id);
                $apiUpdateSingleRecord->update($request->all());
                return response([
                    'Notification Code'              => 'INFO_2',
                    'Notification Short Description' => 'The equipment ' . $apiUpdateSingleRecord->equipment_id . ' with the value: ' . $request->equipment_value . ' was successfully updated in the database',
                    'Notification Reference'         => '!!! Insert documentation link here !!!',
                    'data'                           => new ArduinoEquipmentRecordResource($apiUpdateSingleRecord),
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '23000') 
            {
                if (empty($request->equipment_id) OR empty($request->equipment_value))
                {
                    return response([
                        'Notification Code'               => 'ERR_2',
                        'Notification Short Description'  => 'One or more field does not contain any information.',
                        'Notification Reference'          => '!!! Insert documentation link here !!!',
                    ], 406);
                }
            }
            elseif ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'Notification Code'               => 'ERR_1',
                    'Notification Short Description'  => 'The table you are looking for does not exist in the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 500);
            }
            elseif ($mysqlError->getCode() === 'HY000') 
            {
                return response([
                    'Notification Code'               => 'ERR_3',
                    'Notification Short Description'  => 'One or more field are missing from the JSON object.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
            elseif ($mysqlError->getCode() === '22001') 
            {
                return response([
                    'Notification Code'               => 'ERR_4',
                    'Notification Short Description'  => 'The field equipment_id must have a maximum of 15 characters.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 406);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try 
        {
            $apiDisplayAllRecords = $this->modelName[1]->all();
            $apiDisplaySingleRecord = $this->modelName[1]->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'Notification Code'               => 'WARN_1',
                    'Notification Short Description'  => 'The table you are looking for does not have any records to display.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'Notification Code'               => 'WARN_2',
                    'Notification Short Description'  => 'The equipment record you are looking for does not exist.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelName[1]->find($id)->delete();
                return response([
                    'Notification Code'               => 'INFO_1',
                    'Notification Short Description'  => 'The equipment you have selected was successfully deleted from the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                    'Deleted Equipment'               => new ArduinoEquipmentRecordResource($apiDisplaySingleRecord),
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'Notification Code'               => 'ERR_1',
                    'Notification Short Description'  => 'The table you are looking for does not exist in the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 500);
            }
        }
    }
}
