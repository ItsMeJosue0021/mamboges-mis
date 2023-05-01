<x-guidance-layout>
    <div class="h-screen w-full flex justify-start items-start">

        <div class="w-full flex flex-col p-4">

            <div>
                <h1>LOGS</h1>
            </div>
            
            <div class="w-full flex flex-col">
                <div class="w-full overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-400">
                        <thead>
                            <tr>
                                <th class="poppins text-base border border-gray-400 px-4 py-2 text-center">Activity</th>
                                <th class="poppins border border-gray-400 px-4 py-2 text-center">Ip Address</th>
                                <th class="poppins border border-gray-400 px-4 py-2 text-center" width="300px">User Agent</th>
                                <th class="poppins border border-gray-400 px-4 py-2 text-center">User Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($logs->count())
                                @foreach($logs as $key => $log)
                                <tr>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->subject }}</td>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->ip }}</td>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->agent }}</td>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->user_id }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</x-guidance-layout>