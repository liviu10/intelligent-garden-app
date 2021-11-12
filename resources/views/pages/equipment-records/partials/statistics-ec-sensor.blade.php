<p class="lead">General information</p>
<ul class="list">
    <li class="list-item">Total number of measurements: {{ $displayStatistics['# of Total Measurements'] }}
    </li>
    <li class="list-item">The smallest value: 
        {{ $displayStatistics['Smallest Value of all time'] }} [ms/cm] | {{ $displayStatistics['Smallest Value of all time'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">The highest value: 
        {{ $displayStatistics['Highest Value of all time'] }} [ms/cm] | {{ $displayStatistics['Highest Value of all time'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">Average of all the measurements: 
        {{ $displayStatistics['Average Value of all time'] }} [ms/cm] | {{ $displayStatistics['Average Value of all time'] * $truncheonMeasurement }} [ppm]
    </li>
</ul>
<p class="lead">Last week information</p>
<ul class="list">
    <li class="list-item">The smallest value: 
        {{ $displayStatistics['Last Week Minimum value'] }} [ms/cm] | {{ $displayStatistics['Last Week Minimum value'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">The highest value: 
        {{ $displayStatistics['Last Week Maximum value'] }} [ms/cm] | {{ $displayStatistics['Last Week Maximum value'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">Average of all the measurements: 
        {{ $displayStatistics['Last Week Average value'] }} [ms/cm] | {{ $displayStatistics['Last Week Average value'] * $truncheonMeasurement }} [ppm]
    </li>
</ul>
<p class="lead">Yesterday's information</p>
<ul class="list">
    <li class="list-item">The smallest value: 
        {{ $displayStatistics['Yesterday Minimum value'] }} [ms/cm] | {{ $displayStatistics['Yesterday Minimum value'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">The highest value: 
        {{ $displayStatistics['Yesterday Maximum value'] }} [ms/cm] | {{ $displayStatistics['Yesterday Maximum value'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">Average of all the measurements: 
        {{ $displayStatistics['Yesterday Average value'] }} [ms/cm] | {{ $displayStatistics['Yesterday Average value'] * $truncheonMeasurement }} [ppm]
    </li>
</ul>
<p class="lead">Today's information</p>
<ul class="list">
    <li class="list-item">The smallest value: 
        {{ $displayStatistics['Today Minimum value'] }} [ms/cm] | {{ $displayStatistics['Today Minimum value'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">The highest value: 
        {{ $displayStatistics['Today Maximum value'] }} [ms/cm] | {{ $displayStatistics['Today Maximum value'] * $truncheonMeasurement }} [ppm]
    </li>
    <li class="list-item">Average of all the measurements: 
        {{ $displayStatistics['Today Average value'] }} [ms/cm] | {{ $displayStatistics['Today Average value'] * $truncheonMeasurement }} [ppm]
    </li>
</ul>