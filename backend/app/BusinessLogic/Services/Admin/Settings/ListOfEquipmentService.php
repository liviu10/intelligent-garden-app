<?php

namespace App\BusinessLogic\Services\Admin\Settings;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Settings\ListOfEquipmentInterface;
use App\Http\Requests\Admin\Settings\ListOfEquipmentRequest;
use App\Models\Admin\Settings\ListOfEquipment;
use Illuminate\Database\Eloquent\Collection;

/**
 * ListOfEquipmentService is a service class the will implement all the methods from the ListOfEquipmentInterface contract and will handle the business logic.
 */
class ListOfEquipmentService implements ListOfEquipmentInterface
{
    use ApiResponseMessage;

    protected $modelName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->modelName = new ListOfEquipment();
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
     * @param  ListOfEquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(ListOfEquipmentRequest $request)
    {
        $apiInsertRecord = [
            'equipment_id'          => $request->get('equipment_id'),
            'equipment_description' => $request->get('equipment_description'),
            'equipment_notes'       => $request->get('equipment_notes'),
            'equipment_is_active'   => $request->get('equipment_is_active'),
            'user_id'               => 1,
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
     * @param  ListOfEquipmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(ListOfEquipmentRequest $request, $id)
    {
        $apiUpdateRecord = [
            'equipment_id'          => $request->get('equipment_id'),
            'equipment_description' => $request->get('equipment_description'),
            'equipment_notes'       => $request->get('equipment_notes'),
            'equipment_is_active'   => $request->get('equipment_is_active'),
            'user_id'               => 1,
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
