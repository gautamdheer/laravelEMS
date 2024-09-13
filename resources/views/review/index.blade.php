<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reviewers') }}
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
        <!-- Table Section -->
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Title</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Speaker</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tags</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($proposals as $proposal)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $proposal->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $proposal->speaker->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $proposal->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ implode(', ', $proposal->tags) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $proposal->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Section -->
        <div class="mt-6 bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('review.store') }}">
                @csrf
                <input type="hidden" name="talk_proposal_id" value="{{ $proposal->id }}">
                <div class="mb-4">
                    <label for="comments" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Write your
                        review</label>
                    <textarea name="comments" rows="4" placeholder="Write your review"
                        class="w-full px-4 py-2 bg-gray-700 text-gray-200 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-500"></textarea>
                </div>
                <div class="mb-4">
                    <label for="rating"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating</label>
                    <input type="number" name="rating" max="5" min="1"
                        class="w-full px-4 py-2 bg-gray-700 text-gray-200 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-500">
                </div>
                <div class="text-right">
                    <button type="submit"
                        class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-500">Submit
                        Review</button>
                </div>
            </form>
        </div>
    </div>




</x-app-layout>
