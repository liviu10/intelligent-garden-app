<p class="lead">General information</p>
<ul class="list">
    <li class="list-item">Total number of measurements: {{ $displayStatistics['# of Total Measurements'] }}
    </li>
    <li class="list-item">The smallest value: {{ $displayStatistics['Smallest Value of all time'] }} pH
    </li>
    <li class="list-item">The highest value: {{ $displayStatistics['Highest Value of all time'] }} pH
    </li>
    <li class="list-item">
        Average of all the measurements: {{ $displayStatistics['Average Value of all time'] }} pH
    </li>
</ul>
<p class="lead">Last week information</p>
<ul class="list">
    <li class="list-item">
        The smallest value: {{ $displayStatistics['Last Week Minimum value'] }} pH
    </li>
    <li class="list-item">
        The highest value: {{ $displayStatistics['Last Week Maximum value'] }} pH
    </li>
    <li class="list-item">
        Average of all the measurements: {{ $displayStatistics['Last Week Average value'] }} pH
    </li>
</ul>
<p class="lead">Yesterday's information</p>
<ul class="list">
    <li class="list-item">
        The smallest value: {{ $displayStatistics['Yesterday Minimum value'] }} pH
    </li>
    <li class="list-item">
        The highest value: {{ $displayStatistics['Yesterday Maximum value'] }} pH
    </li>
    <li class="list-item">
        Average of all the measurements: {{ $displayStatistics['Yesterday Average value'] }} pH
    </li>
</ul>
<p class="lead">Today's information</p>
<ul class="list">
    <li class="list-item">
        The smallest value: {{ $displayStatistics['Today Minimum value'] }} pH
    </li>
    <li class="list-item">
        The highest value: {{ $displayStatistics['Today Maximum value'] }} pH
    </li>
    <li class="list-item">
        Average of all the measurements: {{ $displayStatistics['Today Average value'] }} pH
    </li>
</ul>