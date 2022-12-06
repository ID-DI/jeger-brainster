<x-app-layout>
    <x-slot name="header">
        <div class="flex mb-4">
            <div class="font-semibold text-xl text-gray-800 leading-tight w-3/4">
                {{ __('Dashboard') }}
            </div>
            <button class="bg-gray-100 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-xl w-1/4 d-none"
                id="giveAward" data-bs-toggle="modal" data-bs-target="#modalReward">
                {{ __('Award someone') }}
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center text-black-600 text-xl" id="title">
                    - Pending receipts -
                </div>
            </div>
        </div>
    </div>

    <!-- Modal message-->
    <div class="modal fade " id="modalResponse" tabindex="-1" aria-labelledby="modalJeggerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content transparent">
                <div class="modal-body modalBodyResponse">
                </div>
            </div>
        </div>
    </div>

    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="main_nest">
            <div class="p-20 grid grid-cols-4 gap-5" id="nest">
                @foreach($receipts as $receipt)
                <img class="pending w-full h-full object-cover cursor-pointer hover:shadow-xl rounded shadow-md border-gray-400 querryImg"
                    data-bs-toggle="modal" data-bs-target="#exampleModalLg-{{$receipt->id}}"
                    src="{{$receipt->file->file_path}}" id="{{$receipt->id}}">
                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                    id="exampleModalLg-{{$receipt->id}}" tabindex="-1" aria-labelledby="exampleModalLgLabel"
                    aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                        <div
                            class="modal-content border-none shadow-xl relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                            <div class="modal-header">
                                <h5 class="modal-title">Email: {{$receipt->file->email}}</h5>
                                <button type="button"
                                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                    data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body relative p-4">
                                <img id="modal-img" src="{{$receipt->file->file_path}}"
                                    class="max-w-[1100px] max-h-[800px] object-cover mx-auto" />
                            </div>
                            <div
                                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                <form action="{{ route('admin.approve') }}" method="POST" enctype="multipart/form-data"
                                    id="approveForm">
                                    @csrf
                                    <input type="hidden" value="{{$receipt->id}}" name="approveId" id="approveId">
                                    <button type="submit"
                                        class="approve_decline inline-block px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-xl focus:bg-green-600 focus:shadow-xl focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-xl transition duration-150 ease-in-out"
                                        data-bs-dismiss="modal">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.decline') }}" method="POST" enctype="multipart/form-data"
                                    id="declineForm">
                                    @csrf
                                    <input type="hidden" value="{{$receipt->id}}" name="declineId" id="declineId">
                                    <button type="submit"
                                        class="approve_decline inline-block px-6 py-2.5 bg-red-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-xl focus:bg-red-600 focus:shadow-xl focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-xl transition duration-150 ease-in-out ml-1">
                                        Decline
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="p-20 grid grid-cols-4 gap-5" id="nest">
                <div class="modal fade fixed top-0 left-0 w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                    id="modalReward" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-modal="true"
                    role="dialog">
                    <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
                        <div
                            class="modal-content border-none shadow-xl relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailReward"></h5>
                                <button type="button"
                                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                    data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>

                            <form action="{{route('admin.notification')}}" method="POST" enctype="multipart/form-data" id="rewardForm"
                                class="form-group">
                                @csrf
                                <div class="modal-body relative p-4">
                                    <input type="hidden" name="receiptId" id="receiptId">
                                    <select name="reward" id="reward" class="form-select text-capitalize">
                                    </select>
                                </div>
                                <div
                                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                    <button type="submit"
                                        class="approve_decline inline-block px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-xl focus:bg-green-600 focus:shadow-xl focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-xl transition duration-150 ease-in-out"
                                        data-bs-dismiss="modal" id="notificationBtn">
                                        Reward
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-20 grid grid-cols-4 gap-5" id="nest">
                <div class="modal fade fixed top-0 left-0 w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                    id="modalDeclinedApproved" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-modal="true"
                    role="dialog">
                    <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
                        <div
                            class="modal-content border-none shadow-xl relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailDeclinedApproved"></h5>
                                <button type="button"
                                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                    data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>

                            <div class="modal-body relative p-4">
                                <img id="modal-img" 
                                    class="max-w-[1100px] max-h-[800px] object-cover mx-auto" />
                            </div>

                            <form action="{{route('admin.declineApprove')}}" method="POST" enctype="multipart/form-data" id="DeclinedApprovedForm"
                                class="form-group">
                                @csrf
                                <div
                                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                <input type="hidden" name="declineApproveId" id="declineApproveId">
                                <button type="submit"
                                        class="approve_decline inline-block px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-xl focus:bg-green-600 focus:shadow-xl focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-xl transition duration-150 ease-in-out"
                                        data-bs-dismiss="modal" id="declineApproveBtn">
                                        Approve
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>