<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use App\Models\ArduinoEquipmentRecord;
use App\Models\ArduinoListOfEquipment;

class ArduinoEquipmentRecordController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    protected $modelNameListOfEquipment;
    protected $tableNameListOfEquipment;
    protected $tableAllColumnsListOfEquipment;

    /**
     * Defined the variables that will be used to
     * get the model and table name as well as the table columns.
     */
    public function __construct()
    {
        $this->modelName           = new ArduinoEquipmentRecord();
        $this->tableName           = $this->modelName->getTable();
        $this->tableAllColumns     = Schema::getColumnListing($this->tableName);

        $this->modelNameListOfEquipment       = new ArduinoListOfEquipment();
        $this->tableNameListOfEquipment       = $this->modelNameListOfEquipment->getTable();
        $this->tableAllColumnsListOfEquipment = Schema::getColumnListing($this->tableNameListOfEquipment);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterParameter = $request->get('equipment_id');
        $truncheonMeasurement = 700;
        $numberOfMeasurements = '';
        $smallestValue = '';
        $highestValue = '';
        $averageValue = '';
        $lastWeekMinValue = '';
        $lastWeekMaxValue = '';
        $lastWeekAvgValue = '';
        $yesterdayMinValue = '';
        $yesterdayMaxValue = '';
        $yesterdayAvgValue = '';
        $todayMinValue = '';
        $todayMaxValue = '';
        $todayAvgValue = '';

        $displayAllEquipments = $this->modelNameListOfEquipment->select('id', 'equipment_id', 'equipment_description')->get()->toArray();
        $displayAllRecords = $this->modelName
        ->where(function ($query) use ($filterParameter) { $query->where('arduino_list_of_equipment_id', '=', $filterParameter); })
        ->orderBy('created_at', 'desc')
        ->paginate(20)
        ->onEachSide(2)
        ->appends([ 'equipment_id' => $filterParameter ]);

        if ($filterParameter == 1 || $filterParameter == 2)
        {
            $numberOfMeasurements = $this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->count('id');
            $smallestValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->min('equipment_value'), 2);
            $highestValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->max('equipment_value'), 2);
            $averageValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->avg('equipment_value'), 2);
            $lastWeekMinValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->min('equipment_value'), 2);
            $lastWeekMaxValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->max('equipment_value'), 2);
            $lastWeekAvgValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->avg('equipment_value'), 2);
            $yesterdayMinValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->min('equipment_value'), 2);
            $yesterdayMaxValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->max('equipment_value'), 2);
            $yesterdayAvgValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->avg('equipment_value'), 2);
            $todayMinValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->min('equipment_value'), 2);
            $todayMaxValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->max('equipment_value'), 2);
            $todayAvgValue = number_format($this->modelName->where('arduino_list_of_equipment_id', '=', $filterParameter)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->avg('equipment_value'), 2);

            $displayStatistics = [
                '# of Total Measurements' => $numberOfMeasurements,
                'Smallest Value of all time' => $smallestValue,
                'Highest Value of all time' => $highestValue,
                'Average Value of all time' => $averageValue,
                'Last Week Minimum value' => $lastWeekMinValue,
                'Last Week Maximum value' => $lastWeekMaxValue,
                'Last Week Average value' => $lastWeekAvgValue,
                'Yesterday Minimum value' => $yesterdayMinValue,
                'Yesterday Maximum value' => $yesterdayMaxValue,
                'Yesterday Average value' => $yesterdayAvgValue,
                'Today Minimum value' => $todayMinValue,
                'Today Maximum value' => $todayMaxValue,
                'Today Average value' => $todayAvgValue,
            ];
        }
        if ($filterParameter == 3) 
        {
            $numberOfMeasurements = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->count('id');
            $numberOfTimesCritical = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->count('id');
            $numberOfTimesLow = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->count('id');
            $numberOfTimesHigh = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 2)->count('id');
            $numberOfTimesLastWeekCritical = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesLastWeekLow = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesLastWeekHigh = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 2)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesYesterdayCritical = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesYesterdayLow = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesYesterdayHigh = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 2)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesTodayCritical = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->count('id');
            $numberOfTimesTodayLow = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->count('id');
            $numberOfTimesTodayHigh = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 2)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->count('id');

            $displayStatistics = [
                '# of Total Measurements' => $numberOfMeasurements,
                '# of Times Critical Level' => $numberOfTimesCritical,
                '# of Times Low Level' => $numberOfTimesLow,
                '# of Times High Level' => $numberOfTimesHigh,
                '# of Times Last Week Critical' => $numberOfTimesLastWeekCritical,
                '# of Times Last Week Low' => $numberOfTimesLastWeekLow,
                '# of Times Last Week High' => $numberOfTimesLastWeekHigh,
                '# of Times Yesterday Critical' => $numberOfTimesYesterdayCritical,
                '# of Times Yesterday Low' => $numberOfTimesYesterdayLow,
                '# of Times Yesterday High' => $numberOfTimesYesterdayHigh,
                '# of Times Today Critical' => $numberOfTimesTodayCritical,
                '# of Times Today Low' => $numberOfTimesTodayLow,
                '# of Times Today High' => $numberOfTimesTodayHigh,
            ];
        }
        if ($filterParameter == 4 || $filterParameter == 5 || $filterParameter == 6) 
        {
            $numberOfMeasurements = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->count('id');
            $numberOfTimesStopped = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->count('id');
            $numberOfTimesStarted = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->count('id');
            $numberOfTimesLastWeekStopped = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesLastWeekStarted = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->where('created_at', '>=', Carbon::today()->subDay(7))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesYesterdayStopped = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesYesterdayStarted = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->where('created_at', '>=', Carbon::today()->subDay(1))->where('created_at', '<=', Carbon::today())->count('id');
            $numberOfTimesTodayStopped = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 0)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->count('id');
            $numberOfTimesTodayStarted = ArduinoEquipmentRecord::where('arduino_list_of_equipment_id', '=', $filterParameter)->where('equipment_value', '=', 1)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::today()->endOfDay())->count('id');
    
            $displayStatistics = [
                '# of Total Measurements' => $numberOfMeasurements,
                '# of Times Stopped Level'=> $numberOfTimesStopped,
                '# of Times Started Level' => $numberOfTimesStarted,
                '# of Times Last Week Stopped' => $numberOfTimesLastWeekStopped,
                '# of Times Last Week Started' => $numberOfTimesLastWeekStarted,
                '# of Times Yesterday Stopped' => $numberOfTimesYesterdayStopped,
                '# of Times Yesterday Started' => $numberOfTimesYesterdayStarted,
                '# of Times Today Stopped' => $numberOfTimesTodayStopped,
                '# of Times Today Started' => $numberOfTimesTodayStarted,
            ];
        }
        if ($filterParameter == null) 
        {
            $displayAllRecords = $this->modelName
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->onEachSide(2)
            ->appends([ 'arduino_list_of_equipment_id' => $filterParameter ]);

            $displayStatistics = [];
        }

        return view('pages.equipment-records.index', compact(
            'displayAllRecords',
            'displayAllEquipments',
            'displayStatistics',
            'filterParameter',
            'truncheonMeasurement'
        ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.equipment-records.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('arduino_list_of_equipment_id') == 1) 
        {
            // Validated the pH Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0|max:14',
            ]);
            $insertSingleRecord = $this->modelName->create([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            if ($request->get('equipment_value') >= 0.00 && $request->get('equipment_value') <= 6.99) 
            {
                return redirect()->back()->with('success', 'You have inserted an acidic value (' . $request->get('equipment_value') . ' pH) for the pH Sensor!');
            }
            elseif ($request->get('equipment_value') >= 7.00 && $request->get('equipment_value') <= 7.99) 
            {
                return redirect()->back()->with('success', 'You have inserted a neutral value (' . $request->get('equipment_value') . ' pH) for the pH Sensor!');
            }
            else
            {
                return redirect()->back()->with('success', 'You have inserted an alkaline value (' . $request->get('equipment_value') . ' pH) for the pH Sensor!');
            }
        }
        if ($request->get('arduino_list_of_equipment_id') == 2) 
        {
            // Validated the ec Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0.70|max:1.20',
            ]);
            $insertSingleRecord = $this->modelName->create([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            return redirect()->back()->with('success', 'You have inserted the following value: ' . $request->get('equipment_value') . ' [ms/cm] for the Electrical Conductivity Sensor!');
        }
        if ($request->get('arduino_list_of_equipment_id') == 3) 
        {
            // Validated the ec Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^[0-9]+$/u|numeric|min:0|max:2',
            ]);
            $insertSingleRecord = $this->modelName->create([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            if ($request->get('equipment_value') == 0) 
            {
                return redirect()->back()->with('success', 'You have set the water level in the tank to low for the Level Sensor!');
            }
            elseif ($request->get('equipment_value') == 1) 
            {
                return redirect()->back()->with('success', 'You have set the water level in the tank to normal for the Level Sensor!');
            }
            else 
            {
                return redirect()->back()->with('success', 'You have set the water level in the tank to high for the Level Sensor!');
            }
        }
        if ($request->get('arduino_list_of_equipment_id') == 4 || $request->get('arduino_list_of_equipment_id') == 5 || $request->get('arduino_list_of_equipment_id') == 6) 
        {
            // Validated the ec Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^[0-9]+$/u|numeric|min:0|max:1',
            ]);
            $insertSingleRecord = $this->modelName->create([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            if ($request->get('equipment_value') == 0) 
            {
                if ($request->get('arduino_list_of_equipment_id') == 4) 
                {
                    return redirect()->back()->with('success', 'You have stopped the pH-- Pump!');
                }
                elseif ($request->get('arduino_list_of_equipment_id') == 5) 
                {
                    return redirect()->back()->with('success', 'You have stopped the pH++ Pump!');
                }
                else 
                {
                    return redirect()->back()->with('success', 'You have stopped the Nutrients Pump!');
                }
            }
            else 
            {
                if ($request->get('arduino_list_of_equipment_id') == 4) 
                {
                    return redirect()->back()->with('success', 'You have started the pH-- Pump!');
                }
                elseif ($request->get('arduino_list_of_equipment_id') == 5) 
                {
                    return redirect()->back()->with('success', 'You have started the pH++ Pump!');
                }
                else 
                {
                    return redirect()->back()->with('success', 'You have started the Nutrients Pump!');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $displaySingleRecord = $this->modelName
        ->select(
            'id',
            'arduino_list_of_equipment_id',
            'equipment_value',
        )
        //->where('equipment_is_active', '=', 1)
        ->find($id);
        return view('pages.equipment-records.show', compact('displaySingleRecord'));
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $displayAllEquipments = $this->modelNameListOfEquipment->select('id', 'equipment_id', 'equipment_description')->get()->toArray();
        $editSingleRecord = $this->modelName
        ->select(
            'id',
            'arduino_list_of_equipment_id',
            'equipment_value',
        )
        //->where('equipment_is_active', '=', 1)
        ->find($id);
        return view('pages.equipment-records.edit', compact('editSingleRecord', 'displayAllEquipments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->get('arduino_list_of_equipment_id') == 1) 
        {
            // Validated the pH Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0|max:14',
            ]);
            $editSingleRecord = $this->modelName->find($request->id);
            $editSingleRecord->update([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            if ($request->get('equipment_value') >= 0.00 && $request->get('equipment_value') <= 6.99) 
            {
                return redirect()->back()->with('success', 'You have inserted an acidic value (' . $request->get('equipment_value') . ' pH) for the pH Sensor!');
            }
            elseif ($request->get('equipment_value') >= 7.00 && $request->get('equipment_value') <= 7.99) 
            {
                return redirect()->back()->with('success', 'You have inserted a neutral value (' . $request->get('equipment_value') . ' pH) for the pH Sensor!');
            }
            else
            {
                return redirect()->back()->with('success', 'You have inserted an alkaline value (' . $request->get('equipment_value') . ' pH) for the pH Sensor!');
            }
        }
        if ($request->get('arduino_list_of_equipment_id') == 2) 
        {
            // Validated the ec Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0.70|max:1.20',
            ]);
            $editSingleRecord = $this->modelName->find($request->id);
            $editSingleRecord->update([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            return redirect()->back()->with('success', 'You have inserted the following value: ' . $request->get('equipment_value') . ' [ms/cm] for the Electrical Conductivity Sensor!');
        }
        if ($request->get('arduino_list_of_equipment_id') == 3) 
        {
            // Validated the ec Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^[0-9]+$/u|numeric|min:0|max:2',
            ]);
            $editSingleRecord = $this->modelName->find($request->id);
            $editSingleRecord->update([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            if ($request->get('equipment_value') == 0) 
            {
                return redirect()->back()->with('success', 'You have set the water level in the tank to low for the Level Sensor!');
            }
            elseif ($request->get('equipment_value') == 1) 
            {
                return redirect()->back()->with('success', 'You have set the water level in the tank to normal for the Level Sensor!');
            }
            else 
            {
                return redirect()->back()->with('success', 'You have set the water level in the tank to high for the Level Sensor!');
            }
        }
        if ($request->get('arduino_list_of_equipment_id') == 4 || $request->get('arduino_list_of_equipment_id') == 5 || $request->get('arduino_list_of_equipment_id') == 6) 
        {
            // Validated the ec Sensor Input accordingly
            $request->validate([
                'equipment_value' => 'required|regex:/^[0-9]+$/u|numeric|min:0|max:1',
            ]);
            $editSingleRecord = $this->modelName->find($request->id);
            $editSingleRecord->update([
                'arduino_list_of_equipment_id' => $request->get('arduino_list_of_equipment_id'),
                'equipment_value' => $request->get('equipment_value'),
            ]);
            if ($request->get('equipment_value') == 0) 
            {
                if ($request->get('arduino_list_of_equipment_id') == 4) 
                {
                    return redirect()->back()->with('success', 'You have stopped the pH-- Pump!');
                }
                elseif ($request->get('arduino_list_of_equipment_id') == 5) 
                {
                    return redirect()->back()->with('success', 'You have stopped the pH++ Pump!');
                }
                else 
                {
                    return redirect()->back()->with('success', 'You have stopped the Nutrients Pump!');
                }
            }
            else 
            {
                if ($request->get('arduino_list_of_equipment_id') == 4) 
                {
                    return redirect()->back()->with('success', 'You have started the pH-- Pump!');
                }
                elseif ($request->get('arduino_list_of_equipment_id') == 5) 
                {
                    return redirect()->back()->with('success', 'You have started the pH++ Pump!');
                }
                else 
                {
                    return redirect()->back()->with('success', 'You have started the Nutrients Pump!');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $displaySingleRecord = $this->modelName->select('id')->find($id);
        $deleteSingleRecord = $this->modelName->find($id)->delete();
        return redirect()->back()->with('success', 'The record you have selected was successfully deleted!');
    }
}