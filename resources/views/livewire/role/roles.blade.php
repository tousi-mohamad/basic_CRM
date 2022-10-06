<div>

    <div class="border-t overflow-x-auto relative shadow-md sm:rounded-lg w-1/2"
         x-data="{
         darkMode : 0,
         inputType: 'text',
         gholi(qq){
         console.log(qq);
         }
          }">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="">
                <input type="text" class="m-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search..." wire:model.debounce.1000ms="searchTerm">
                <span class="float-right p-5 cursor-pointer border-gray-200"
                      :class="darkMode == 0 ? 'bg-amber-50' : 'dark:bg-gray-900 dark:border-gray-700 text-white'"
                      @click="darkMode = (darkMode == 0) ? 1: 0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </span>

            </tr>
            <tr>
                <th scope="col" class="py-3 px-6">Role</th>
                <th scope="col" class="py-3 px-6">Edit</th>
                <th scope="col" class="py-3 px-6">Delete</th>

            </tr>
            </thead>
            <tbody>

            @foreach($roles as $role)
                <tr class="bg-white border-b" :class="darkMode == 0 ? 'dark:bg-gray-900 dark:border-gray-700' : 'bg-amber-50'">
                    <th
                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap select-none cursor-pointer"
                        :class="darkMode == 0 ? 'dark:text-white' : 'text-black'">

                        <span id="name_{{$role->id}}" class="names">{{$role->name}}</span>
                        <input id="input_{{$role->id}}" x-bind:type="inputType" class="names_input hidden text-black border-b-cyan-500 border-r" value="{{$role->name}}"
                               wire:change="edit({{$role->id}},$event.target.value)">
                    </th>
                    <td class="py-4 px-6">
                        <svg class="w-6 h-6 cursor-pointer text-green-500" fill="none" data-id="{{$role->id}}"
                             onclick="editName(this)"
                             stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </td>
                    <td class="py-4 px-6 flex">
                        <svg wire:click="delete({{$role->id}})" id="trash_{{$role->id}}" @click="handleClick" data-timer="5"
                             class="w-6 h-6 cursor-pointer text-red-600 z-50"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path id="trash_{{$role->id}}" @click="handleClick" data-timer="5" class="z-0"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$roles->links()}}
    </div>

    <script>

        function editName(e) {
            var id = e.getAttribute("data-id");

            $('#input_' + id).removeClass('hidden');
            $('#name_' + id).hide();
        }


    </script>
</div>
