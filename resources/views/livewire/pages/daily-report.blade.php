<div>
    <div class="w-full mb-3 ml-auto flex flex-col lg:flex-row justify-between lg:justify-end items-center gap-3">
        <div class="w-[90%] lg:w-[40%] flex gap-3 lg:ml-20">
            <x-datetime-picker
                label="Filter Date"
                placeholder="Filter Date"
                wire:model.defer="filterDate"
                without-time
                parse-format="YYYY-MM-DD"
                display-format="MMMM DD, YYYY"
            />
        </div>
        <div class="w-[90%] lg:w-[30%]">
            <x-native-select
                label="Select Tray Number"
                {{-- :options="['B1', 'B2', 'B3', 'B4']" --}}
                :options="[
                    ['name' => 'Tray 1',  'id' => 'B1'],
                    ['name' => 'Tray 2', 'id' => 'B2'],
                    ['name' => 'Tray 3',   'id' => 'B3'],
                    ['name' => 'Tray 4',    'id' => 'B4'],
                ]"
                option-label="name"
                option-value="id"
                wire:model="selectedBoard"
            />
        </div>
        <div class="lg:pt-6 w-[90%] lg:w-fit">
            {{-- <x-button label="Apply" wire:click="getGraphValues"/> --}}
            <x-button icon="filter" positive label="Apply" wire:click="getGraphValues" />
        </div>
    </div>

    <div class="flex justify-center items-center">
        <div class="flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600">
          <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
            <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-hidden focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
              Graph View
            </button>
            <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-hidden focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
              Table View
            </button>
          </nav>
        </div>
    </div>

    <div class="mt-3">
        <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
            {{-- GRAPH --}}
            <div class="border-b border-gray-200 dark:border-neutral-700 overflow-x-auto">
                <nav class="flex gap-x-3" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500 active" id="tabs-with-icons-item-1" aria-selected="true" data-hs-tab="#tabs-with-icons-1" aria-controls="tabs-with-icons-1" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                        <path d="M400 320c0 88.37-55.63 144-144 144s-144-55.63-144-144c0-94.83 103.23-222.85 134.89-259.88a12 12 0 0118.23 0C296.77 97.15 400 225.17 400 320z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                        <path d="M344 328a72 72 0 01-72 72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    </svg>
                    Soil Moisture
                </button>
                <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-2" aria-selected="false" data-hs-tab="#tabs-with-icons-2" aria-controls="tabs-with-icons-2" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                        <path d="M321.89 171.42C233 114 141 155.22 56 65.22c-19.8-21-8.3 235.5 98.1 332.7 77.79 71 197.9 63.08 238.4-5.92s18.28-163.17-70.61-220.58zM173 253c86 81 175 129 292 147" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    </svg>
                    Soil pH
                </button>
                <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-3" aria-selected="false" data-hs-tab="#tabs-with-icons-3" aria-controls="tabs-with-icons-3" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                        <circle cx="256" cy="184" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                        <circle cx="344" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                        <circle cx="168" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                    </svg>
                    Water pH
                </button>
                <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-4" aria-selected="false" data-hs-tab="#tabs-with-icons-4" aria-controls="tabs-with-icons-4" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                        <path d="M307.72 302.27a8 8 0 01-3.72-6.75V80a48 48 0 00-48-48h0a48 48 0 00-48 48v215.52a8 8 0 01-3.71 6.74 97.51 97.51 0 00-44.19 86.07A96 96 0 00352 384a97.49 97.49 0 00-44.28-81.73zM256 112v272" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32"/>
                        <circle cx="256" cy="384" r="48"/>
                    </svg>  
                    Temperature
                </button>
                <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-5" aria-selected="false" data-hs-tab="#tabs-with-icons-5" aria-controls="tabs-with-icons-5" role="tab">
                    <svg width="24" height="24" fill="#00BCD4" viewBox="0 0 24 24">
                        <path d="M12 2C10 6 6 10 6 14c0 3.3 2.7 6 6 6s6-2.7 6-6c0-4-4-8-6-12zm0 16c-2.2 0-4-1.8-4-4 0-1.6 1.5-3.9 4-7.2 2.5 3.3 4 5.6 4 7.2 0 2.2-1.8 4-4 4z"/>
                    </svg>                
                    Humidity
                </button>
                </nav>
            </div>
            
            <div class="mt-3">
                <div id="tabs-with-icons-1" role="tabpanel" aria-labelledby="tabs-with-icons-item-1">
                    <div>
                        <canvas id="soilMoistureChart"></canvas>
                    </div>
                </div>
                <div id="tabs-with-icons-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-2">
                    <div>
                        <canvas id="soilPHChart"></canvas>
                    </div>
                </div>
                <div id="tabs-with-icons-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-3">
                    <div>
                        <canvas id="waterPHChart"></canvas>
                    </div>
                </div>
                <div id="tabs-with-icons-4" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-4">
                    <div>
                        <canvas id="temperatureChart"></canvas>
                    </div>
                </div>
                <div id="tabs-with-icons-5" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-5">
                    <div>
                        <canvas id="humidityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
            <div class="w-full flex justify-end items-end mb-2">
                <x-button
                    icon="download"
                    primary
                    label="Export XLSX"
                    wire:click="exportSensorData"
                />
            </div>
            <div class="overflow-x-auto">
                
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border dark:text-black">Soil Moisture</th>
                            <th class="px-4 py-2 border dark:text-black">Soil pH</th>
                            <th class="px-4 py-2 border dark:text-black">Water pH</th>
                            <th class="px-4 py-2 border dark:text-black">Temperature (°C)</th>
                            <th class="px-4 py-2 border dark:text-black">Humidity (%)</th>
                            <th class="px-4 py-2 border dark:text-black">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soilMoistureData as $index => $row)
                            <tr>
                                <td class="px-4 py-2 border text-center">{{ $row['Value'] }}</td>
                                <td class="px-4 py-2 border text-center">{{ $soilPHData[$index]['Value'] ?? '-' }}</td>
                                <td class="px-4 py-2 border text-center">{{ $waterPHData[$index]['Value'] ?? '-' }}</td>
                                <td class="px-4 py-2 border text-center">{{ $temperatureData[$index]['Value'] ?? '-' }}</td>
                                <td class="px-4 py-2 border text-center">{{ $humidityData[$index]['Value'] ?? '-' }}</td>
                                <td class="px-4 py-2 border text-center">{{ $row['time'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        
        var soilMoistureData = @json($soilMoistureData);
        
        console.log(soilMoistureData);
        
        const ctx = document.getElementById('soilMoistureChart');
        const time = soilMoistureData.map(item => item.time);
        const values = soilMoistureData.map(item => item.Value);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: 'Soil Moisture',
                    data: values, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#4CAF50',
                    backgroundColor: '#4CAF50',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        Livewire.on('updateChart', (newSoilData) => {
            soilMoistureData = newSoilData;
        });

    </script>

    <script>
            
        var soilPHData = @json($soilPHData);
        
        console.log(soilPHData);
        
        const ctxSoil = document.getElementById('soilPHChart');
        const timeSoil = soilPHData.map(item => item.time);
        const valuesSoil = soilPHData.map(item => item.Value);
        
        new Chart(ctxSoil, {
            type: 'line',
            data: {
                labels: timeSoil,
                datasets: [{
                    label: 'Soil pH',
                    data: valuesSoil, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#795548',
                    backgroundColor: '#795548',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        Livewire.on('updateSoilPHChart', (newSoilPHData) => {
            soilPHData = newSoilPHData;
        });

    </script>

    <script>
                
        var waterPHData = @json($waterPHData);
        
        console.log(waterPHData);
        
        const ctxWater = document.getElementById('waterPHChart');
        const timeWater = waterPHData.map(item => item.time);
        const valuesWater = waterPHData.map(item => item.Value);
        
        new Chart(ctxWater, {
            type: 'line',
            data: {
                labels: timeWater,
                datasets: [{
                    label: 'Water pH',
                    data: valuesWater, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#03A9F4',
                    backgroundColor: '#03A9F4',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        Livewire.on('updateWaterPHChart', (newWaterPHData) => {
            waterPHData = newWaterPHData;
        });

    </script>

    <script>
                    
        var temperatureData = @json($temperatureData);
        
        console.log(temperatureData);
        
        const ctxTemp = document.getElementById('temperatureChart');
        const timeTemp = temperatureData.map(item => item.time);
        const valuesTemp = temperatureData.map(item => item.Value);
        
        new Chart(ctxTemp, {
            type: 'line',
            data: {
                labels: timeTemp,
                datasets: [{
                    label: 'Temperature',
                    data: valuesTemp, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#FF5722',
                    backgroundColor: '#FF5722',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        Livewire.on('updateTemperatureChart', (newTempData) => {
            temperatureData = newTempData;
        });

    </script>

    <script>
                        
        var humidityData = @json($humidityData);
        
        console.log(humidityData);
        
        const ctxHumid = document.getElementById('humidityChart');
        const timeHumid = humidityData.map(item => item.time);
        const valuesHumid = humidityData.map(item => item.Value);
        
        new Chart(ctxHumid, {
            type: 'line',
            data: {
                labels: timeHumid,
                datasets: [{
                    label: 'Humidity',
                    data: valuesHumid, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#00BCD4',
                    backgroundColor: '#00BCD4',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        Livewire.on('updateHumidityChart', (newHumidData) => {
            humidityData = newHumidData;
        });

    </script>
</div>


