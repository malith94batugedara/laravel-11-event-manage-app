<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.update',$gallery->id) }}" enctype="multipart/form-data"
                class="p-4 bg-white dark:bg-slate-800 rounded-md space-y-2">
                @csrf
                @method('PUT')
                <div>
                    <label for="caption"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caption</label>
                    <input type="text" id="caption" name="caption"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('caption',$gallery->caption)}}">
                    @error('caption')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                        Image</label>
                    <img src="{{ asset('uploads/galleries/' . $gallery->image) }}" class="w-20 h-20"><br/>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="image">
                    @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="bg-white-200">
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-dark-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2  dark:hover:bg-dark-green-700 ">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
