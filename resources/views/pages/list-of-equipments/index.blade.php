@extends('layouts.app')
@extends('components.navbar')

@section('content')

    <div class="equipments">

        <!-- CONTENT HEADER SECTION START -->
            <div class="equipments__header">
                <div class="equipments__header-description">
                    <h2 class="equipments__header-description-title">{{ strtoupper(__('list_of_equipments.page_title')) }}</h2>
                    <p class="equipments__header-description-paragraph">
                        {{ __('list_of_equipments.page_info_1') }}
                    </p>
                    <p class="equipments__header-description-paragraph">
                        {{ __('list_of_equipments.page_info_2') }}
                    </p>
                    <div class="equipments__header-description-button">
                        <a class="btn btn-success" href="{{ route('list-of-equipments.create') }}" title="{{ __('list_of_equipments.page_btn_add.title') }}">
                            <i class="fas fa-plus"></i>
                            {{ strtoupper(__('list_of_equipments.page_btn_add.label')) }}
                        </a>
                    </div>
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

            <div class="equipments__main-content">

                <!-- CONTENT TABLE SECTION START -->
                    <div class="container-table">
                        <table class="table table--standard">

                            <!-- TABLE HEADER SECTION START -->
                                <thead class="table-head">
                                    <tr>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.column_1')) }}
                                            </p>
                                        </th>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.column_2')) }}
                                            </p>
                                        </th>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.column_4')) }}
                                            </p>
                                        </th>
                                        <th class="table-head__cell">
                                            <p class="table-head__typography">
                                                {{ strtoupper(__('list_of_equipments.page_table.column_5.title')) }}
                                            </p>
                                        </th>
                                    </tr>
                                </thead>
                            <!-- TABLE HEADER SECTION END -->

                            <!-- TABLE BODY SECTION START -->
                                @if ($displayAllRecords->isEmpty())
                                    <tbody class="table-body">
                                        <tr>
                                            <td colspan="4" class="table-body__cell">
                                                <p class="table-body__typography">
                                                    Currently, there are no equipments defined in the database! Add your first Equipment by clicking on&nbsp;
                                                    <a href="{{ route('list-of-equipments.create') }}" title="{{ __('list_of_equipments.page_btn_add.title') }}">
                                                        {{ __('list_of_equipments.page_btn_add.label') }}
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
                                                <p class="table-body__typography">{{ $data -> equipment_id }}</p>
                                            </td>
                                            <td class="table-body__cell">
                                                <p class="table-body__typography">{{ $data -> equipment_description }}</p>
                                            </td>
                                            <td class="table-body__cell">
                                                @if ( $data -> created_at = $data -> updated_at )
                                                    <p class="table-body__typography">
                                                        {{ date("d", strtotime($data -> created_at)) }}.{{ date("m", strtotime($data -> created_at)) }}.{{ date("Y", strtotime($data -> created_at)) }} at 
                                                        {{ date("H", strtotime($data -> created_at)) }}:{{ date("i", strtotime($data -> created_at)) }}:{{ date("s", strtotime($data -> created_at)) }}
                                                    </p>
                                                @elseif ( $data -> created_at <> $data -> updated_at )
                                                    <p class="table-body__typography">
                                                        {{ date("d", strtotime($data -> updated_at)) }}.{{ date("m", strtotime($data -> updated_at)) }}.{{ date("Y", strtotime($data -> updated_at)) }} at 
                                                        {{ date("H", strtotime($data -> updated_at)) }}:{{ date("i", strtotime($data -> updated_at)) }}:{{ date("s", strtotime($data -> updated_at)) }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="table-body__cell">
                                                <form action="{{ route('list-of-equipments.destroy', $data -> id) }}" method="POST" class="table-body-form">
                                                    <div class="table-body-form__actions">
                                                        <button type="button"
                                                                class="table-body-form__actions__btn table-body-form__actions__btn--success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $key }}"
                                                                title="{{ __('list_of_equipments.page_table.column_5.btn_show', [ 'sensorDescription' => $data -> equipment_description ]) }}"
                                                        >
                                                            <i class="fas fa-info"></i>
                                                        </button>
                                                        <!-- MODAL DETAILS SECTION START -->
                                                        <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $key }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            {{ __('list_of_equipments.page_modal.title', [ 'sensorDescription' => $data -> equipment_description ]) }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {{ $data -> equipment_notes }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- MODAL DETAILS SECTION END -->
                                                        <a href="{{ route('list-of-equipments.edit', $data -> id) }}"
                                                            class="table-body-form__actions__btn table-body-form__actions__btn--warning"
                                                            title="{{ __('list_of_equipments.page_table.column_5.btn_edit', [ 'sensorDescription' => $data -> equipment_description ]) }}"
                                                        >
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="table-body-form__actions__btn table-body-form__actions__btn--danger"
                                                                title="{{ __('list_of_equipments.page_table.column_5.btn_delete', [ 'sensorDescription' => $data -> equipment_description ]) }}"
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
                            <!-- TABLE BODY SECTION END -->

                        </table>
                        {!! $displayAllRecords->links('pagination::bootstrap-4') !!}
                    </div>
                <!-- CONTENT TABLE SECTION END -->
                
            </div>

        <!-- CONTENT MAIN SECTION END -->

        @include('components.footer')

    </div>

@endsection