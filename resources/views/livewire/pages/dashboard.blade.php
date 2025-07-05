<div>
    <div class="w-full max-w-sm mb-3 ml-auto">
        <x-select
            label="Select Board"
            placeholder="Select one board"
            :options="['B1', 'B2', 'B3', 'B4']"
            wire:model.live="selectedBoard"
        />
    </div>
    <div class="flex justify-center items-center flex-col lg:flex-row">
        <div class="grid grid-cols-3 gap-2 w-full place-items-stretch">
            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/Moisture.png') }}" alt="">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Soil Moisture</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{ number_format((float) $soilMoistureData, 2, '.', ',') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/PH.png') }}" alt="">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Soil pH</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $soilPHData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/PH-Water.png') }}" alt="">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Water pH</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $waterPHData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2 w-full place-items-stretch mt-2 md:mt-0 md:ml-2">

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/Temperature.png') }}" alt="">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Temperature</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $temperatureData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/Hygrometer.png') }}" alt="">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Humidity</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $humidityData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/Wind.png') }}" alt="">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Air Flow</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $airFlowData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 mt-3 flex items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">System Status</div>
    
    <div class="w-full">
        <div class="flex flex-col lg:flex-row w-full gap-2">
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/Fan Speed.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Fan</p>
                </div>
                <div class="ml-auto">
                    <x-toggle wire:model="isActiveFan" lg wire:click="toggleFan" />
                </div>
            </div>
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/Wet.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Misting System</p>
                </div>
                <div class="ml-auto">
                    <p>{{ $mistingSystemData }}</p>
                </div>
            </div>
        </div>
    
        <div class="flex flex-col lg:flex-row w-full gap-2 mt-3">
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/Light.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Lights</p>
                </div>
                <div class="ml-auto">
                    <x-toggle wire:model.defer="isActiveLight" lg wire:click="toggleLight" />
                </div>
            </div>
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/Water.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Water Level</p>
                </div>
                <div class="ml-auto">
                    <p> {{number_format($waterLevelData, 2, '.', ',')}} %</p>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="flex items-center flex-col nt-3" wire:ignore>
        <div class="w-full flex flex-col lg:flex-row">
            <div class="w-full lg:w-1/2">
                <canvas id="phLevelChart"></canvas>
            </div>
            <div class="w-full lg:w-1/2">
                <canvas id="doLevelChart"></canvas>
            </div>
        </div>
        <div class="w-full flex flex-col lg:flex-row">
            <div class="w-full lg:w-1/2">
                <canvas id="alLevelChart"></canvas>
            </div>
            <div class="w-full lg:w-1/2">
                <canvas id="wtLevelChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        
            var phLevelData = @json($phLevelData);
            
            console.log(phLevelData);
            
            const ctx = document.getElementById('phLevelChart');
            const days = phLevelData.map(item => item.Day);
            const values = phLevelData.map(item => item.Value);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: days,  // Use the day labels
                    datasets: [{
                        label: 'pH Level',
                        data: values, 
                        borderWidth: 1,
                        tension: 0.5,
                        borderColor: '#FF6384',
                        backgroundColor: '#FFB1C1',
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
        
    </script>

    <script>
                
        var doLevelData = @json($doLevelData);
        
        console.log(doLevelData);
        
        const ctxdo = document.getElementById('doLevelChart');
        const daysdo = doLevelData.map(item => item.Day);
        const valuesdo = doLevelData.map(item => item.Value);
        
        new Chart(ctxdo, {
            type: 'line',
            data: {
                labels: daysdo,  // Use the day labels
                datasets: [{
                    label: 'Dissolved Oxygen Level',
                    data: valuesdo, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#90EE90',
                    backgroundColor: '#90EE90',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';

                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    // Format the number with up to two decimal places and append 'ppm'
                                    label += context.parsed.y.toFixed(2) + 'mg/L';
                                }
                                return label;
                            }
                        }
                    }
                }

            }
        });

    </script>
    <script>
                
        var alLevelData = @json($alLevelData);
        
        console.log(alLevelData);
        
        const ctxal = document.getElementById('alLevelChart');
        const daysal = alLevelData.map(item => item.Day);
        const valuesal = alLevelData.map(item => item.Value);
        
        new Chart(ctxal, {
            type: 'line',
            data: {
                labels: daysal,  // Use the day labels
                datasets: [{
                    label: 'Alkalinity Level',
                    data: valuesal, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#FFA500',
                    backgroundColor: '#FFA500',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';

                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    // Format the number with up to two decimal places and append 'ppm'
                                    label += context.parsed.y.toFixed(0) + 'ppm';
                                }
                                return label;
                            }
                        }
                    }
                }

            }
        });

    </script>

    <script>
                    
        var wtLevelData = @json($wtLevelData);
        
        console.log(wtLevelData);
        
        const ctxwt = document.getElementById('wtLevelChart');
        const dayswt = wtLevelData.map(item => item.Day);
        const valueswt = wtLevelData.map(item => item.Value);
        
        new Chart(ctxwt, {
            type: 'line',
            data: {
                labels: dayswt,  // Use the day labels
                datasets: [{
                    label: 'Water Temperature',
                    data: valueswt, 
                    borderWidth: 1,
                    tension: 0.5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';

                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    // Format the number with up to two decimal places and append 'ppm'
                                    label += context.parsed.y.toFixed(0) + ' °C';
                                }
                                return label;
                            }
                        }
                    }
                }

            }
        });

    </script> --}}
</div>
