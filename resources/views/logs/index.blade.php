<x-guidance-layout>
    <div class="h-screen w-full flex justify-start items-start">

        <div class="w-full flex flex-col p-4">

            <div class="w-full flex border-l-4 border-red-400 py-1 px-2 mb-4 border-b border-gray-400">
                <h1 class="poppins text-2xl font-medium">LOGS</h1>
            </div>
            
            <div class="w-full flex flex-col">
                <div class="w-full overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-400">
                        <thead>
                            <tr>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">ACTIVITY</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">DATE & TIME</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">IP ADDRESS</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center" width="300px">USER AGENT</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">USER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($logs->count())
                                @foreach($logs as $key => $log)
                                <tr>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->subject }}</td>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->created_at }}</td>
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