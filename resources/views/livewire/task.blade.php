<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <input wire:model='newTaskName' wire:keydown.enter='createTask' type="text" class="border w-full rounded mb-3 border-gray-300" placeholder="Create Task..">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach ( $tasks as $task )
                        <li class="flex items-center justify-between gap-x-6 py-5 cursor-grab" wire:key='task-{{ $task->id }}'>
                            <div class="min-w-0">
                                <div class="flex items-start gap-x-3">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ $task->name }}</p>
                                    <p class="mt-0.5 whitespace-nowrap rounded-md {{ $task->is_completed ? 'bg-green-50 text-green-700 ring-green-600/20' : 'bg-red-50 text-red-700 ring-red-600/20' }}  px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset">
                                        {{ $task->is_completed ? 'Complete' : 'Incomplete' }}
                                    </p>
                                </div>
                                <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                    <p class="whitespace-nowrap">Created at <time datetime="2023-03-17T00:00Z">{{ $task->created_at->format('M d, Y') }}</time></p>
                                    <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                        <circle cx="1" cy="1" r="1" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex flex-none items-center gap-x-4">
                                <a wire:click.prevent='markAsCompleteOrIncomplete({{ $task->id }})' href="#" class="hidden rounded-md {{ !$task->is_completed ? 'bg-green-100 hover:bg-green-200' : 'bg-red-100 hover:bg-red-200' }} px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:block">
                                    {{ $task->is_completed ? 'Mark as Incomplete' : 'Mark as Complete' }}
                                </a>
                                <a wire:click='deleteTask({{ $task->id }})' wire:confirm='Are you sure you want to delelte this task?' href="#">
                                    <svg class="text-red-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

