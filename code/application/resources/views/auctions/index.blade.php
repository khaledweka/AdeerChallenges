<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Auctions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white text-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-max">
                    <table class="table table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Ends At</th>
                            <th class="px-4 py-2">Created At</th>
                            <th class="px-4 py-2">Show </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($auctions as $auction)
                            <tr>
                                <td class="border px-4 py-2">{{ $auction->title }}</td>
                                <td class="border px-4 py-2">{{ $auction->description }}</td>
                                <td class="border px-4 py-2">{{ $auction->ends_at }}</td>
                                <td class="border px-4 py-2">{{ $auction->created_at }}</td>
                                <td class="border px-4 py-2">
                                    {{--show button--}}
                                    <a href="{{ route('auctions.show', $auction) }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Show</a>
                                    {{--edit button--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $auctions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
