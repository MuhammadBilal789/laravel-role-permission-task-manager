@extends('layouts.master')

@section('title')
    Task Manager
@endsection()

@push('scripts')
    <script>
      document.getElementById('body').onkeyup = function(e) {
        if (e.keyCode === 13) {
          document.getElementById('search').submit(); // your form has an id="form"
        }
        return true;
      }
    </script>
@endpush

@section('search')
<form id="search" action="{{ route('admin.tasks.search') }}" method="GET">
  @csrf
  <input class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
  type="text"
  name="term"
  placeholder="Search Task"
  aria-label="Search" />
</form>
@endsection()

@section('content')
<div class="container grid px-6 mx-auto">

  @if ($message = Session::get('success'))

            <div class="px-6 my-6"> <div>
              <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $message }}
                </p>
            </div>
  @endif
              <!-- With actions -->
              <div class="px-6 my-6" align="right">
                
              </div>

              <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="w-full whitespace-no-wrap">
                    <thead>
                      <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                      >
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Create</th>
                        <th class="px-4 py-3">Edit</th>
                        <th class="px-4 py-3">Delete</th>
                        <th class="px-4 py-3">Show</th>
                        <th class="px-4 py-3">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($user as $users)
                      <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                          <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->

                            <div>
                              <p class="font-semibold">{{$users->name}}</p>
                              <p class="text-xs text-gray-600 dark:text-gray-400">
                              {{$users->email}}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="px-4 py-3 text-xs">
                          @if($users->can('create task'))
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                          >
                            Granted
                          </span>
                          @else
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                          >
                            Restricted
                          </span>
                          @endif
                        </td>
                        <td class="px-4 py-3 text-xs">
                          @if($users->can('edit task'))
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                          >
                          Granted
                          </span>
                          @else
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                          >
                            Restricted
                          </span>
                          @endif
                        </td>
                        <td class="px-4 py-3 text-xs">
                          @if($users->can('destroy task'))
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                          >
                          Granted
                          </span>
                          @else
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                          >
                            Restricted
                          </span>
                          @endif
                        </td>
                        <td class="px-4 py-3 text-xs">
                          @if($users->can('show task'))
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                          >
                          Granted
                          </span>
                          @else
                          <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                          >
                            Restricted
                          </span>
                          @endif
                        </td>
                        <td class="px-4 py-3">
                          <div class="flex items-center space-x-2 text-sm">
                            <button onclick="location.href='{{ route('admin.permissions.edit', $users->id)}}'"
                              class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="Edit"
                            >
                              <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                              >
                              <title>Edit</title>
                                <path
                                  d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                ></path>
                              </svg>
                            </button>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <div
                  class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                  <span class="flex items-center col-span-3">
                    Showing
                    @if(count($user)!=0)
                    {{$user->firstItem()}}-{{$user->lastItem()}} of {{$user->total()}}
                    @endif
                  </span>
                  <span class="col-span-2"></span>
                  <!-- Pagination -->
                  <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    {{$user->links('vendor.pagination.custom')}}
                  </span>
                </div>
              </div>
            </div>
  @endsection()
