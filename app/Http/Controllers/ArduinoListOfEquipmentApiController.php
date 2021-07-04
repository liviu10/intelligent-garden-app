<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArduinoListOfEquipment;
use App\Http\Resources\ArduinoListOfEquipmentResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ArduinoListOfEquipmentApiController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    public function __construct()
    {
        $this->modelName              = new ArduinoListOfEquipment();
        $this->tableName              = $this->modelName->getTable();
        $this->tableAllColumns        = Schema::getColumnListing($this->tableName);
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
            $apiDisplayAllRecords = $this->modelName->all();
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
                return response([
                    'Notification Code'               => 'INFO_1',
                    'Notification Short Description'  => 'The equipment record list (' . $apiDisplayAllRecords->count() . ' record(s)) was successfully fetched from the database which contains.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                    'Equipment List'                  => new ArduinoListOfEquipmentResource($apiDisplayAllRecords),
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
            $apiInsertSingleRecord = $this->modelName->create($request->all());
            return response([
                'Notification Code'               => 'INFO_2',
                'Notification Short Description'  => 'The equipment ' . $apiInsertSingleRecord->equipment_id . ' was successfully inserted in the database.',
                'Notification Reference'          => '!!! Insert documentation link here !!!',
                'Equipment List'                  => new ArduinoListOfEquipmentResource($apiInsertSingleRecord),
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '23000') 
            {
                if (empty($apiInsertSingleRecord->equipment_id) OR empty($apiInsertSingleRecord->equipment_description) OR empty($apiInsertSingleRecord->equipment_notes))
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
            $apiDisplayAllRecords = $this->modelName->all();
            $apiDisplaySingleRecord = $this->modelName->find($id);
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
                    'Notification Short Description'  => 'The equipment you are looking for does not exist.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                return response([
                    'Notification Code'               => 'INFO_1',
                    'Notification Short Description'  => 'The details of equipment ID ' . $apiDisplaySingleRecord->equipment_id . ' was successfully fetched from the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                    'Equipment List'                  => new ArduinoListOfEquipmentResource($apiDisplaySingleRecord),
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
            $apiUpdateSingleRecord = $this->modelName->find($id);
            $apiUpdateSingleRecord->update($request->all());
            return response([
                'Notification Code'              => 'INFO_2',
                'Notification Short Description' => 'The equipment ' . $apiUpdateSingleRecord->equipment_id . ' was successfully updated in the database',
                'Notification Reference'         => '!!! Insert documentation link here !!!',
                'Equipment List'                 => new ArduinoListOfEquipmentResource($apiUpdateSingleRecord),
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '23000') 
            {
                if (empty($apiUpdateSingleRecord->equipment_id) OR empty($apiUpdateSingleRecord->equipment_description) OR empty($apiUpdateSingleRecord->equipment_notes))
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
            $apiDisplayAllRecords = $this->modelName->all();
            $apiDisplaySingleRecord = $this->modelName->find($id);
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
                    'Notification Short Description'  => 'The equipment you are looking for does not exist.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelName->find($id)->delete();
                return response([
                    'Notification Code'               => 'INFO_1',
                    'Notification Short Description'  => 'The equipment you have selected was successfully deleted from the database.',
                    'Notification Reference'          => '!!! Insert documentation link here !!!',
                    'Deleted Equipment'               => new ArduinoListOfEquipmentResource($apiDisplaySingleRecord),
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