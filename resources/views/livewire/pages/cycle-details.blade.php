<div>
    <div class="w-full flex justify-end items-center mb-3">
        <x-button icon="plus-sm" primary label="Create New Cycle" onclick="$openModal('newCycle')" wire:click="getCycleNumber"/>
    </div>
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div>
                    @if (count($cycleLists) == 0)
                        <h1 class="text-center font-normal text-lg mt-5 italic text-gray-500">No data available.</h1>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Cycle No.</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Start Date</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">End Date</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">No. of Shrimp</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Harvest</th>
                                    {{-- <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Description</th> --}}
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cycleLists as $cycle)
                                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            
                                            @if ($cycle->status == 'current')
                                                <p class="text-lg font-semibold bg-yellow-500 w-fit px-2.5 text-white rounded-full">{{$cycle->cycle_no}}</p>
                                            @else
                                                <p class="w-fit px-2">{{$cycle->cycle_no}}</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{\Carbon\Carbon::parse($cycle->start_date)->format('M j, Y')}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            @if ($cycle->end_date == null)
                                                <div class="flex flex-row items-center gap-0.5 italic">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                    </svg>
                                                    <p class="text-xs text-gray-500">Cycle not ended.</p>
                                                </div>
                                            @else
                                                {{\Carbon\Carbon::parse($cycle->end_date)->format('M j, Y')}}
                                            @endif
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$cycle->description}}</td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ number_format($cycle->shrimp->shrimp_count) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            @if ($cycle->harvest == null)
                                                <div class="flex flex-row items-center gap-0.5 italic">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                    </svg>
                                                    <p class="text-xs text-gray-500">Not harvested.</p>
                                                </div>
                                            @else
                                                {{ number_format($cycle->harvest->harvest_count) }} Kg
                                            @endif
                                        </td>
                                        @if ($cycle->status == 'current')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white capitalize">{{$cycle->status}}</span>
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-500 text-white capitalize">{{$cycle->status}}</span>
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    Actions
                                                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                                </button>
                                              
                                                <div class="hs-dropdown-menu z-50 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                                                    <div class="p-1 space-y-0.5">
                                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-blue-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="getSelectedCycle({{ $cycle->id }})" onclick="$openModal('editCycle')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>
                                                              
                                                            Edit
                                                        </a>
                                                        @if ($cycle->status == 'current' && $cycle->harvest == null)
                                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-green-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="getSelectedHarvestCycle({{ $cycle->id }})" onclick="$openModal('harvestCycle')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                                                                </svg>
                                                                Harvest Now
                                                            </a>
                                                        @endif
                                                        @if ($cycle->status != 'current')
                                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="deleteCycleConfirmation({{ $cycle->id }}, {{ $cycle->cycle_no }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>                                                                  
                                                                Delete
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-modal blur name="newCycle" persistent align="center" max-width="sm">
        <x-card title="Create New Cycle">
            
            <div class="relative w-auto">
                <span class="absolute left-[4.5rem] top-[0.10rem] text-xs italic text-green-400">(This will automatically generated)</span>
                <x-input right-icon="hashtag" label="Cycle No." placeholder="Ex: 1"  wire:model="cycleNo" disabled />
            </div>
           
            <div class="mt-3">
                <x-datetime-picker
                    label="Start Date"
                    placeholder="Start Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="startDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div>

            <div class="mt-3">
                <x-inputs.number label="Number of Shrimp" wire:model="shrimpCount" />
            </div>
            {{-- <div class="mt-3">
                <x-datetime-picker
                    label="End Date"
                    placeholder="End Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="endDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div> --}}
            <div class="mt-3">
                <x-textarea label="Description" placeholder="write cycle description" wire:model="description" />
            </div>
            
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="createNewCycle" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="editCycle" persistent align="center" max-width="sm">
        <x-card title="Edit Cycle">
            
            <div class="relative w-auto">
                <span class="absolute left-[4.5rem] top-[0.10rem] text-xs italic text-green-400">(This value is not changeable.)</span>
                <x-input right-icon="hashtag" label="Cycle No." placeholder="Ex: 1"  wire:model="editCycleNo" disabled />
            </div>
           
            <div class="mt-3">
                <x-datetime-picker
                    label="Start Date"
                    placeholder="Start Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="editStartDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div>

            <div class="mt-3">
                <x-inputs.number label="Number of Shrimp" wire:model="editShrimpCount" />
            </div>
            {{-- <div class="mt-3">
                <x-datetime-picker
                    label="End Date"
                    placeholder="End Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="endDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div> --}}
            <div class="mt-3">
                <x-textarea label="Description" placeholder="write cycle description" wire:model="editDescription" />
            </div>

            @if ($editHarvestDate && $editHarvestWeight)
                <div class="py-2 flex items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">Edit Harvest Details</div>
                <div class="mt-3">
                    <x-datetime-picker
                        label="Harvest Date"
                        placeholder="Harvest Date"
                        parse-format="YYYY-MM-DD"
                        display-format="MMMM DD, YYYY"
                        wire:model.defer="editHarvestDate"
                        without-tips
                        :min="now()"
                        without-time
                    />
                </div>
                <div class="relative w-auto mt-3">
                    <span class="absolute left-[3.5rem] top-[0.10rem] text-xs italic text-green-400">(This value is in kilogram.)</span>
                    <x-inputs.number label="Weight" wire:model="editHarvestWeight" />
                </div>
            @endif
            
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" wire:click="cancelEdit" />
                    <x-button primary label="Save" wire:click="editCycleConfirmation({{ $selectedCycleId }})" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="harvestCycle" persistent align="center" max-width="sm">
        <x-card title="Harvest Cycle">
            
            <div class="relative w-auto flex flex-row items-center gap-1">
                {{-- <span class="absolute left-[4.5rem] top-[0.10rem] text-xs italic text-green-400">(This value is not changeable.)</span>
                <x-input right-icon="hashtag" label="Cycle No." placeholder="Ex: 1"  wire:model="editCycleNo" disabled /> --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                </svg>
                <div class="flex flex-row items-center gap-2">
                    <p>
                        Harvest Cycle No. 
                       
                    </p>
                    @if ($harvestCycleNo)
                        <p class="font-bold bg-yellow-500 px-2.5 text-white rounded-full text-center">{{ $harvestCycleNo }}</p>
                    @else
                        <div class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="py-2 flex items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">Harvest Details</div>
            <div class="mt-3">
                <x-datetime-picker
                    label="Harvest Date"
                    placeholder="Harvest Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="harvestDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div>

            <div class="relative w-auto mt-3">
                <span class="absolute left-[3.5rem] top-[0.10rem] text-xs italic text-green-400">(This value is in kilogram.)</span>
                <x-inputs.number label="Weight" wire:model="harvestWeight" />
            </div>
            
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="harvestCycleConfirmation({{ $selectedCycleToHarvestId }})" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
