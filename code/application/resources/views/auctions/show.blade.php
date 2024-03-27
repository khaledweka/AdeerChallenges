<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Auctions') }}
        </h2>
    </x-slot>
    <div class="bg-white">
        <div class="p-8 py-12">
            <div>
                <div class="px-4 sm:px-0">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Auction Information</h3>
                    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Auctions details and users Bids.</p>
                </div>
                <div class="mt-6 border-t border-gray-100">
                    {{--draw 3 column with tailwind--}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div class="sm:col-span-1">
                            <div class="px-4 py-5 sm:px-6">
                                <dl class="divide-y divide-gray-100">
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $auction->title }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $auction->description }}
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Ends At</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $auction->ends_at }}
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Created At</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $auction->created_at }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <div class="px-4 py-5 sm:px-6" style="height: 350px;overflow: scroll">
                                <ul role="list" id="bidList" class="divide-y divide-gray-100">
                                    @foreach ($auction->bids as $bid)
                                        <li class="flex justify-between gap-x-6 py-5">
                                            <div class="flex min-w-0 gap-x-4">
                                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                                     src="https://placehold.co/600x400.png"
                                                     alt="">
                                                <div class="min-w-0 flex-auto">
                                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                                        {{ $bid->user->name ??"" }}
                                                    </p>
                                                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                                        {{ $bid->user->email ??"" }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                                <p class="text-sm leading-6 text-gray-900">{{ $bid->price }}</p>
                                                <p class="mt-1 text-xs leading-5 text-gray-500"> Bid At
                                                    <time datetime="2023-01-23T13:23Z">
                                                        {{ $bid->created_at }}
                                                    </time>
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <div class="px-4 py-5 sm:px-6">
                                <form id="bidCreate" action="{{ route('bids.store', $auction) }}" method="POST">
                                    @csrf
                                    <div class="space-y-2 flex flex-col ">
                                        <label for="amount" class="font-semibold">Amount</label>
                                        <input type="number" name="price" id="amount" class="border rounded px-4 py-2">
                                        {{--display validaiton message--}}
                                        @error('price')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="my-1 flex flex-col ">
                                        <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Bid
                                        </button>
                                    </div>
                                </form>

                            </div>
                            {{--show number of bids and highest bidder--}}
                            <div class="px-4 py-5 sm:px-6">
                                <dl class="divide-y divide-gray-100">
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Number of Bids</dt>
                                        <dd id="bids_count"
                                            class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $auction->bids->count() }}
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Highest Bidder</dt>
                                        <dd id="highest_bidder"
                                            class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $auction->bids->first()->user->name ?? "" }}
                                        </dd>
                                    </div>
                                    {{--highest bid--}}
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Highest Bid</dt>
                                        <dd id="highest_bid"
                                            class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $auction->bids->first()->price ?? "" }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{--apply pusher realtime bid--}}
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            Pusher.logToConsole = true;

            const pusher = new Pusher('{!! env('PUSHER_APP_KEY') !!}', {
                cluster: '{!! env('PUSHER_APP_CLUSTER') !!}'
            });
            const channel = pusher.subscribe('auctions.' + {{ $auction->id }});


            //bind to teh top of the list
            channel.bind('bid.created', function (data) {
                const bidList = document.querySelector('#bidList');
                const newBid = document.createElement('li');
                newBid.classList.add('flex', 'justify-between', 'gap-x-6', 'py-5');
                newBid.innerHTML = `
                <div class="flex min-w-0 gap-x-4">
                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                         src="https://placehold.co/600x400.png"
                         alt="">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">
                            ${data.user.name}
                        </p>
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                            ${data.user.email}
                        </p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900">${data.amount}</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500"> Bid At
                        <time datetime="2023-01-23T13:23Z">
                            ${data.created_at}
                        </time>
                    </p>
                </div>
            `;
                bidList.prepend(newBid);

                //update the number of bids
                const bidsCount = document.querySelector('#bids_count');
                bidsCount.innerText = parseInt(bidsCount.innerText) + 1;

                //update the highest bidder
                const highestBidder = document.querySelector('#highest_bidder');
                highestBidder.innerText = data.user.name;

                //update the highest bid
                const highestBid = document.querySelector('#highest_bid');
                highestBid.innerText = data.amount;

                //ring bell after bidding
                const audio = new Audio('https://www.soundjay.com/buttons/sounds/beep-07a.mp3');
                audio.play();

            });


        </script>

        {{--make ajax request to handle bid--}}
        <script>
            const form = document.querySelector('#bidCreate');
            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                });
                const data = await response.json();
                //handle success message and error message
                if (response.ok) {
                    form.reset();
                } else {
                    //display error under input
                    if (document.querySelector('.text-red-500')) {
                        document.querySelector('.text-red-500').remove();
                    }
                    if (data.errors && data.errors.price[0]) {
                        const amount = document.querySelector('#amount');
                        amount.insertAdjacentHTML('afterend', `<p class="text-red-500">${data.errors.price[0]}</p>`);
                    } else {
                        alert(data.message);
                    }
                }
            });
        </script>
</x-app-layout>
