<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\ArduinoEquipmentRecord;

class ArduinoEquipmentRecordController extends Controller
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
        $this->modelName           = new ArduinoEquipmentRecord();
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
        try
        {
            $displayAllRecords = $this->modelName->all();
            if ($displayAllRecords->isEmpty()) 
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'short_description'  => '',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [ 
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'controllerName' => __NAMESPACE__ . '\\' . substr(basename(ErrorAndNotificationSystemController::class), 0, -10) . '.php',
                        'databaseName'   => $_SERVER['DB_DATABASE'],
                        'tableName'      => $this->tableName 
                    ]),
                    'reference'          => config('app.url') . '/documentation/warning#WAR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 404,
                        'general_message'=> 'The HTTP 404 Not Found client error response code indicates that the server can\'t find the requested resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/404',
                    ],
                    'records'            => [],
                ], 404);
            }
            else
            {
                return response([
                    'title'              => __('error_and_notification_system.index.info_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00001',
                    'short_description'  => '',
                    'description'        => __('error_and_notification_system.index.info_00001_notify.user_has_rights.message_super_admin', [ 
                        'numberOfRecords'=> $displayAllRecords->count(),
                        'databaseName'   => $_SERVER['DB_DATABASE'],
                        'tableName'      => $this->tableName 
                    ]),
                    'reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_00001')->pluck($this->tableAllColumns[3])[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 200,
                        'general_message'=> 'The HTTP 200 OK success status response code indicates that the request has succeeded. A 200 response is cacheable by default.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200',
                    ],
                    'records'            => $displayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'title'              => __('error_and_notification_system.index.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'short_description'  => '',
                    'description'        => __('error_and_notification_system.index.err_00001_notify.user_has_rights.message_super_admin', [ 
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'controllerName' => __NAMESPACE__ . '\\' . substr(basename(ErrorAndNotificationSystemController::class), 0, -10) . '.php',
                        'databaseName'   => $_SERVER['DB_DATABASE'],
                        'tableName'      => 'error_and_notification_system'
                    ]),
                    'reference'          => config('app.url') . '/documentation/error#ERR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 500,
                        'general_message'=> 'The HyperText Transfer Protocol (HTTP) 500 Internal Server Error server error response code indicates that the server encountered an unexpected condition that prevented it from fulfilling the request.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500',
                    ],
                    'records'            => [],
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
            $request->validate([
                'notify_code'              => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:10',
                'notify_short_description' => 'required|max:255',
                'notify_reference'         => 'required|max:255',
            ]);
            $insertSingleRecord = $this->modelName->create([
                'notify_code'              => $request->get('notify_code'),
                'notify_short_description' => $request->get('notify_short_description'),
                'notify_reference'         => $request->get('notify_reference'),
            ]);
            return response([
                'notify_code'              => 'INFO_0003',
                'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0003')->pluck($this->tableAllColumns[2])[0],
                'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0003')->pluck($this->tableAllColumns[3])[0],
                'admin_message'            => __('error_and_notification_system.store.info_0003_admin_message', [
                                                'notifyCode'        => $request->get('notify_code'),
                                                'notifyDescription' => $request->get('notify_short_description'),
                                            ]),
                'records'                  => $insertSingleRecord,
            ], 201);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'error_code'               => 'ERR_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.store.err_0001_admin_message'),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22')
            {
                return response([
                    'error_code'               => 'ERR_0002',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.store.err_0002_admin_message'),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000')
            {
                return response([
                    'error_code'               => 'ERR_0003',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0003')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0003')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.store.err_0003_admin_message', [ 'notifyCode' => $request->get('notify_code') ]),
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
            $displayAllRecords = $this->modelName->all();
            $displaySingleRecord = $this->modelName->find($id);
            if ($displayAllRecords->isEmpty()) 
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'short_description'  => '',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [ 
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'controllerName' => __NAMESPACE__ . '\\' . substr(basename(ErrorAndNotificationSystemController::class), 0, -10) . '.php',
                        'databaseName'   => $_SERVER['DB_DATABASE'],
                        'tableName'      => $this->tableName 
                    ]),
                    'reference'          => config('app.url') . '/documentation/warning#WAR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 404,
                        'general_message'=> 'The HTTP 404 Not Found client error response code indicates that the server can\'t find the requested resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/404',
                    ],
                    'records'            => [],
                ], 404);
            }
            elseif (is_null($displaySingleRecord)) 
            {
                return response([
                    'title'              => __('error_and_notification_system.index.info_00006_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00006',
                    'short_description'  => '',
                    'description'        => __('error_and_notification_system.index.info_00006_notify.user_has_rights.message_super_admin', [ 
                        'numberOfRecords'=> $displayAllRecords->count(),
                        'databaseName'   => $_SERVER['DB_DATABASE'],
                        'tableName'      => $this->tableName 
                    ]),
                    'reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_00006')->pluck($this->tableAllColumns[3])[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 404,
                        'general_message'=> 'The HTTP 404 Not Found client error response code indicates that the server can\'t find the requested resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/404',
                    ],
                    'records'            => $displaySingleRecord,
                ], 404);
            }
            else 
            {
                return response([
                    'title'              => __('error_and_notification_system.index.info_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00001',
                    'short_description'  => '',
                    'description'        => __('error_and_notification_system.index.info_00001_notify.user_has_rights.message_super_admin', [ 
                        'numberOfRecords'=> $displayAllRecords->count(),
                        'databaseName'   => $_SERVER['DB_DATABASE'],
                        'tableName'      => $this->tableName 
                    ]),
                    'reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_00001')->pluck($this->tableAllColumns[3])[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 200,
                        'general_message'=> 'The HTTP 200 OK success status response code indicates that the request has succeeded. A 200 response is cacheable by default.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200',
                    ],
                    'records'            => $displaySingleRecord,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'title'              => __('error_and_notification_system.index.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'short_description'  => '',
                    'description'        => __('error_and_notification_system.index.err_00001_notify.user_has_rights.message_super_admin', [ 
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'controllerName' => __NAMESPACE__ . '\\' . substr(basename(ErrorAndNotificationSystemController::class), 0, -10) . '.php',
                        'databaseName'   => $_SERVER['DB_DATABASE'],
                        'tableName'      => 'error_and_notification_system'
                    ]),
                    'reference'          => config('app.url') . '/documentation/error#ERR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 500,
                        'general_message'=> 'The HyperText Transfer Protocol (HTTP) 500 Internal Server Error server error response code indicates that the server encountered an unexpected condition that prevented it from fulfilling the request.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500',
                    ],
                    'records'            => [],
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
            $updateSingleRecord = $this->modelName->find($id);
            $updateSingleRecord->update($request->validate([
                'notify_code'              => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:10',
                'notify_short_description' => 'required|max:255',
                'notify_reference'         => 'required|max:255',
            ]));
            return response([
                'notify_code'              => 'INFO_0006',
                'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[2])[0],
                'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[3])[0],
                'admin_message'            => __('error_and_notification_system.update.info_0006_admin_message', ['notifyCode' => $request->get('notify_code')]),
                'records'                  => $updateSingleRecord,
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'error_code'               => 'ERR_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.update.err_0001_admin_message'),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22')
            {
                return response([
                    'error_code'               => 'ERR_0002',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.update.err_0002_admin_message'),
                ], 500);
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
            $displayAllRecords = $this->modelName->all();
            $displaySingleRecord = $this->modelName->find($id);
            if ($displayAllRecords->isEmpty())
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.info_0001_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            elseif (is_null($displaySingleRecord))
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.info_0005_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            else
            {
                $apiDeleteSingleRecord = $this->modelName->find($id)->delete();
                return response([
                    'notify_code'              => 'INFO_0006',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.info_0006_admin_message', [ 'notifyCode' => $displaySingleRecord->notify_code ]),
                    'delete_records'           => $displaySingleRecord,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'error_short_description'  => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'error_reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.err_0001_admin_message'),
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllRecords()
    {
        try
        {
            $displayAllRecords = $this->modelName->all();
            if ($displayAllRecords->isEmpty())
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.info_0001_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            elseif (is_null($displayAllRecords))
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.info_0005_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            else
            {
                $apiDeleteSingleRecord = $this->modelName->truncate();
                return response([
                    'notify_code'              => 'INFO_0007',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0007')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0007')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.info_0007_admin_message', [ 'tableName' => $this->tableName ]),
                    'user_message'             => $displayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'error_short_description'  => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'error_reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }
}