<div>
    <div class="border-b border-gray-200 dark:border-neutral-700">
        <nav class="-mb-0.5 flex justify-center gap-x-6" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500 active" id="horizontal-alignment-item-1" aria-selected="true" data-hs-tab="#horizontal-alignment-1" aria-controls="horizontal-alignment-1" role="tab">
            Hardware Tutorial
          </button>
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="horizontal-alignment-item-2" aria-selected="false" data-hs-tab="#horizontal-alignment-2" aria-controls="horizontal-alignment-2" role="tab">
            Web Interface Tutorial
          </button>
        </nav>
      </div>
      
      <div class="mt-3">
        <div id="horizontal-alignment-1" role="tabpanel" aria-labelledby="horizontal-alignment-item-1">
          <div class="hs-accordion-group">
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-one">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                Sensors, Main Controller and Actuators Identification & Function Guide
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Ultrasonic.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Ultrasonic Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Measures the water level in the tank using
                          ultrasonic sound waves.</li>
                        <li class="list-disc">Troubleshooting Tip: If readings are unstable, ensure the
                          sensor surface is clean and unobstructed.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/DHT11-Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">DHT22 - Temperature & Humidity Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Monitors temperature and relative humidity
                          to maintain optimal growing conditions.</li>
                        <li class="list-disc">Troubleshooting Tip: Keep it away from moisture
                          buildup or direct misting.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/pH-450C_liquid_pH.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">pH-450C Liquid pH Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Measures the pH level of the nutrient water
                          solution in real time.</li>
                        <li class="list-disc">Troubleshooting Tip: Regular calibration and cleaning are recommended for accuracy.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Soil-Moisture-Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Soil Moisture Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Detects the amount of water in the growing
                          medium to guide watering schedules.</li>
                        <li class="list-disc">Troubleshooting Tip: Ensure stable insertion and watch for
                          rust or corrosion on probes.                          
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Soil-pH-Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">RS485 Soil pH Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Monitors temperature and relative humidity to
                          maintain optimal growing conditions.</li>
                        <li class="list-disc">Troubleshooting Tip: Keep it away from moisture buildup or
                          direct misting.                         
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/ESP8266-NodeMCU.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">ESP8266 Node MCU (Microcontroller)</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Serves as the main controller that gathers sensor
                          data and transmits it to the web system via Wi-Fi.</li>
                        <li class="list-disc">Troubleshooting Tip: Restart if the system becomes
                          unresponsive or disconnects from the internet.                         
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Water Pump</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Automatically delivers water or nutrient solution to
                          the grow trays based on moisture readings.
                          </li>
                        <li class="list-disc">Troubleshooting Tip: Check for clogging or wiring issues if
                          flow stops.                        
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Fan</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Controls air circulation to maintain proper
                          ventilation, temperature, and humidity.
                          </li>
                        <li class="list-disc">Troubleshooting Tip: Clear dust buildup and ensure                        
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">pH Down Solution Pump</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Automatically adds acidic solution to lower the pH
                          of the water when it's too high.                          
                        </li>
                        <li class="list-disc">Troubleshooting Tip: Monitor dosing and keep tubes clear.                     
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">pH Up Solution Pump</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Automatically dispenses alkaline solution to
                          increase water pH when it's too low.                          
                        </li>
                        <li class="list-disc">Troubleshooting Tip: Make sure the solution container isn't
                          empty, and tubing is unclogged.                                               
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Grow-Light.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Grow Light</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Provides supplemental lighting to support
                          plant photosynthesis during low-light hours.                          
                        </li>
                        <li class="list-disc">Troubleshooting Tip: Replace flickering lights and ensure
                          timers are set correctly.                                               
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-two">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                How to Place the Sensor (Sensor Placement Guide)
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                <div class="w-full max-w-3xl mx-auto aspect-video">
                  <video class="w-full h-full" controls>
                    <source src="/videos/sample.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
          
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-three">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
                How to start the iBroccoGreens Device (Video Demo)
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
                <div class="w-full max-w-3xl mx-auto aspect-video">
                  <video class="w-full h-full" controls>
                    <source src="/videos/sample.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>

            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-four">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
                Floorplan of iBroccoGreens Device
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-four" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
                <div class="w-full max-w-3xl mx-auto">
                  <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="horizontal-alignment-2" class="hidden" role="tabpanel" aria-labelledby="horizontal-alignment-item-2">
          <div class="hs-accordion-group">
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-one">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                Sensor Alert Notification
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">High Soil Moisture</li>
                          <li class="text-center">Low Soil Moisture</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">Risk of overwatering</li>
                          <li class="text-center">Soil is too dry</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">High Temperature</li>
                          <li class="text-center">Low Temperature</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">Risk of heat stress</li>
                          <li class="text-center">Too cold for proper growth</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">High Humidity</li>
                          <li class="text-center">Low Humidity</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">May cause mold or disease</li>
                          <li class="text-center">Can dry out plants</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="https://placehold.co/400" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">Water pH - Too Low</li>
                          <li class="text-center">Water pH - Too High</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">Nutrient imbalance risk.</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-two">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                How to Use the Web System
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                <div class="w-full h-auto flex flex-col gap-8">
                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">LOG IN</h2>
                    <p class="text-center">The login page allows users to enter their registered credentials if they have already
                      created an account, enabling them to access and use the iBroccogreens Web
                      system.
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">SIGN IN</h2>
                    <p class="text-center">The signup page is where Admin and Users enter their full name, email address, and
                      password. These credentials will be used to log in to the iBroccoGreens Web System                      
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">TERMS AND CONDITION PAGE</h2>
                    <p class="text-center">The Terms and Conditions outline the rules and responsibilities that users agree to when
                      accessing and using the iBroccoGreens system.                                            
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">GROWERS GUIDE PAGE</h2>
                    <p class="text-center">The Grower's Guide contains essential information on system usage. Users can access:
                      (1) Hardware Tutorial - for understanding the sensors and components
                      (2) Web Interface Tutorial - for navigating the system's online features                                          
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">PARAMETERS</h2>
                    <p class="text-center">The real-time Parameters Monitoring page allows Admin and Users to track sensor
                      readings, including Soil pH, Water pH, Soil Moisture, Temperature, and Humidity.                                         
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">DAILY RECORDS PAGE</h2>
                    <p class="text-center">The Daily Records section allows the Admin to view sensor trends through graphical
                      charts and timestamped logs of data, including soil pH, water pH, temperature, humidity,
                      and moisture levels.                                         
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">CULTIVATION CYCLES PAGE</h2>
                    <p class="text-center">The Cultivation Cycle page allows Admins and Users to manage cycle information.
                      Fields include Cycle Number, Start Date, End Date, Assigned Trays, Duration in Days, and
                      Current Phase (e.g., Germination, Growth, Harvest).
                      It also provides options to Edit or Remove a cycle.                                      
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">YIELD TRACKER PAGE</h2>
                    <p class="text-center">The Yield Tracker page allows users to document production results.
                      Fields include Cycle, Tray, Yield per Tray, and Date, with options to edit and remove
                      entries.                                                           
                    </p>
                    <p class="text-center mt-2">The system also visualizes yields in a graph for performance tracking.</p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">USER REGISTRATION</h2>
                    <p class="text-center">The Admin interface lets administrators register new users by entering their full name,
                      email address, password, and status (Active or Inactive).                                             
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96">
                        <img src="https://placehold.co/400" alt="Mobile View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96">
                        <img src="https://placehold.co/600x400" alt="Desktop View"
                             class="w-full h-full object-cover rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">USER MANAGEMENT</h2>
                    <p class="text-center">This figure shows where the Admin can view a list of registered users and perform actions
                      such as removing them from the system.                                             
                    </p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
