<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Settings\UserInterface;
use App\Http\Requests\Admin\Settings\UserRequest;

class UserController extends Controller
{
    protected UserInterface $userService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(UserInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return $this->userService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->userService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        return $this->userService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->userService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->userService->handleFilterTableColumn($request);
    }
}
