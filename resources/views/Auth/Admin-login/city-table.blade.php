<div class="bg-white rounded-xl shadow">
                @if ($cities->isEmpty())
                    <p class="text-center text-gray-500 text-sm py-10">No state available.</p>
                @else
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                            <tr>
                                <th class="px-1 py-3 text-center">Sr.No</th>
                                <th class="px-1 py-3 text-left">City Name</th>
                                 <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-1 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cities as $city)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="text-center">
                                        {{ ($cities->currentPage() - 1) * $cities->perPage() + $loop->iteration }}
                                    </td>

                                    <td class="px-1 py-1 font-medium whitespace-nowrap">{{$city->city_name}}</td>
                                     <td class="px-1 py-3 font-medium whitespace-nowrap text-left">
                                        @if($city->op_status==1)
                                                 <h6>Active</h6>
                                            @elseif ($city->op_status==0)
                                                 <h6>Inctive</h6>
                                            @endif
                                    </td>
                                    <td class="px-1 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ '/edit-city-from-list/' .urlencode(Crypt::encrypt($city->city_id)) }}">

                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                    width="24px" fill="#1f1f1f">
                                                    <path
                                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('delete-city', encrypt($city->city_id)) }}"
                                                onsubmit="return confirm('Are you sure?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                        viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
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
