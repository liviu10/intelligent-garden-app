@extends('layouts.app')
@extends('components.navbar')

@section('content')

    <div class="equipments">

        <!-- PAGE: EQUIPMENT LIST HEADER, SECTION START -->
            <div class="equipments__header">
                <div class="equipments__header-description">
                    <h2 class="equipments__header-description-title">{{ strtoupper(__('list_of_equipments.page_title')) }}</h2>
                    <p class="equipments__header-description-paragraph">
                        {{ __('list_of_equipments.page_header.info_1') }}
                    </p>
                    <p class="equipments__header-description-paragraph">
                        {{ __('list_of_equipments.page_header.info_2') }}
                    </p>
                    <div class="equipments__header-description-button">
                        <button type="button"
                                class="btn btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModalCreateEquipment"
                                title="{{ __('list_of_equipments.page_header.btn_add.title') }}"
                        >
                            <i class="fas fa-plus"></i>
                            {{ strtoupper(__('list_of_equipments.page_header.btn_add.label')) }}
                        </button>
                    </div>
                </div>
            </div>
        <!-- PAGE: EQUIPMENT LIST HEADER, SECTION END -->

        <!-- PAGE: EQUIPMENT LIST MAIN CONTENT, SECTION START -->

            <div class="equipments__main-content">

                <!-- PAGE: EQUIPMENT LIST ADD NEW RECORD, SECTION START -->
                    <div class="modal fade" id="exampleModalCreateEquipment" tabindex="-1" aria-labelledby="exampleModalCreateEquipment" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content equipments-create-record">
                                <!-- MODAL HEADER, SECTION START -->
                                <div class="modal-header equipments-create-record__header">
                                    <div class="equipments-create-record__header-description">
                                        <h5 class="modal-title equipments-create-record__header-description-title" id="exampleModalCreateEquipmentLabel">
                                            {{ strtoupper(__('list_of_equipments.page_modal_new.title', [ 'sensorDescription' => $displayAllRecords[0]['equipment_description'] ])) }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <!-- MODAL HEADER, SECTION END -->
                                <!-- MODAL BODY, SECTION START -->
                                <div class="modal-body equipments-create-record__form">
                                    <p class="lead equipments-create-record__header-description-paragraph">
                                        {{ __('list_of_equipments.page_modal_new.info_1') }}
                                    </p>
                                    <div class="equipments-create-record__form">
                                        <!-- MODAL BODY FORM, SECTION START -->
                                        <form action="{{ route('list-of-equipments.store') }}" method="POST">
                                            @csrf
                                            <div class="container-form">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        {{ strtoupper(__('list_of_equipments.page_modal_new.form.label_1')) }}
                                                    </span>
                                                    <input type="text" class="form-control input-sensor-id" name="equipment_id" required>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                    {{ strtoupper(__('list_of_equipments.page_modal_new.form.label_2')) }}
                                                    </span>
                                                    <input type="text" class="form-control input-sensor-description" name="equipment_description" required>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        {{ strtoupper(__('list_of_equipments.page_modal_new.form.label_3')) }}
                                                    </span>
                                                    <input type="text" class="form-control input-sensor-notes" name="equipment_notes" required>
                                                </div>
                                                <div class="input-group-button">
                                                    <button type="submit" class="btn btn-success rounded-0 my-2" title="{{ __('list_of_equipments.page_modal_new.btn_save.title') }}">
                                                        <i class="fas fa-check"></i>
                                                        {{ __('list_of_equipments.page_modal_new.btn_save.label') }}
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
                <!-- PAGE: EQUIPMENT LIST ADD NEW RECORD, SECTION END -->
                
                <!-- PAGE: EQUIPMENT LIST TABLE, SECTION START -->
                    <div class="container-table">
                        
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p class="my-0">{{ $message }}</p>
                                <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                            {{ __('list_of_equipments.error_info') }}<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table table--standard">

                            <!-- PAGE: EQUIPMENT LIST TABLE HEADER, SECTION START -->
                                <thead class="table-head">
                                    <tr>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.label_1')) }}
                                            </p>
                                        </th>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.label_2')) }}
                                            </p>
                                        </th>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.label_4')) }}
                                            </p>
                                        </th>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.label_5.title')) }}
                                            </p>
                                        </th>
                                    </tr>
                                </thead>
                            <!-- PAGE: EQUIPMENT LIST TABLE HEADER, SECTION END -->

                            <!-- PAGE: EQUIPMENT LIST TABLE BODY, SECTION START -->
                                @if ($displayAllRecords->isEmpty())
                                    <tbody class="table-body">
                                        <tr>
                                            <td colspan="4" class="table-body__cell">
                                                <p class="table-body__typography">
                                                    Currently, there are no equipments defined in the database! Add your first Equipment by clicking on&nbsp;
                                                    <a href="{{ route('list-of-equipments.create') }}" title="{{ __('list_of_equipments.page_table.empty.btn_save.title') }}">
                                                        {{ __('list_of_equipments.page_table.empty.btn_save.label') }}
                                                    </a>!
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                @else
                                    @foreach ($displayAllRecords as $key => $data)
                                    <tbody class="table-body">
                                        <tr>
                                            <td class="table-body__cell">
                                                <p class="table-body__typography">{{ $data->equipment_id }}</p>
                                            </td>
                                            <td class="table-body__cell">
                                                <p class="table-body__typography">{{ $data->equipment_description }}</p>
                                            </td>
                                            <td class="table-body__cell">
                                                @if ( $data->created_at = $data->updated_at )
                                                    <p class="table-body__typography">
                                                        {{ date("d", strtotime($data->created_at)) }}.{{ date("m", strtotime($data->created_at)) }}.{{ date("Y", strtotime($data->created_at)) }} at 
                                                        {{ date("H", strtotime($data->created_at)) }}:{{ date("i", strtotime($data->created_at)) }}
                                                    </p>
                                                @elseif ( $data->created_at <> $data->updated_at )
                                                    <p class="table-body__typography">
                                                        {{ date("d", strtotime($data->updated_at)) }}.{{ date("m", strtotime($data->updated_at)) }}.{{ date("Y", strtotime($data->updated_at)) }} at 
                                                        {{ date("H", strtotime($data->updated_at)) }}:{{ date("i", strtotime($data->updated_at)) }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="table-body__cell">
                                                <form action="{{ route('list-of-equipments.destroy', $data->id) }}" method="POST" class="table-body-form">
                                                    <div class="table-body-form__actions">
                                                        <button type="button"
                                                                class="table-body-form__actions__btn table-body-form__actions__btn--success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalShowEquipment{{ $key }}"
                                                                title="{{ __('list_of_equipments.page_table.label_5.btn_show', [ 'sensorDescription' => $data->equipment_description ]) }}"
                                                        >
                                                            <i class="fas fa-info"></i>
                                                        </button>
                                                        <!-- PAGE: EQUIPMENT LIST SHOW RECORD, SECTION START -->
                                                            <div class="modal fade" id="exampleModalShowEquipment{{ $key }}" tabindex="-1" aria-labelledby="exampleModalShowEquipmentLabel{{ $key }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content equipments-show-record">
                                                                        <!-- MODAL HEADER, SECTION START -->
                                                                            <div class="modal-header equipments-show-record__header">
                                                                                <div class="equipments-show-record__header-description">
                                                                                    <h5 class="modal-title equipments-show-record__header-description-title" id="exampleModalShowEquipmentLabel{{ $key }}">{{ strtoupper(__('list_of_equipments.page_modal_show.title', [ 'sensorDescription' => $data->equipment_description ])) }}</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                            </div>
                                                                        <!-- MODAL HEADER, SECTION END -->
                                                                        <!-- MODAL BODY, SECTION START -->
                                                                            <div class="modal-body equipments-show-record__body">
                                                                                <p class="lead equipments-show-record__header-name-paragraph">
                                                                                    {{ __('list_of_equipments.page_modal_show.info_1', [ 'sensorDescription' => $data->equipment_description ]) }}
                                                                                </p>
                                                                                <p class="lead equipments-show-record__header-information-paragraph">
                                                                                    {{ __('list_of_equipments.page_modal_show.info_2', [ 'sensorInformation' => $data->equipment_notes ]) }}
                                                                                </p>
                                                                                @if ( $data->created_at = $data->updated_at )
                                                                                    <p class="lead equipments-show-record__header-date-paragraph">
                                                                                        {{ __('list_of_equipments.page_modal_show.info_3') }}
                                                                                        {{ date("d", strtotime($data->created_at)) }}.{{ date("m", strtotime($data->created_at)) }}.{{ date("Y", strtotime($data->created_at)) }} at 
                                                                                        {{ date("H", strtotime($data->created_at)) }}:{{ date("i", strtotime($data->created_at)) }}
                                                                                    </p>
                                                                                @elseif ( $data->created_at <> $data->updated_at )
                                                                                    <p class="lead equipments-show-record__header-date-paragraph">
                                                                                        {{ __('list_of_equipments.page_modal_show.info_3') }}
                                                                                        {{ date("d", strtotime($data->updated_at)) }}.{{ date("m", strtotime($data->updated_at)) }}.{{ date("Y", strtotime($data->updated_at)) }} at 
                                                                                        {{ date("H", strtotime($data->updated_at)) }}:{{ date("i", strtotime($data->updated_at)) }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        <!-- MODAL BODY, SECTION END -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- PAGE: EQUIPMENT LIST SHOW RECORD, SECTION END -->
                                                        <a href="{{ route('list-of-equipments.edit', $data->id) }}"
                                                            class="table-body-form__actions__btn table-body-form__actions__btn--warning"
                                                            title="{{ __('list_of_equipments.page_table.label_5.btn_edit', [ 'sensorDescription' => $data->equipment_description ]) }}"
                                                        >
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="table-body-form__actions__btn table-body-form__actions__btn--danger"
                                                                title="{{ __('list_of_equipments.page_table.label_5.btn_delete', [ 'sensorDescription' => $data->equipment_description ]) }}"
                                                        >
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                @endif
                            <!-- PAGE: EQUIPMENT LIST TABLE BODY, SECTION END -->

                        </table>
                        {!! $displayAllRecords->links('pagination::bootstrap-4') !!}
                    </div>
                <!-- PAGE: EQUIPMENT LIST TABLE, SECTION START -->
                
            </div>

        <!-- PAGE: EQUIPMENT LIST MAIN CONTENT, SECTION END -->

        @include('components.footer')

    </div>

@endsection