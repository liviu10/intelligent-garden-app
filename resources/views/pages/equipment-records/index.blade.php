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
                        <b>
                            <u>
                                @if ($filterParameter == 1) pH Sensor
                                @elseif ($filterParameter == 2) Electrical Conductivity Sensor
                                @elseif ($filterParameter == 3) Level Sensor
                                @elseif ($filterParameter == 4) pH-- Pump
                                @elseif ($filterParameter == 5) pH++ Pump
                                @elseif ($filterParameter == 6) Nutrients Pump
                                @endif
                            </u>
                        </b>
                                @if ($filterParameter > 6 || $filterParameter == null) &#8212;
                                @endif
                    </p>
                    <p class="statistics__header-description-paragraph">
                        {{ __('equipment_records.page_header.info_4') }}<br>
                        <form action="{{ route('equipment-records.index') }}" method="GET">
                            @foreach ($displayAllEquipments as $key => $equipments)
                            <button type="submit" class="btn btn-info" value="{{ $equipments['id'] }}" name="equipment_id">
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
                        <x-google-data-chart></x-google-data-chart>
                    </div>
                <!-- PAGE: EQUIPMENT RECORDS LINE CHART, SECTION END -->

                <!-- PAGE: EQUIPMENT RECORDS TABLE, SECTION START -->
                    <div class="statistics__main-content-table">

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
                                                <form action="{{ route('equipment-records.store') }}" method="POST">
                                                    @csrf
                                                    <div class="container-form">
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                {{ strtoupper(__('equipment_records.page_modal_new.form.label_1')) }}
                                                            </span>
                                                            <select class="form-select form-select-lg input-sensor-id" name="arduino_list_of_equipment_id" required>
                                                                <option selected>Choose the equipment name</option>
                                                                @foreach ($displayAllEquipments as $key => $equipment)
                                                                <option value="{{ $equipment['id'] }}">
                                                                    {{ $equipment['equipment_description'] }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                {{ strtoupper(__('equipment_records.page_modal_new.form.label_2')) }}
                                                            </span>
                                                            <input type="number" class="form-control input-sensor-value" name="equipment_value" min="0.00" max="" step="0.01" required>
                                                        </div>
                                                        <div class="input-group-button">
                                                            <button type="submit" class="btn btn-success rounded-0 my-2" title="{{ __('equipment_records.page_modal_new.btn_save.title') }}">
                                                                <i class="fas fa-check"></i>
                                                                {{ __('equipment_records.page_modal_new.btn_save.label') }}
                                                            </button>
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
                                                {{ strtoupper(__('equipment_records.page_modal_statistics.ph_sensor.title')) }}:
                                                @if ($filterParameter == 1) pH Sensor
                                                @elseif ($filterParameter == 2) Electrical Conductivity Sensor
                                                @elseif ($filterParameter == 3) Level Sensor
                                                @elseif ($filterParameter == 4) pH-- Pump
                                                @elseif ($filterParameter == 5) pH++ Pump
                                                @elseif ($filterParameter == 6) Nutrients Pump
                                                @else &#8212;
                                                @endif
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($filterParameter == 1) @include('pages.equipment-records.partials.statistics-ph-sensor')
                                            @elseif ($filterParameter == 2) @include('pages.equipment-records.partials.statistics-ec-sensor')
                                            @elseif ($filterParameter == 3) @include('pages.equipment-records.partials.statistics-level-sensor')
                                            @elseif ($filterParameter == 4) @include('pages.equipment-records.partials.statistics-pump1')
                                            @elseif ($filterParameter == 5) @include('pages.equipment-records.partials.statistics-pump2')
                                            @elseif ($filterParameter == 6) @include('pages.equipment-records.partials.statistics-pump3')
                                            @else
                                                <p class="lead">Currently, you are not viewing any particular equipment record(s)! To see the statistics of a certain equipment close this window and press on one of the above filter buttons!</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- PAGE: EQUIPMENT RECORDS STATISTICS MODAL, SECTION END -->

                        <div class="container-table">
                            @if ($displayAllRecords->isEmpty() || $filterParameter > count($displayAllEquipments) || $filterParameter == null)
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
                                        <tbody class="table-body">
                                            <tr>
                                                <td colspan="3" class="table-body__cell">
                                                    <p class="table-body__typography text-center">
                                                        Currently, you are not viewing any particular equipment record(s)! Start by pressing on one of the above filter buttons!
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <!-- PAGE: EQUIPMENT RECORDS TABLE BODY, SECTION END -->
                                </table>
                            @else
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
                                                            @if ($data['arduino_list_of_equipment_id'] === 1)
                                                                {{ number_format($data['equipment_value'], 2, '.', '') }} pH
                                                            @elseif ($data['arduino_list_of_equipment_id'] === 2)
                                                                {{ number_format($data['equipment_value'], 2, '.', '') }} [ms/cm] &vert; 
                                                                {{ number_format($data['equipment_value'], 2, '.', '') * $truncheonMeasurement }} [ppm]
                                                            @elseif ($data['arduino_list_of_equipment_id'] === 3)
                                                                @if ($data['equipment_value'] === 1.00)
                                                                    low
                                                                @elseif ($data['equipment_value'] === 2.00)
                                                                    normal
                                                                @else
                                                                    high
                                                                @endif
                                                            @elseif ($data['arduino_list_of_equipment_id'] === 4 || $data['arduino_list_of_equipment_id'] === 5 || $data['arduino_list_of_equipment_id'] === 6)
                                                                @if ($data['equipment_value'] === 1.00)
                                                                    stopped
                                                                @else
                                                                    started
                                                                @endif
                                                            @endif
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
                            @endif
                        </div>

                    </div>
                <!-- PAGE: EQUIPMENT RECORDS TABLE, SECTION END -->

            </div>

        <!-- PAGE: EQUIPMENT RECORDS MAIN CONTENT, SECTION END -->

        @include('components.footer')

    </div>

@endsection