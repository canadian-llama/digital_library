<div class="flex-1 flex items-center justify-center p-6 overflow-hidden"
    x-data="{ open:false, openEditModal:false, selectedUser:null }">
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-6 h-[85vh] overflow-y-auto">
        <h2 class="text-2xl font-bold text-indigo-600 border-b pb-4">👥 Manage Users</h2>
        @if ($users->isEmpty())
        <span class="text-gray-800">No Users yet!</span>
        @else
        <div class="table w-full">
            
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">S/N
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User
                            Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Suspension Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deactivation Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($users as $user)
                    <tr class="bg-gray-50 hover:bg-gray-100" wire:key="{{ $user->id }}">
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $count+=1 }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $user->username }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $user->role }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->suspended ? 'bg-green-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $user->suspended ? 'Suspended' : 'Active' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->deactivated ? 'bg-green-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $user->deactivated ? 'Deactivated' : 'Active' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap flex space-x-2">
                            <!-- Edit Button -->
                            <button @click="openEditModal = true;" wire:click='viewUser({{ $user }})' class="text-gray-600 hover:text-blue-500"
                                title="Edit User">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-13 13H3v-5L16 3z"></path>
                                </svg>
                            </button>
                            
                            <!-- Suspend Button -->
                            <button wire:click="suspendUser({{ $user->id }})" class="text-gray-600 hover:text-yellow-500" title="Suspend User">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"></path>
                                </svg>
                            </button>
                            
                            <!-- Deactivate Button -->
                            <button wire:click="deactivateUser({{ $user->id }})" class="text-gray-600 hover:text-red-500" title="Deactivate User">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6l-6 6-6-6"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v6"></path>
                                </svg>
                            </button>
                            
                            <!-- Delete Button -->
                            <button @click="open = true; confirmAction = () => deleteItem({{ $user->id }})" class="text-gray-600 hover:text-red-500"
                                title="Delete User">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6h12M6 6l1 14h10l1-14"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10h6"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal for Delete Confirmation -->
            <div x-show="open" x-transition.opacity
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-lg font-bold text-red-600">Warning</h2>
                    <p class="text-gray-700 mt-2">Are You sure you want to Delete this User? This action is irreversible!!</p>
                    <div class="flex justify-end mt-4 space-x-2">
                        <button @click="open = false" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">No</button>
                        <button @click="open = false" class="px-4 py-2 bg-red-600 text-white rounded-md"
                            wire:click="delete({{ $user->id }})">Yes</button>
                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            @if ($selectedUser)
                <div x-show="openEditModal" x-transition.opacity
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                        <h2 class="text-lg font-bold text-blue-600">Edit User</h2>
                        <form wire:submit.prevent="update({{ $selectedUser }})">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-600">Name</label>
                                <input type="text" id="name" class="input w-full" wire:model.defer="name" placeholder="Name">
                            </div>
                            <div class="mb-4">
                                <label for="username" class="block text-gray-600">Username</label>
                                <input type="text" id="username" class="input w-full" wire:model.defer="username"
                                    placeholder="Username">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-600">Email</label>
                                <input type="email" id="email" class="input w-full" wire:model.defer="email" placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <label for="role" class="block text-gray-600">Role</label>
                                <select id="role" class="input w-full" wire:model.defer="role">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button @click="openEditModal = false" type="button"
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Cancel</button>
                                <button @click="openEditModal = false" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save
                                    Changes</button>
                            </div>
                        </form>
                    </div>
                </div>                
            @endif
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>