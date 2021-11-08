@extends('layouts.app')
@extends('components.navbar')

@section('content')

    <div class="statistics">

        <!-- PAGE: EQUIPMENT RECORDS HEADER, SECTION START -->
            <div class="statistics__header">
                <div class="statistics__header-description">
                    <h2 class="statistics__header-description-title">
                        {{ __('equipment_records.page_title') }}
                    </h2>
                    <p class="statistics__header-description-paragraph">
                        {{ __('equipment_records.page_header.info_1') }}
                    </p>
                    <p class="statistics__header-description-paragraph">
                        {{ __('equipment_records.page_header.info_2') }}
                    </p>
                    <p class="statistics__header-description-paragraph">
                        {{ __('equipment_records.page_header.info_3') }}
                    </p>
                    <p class="statistics__header-description-paragraph">
                        {{ __('equipment_records.page_header.info_4') }}<br>
                        <form action="" method="">
                            @foreach ($displayAllEquipments as $key => $equipments)
                            <button type="submit" class="btn btn-info">                                
                                {{ ucwords(strtolower(strtok(trim($equipments['equipment_id']), '_'))) }}
                                {{ substr($equipments['equipment_id'], strrpos($equipments['equipment_id'], '_') + 1) }}
                            </button>
                            @endforeach
                        </form>
                    </p>
                </div>
            </div>
        <!-- PAGE: EQUIPMENT RECORDS HEADER, SECTION END -->

        <!-- PAGE: EQUIPMENT RECORDS MAIN CONTENT, SECTION START -->

            <div class="statistics__main-content">

                <!-- PAGE: EQUIPMENT RECORDS LINE CHART, SECTION START -->
                    <div class="statistics__main-content-line-chart">
                        <!-- x-ph-line-chart -->
                    </div>
                <!-- PAGE: EQUIPMENT RECORDS LINE CHART, SECTION END -->

                <!-- PAGE: EQUIPMENT RECORDS TABLE, SECTION START -->
                    <div class="statistics__main-content-table">

                        <!-- PAGE: EQUIPMENT RECORDS TABLE OPTIONS, SECTION START -->
                            <div class="statistics__main-content-table__button">
                                <button type="button"
                                        class="btn btn-success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModalAddNew"
                                        title="{{ __('equipment_records.page_header.btn_add.title') }}"
                                >
                                    <i class="fas fa-plus"></i>
                                    {{ __('equipment_records.page_header.btn_add.label') }}
                                </button>
                                <a class="btn btn-primary"
                                    href=""
                                    title="{{ __('equipment_records.page_header.btn_export.title') }}"
                                >
                                    <i class="fas fa-file-export"></i>
                                    {{ __('equipment_records.page_header.btn_export.label') }}
                                </a>
                                <button type="button"
                                        class="btn btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModalEquipmentStatistics"
                                        title="{{ __('equipment_records.page_header.btn_statistics.title') }}"
                                >
                                    <i class="fas fa-paste"></i>
                                    {{ __('equipment_records.page_header.btn_statistics.label') }}
                                </button>
                            </div>
                        <!-- PAGE: EQUIPMENT RECORDS TABLE OPTIONS, SECTION END -->

                        <!-- PAGE: EQUIPMENT RECORDS ADD NEW MODAL, SECTION START -->
                            <div class="modal fade" id="exampleModalAddNew" tabindex="-1" aria-labelledby="exampleModalAddNew" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content equipments-create-record">
                                        <!-- MODAL HEADER, SECTION START -->
                                        <div class="modal-header equipments-create-record__header">
                                            <div class="equipments-create-record__header-description">
                                                <h5 class="modal-title equipments-create-record__header-description-title" id="exampleModalAddNewLabel">
                                                    {{ strtoupper(__('equipment_records.page_modal_new.title')) }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <!-- MODAL HEADER, SECTION END -->
                                        <!-- MODAL BODY, SECTION START -->
                                        <div class="modal-body equipments-create-record__form">
                                            <p class="lead equipments-create-record__header-description-paragraph">
                                                {{ __('equipment_records.page_modal_new.info_1') }}
                                            </p>
                                            <div class="equipments-create-record__form">
                                                <!-- MODAL BODY FORM, SECTION START -->
                                                <form action="{{ route('list-of-equipments.store') }}" method="POST">
                                                    @csrf
                                                    <div class="container-form">
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                {{ strtoupper(__('equipment_records.page_modal_new.form.label_1')) }}
                                                            </span>
                                                            <input type="text" class="form-control input-sensor-id" name="equipment_id" required>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                {{ strtoupper(__('equipment_records.page_modal_new.form.label_2')) }}
                                                            </span>
                                                            <input type="number" class="form-control input-sensor-value" name="equipment_value" required>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- MODAL BODY FORM, SECTION END -->
                                            </div>
                                        </div>
                                        <!-- MODAL BODY, SECTION END -->
                                    </div>
                                </div>
                            </div>
                        <!-- PAGE: EQUIPMENT RECORDS ADD NEW MODAL, SECTION END -->

                        <!-- PAGE: EQUIPMENT RECORDS STATISTICS MODAL, SECTION START -->
                            <div class="modal fade" id="exampleModalEquipmentStatistics" tabindex="-1" aria-labelledby="exampleModalEquipmentStatistics" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalEquipmentStatistics">
                                                {{ strtoupper(__('equipment_records.page_modal_statistics.ph_sensor.title', [ 'sensorDescription' => $displayAllRecords[0]['equipment_description'] ])) }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="lead">{{ __('equipment_records.page_modal_statistics.ph_sensor.title_5') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_1') }}:
                                                    $displayStatistics['# of Total Measurements']
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Smallest Value of all time'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Highest Value of all time'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Average Value of all time'] pH
                                                </li>
                                            </ul>
                                            <p class="lead">{{ __('equipment_records.page_modal_statistics.ph_sensor.title_4') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Last Week Minimum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Last Week Maximum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Last Week Average value'] pH
                                                </li>
                                            </ul>
                                            <p class="lead">{{ __('equipment_records.page_modal_statistics.ph_sensor.title_3') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Yesterday Minimum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Yesterday Maximum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Yesterday Average value'] pH
                                                </li>
                                            </ul>
                                            <p class="lead">{{ __('equipment_records.page_modal_statistics.ph_sensor.title_2') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Today Minimum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Today Maximum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_modal_statistics.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Today Average value'] pH
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- PAGE: EQUIPMENT RECORDS STATISTICS MODAL, SECTION END -->

                        <div class="container-table">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p class="my-0">{{ $message }}</p>
                                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                {{ __('equipment_records.error_info') }}<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <table class="table table--standard">

                                <!-- PAGE: EQUIPMENT RECORDS TABLE HEADER, SECTION START -->
                                    <thead class="table-head">
                                        <tr>
                                            <th class="table-head__cell">
                                                <p class="table-head__typography">{{ strtoupper(__('equipment_records.page_table.label_1')) }}</p>
                                            </th>
                                            <th class="table-head__cell">
                                                <p class="table-head__typography">{{ strtoupper(__('equipment_records.page_table.label_2')) }}</p>
                                            </th>
                                            <th class="table-head__cell">
                                                <p class="table-head__typography">{{ strtoupper(__('equipment_records.page_table.label_3.title')) }}</p>
                                            </th>
                                        </tr>
                                    </thead>
                                <!-- PAGE: EQUIPMENT RECORDS TABLE HEADER, SECTION END -->

                                <!-- PAGE: EQUIPMENT RECORDS TABLE BODY, SECTION START -->
                                    @foreach ($displayAllRecords as $key => $data)
                                    <tbody class="table-body">
                                        <tr>
                                            <td class="table-body__cell">
                                                <p class="table-body__typography">
                                                    {{ number_format($data['equipment_value']) }}
                                                </p>
                                            </td>
                                            <td class="table-body__cell">
                                                <p class="table-body__typography">
                                                    {{
                                                        date("d", strtotime($data['updated_at'])) . '.' . 
                                                        date("m", strtotime($data['updated_at'])) . '.' . 
                                                        date("Y", strtotime($data['updated_at'])) . ' ' .
                                                        date("H", strtotime($data['updated_at'])) . ':' . 
                                                        date("i", strtotime($data['updated_at'])) . ':' . 
                                                        date("s", strtotime($data['updated_at']))
                                                    }}
                                                </p>
                                            </td>
                                            <td class="table-body__cell">
                                                <form action="{{ route('equipment-records.destroy', $data['id']) }}" method="POST" class="table-body-form">
                                                    <div class="table-body-form__actions">
                                                        <a href="{{ route('equipment-records.edit', $data['id']) }}"
                                                            class="table-body-form__actions__btn table-body-form__actions__btn--warning"
                                                            title="{{ __('equipment_records.page_table.column_4.btn_edit', ['sensorDescription' => $displayAllRecords[0]['equipment_description']]) }}"
                                                        >
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="table-body-form__actions__btn table-body-form__actions__btn--danger"
                                                                title="{{ __('equipment_records.page_table.column_4.btn_delete', ['sensorDescription' => $displayAllRecords[0]['equipment_description']]) }}"
                                                        >
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                <!-- PAGE: EQUIPMENT RECORDS TABLE BODY, SECTION END -->

                            </table>
                            {!! $displayAllRecords->links('pagination::bootstrap-4') !!}
                        </div>

                    </div>
                <!-- PAGE: EQUIPMENT RECORDS TABLE, SECTION END -->

            </div>

        <!-- PAGE: EQUIPMENT RECORDS MAIN CONTENT, SECTION END -->

        @include('components.footer')

    </div>

@endsection