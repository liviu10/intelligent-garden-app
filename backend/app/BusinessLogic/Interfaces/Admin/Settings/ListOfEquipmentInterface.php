<?php

namespace App\BusinessLogic\Interfaces\Admin\Settings;

use App\Http\Requests\Admin\Settings\ListOfEquipmentRequest;

/**
 * ListOfEquipmentInterface is a contract for what methods will be used in the ListOfEquipmentService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleShow();
 * - handleUpdate();
 * - handleOrderTableColumn();
 * - handleFilterTableColumn();
 */
interface ListOfEquipmentInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Admin\ListOfEquipmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(ListOfEquipmentRequest $request);

    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Admin\ListOfEquipmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(ListOfEquipmentRequest $request, $id);

    /**
     * Order all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleOrderTableColumn($request);

    /**
     * Filter all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleFilterTableColumn($request);
}
