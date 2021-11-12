<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\ArduinoEquipmentRecord;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GoogleDataChart extends Component
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    /**
     * Defined the variables that will be used to
     * get the model and table name as well as the table columns.
     */
    public function __construct()
    {
        $this->modelName           = new ArduinoEquipmentRecord();
        $this->tableName           = $this->modelName->getTable();
        $this->tableAllColumns     = Schema::getColumnListing($this->tableName);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if (array_key_exists('QUERY_STRING', $_SERVER)) 
        {
            $getCurrentEquipmentId = explode('=', $_SERVER['QUERY_STRING'])[1];
            $googleDataChart = $this->modelName
            ->where('arduino_list_of_equipment_id', '=', $getCurrentEquipmentId)
            ->orderBy('created_at', 'ASC')
            ->limit(20)
            ->get();
    
            if ($getCurrentEquipmentId == 1)
            {
                $results[] = [ 
                    $xAxis = 'Read date', 
                    $yAxis = 'pH Sensor: Read value',
                ];
                foreach ($googleDataChart as $key => $value) {
                    $results[++$key] = [
                        $xAxis = 
                            date('d', strtotime($value->created_at)) . '.' .
                            date('m', strtotime($value->created_at)) . ' la ' . 
                            date("H", strtotime($value->created_at)) . ':' . 
                            date("i", strtotime($value->created_at)),
                        $yAxis = $value->equipment_value,
                    ];
                }
                $googleChartTitle = 'pH Sensor: Sensor reading evolution';
                $googleChartHorizontalAxisTitle = 'pH Sensor: Date and Time sensor readings';
                $googleChartVerticalAxisTitle = 'pH Sensor: Reading values (between 0.00 pH and 14.00 pH)';
    
                return view('components.google-data-chart')
                    ->with('googleDataChart', json_encode($results))
                    ->with('getCurrentEquipmentId', json_encode($getCurrentEquipmentId))
                    ->with('googleChartTitle', json_encode($googleChartTitle))
                    ->with('googleChartHorizontalAxisTitle', json_encode($googleChartHorizontalAxisTitle))
                    ->with('googleChartVerticalAxisTitle', json_encode($googleChartVerticalAxisTitle));
            }
            if ($getCurrentEquipmentId == 2) 
            {
                $results[] = [ 
                    $xAxis = 'Read date', 
                    $yAxis = 'Electrical Conductivity Sensor: Read value',
                ];
                foreach ($googleDataChart as $key => $value) {
                    $results[++$key] = [
                        $xAxis = 
                            date('d', strtotime($value->created_at)) . '.' .
                            date('m', strtotime($value->created_at)) . ' la ' . 
                            date("H", strtotime($value->created_at)) . ':' . 
                            date("i", strtotime($value->created_at)),
                        $yAxis = $value->equipment_value,
                    ];
                }
                $googleChartTitle = 'Electrical Conductivity Sensor: Sensor reading evolution';
                $googleChartHorizontalAxisTitle = 'Electrical Conductivity Sensor: Date and Time sensor readings';
                $googleChartVerticalAxisTitle = 'Electrical Conductivity Sensor: Reading values (between 0.70 [ms/cm] and 14.00 [ms/cm])';
    
                return view('components.google-data-chart')
                    ->with('googleDataChart', json_encode($results))
                    ->with('getCurrentEquipmentId', json_encode($getCurrentEquipmentId))
                    ->with('googleChartTitle', json_encode($googleChartTitle))
                    ->with('googleChartHorizontalAxisTitle', json_encode($googleChartHorizontalAxisTitle))
                    ->with('googleChartVerticalAxisTitle', json_encode($googleChartVerticalAxisTitle));
            }
            if ($getCurrentEquipmentId == 3) 
            {
                $googleDataChart = $this->modelName
                ->select(
                    'arduino_list_of_equipment_id',
                    'equipment_value',
                    DB::raw("count(equipment_value) as frequency")
                )
                ->where('arduino_list_of_equipment_id', '=', $getCurrentEquipmentId)
                ->groupBy('arduino_list_of_equipment_id')
                ->groupBy('equipment_value')
                ->get();
    
                $results[] = [ 
                    $xAxis = 'Read date', 
                    $yAxis = 'Level Sensor: Frequency Status',
                ];
                foreach ($googleDataChart as $key=>$value) {
                    if ($value->equipment_value == 0) {
                        $results[++$key] = [
                            $xAxis = 'Status: Low Level', 
                            $yAxis = $value->frequency,
                        ];
                    }
                    if ($value->equipment_value == 1) {
                        $results[++$key] = [
                            $xAxis = 'Status: Normal Level', 
                            $yAxis = $value->frequency,
                        ];
                    }
                    if ($value->equipment_value == 2) {
                        $results[++$key] = [
                            $xAxis = 'Status: High Level', 
                            $yAxis = $value->frequency,
                        ];
                    }
                }
                $googleChartTitle = 'Percentage analysis for Level Sensor';
                $googleChartHorizontalAxisTitle = '';
                $googleChartVerticalAxisTitle = '';
    
                return view('components.google-data-chart')
                    ->with('googleDataChart', json_encode($results))
                    ->with('getCurrentEquipmentId', json_encode($getCurrentEquipmentId))
                    ->with('googleChartTitle', json_encode($googleChartTitle))
                    ->with('googleChartHorizontalAxisTitle', json_encode($googleChartHorizontalAxisTitle))
                    ->with('googleChartVerticalAxisTitle', json_encode($googleChartVerticalAxisTitle));
            }
            if ($getCurrentEquipmentId == 4) 
            {
                $googleDataChart = $this->modelName
                ->select(
                    'arduino_list_of_equipment_id',
                    'equipment_value',
                    DB::raw("count(equipment_value) as frequency")
                )
                ->where('arduino_list_of_equipment_id', '=', $getCurrentEquipmentId)
                ->groupBy('arduino_list_of_equipment_id')
                ->groupBy('equipment_value')
                ->get();
    
                $results[] = [ 
                    $xAxis = 'Read date', 
                    $yAxis = 'pH-- Pump: Frequency Status',
                ];
                foreach ($googleDataChart as $key => $value) {
                    if( $value->equipment_value == 0 ) {
                        $results[++$key] = [
                            $xAxis = 'Status: pH-- Pump Stopped', 
                            $yAxis = $value->frequency,
                        ];
                    }
                    elseif( $value->equipment_value == 1 ) {
                        $results[++$key] = [
                            $xAxis = 'Status: pH-- Pump Started', 
                            $yAxis = $value->frequency,
                        ];
                    }
                }
                $googleChartTitle = 'Percentage analysis for pH-- Pump';
                $googleChartHorizontalAxisTitle = '';
                $googleChartVerticalAxisTitle = '';
    
                return view('components.google-data-chart')
                    ->with('googleDataChart', json_encode($results))
                    ->with('getCurrentEquipmentId', json_encode($getCurrentEquipmentId))
                    ->with('googleChartTitle', json_encode($googleChartTitle))
                    ->with('googleChartHorizontalAxisTitle', json_encode($googleChartHorizontalAxisTitle))
                    ->with('googleChartVerticalAxisTitle', json_encode($googleChartVerticalAxisTitle));
            }
            if ($getCurrentEquipmentId == 5) 
            {
                $googleDataChart = $this->modelName
                ->select(
                    'arduino_list_of_equipment_id',
                    'equipment_value',
                    DB::raw("count(equipment_value) as frequency")
                )
                ->where('arduino_list_of_equipment_id', '=', $getCurrentEquipmentId)
                ->groupBy('arduino_list_of_equipment_id')
                ->groupBy('equipment_value')
                ->get();
    
                $results[] = [ 
                    $xAxis = 'Read date', 
                    $yAxis = 'pH++ Pump: Frequency Status',
                ];
                foreach ($googleDataChart as $key => $value) {
                    if( $value->equipment_value == 0 ) {
                        $results[++$key] = [
                            $xAxis = 'Status: pH++ Pump Stopped', 
                            $yAxis = $value->frequency,
                        ];
                    }
                    elseif( $value->equipment_value == 1 ) {
                        $results[++$key] = [
                            $xAxis = 'Status: pH++ Pump Started', 
                            $yAxis = $value->frequency,
                        ];
                    }
                }
                $googleChartTitle = 'Percentage analysis for pH++ Pump';
                $googleChartHorizontalAxisTitle = '';
                $googleChartVerticalAxisTitle = '';
    
                return view('components.google-data-chart')
                    ->with('googleDataChart', json_encode($results))
                    ->with('getCurrentEquipmentId', json_encode($getCurrentEquipmentId))
                    ->with('googleChartTitle', json_encode($googleChartTitle))
                    ->with('googleChartHorizontalAxisTitle', json_encode($googleChartHorizontalAxisTitle))
                    ->with('googleChartVerticalAxisTitle', json_encode($googleChartVerticalAxisTitle));
            }
            if ($getCurrentEquipmentId == 6) 
            {
                $googleDataChart = $this->modelName
                ->select(
                    'arduino_list_of_equipment_id',
                    'equipment_value',
                    DB::raw("count(equipment_value) as frequency")
                )
                ->where('arduino_list_of_equipment_id', '=', $getCurrentEquipmentId)
                ->groupBy('arduino_list_of_equipment_id')
                ->groupBy('equipment_value')
                ->get();
    
                $results[] = [ 
                    $xAxis = 'Read date', 
                    $yAxis = 'Nutrients Pump: Frequency Status',
                ];
                foreach ($googleDataChart as $key => $value) {
                    if( $value->equipment_value == 0 ) {
                        $results[++$key] = [
                            $xAxis = 'Status: Nutrients Pump Stopped', 
                            $yAxis = $value->frequency,
                        ];
                    }
                    elseif( $value->equipment_value == 1 ) {
                        $results[++$key] = [
                            $xAxis = 'Status: Nutrients Pump Started', 
                            $yAxis = $value->frequency,
                        ];
                    }
                }
                $googleChartTitle = 'Percentage analysis for Nutrients Pump';
                $googleChartHorizontalAxisTitle = '';
                $googleChartVerticalAxisTitle = '';
    
                return view('components.google-data-chart')
                    ->with('googleDataChart', json_encode($results))
                    ->with('getCurrentEquipmentId', json_encode($getCurrentEquipmentId))
                    ->with('googleChartTitle', json_encode($googleChartTitle))
                    ->with('googleChartHorizontalAxisTitle', json_encode($googleChartHorizontalAxisTitle))
                    ->with('googleChartVerticalAxisTitle', json_encode($googleChartVerticalAxisTitle));
            }
        }
    }
}