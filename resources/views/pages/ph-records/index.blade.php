@extends('layouts.app')
@extends('components.navbar')

@section('content')

    <div class="statistics">

        <!-- CONTENT HEADER SECTION START -->
            <div class="statistics__header">
                <div class="statistics__header-description">
                    <h2 class="statistics__header-description-title">
                        {{ __('equipment_records.page_title') }}:
                        {{ ucwords(strtolower(strtok(trim($displayAllRecords[0]['equipment_id']), '_'))) }}
                        {{ substr($displayAllRecords[0]['equipment_id'], strrpos($displayAllRecords[0]['equipment_id'], '_') + 1) }}
                    </h2>
                    <p class="statistics__header-description-paragraph">
                        {{ __('equipment_records.page_info_1', ['sensorDescription' => $displayAllRecords[0]['equipment_description'] ]) }}
                    </p>
                    <p class="statistics__header-description-paragraph">{{ __('equipment_records.page_info_2') }}</p>
                </div>
            </div>
        <!-- CONTENT HEADER SECTION END -->

        <!-- CONTENT MAIN SECTION START -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p class="my-0">{{ $message }}</p>
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="statistics__main-content">

                <!-- CONTENT LINE CHART SECTION START -->
                    <div class="statistics__main-content-line-chart">
                        <!-- x-ph-line-chart -->
                    </div>
                <!-- CONTENT LINE CHART SECTION END -->

                <!-- CONTENT TABLE SECTION START -->
                    <div class="statistics__main-content-table">

                        <!-- CONTENT BUTTONS SECTION START -->
                            <div class="statistics__main-content-table__button">
                                <button type="button"
                                        class="btn btn-success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"
                                        title="{{ __('equipment_records.page_btn_add.title') }}"
                                >
                                    <i class="fas fa-plus"></i>
                                    {{ __('equipment_records.page_btn_add.label') }}
                                </button>
                                <a class="btn btn-primary"
                                    href=""
                                    title="{{ __('equipment_records.page_btn_export.title', [ 'sensorDescription' =>  $displayAllRecords[0]['equipment_description'] ]) }}"
                                >
                                    <i class="fas fa-file-export"></i>
                                    {{ __('equipment_records.page_btn_export.label') }}
                                </a>
                                <button type="button"
                                        class="btn btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModal1"
                                        title="{{ __('equipment_records.page_btn_statistics.title', [ 'sensorDescription' =>  $displayAllRecords[0]['equipment_description'] ]) }}"
                                >
                                    <i class="fas fa-paste"></i>
                                    {{ __('equipment_records.page_btn_statistics.label') }}
                                </button>
                            </div>
                        <!-- CONTENT BUTTONS CHART SECTION END -->

                        <!-- CONTENT MODAL ADD NEW SECTION START -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ strtoupper(__('equipment_records.page_btn_add.modal.title')) }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="lead">{{ __('equipment_records.page_btn_add.modal.last_record_info') }}</p>
                                            <p class="lead">
                                                {{ number_format($displayAllRecords[0]['equipment_value'], 2, '.') . 'ph' }}
                                                @if ( $displayAllRecords[0]['created_at'] = $displayAllRecords[0]['updated_at'] )
                                                    {{ 
                                                        __(
                                                            'equipment_records.page_btn_add.modal.last_record_details', 
                                                            [
                                                                'created_at_date' => date("d", strtotime($displayAllRecords[0]['created_at'])) . '.' . date("m", strtotime($displayAllRecords[0]['created_at'])) . '.' . date("Y", strtotime($displayAllRecords[0]['created_at'])),
                                                                'created_at_time' => date("H", strtotime($displayAllRecords[0]['created_at'])) . ':' . date("i", strtotime($displayAllRecords[0]['created_at'])) . ':' . date("s", strtotime($displayAllRecords[0]['created_at'])),
                                                            ]
                                                        ) 
                                                    }}
                                                @elseif ( $displayAllRecords[0]['created_at'] <> $displayAllRecords[0]['updated_at'] )
                                                    {{ 
                                                        __(
                                                            'equipment_records.page_btn_add.modal.last_record_details', 
                                                            [
                                                                'created_at_date' => date("d", strtotime($displayAllRecords[0]['updated_at'])) . '.' . date("m", strtotime($displayAllRecords[0]['updated_at'])) . '.' . date("Y", strtotime($displayAllRecords[0]['updated_at'])),
                                                                'created_at_time' => date("H", strtotime($displayAllRecords[0]['updated_at'])) . ':' . date("i", strtotime($displayAllRecords[0]['updated_at'])) . ':' . date("s", strtotime($displayAllRecords[0]['updated_at'])),
                                                            ]
                                                        ) 
                                                    }}
                                                @endif
                                            </p>
                                            <form action="{{ route('ph-records.store') }}" method="POST">
                                                @csrf
                                                <div class="container-form">
                                                    <div class="input-group">
                                                        <span class="input-group-text">{{ strtoupper(__('equipment_records.page_btn_add.modal.first_label')) }}</span>
                                                        <input type="text" class="form-control input-sensor-id" name="equipment_id" required>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-text">{{ strtoupper(__('equipment_records.page_btn_add.modal.second_label')) }}</span>
                                                        <input type="number" class="form-control input-sensor-value" name="equipment_value" min="" max="" step="0.01" required>
                                                    </div>
                                                    <div class="input-group-button">
                                                        <button type="submit" class="btn btn-success rounded-0 my-2" title="{{ __('equipment_records.page_btn_add.modal.btn_title') }}">
                                                            <i class="fas fa-check"></i>
                                                            {{ strtoupper(__('equipment_records.page_btn_add.modal.btn_name')) }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- CONTENT MODAL ADD NEW SECTION START -->

                        <!-- CONTENT MODAL STATISTICS SECTION START -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ strtoupper(__('equipment_records.page_btn_statistics.modal.ph_sensor.title', [ 'sensorDescription' => $displayAllRecords[0]['equipment_description'] ])) }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="lead">{{ __('equipment_records.page_btn_statistics.modal.ph_sensor.title_5') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_1') }}:
                                                    $displayStatistics['# of Total Measurements']
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Smallest Value of all time'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Highest Value of all time'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Average Value of all time'] pH
                                                </li>
                                            </ul>
                                            <p class="lead">{{ __('equipment_records.page_btn_statistics.modal.ph_sensor.title_4') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Last Week Minimum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Last Week Maximum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Last Week Average value'] pH
                                                </li>
                                            </ul>
                                            <p class="lead">{{ __('equipment_records.page_btn_statistics.modal.ph_sensor.title_3') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Yesterday Minimum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Yesterday Maximum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Yesterday Average value'] pH
                                                </li>
                                            </ul>
                                            <p class="lead">{{ __('equipment_records.page_btn_statistics.modal.ph_sensor.title_2') }}</p>
                                            <ul class="list">
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_2') }}:
                                                    $displayStatistics['Today Minimum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_3') }}:
                                                    $displayStatistics['Today Maximum value'] pH
                                                </li>
                                                <li class="list-item">
                                                    {{ __('equipment_records.page_btn_statistics.modal.ph_sensor.list_item_4') }}:
                                                    $displayStatistics['Today Average value'] pH
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- CONTENT MODAL STATISTICS SECTION START -->

                        <div class="container-table">
                            <table class="table table--standard">

                                <!-- TABLE HEADER SECTION START -->
                                    <thead class="table-head">
                                        <tr>
                                            <th class="table-head__cell">
                                                <p class="table-head__typography">{{ strtoupper(__('equipment_records.page_table.column_2')) }}</p>
                                            </th>
                                            <th class="table-head__cell">
                                                <p class="table-head__typography">{{ strtoupper(__('equipment_records.page_table.column_3')) }}</p>
                                            </th>
                                            <th class="table-head__cell">
                                                <p class="table-head__typography">{{ strtoupper(__('equipment_records.page_table.column_4.title')) }}</p>
                                            </th>
                                        </tr>
                                    </thead>
                                <!-- TABLE HEADER SECTION END -->

                                <!-- TABLE BODY SECTION START -->
                                    @foreach ($displayAllRecords as $key => $data)
                                    <tbody class="table-body">
                                        @for ($i = 0; $i < count($data['arduino_equipment_records']); $i++)
                                        <tr>
                                            <td class="table-body__cell">
                                                <p class="table-body__typography">
                                                    {{ number_format($data['arduino_equipment_records'][$i]['equipment_value']) }}
                                                </p>
                                            </td>
                                            <td class="table-body__cell">
                                                <p class="table-body__typography">
                                                    {{
                                                        date("d", strtotime($data['arduino_equipment_records'][$i]['updated_at'])) . '.' . 
                                                        date("m", strtotime($data['arduino_equipment_records'][$i]['updated_at'])) . '.' . 
                                                        date("Y", strtotime($data['arduino_equipment_records'][$i]['updated_at'])) . ' ' .
                                                        date("H", strtotime($data['arduino_equipment_records'][$i]['updated_at'])) . ':' . 
                                                        date("i", strtotime($data['arduino_equipment_records'][$i]['updated_at'])) . ':' . 
                                                        date("s", strtotime($data['arduino_equipment_records'][$i]['updated_at']))
                                                    }}
                                                </p>
                                            </td>
                                            <td class="table-body__cell">
                                                <form action="{{ route('ph-records.destroy', $data['arduino_equipment_records'][$i]['id']) }}" method="POST" class="table-body-form">
                                                    <div class="table-body-form__actions">
                                                        <a href="{{ route('ph-records.edit', $data['arduino_equipment_records'][$i]['id']) }}"
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
                                        @endfor
                                    </tbody>
                                    @endforeach
                                <!-- TABLE BODY SECTION END -->

                            </table>
                            <!-- TODO: Paginate Child Element from the Eloquent Model -->
                            <!-- {!! $displayAllRecords->links('pagination::bootstrap-4') !!} -->
                        </div>

                    </div>
                <!-- CONTENT TABLE SECTION END -->

            </div>

        <!-- CONTENT MAIN SECTION END -->     

        @include('components.footer')

    </div>

@endsection