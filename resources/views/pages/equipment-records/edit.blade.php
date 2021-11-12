@extends('layouts.app')
@extends('components.navbar')

@section('content')

    <div class="statistics-edit-record">

        <!-- CONTENT HEADER SECTION START -->
            <div class="statistics-edit-record__header">
                <div class="statistics-edit-record__header-description">
                    <h2 class="statistics-edit-record__header-description-title">
                        {{ __('statistics.Page edit form.Title') }}
                    </h2>
                    <p class="statistics-edit-record__header-description-paragraph">
                        {{ __('statistics.Page edit form.Short Description') }}
                    </p>
                </div>
            </div>
        <!-- CONTENT HEADER SECTION END -->

        <!-- CONTENT FORM SECTION START -->
            <div class="statistics-edit-record__form">
                <form action="{{ route('equipment-records.update', $editSingleRecord -> id) }}" class="mb-0" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $editSingleRecord -> id }}">
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
                            <span class="input-group-text">{{ strtoupper(__('statistics.Page edit form.Second Label')) }}</span>
                            <input type="number" class="form-control input-sensor-value" name="equipment_value" min="0.00" max="" step="0.01" value="{{ number_format($editSingleRecord -> equipment_value, 2, '.', '') }}" required>
                        </div>
                        <div class="input-group-button">
                            <button type="submit" class="btn btn-success rounded-0 my-2" title="{{ __('statistics.Page edit form.Button Placeholder') }}">
                                <i class="fas fa-check"></i>
                                {{ strtoupper(__('statistics.Page edit form.Button Name')) }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        <!-- CONTENT FORM SECTION END -->

    </div>

    @include('components.footer')

@endsection