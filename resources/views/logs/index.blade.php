<x-guidance-layout>
    <div class="h-auto min-h-screen w-full flex justify-start items-start">
        <div class="w-full flex flex-col p-4">
            <div class="py-2">
                <p class="poppins text-2xl font-medium text-gray-700">LOGS</p>
            </div>
            <div class="w-full flex flex-col">
                <div class="w-full overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-400 text-gray-700">
                        <thead>
                            <tr>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">ACTIVITY</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">DATE & TIME</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">IP ADDRESS</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center" >USER AGENT</th>
                                <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">USER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($logs->count())
                                @foreach($logs as $key => $log)
                                <tr>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-left">{{ $log->subject }}</td>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->created_at }}</td>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->ip }}</td>
                                    <td class="poppins text-xs border border-gray-400 px-4 py-2 text-center w-[500px] max-w-[500px]">{{ $log->agent }}</td>
                                    <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $log->user_id }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="py-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-guidance-layout>
