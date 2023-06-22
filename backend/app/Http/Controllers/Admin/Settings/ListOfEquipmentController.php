<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Settings\ListOfEquipmentInterface;
use App\Http\Requests\Admin\Settings\ListOfEquipmentRequest;

class ListOfEquipmentController extends Controller
{
    protected ListOfEquipmentInterface $listOfEquipmentService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ListOfEquipmentInterface $listOfEquipmentService)
    {
        $this->listOfEquipmentService = $listOfEquipmentService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->listOfEquipmentService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ListOfEquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListOfEquipmentRequest $request)
    {
        return $this->listOfEquipmentService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->listOfEquipmentService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ListOfEquipmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListOfEquipmentRequest $request, $id)
    {
        return $this->listOfEquipmentService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->listOfEquipmentService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->listOfEquipmentService->handleFilterTableColumn($request);
    }
}
