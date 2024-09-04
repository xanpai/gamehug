@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="border border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-500 shadow-sm rounded-xl p-1">
        <div class="overflow-auto lg:overflow-visible">
            <table class="table-list">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="text-xs font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                {{__('Game Title')}}
                            </div>
                        </th>
                        <th scope="col">
                            <div class="text-xs font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                {{__('Status')}}
                            </div>
                        </th>
                        <th scope="col">
                            <div class="text-xs font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                {{__('Requested By')}}
                            </div>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($listings as $listing)
                    <tr>
                        <td>
                            <div class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $listing->title }}
                            </div>
                        </td>
                        <td>
                            <div class="text-xs text-gray-400 dark:text-gray-400">
                                <form action="{{ route('admin.request.update-status', $listing->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-xs">
                                        <option value="pending" {{ $listing->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $listing->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $listing->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="text-xs text-gray-400 dark:text-gray-400">
                                {{ $listing->user->name }}
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center justify-end text-end space-x-5">
                                <x-form.button-delete route="{{ route('admin.request.destroy', $listing->id) }}" />
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @include('admin.partials.table-footer')
        </div>
    </div>
</div>
@endsection