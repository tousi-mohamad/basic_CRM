<div>
    <div class="border-t overflow-x-auto relative shadow-md sm:rounded-lg w-full"
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
                <input type="text"
                       class="m-4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="Search..." wire:model.debounce.1000ms="searchTerm">
                <span class="float-right p-5 cursor-pointer border-gray-200"
                      :class="darkMode == 0 ? 'bg-amber-50' : 'dark:bg-gray-900 dark:border-gray-700 text-white'"
                      @click="darkMode = (darkMode == 0) ? 1: 0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </span>

            </tr>
            <tr>
                <th scope="col" class="py-3 px-6">Name</th>
                <th scope="col" class="py-3 px-6">Edit</th>
                <th scope="col" class="py-3 px-6">Roles</th>
                <th scope="col" class="py-3 px-6">Permissions</th>
                <th scope="col" class="py-3 px-6">Organizations</th>
                <th scope="col" class="py-3 px-6">Delete</th>

            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)

                <tr class="bg-white border-b"
                    :class="darkMode == 0 ? 'dark:bg-gray-900 dark:border-gray-700' : 'bg-amber-50'">
                    <th
                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap select-none cursor-pointer"
                        :class="darkMode == 0 ? 'dark:text-white' : 'text-black'">

                        <span id="name_{{$user->id}}" class="names">{{$user->name}}</span>
                        <input id="input_{{$user->id}}" x-bind:type="inputType"
                               class="names_input hidden text-black border-b-cyan-500 border-r" value="{{$user->name}}"
                               wire:change="edit({{$user->id}},$event.target.value)">
                    </th>
                    <td class="py-4 px-6">
                        <svg class="w-6 h-6 cursor-pointer text-green-500" fill="none" data-id="{{$user->id}}"
                             onclick="editName(this)"
                             stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </td>
                    <td class="m-3">
                        <div x-data="{isOpen: false}">

                            <button
                                @click="isOpen = !isOpen"
                                type="button"
                                class="inline-flex justify-center w-full border border-gray-300 p-2"
                                @keydown.escape="isOpen= false"
                                aria-haspopup="true"
                                aria-expanded="true"
                            >Roles
                            </button>
                            <div class="bg-white overflow-auto max-h-40"
                                 x-show="isOpen"
                                 x-transition:enter.duration.500ms
                                 x-transition:leave.duration.400ms
                                 @click.away="isOpen= false"
                            >

                                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                    <div class="flex justify-between p-2 text-black ">
                                        <label for="per_{{$role->id}}">{{$role->name}}</label>
                                        <input type="checkbox" id="per_{{$role->id}}"
                                               class="focus:border-transparent focus:ring-0"
                                               wire:click="role_assign_revoke({{$user->id}},'{{$role->name}}')"
                                               @if(\App\Models\User::find($user->id)->hasRole($role->name)) checked @endif
                                        >
                                    </div>
                                @endforeach

                            </div>
                        </div>


                    </td>
                    <td class="m-3">
                        <div x-data="{isOpen: false}">

                            <button
                                @click="isOpen = !isOpen"
                                type="button"
                                class="inline-flex justify-center w-full border border-gray-300 p-2"
                                @keydown.escape="isOpen= false"
                                aria-haspopup="true"
                                aria-expanded="true"
                            >Permissions
                            </button>
                            <div class="bg-white overflow-auto max-h-40"
                                 x-show="isOpen"
                                 x-transition:enter.duration.500ms
                                 x-transition:leave.duration.400ms
                                 @click.away="isOpen= false"
                            >

                                @foreach(\Spatie\Permission\Models\Permission::all() as $per)
                                    <div class="flex justify-between p-2 text-black ">
                                        <label for="per_{{$per->id}}">{{$per->name}}</label>
                                        <input type="checkbox" id="per_{{$per->id}}"
                                               class="focus:border-transparent focus:ring-0"
                                               wire:click="per_assign_revoke({{$user->id}},'{{$per->name}}')"
                                               @if(\App\Models\User::find($user->id)->hasPermissionTo($per->id)) checked @endif
                                        >
                                    </div>
                                @endforeach

                            </div>
                        </div>


                    </td>
                    <td class="m-3">
                        <div x-data="{isOpen: false}">

                            <button
                                @click="isOpen = !isOpen"
                                type="button"
                                class="inline-flex justify-center w-full border border-gray-300 p-2"
                                @keydown.escape="isOpen= false"
                                aria-haspopup="true"
                                aria-expanded="true"
                            >{{$user->organization->name}}
                            </button>
                            <div class="bg-white overflow-auto max-h-40"
                                 x-show="isOpen"
                                 x-transition:enter.duration.500ms
                                 x-transition:leave.duration.400ms
                                 @click.away="isOpen= false"
                            >
                                <ul>
                                    @foreach($organizations as $org)
                                        <li class="hover:bg-gray-300 m-4 text-black cursor-pointer
                                           @if($user->organization->id == $org->id) bg-blue-500 @endif
                                           " wire:click="updateOrg({{$user->id}},{{$org->id}})">{{$org->name}}</li>

                                    @endforeach
                                </ul>


                            </div>
                        </div>

                        {{--                        <div  >--}}
                        {{--                            @foreach($organizations as $org)--}}
                        {{--                                <span class="hover:bg-gray-50" wire:click="updateOrg({{$user->id}},{{$org->id}})">{{$org->name}}</span>--}}
                        {{--                            @endforeach--}}
                        {{--                        </div>--}}
                    </td>

                    <td class="py-4 px-6 flex">
                        <svg wire:click="delete({{$user->id}})" id="trash_{{$user->id}}" @click="handleClick"
                             data-timer="5"
                             class="w-6 h-6 cursor-pointer text-red-600 z-50"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path id="trash_{{$user->id}}" @click="handleClick" data-timer="5" class="z-0"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>


</div>
