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
                    'HTTP Response Code'        => 404,
                    'HTTP Response Description' => 'Not Found',
                    'Interpretation'            => 'This means that the table does not have any records to show'
                ], 404);
            }
            else 
            {
                return response([
                    'HTTP Response Code'        => 201,
                    'HTTP Response Description' => 'Created',
                    'Message'                   => 'The list of equipments was successfully fetched from the database which contains ' . $apiDisplayAllRecords->count() . ' record(s).',
                    'Equipment List'            => new ArduinoListOfEquipmentResource($apiDisplayAllRecords),
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'HTTP Response Code'        => 500,
                    'HTTP Response Description' => 'Internal Server Error',
                    'Interpretation'            => 'This means that the table you are looking for does not exist in the database. Please contact the site owner!',
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
                'HTTP Response Code'        => 201,
                'HTTP Response Description' => 'Created',
                'Message'                   => 'The equipment ID: ' . $apiInsertSingleRecord->equipment_id . ' was successfully saved in the database',
                'Equipment List'            => new ArduinoListOfEquipmentResource($apiInsertSingleRecord),
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '23000') 
            {
                if (empty($apiInsertSingleRecord->equipment_id) OR empty($apiInsertSingleRecord->equipment_description) OR empty($apiInsertSingleRecord->equipment_notes))
                {
                    return response([
                        'HTTP Response Code'        => 406,
                        'HTTP Response Description' => 'Not Acceptable',
                        'Interpretation'            => 'This means that one or more fields does not contain any information',
                        'More information'          => 'Please check the documentation Arduino API  - List Of Equipments',
                    ], 406);
                }
            }
            elseif ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'HTTP Response Code'        => 500,
                    'HTTP Response Description' => 'Internal Server Error',
                    'Interpretation'            => 'This means that the table you are looking for does not exist in the database. Please contact the site owner!',
                ], 500);
            }
            elseif ($mysqlError->getCode() === 'HY000') 
            {
                return response([
                    'HTTP Response Code'        => 406,
                    'HTTP Response Description' => 'Not Acceptable',
                    'Interpretation'            => 'This means that one or more fields are missing from the JSON object',
                    'More information'          => 'Please check the documentation Arduino API  - List Of Equipments',
                ], 406);
            }
            elseif ($mysqlError->getCode() === '22001') 
            {
                return response([
                    'HTTP Response Code'        => 406,
                    'HTTP Response Description' => 'Not Acceptable',
                    'Interpretation'            => 'This means that the field equipment_id must have a maximum of 15 characters',
                    'More information'          => 'Please check the documentation Arduino API  - List Of Equipments',
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
                    'HTTP Response Code'        => 404,
                    'HTTP Response Description' => 'Not Found',
                    'Interpretation'            => 'This means that the table does not have any records'
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'HTTP Response Code'        => 404,
                    'HTTP Response Description' => 'Not Found',
                    'Interpretation'            => 'This means that the equipment you are looking for does not exist'
                ], 404);
            }
            else 
            {
                return response([
                    'HTTP Response Code'        => 201,
                    'HTTP Response Description' => 'Created',
                    'Message'                   => 'The equipment ID: ' . $apiDisplaySingleRecord->equipment_id . ' was successfully fetched from the database',
                    'Equipment List'            => new ArduinoListOfEquipmentResource($apiDisplaySingleRecord),
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'HTTP Response Code'        => 500,
                    'HTTP Response Description' => 'Internal Server Error',
                    'Interpretation'            => 'This means that the table you are looking for does not exist in the database. Please contact the site owner!',
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
                'HTTP Response Code'        => 201,
                'HTTP Response Description' => 'Created',
                'Message'                   => 'The equipment ID: ' . $apiUpdateSingleRecord->equipment_id . ' was successfully updated in the database',
                'Equipment List'            => new ArduinoListOfEquipmentResource($apiUpdateSingleRecord),
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '23000') 
            {
                if (empty($apiUpdateSingleRecord->equipment_id) OR empty($apiUpdateSingleRecord->equipment_description) OR empty($apiUpdateSingleRecord->equipment_notes))
                {
                    return response([
                        'HTTP Response Code'        => 406,
                        'HTTP Response Description' => 'Not Acceptable',
                        'Interpretation'            => 'This means that one or more fields does not contain any information',
                        'More information'          => 'Please check the documentation Arduino API  - List Of Equipments',
                    ], 406);
                }
            }
            elseif ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'HTTP Response Code'        => 500,
                    'HTTP Response Description' => 'Internal Server Error',
                    'Interpretation'            => 'This means that the table you are looking for does not exist in the database. Please contact the site owner!',
                ], 500);
            }
            elseif ($mysqlError->getCode() === 'HY000') 
            {
                return response([
                    'HTTP Response Code'        => 406,
                    'HTTP Response Description' => 'Not Acceptable',
                    'Interpretation'            => 'This means that one or more fields are missing from the JSON object',
                    'More information'          => 'Please check the documentation Arduino API  - List Of Equipments',
                ], 406);
            }
            elseif ($mysqlError->getCode() === '22001') 
            {
                return response([
                    'HTTP Response Code'        => 406,
                    'HTTP Response Description' => 'Not Acceptable',
                    'Interpretation'            => 'This means that the field equipment_id must have a maximum of 15 characters',
                    'More information'          => 'Please check the documentation Arduino API  - List Of Equipments',
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
                    'HTTP Response Code'        => 404,
                    'HTTP Response Description' => 'Not Found',
                    'Interpretation'            => 'This means that the table does not have any records'
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'HTTP Response Code'        => 404,
                    'HTTP Response Description' => 'Not Found',
                    'Interpretation'            => 'This means that the equipment you are looking for does not exist'
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelName->find($id)->delete();
                return response([
                    'HTTP Response Code'        => 200,
                    'HTTP Response Description' => 'OK',
                    'Message'                   => 'The equipment you have selected was successfully deleted from the database',
                    'Equipment List'            => $apiDisplaySingleRecord,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'HTTP Response Code'        => 500,
                    'HTTP Response Description' => 'Internal Server Error',
                    'Interpretation'            => 'This means that the table you are looking for does not exist in the database. Please contact the site owner!',
                ], 500);
            }
        }
    }
}
