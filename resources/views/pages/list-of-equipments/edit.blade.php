@extends('layouts.app')
@extends('components.navbar')

@section('content')

    <div class="equipments-edit-record">

        <!-- CONTENT HEADER SECTION START -->
            <div class="equipments-edit-record__header">
                <div class="equipments-edit-record__header-description">
                    <h2 class="equipments-edit-record__header-description-title">{{ strtoupper(__('list_of_equipments.page_title')) }}</h2>
                    <p class="equipments-edit-record__header-description-paragraph">─ {{ __('list_of_equipments.page_edit_records.info_1') }} ─</p>
                </div>
            </div>
        <!-- CONTENT HEADER SECTION END -->

        @if ($errors->any())
            <div class="alert alert-danger my-0">
            {{ __('list_of_equipments.page_edit_records.error_info') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- CONTENT FORM SECTION START -->
            <div class="equipments-edit-record__form">
                <form action="{{ route('list-of-equipments.update', $editSingleRecord -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $editSingleRecord -> id }}">
                    <div class="container-form">
                        <div class="input-group">
                            <span class="input-group-text">
                                {{ strtoupper(__('list_of_equipments.page_table.column_1')) }}
                            </span>
                            <input type="text" class="form-control input-sensor-id" name="equipment_id" value="{{ $editSingleRecord -> equipment_id }}" disabled="disabled">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">
                                {{ strtoupper(__('list_of_equipments.page_table.column_2')) }}
                            </span>
                            <input type="text" class="form-control input-sensor-description" name="equipment_description" value="{{ $editSingleRecord -> equipment_description }}" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">
                                {{ strtoupper(__('list_of_equipments.page_table.column_3')) }}
                            </span>
                            <input type="text" class="form-control input-sensor-description" name="equipment_notes" value="{{ $editSingleRecord -> equipment_notes }}" required>
                        </div>
                        <div class="input-group-button">
                            <button type="submit" class="btn btn-success rounded-0 my-2" title="{{ __('list_of_equipments.page_edit_records.actions.btn_title') }}">
                                <i class="fas fa-check"></i>
                                {{ __('list_of_equipments.page_edit_records.actions.btn_save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        <!-- CONTENT FORM SECTION END -->

    </div>

@endsection