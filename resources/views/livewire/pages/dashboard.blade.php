<div>
    <div class="flex justify-center items-center flex-col lg:flex-row">
        <div class="flex justify-between items-center w-full lg:w-1/2 gap-2">
            <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        pH Level
                    </p>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="36" height="36">
                            <path d="M400 320c0 88.37-55.63 144-144 144s-144-55.63-144-144c0-94.83 103.23-222.85 134.89-259.88a12 12 0 0118.23 0C296.77 97.15 400 225.17 400 320z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                            <path d="M344 328a72 72 0 01-72 72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format($phData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        Dissolved Oxygen
                    </p>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="36" height="36">
                            <path d="M321.89 171.42C233 114 141 155.22 56 65.22c-19.8-21-8.3 235.5 98.1 332.7 77.79 71 197.9 63.08 238.4-5.92s18.28-163.17-70.61-220.58zM173 253c86 81 175 129 292 147" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                        </svg>                      
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format($doData, 2, '.', ',')}}mg/L
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center w-full lg:w-1/2 gap-2 mt-2 ml-0 lg:mt-0 lg:ml-2 ">
            <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        Alkalinity Level
                    </p>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="36" height="36">
                            <circle cx="256" cy="184" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                            <circle cx="344" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                            <circle cx="168" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format($alData, 2, '.', ',')}}ppm
                        </h3>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        Water Temperature
                    </p>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="36" height="36">
                            <path d="M307.72 302.27a8 8 0 01-3.72-6.75V80a48 48 0 00-48-48h0a48 48 0 00-48 48v215.52a8 8 0 01-3.71 6.74 97.51 97.51 0 00-44.19 86.07A96 96 0 00352 384a97.49 97.49 0 00-44.28-81.73zM256 112v272" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32"/>
                            <circle cx="256" cy="384" r="48"/>
                        </svg>                      
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{$wTempData}}°C
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 mt-3 flex items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">System Status</div>
    <livewire:pages.manual-controls />
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
