<div class="bg-white rounded-xl shadow">
    @if ($states->isEmpty())
        <p class="text-center text-gray-500 text-sm py-10">No state available.</p>
    @else
        <table class="w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                <tr>
                    <th class="px-1 py-3 text-center">Sr.No</th>
                    <th class="px-1 py-3 text-left">State Name</th>
                    <th class="px-1 py-3 text-center">Status</th>
                    <th class="px-1 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($states as $state)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="text-center">
                            {{ ($states->currentPage() - 1) * $states->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-1 py-3 font-medium whitespace-nowrap">{{$state->state_name}}</td>
                        <td class="px-1 py-3 font-medium whitespace-nowrap text-center">
                            @if($state->op_status == 1)
                                <h6>Active</h6>
                            @elseif ($state->op_status == 0)
                                <h6>Inactive</h6>
                            @endif
                        </td>
                        <td class="px-1 py-3 text-center">
                            <div class="flex justify-center gap-2">
                               @if ($state->op_status == 1)
                                <a
                                    href="{{ route('view-state-details', ['encrypted_state_id' => urlencode(Crypt::encrypt($state->state_id))]) }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                        fill="#1f1f1f">
                                        <path
                                            d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                    </svg>
                                </a>
                                @else ($state->op_status==0)
                                <a href="javascript:void(0)" onclick="alert('This state is inactive and cannot be viewed.')" title="State Inactive">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
            width="24px" fill="#9ca3af"> 
                                        <path
                                            d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                    </svg>
                                </a>
                                @endif

                                <a
                                    href="{{ route('edit-state', ['encrypted_state_id' => urlencode(Crypt::encrypt($state->state_id))]) }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                        fill="#1f1f1f">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('delete-state-details', $state->state_id) }}"
                                    onsubmit="return confirm('Are you sure?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#1f1f1f">
                                            <path
                                                d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>