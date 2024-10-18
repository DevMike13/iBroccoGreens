<div>
    <div class="w-full flex justify-end items-center mb-3">
        <x-button icon="plus-sm" primary label="Create New Cycle" onclick="$openModal('newCycle')" wire:click="getCycleNumber"/>
    </div>
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Cycle No.</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Start Date</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">End Date</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Description</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{\Carbon\Carbon::parse($cycle->end_date)->format('M j, Y')}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$cycle->description}}</td>
                                    @if ($cycle->status == 'current')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white capitalize">{{$cycle->status}}</span>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-500 text-white capitalize">{{$cycle->status}}</span>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</button>
                                        <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            </div>

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
</div>
