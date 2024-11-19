<div>
    <div class="flex flex-col lg:flex-row gap-3">
        <div class="flex flex-row w-full justify-center gap-2 mt-3">
            <div class="w-full flex flex-col justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="mb-3">
                    <h1 class="text-sm italic">Current:</h1>
                    <h2 class="text-center py-2 text-lg font-bold">{{ $timeOne }}</h2>
                </div>
                <hr class="border-blue-500 mb-3">
                <x-time-picker
                    label="Select Time"
                    placeholder="22:30"
                    format="24"
                    interval="60"
                    wire:model.defer="timeOne"
                />
                <button wire:click="editFeedingScheduleOne" class="py-2 px-3 flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none mt-3">
                    Apply
                </button>
                
            </div>
        </div>

        <div class="flex flex-row w-full justify-center gap-2 mt-3">
            <div class="w-full flex flex-col justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="mb-3">
                    <h1 class="text-sm italic">Current:</h1>
                    <h2 class="text-center py-2 text-lg font-bold">{{ $timeTwo }}</h2>
                </div>
                <hr class="border-blue-500 mb-3">
                <x-time-picker
                    label="Select Time"
                    placeholder="22:30"
                    format="24"
                    interval="60"
                    wire:model.defer="timeTwo"
                />
                <button wire:click="editFeedingScheduleTwo" class="py-2 px-3 flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none mt-3">
                    Apply
                </button>
                
            </div>
        </div>

        <div class="flex flex-row w-full justify-center gap-2 mt-3">
            <div class="w-full flex flex-col justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="mb-3">
                    <h1 class="text-sm italic">Current:</h1>
                    <h2 class="text-center py-2 text-lg font-bold">{{ $timeThree }}</h2>
                </div>
                <hr class="border-blue-500 mb-3">
                <x-time-picker
                    label="Select Time"
                    placeholder="22:30"
                    format="24"
                    interval="60"
                    wire:model.defer="timeThree"
                />
                <button wire:click="editFeedingScheduleThree" class="py-2 px-3 flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none mt-3">
                    Apply
                </button>
                
            </div>
        </div>

        <div class="flex flex-row w-full justify-center gap-2 mt-3">
            <div class="w-full flex flex-col justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="mb-3">
                    <h1 class="text-sm italic">Current:</h1>
                    <h2 class="text-center py-2 text-lg font-bold">{{ $timeFour }}</h2>
                </div>
                <hr class="border-blue-500 mb-3">
                <x-time-picker
                    label="Select Time"
                    placeholder="22:30"
                    format="24"
                    interval="60"
                    wire:model.defer="timeFour"
                />
                <button wire:click="editFeedingScheduleFour" class="py-2 px-3 flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none mt-3">
                    Apply
                </button>
                
            </div>
        </div>

        <div class="flex flex-row w-full justify-center gap-2 mt-3">
            <div class="w-full flex flex-col justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="mb-3">
                    <h1 class="text-sm italic">Current:</h1>
                    <h2 class="text-center py-2 text-lg font-bold">{{ $timeFive }}</h2>
                </div>
                <hr class="border-blue-500 mb-3">
                <x-time-picker
                    label="Select Time"
                    placeholder="22:30"
                    format="24"
                    interval="60"
                    wire:model.defer="timeFive"
                />
                <button wire:click="editFeedingScheduleFive" class="py-2 px-3 flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none mt-3">
                    Apply
                </button>
                
            </div>
        </div>
    </div>
</div>
