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
<form action="{{ route('admin.permissions.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
      <div class="container px-6 mx-auto grid">
        <div class="px-6 my-6"></div>
          <!-- General elements -->
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Permission Note</span>
              <textarea
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3"
                name ="description"
              ></textarea>
            </label>
            <label class="block mt-4 text-sm">
              <input type="checkbox" checked name="create_task" hidden="true" value="off">
              <input type="checkbox" checked name="edit_task" hidden="true" value="off">
              
              <input type="checkbox" checked name="show_task" hidden="true" value="off">
              <input type="checkbox" checked name="destroy_task" hidden="true" value="off">

              <input
                  name="create_task"
                  type="checkbox"
                   {{$user->can('create task') == 1 ? 'checked' : ''}}
                  class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              />
              <span class="ml-2">
                  Create Permission
              </span>
              &nbsp;
              &nbsp;
              <input
                  name="edit_task"
                  type="checkbox"
                   {{$user->can('edit task') == 1 ? 'checked' : ''}}
                  class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              />
              <span class="ml-2">
                  Edit Permission
              </span>
              &nbsp;
              &nbsp;
              <input
                  name="show_task"
                  type="checkbox"
                   {{$user->can('show task') == 1 ? 'checked' : ''}}
                  class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              />
              <span class="ml-2">
                  Show Permission
              </span>
              &nbsp;
              &nbsp;
              <input
                  name="destroy_task"
                  type="checkbox"
                   {{$user->can('destroy task') == 1 ? 'checked' : ''}}
                  class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              />
              <span class="ml-2">
                  Delete Permission
              </span>
              </label>           
            <div class="flex mt-6 text-sm" float="left">
              <button type="submit" class="flex items-center justify-between w-half px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Update
              </button>
            </div>
          </div>
      </div>
</form>
@endsection()
