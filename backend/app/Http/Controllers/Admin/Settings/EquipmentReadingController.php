<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Settings\EquipmentReadingInterface;
use App\Http\Requests\Admin\Settings\EquipmentReadingRequest;

class EquipmentReadingController extends Controller
{
    protected EquipmentReadingInterface $equipmentReeadingService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(EquipmentReadingInterface $equipmentReeadingService)
    {
        $this->equipmentReeadingService = $equipmentReeadingService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->equipmentReeadingService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  EquipmentReadingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentReadingRequest $request)
    {
        return $this->equipmentReeadingService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->equipmentReeadingService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  EquipmentReadingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentReadingRequest $request, $id)
    {
        return $this->equipmentReeadingService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->equipmentReeadingService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->equipmentReeadingService->handleFilterTableColumn($request);
    }
}
