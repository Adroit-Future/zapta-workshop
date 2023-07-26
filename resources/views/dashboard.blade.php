<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User</th>
                            <th scope="col">qty</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(isset($products))
                                @forelse ($products as $key=>$item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ optional($item)->name ?? 'name' }}</td>
                                    <td>{{ $item->qty }}</td>
                                    @can('view-product',$item)
                                    <td> Edit </td>
                                    @endcan
                                </tr>
                                @empty
                                @endforelse
                            @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
