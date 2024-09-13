<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Talk Proposal') }}
        </h2>


        @if (session('success'))
            <div class="flex items-center py-2 p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ session('success') }}

                </div>
            </div>
        @endif


    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 my-5">

        <form method="POST" action="{{ route('talkproposal.store') }}" enctype="multipart/form-data"
            class="bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf

            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-gray-300 font-medium mb-2">Title</label>
                <input type="text" name="title" placeholder="Enter title"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    required>
            </div>

            <!-- Description Textarea -->
            <div class="mb-4">
                <label for="description" class="block text-gray-300 font-medium mb-2">Description</label>
                <textarea name="description" rows="4" placeholder="Enter description"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    required></textarea>
            </div>

            <!-- Tags Input -->
            <div class="mb-4">
                <label for="tags" class="block text-gray-300 font-medium mb-2">Tags</label>
                <input type="text" name="tags" placeholder="Tags (comma-separated)"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    required>
            </div>

            <!-- File Upload -->
            <div class="mb-4">
                <label for="pdf_file" class="block text-gray-300 font-medium mb-2">Upload PDF</label>
                <input type="file" name="pdf_file" accept=".pdf"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    required>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Submit
                </button>
            </div>
        </form>

    </div>



</x-app-layout>
