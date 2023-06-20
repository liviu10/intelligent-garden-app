<?php

namespace App\BusinessLogic\Interfaces\Admin\Settings;

use App\Http\Requests\Admin\Settings\UserRoleTypeRequest;

/**
 * UserRoleTypeInterface is a contract for what methods will be used in the UserRoleTypeService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleOrderTableColumn();
 * - handleFilterTableColumn();
 */
interface UserRoleTypeInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);

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
