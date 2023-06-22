<?php

namespace App\BusinessLogic\Services\Admin\Settings;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Settings\EquipmentReadingInterface;
use App\Http\Requests\Admin\Settings\EquipmentReadingRequest;
use App\Models\Admin\Settings\EquipmentReading;
use Illuminate\Database\Eloquent\Collection;

/**
 * EquipmentReadingService is a service class the will implement all the methods from the EquipmentReadingInterface contract and will handle the business logic.
 */
class EquipmentReadingService implements EquipmentReadingInterface
{
    use ApiResponseMessage;

    protected $modelName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->modelName = new EquipmentReading();
    }

    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex()
    {
        $apiDisplayAllRecords = $this->modelName->fetchAllRecords();

        if ($apiDisplayAllRecords instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                return response($this->handleResponse('success', $apiDisplayAllRecords), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Store a new record in the database.
     * @param  EquipmentReadingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(EquipmentReadingRequest $request)
    {
        $apiInsertRecord = [
            'list_of_equipment_id' => $request->get('list_of_equipment_id'),
            'equipment_value'      => $request->get('equipment_value'),
            'user_id'              => 1,
        ];
        $saveRecord = $this->modelName->createRecord($apiInsertRecord);

        if ($saveRecord === true)
        {
            return response($this->handleResponse('success'), 201);
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Fetch a single record from the database.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id)
    {
        $apiDisplaySingleRecord = $this->modelName->fetchSingleRecord($id);

        if ($apiDisplaySingleRecord instanceof Collection)
        {
            if ($apiDisplaySingleRecord->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                return response($this->handleResponse('success', $apiDisplaySingleRecord), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  EquipmentReadingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(EquipmentReadingRequest $request, $id)
    {
        $apiUpdateRecord = [
            'list_of_equipment_id' => $request->get('list_of_equipment_id'),
            'equipment_value'      => $request->get('equipment_value'),
            'user_id'              => 1,
        ];
        $updateRecord = $this->modelName->updateRecord($apiUpdateRecord, $id);

        if ($updateRecord === true)
        {
            return response($this->handleResponse('success'), 200);
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Order all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleOrderTableColumn($request)
    {
        $orderTableColumnPayload = [
            'column_name' => $request->get('column_name'),
            'order_type'  => $request->get('order_type')
        ];
        $apiOrderAllRecords = $this->modelName->orderTableColumn($orderTableColumnPayload);

        if ($apiOrderAllRecords instanceof Collection)
        {
            if ($apiOrderAllRecords->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                return response($this->handleResponse('success', $apiOrderAllRecords), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Filter all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleFilterTableColumn($request)
    {
        $filterTableColumnPayload = [
            'column_name'  => $request->get('column_name'),
            'filter_value' => $request->get('filter_value')
        ];
        $apiFilterAllRecords = $this->modelName->filterTableColumn($filterTableColumnPayload);

        if ($apiFilterAllRecords instanceof Collection)
        {
            if ($apiFilterAllRecords->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                return response($this->handleResponse('success', $apiFilterAllRecords), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }
}
