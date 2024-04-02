<div class="flex items-center justify-center w-screen font-medium ">
    <div class="flex flex-grow items-center justify-center h-screen text-gray-600 bg-gray-100 py-5">
        <!-- Component Start -->
        <div class="max-w-full p-8 bg-white rounded-lg shadow-lg w-[500px] max-h-[800vh] overflow-y-auto">
            <div class="flex items-center mb-6">
                <svg class="h-8 w-8 text-indigo-500 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h4 class="font-semibold ml-3 text-lg">Todo List</h4>
            </div>
            <form class="max-w-md mx-auto mt-2 mb-2" wire:submit='searchTearm'>
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white  dark:focus:border-blue-500 mb-2 mt-2"
                        placeholder="Tìm sự kiện ..." required wire:model.live.debounce.500='searchTearm' />
            </form>
            {{-- <div class="flex justify-center w-full mb-3 mt-3">
                <span  wire:loading>
                    <livewire:loading />
                </span>
               
            </div> --}}
            @foreach ($todos as $item)
                <li class="flex justify-between rounded-md p-2 items-center hover:bg-gray-100" >
                    <div>
                        <input class="hidden" type="checkbox" id="task_1" checked>
                        <label wire:click="dispatch('checkedTask' , {
                        id : {{$item->id}},
                        status : {{$item->status}}
                    })" class="flex items-center h-10 px-2 rounded cursor-pointer " for="task_1">
    
                            @if (!$item->status)
                            <span
                                class="flex items-center justify-center w-5 h-5 text-transparent border-2 border-gray-300 rounded-full">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            @else
                            <svg width="20px" height="20px" viewBox="0 0 0.6 0.6" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.226 0.084a0.325 0.325 0 0 1 0.149 0 0.191 0.191 0 0 1 0.142 0.142 0.325 0.325 0 0 1 0 0.149 0.191 0.191 0 0 1 -0.142 0.142 0.325 0.325 0 0 1 -0.149 0 0.191 0.191 0 0 1 -0.142 -0.142 0.325 0.325 0 0 1 0 -0.149A0.191 0.191 0 0 1 0.226 0.084m0.151 0.178a0.014 0.014 0 1 0 -0.021 -0.02l-0.074 0.079 -0.037 -0.037a0.014 0.014 0 0 0 -0.02 0.02l0.048 0.048a0.014 0.014 0 0 0 0.021 0z"
                                    fill="#363853" />
                            </svg>
                            @endif
                            <div class="flex flex-col">
                                <span class="ml-4 text-sm {{$item->status ? 'line-through' : ''}}">{{$item->name}}</span>
                                <span
                                    class="{{$item->status ? 'line-through' : ''}} ml-4 text-gray-400 text-[12px]">{{date_format($item->created_at,'H:i
                                    d-m-Y')
                                    }}</span>
    
                            </div>
    
                        </label>
                    </div>
                    <div class="flex gap-5">
                        @if (!$isEdit)
                        <span class="text-sm cursor-pointer hover:text-indigo-600 transition-all duration-200 text-red-600"
                            wire:click="dispatch('delete' , {
                            id : {{$item->id}}
                          })">Xoá</span>
                        @endif
                        @if (!$item->status)
                        <div class="flex items-center">
                            @if ($isEdit && $item->id == $idEdit)
                            <span class="text-sm cursor-pointer hover:text-indigo-600 transition-all duration-200"
                                wire:click="cancelUpdate">Huỷ cập nhật</span>
                            @else
                            <span class="text-sm cursor-pointer hover:text-indigo-600 transition-all duration-200"
                                wire:click="dispatch('edit' , {
                        id : {{$item->id}},
                        name : '{{$item->name}}'
                    })">Cập nhật</span>
                            @endif
    
                        </div>
                        @endif
    
                    </div>
                </li>
                @endforeach
          
            <div class="pagination mt-4">
                {{$todos->links('vendor.livewire.tailwind')}}
            </div>
            <form wire:submit='save' class="mt-2">
                <div class="">
                    <input id="input-task" class="@error('task') border border-red-500 @enderror flex-grow h-12 bg-gray-300 w-full p-2 rounded-md bg-transparent focus:outline-none font-medium 
                }}" type="text" wire:model.live='task' placeholder="Nhập nội dung thêm mới ...">
                    @error('task')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    @if ($task)
                    <button type="submit"
                        class="flex items-center justify-center h-12 px-2 mt-2 text-sm font-medium rounded bg-blue-600 hover:bg-red-600 transition-all duration-300 text-white w-full text-center">
                        <span>
                            {{$isEdit ? 'Cập nhật' : 'Thêm task' }}
                        </span>
                    </button>
                    @endif

                </div>
            </form>
        </div>
        <!-- Component End  -->
    </div>

</div>