<div>
    <div class="border-b border-gray-200 dark:border-neutral-700">
        <nav class="flex gap-x-3" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500 active" id="tabs-with-icons-item-1" aria-selected="true" data-hs-tab="#tabs-with-icons-1" aria-controls="tabs-with-icons-1" role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                <path d="M400 320c0 88.37-55.63 144-144 144s-144-55.63-144-144c0-94.83 103.23-222.85 134.89-259.88a12 12 0 0118.23 0C296.77 97.15 400 225.17 400 320z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                <path d="M344 328a72 72 0 01-72 72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
            pH Level
          </button>
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-2" aria-selected="false" data-hs-tab="#tabs-with-icons-2" aria-controls="tabs-with-icons-2" role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                <path d="M321.89 171.42C233 114 141 155.22 56 65.22c-19.8-21-8.3 235.5 98.1 332.7 77.79 71 197.9 63.08 238.4-5.92s18.28-163.17-70.61-220.58zM173 253c86 81 175 129 292 147" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
            Dissolved Oxygen
          </button>
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-3" aria-selected="false" data-hs-tab="#tabs-with-icons-3" aria-controls="tabs-with-icons-3" role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                <circle cx="256" cy="184" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                <circle cx="344" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                <circle cx="168" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
            </svg>
            Alkalinity Level
          </button>
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-4" aria-selected="false" data-hs-tab="#tabs-with-icons-4" aria-controls="tabs-with-icons-4" role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20" height="20">
                <path d="M307.72 302.27a8 8 0 01-3.72-6.75V80a48 48 0 00-48-48h0a48 48 0 00-48 48v215.52a8 8 0 01-3.71 6.74 97.51 97.51 0 00-44.19 86.07A96 96 0 00352 384a97.49 97.49 0 00-44.28-81.73zM256 112v272" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32"/>
                <circle cx="256" cy="384" r="48"/>
            </svg>  
            Water Temperature
          </button>
        </nav>
      </div>
      
      <div class="mt-3">
        <div id="tabs-with-icons-1" role="tabpanel" aria-labelledby="tabs-with-icons-item-1">
            <div>
                <canvas id="phLevelChart"></canvas>
            </div>
        </div>
        <div id="tabs-with-icons-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-2">
            <div>
                <canvas id="doLevelChart"></canvas>
            </div>
        </div>
        <div id="tabs-with-icons-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-3">
            <div>
                <canvas id="alLevelChart"></canvas>
            </div>
        </div>
        <div id="tabs-with-icons-4" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-4">
            <div>
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

    </script>
</div>


