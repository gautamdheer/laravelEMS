<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Talk Proposal') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 my-5">
        
        <form method="POST" action="{{ route('talkproposal.store') }}" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf

            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-gray-300 font-medium mb-2">Title</label>
                <input type="text" name="title" placeholder="Enter title" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
            </div>

            <!-- Description Textarea -->
            <div class="mb-4">
                <label for="description" class="block text-gray-300 font-medium mb-2">Description</label>
                <textarea name="description" rows="4" placeholder="Enter description" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required></textarea>
            </div>

            <!-- Tags Input -->
            <div class="mb-4">
                <label for="tags" class="block text-gray-300 font-medium mb-2">Tags</label>
                <input type="text" name="tags" placeholder="Tags (comma-separated)" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
            </div>

            <!-- File Upload -->
            <div class="mb-4">
                <label for="pdf_file" class="block text-gray-300 font-medium mb-2">Upload PDF</label>
                <input type="file" name="pdf_file" accept=".pdf" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Submit
                </button>
            </div>
        </form>

    </div>



</x-app-layout>

