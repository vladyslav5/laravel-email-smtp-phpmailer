@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('email.send') }}" class="w-full max-w-2xl bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 space-y-6 border border-gray-200 dark:border-gray-700">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4">✉️ Send Email</h1>
        @csrf

        @if ($errors->any())
            <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-md">
                Please correct the errors in the form.
            </div>
        @endif


        <div>
            <label for="from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">From</label>
            <input type="email" name="from" id="from" value="{{ old('from') }}" required class="mt-2 w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" />
            @error('from')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="to" class="block text-sm font-medium text-gray-700 dark:text-gray-300">To</label>
            <input type="email" name="to" id="to" value="{{ old('to') }}" required class="mt-2 w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" />
            @error('to')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="cc" class="block text-sm font-medium text-gray-700 dark:text-gray-300">CC</label>
            <input type="email" name="cc" id="cc" value="{{ old('cc') }}" class="mt-2 w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" />
            @error('cc')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required class="mt-2 w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" />
            @error('subject')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Body Type</label>
            <select name="type" id="type" required class="mt-2 w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                <option value="">Select type</option>
                <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                <option value="html" {{ old('type') == 'html' ? 'selected' : '' }}>HTML</option>
            </select>
            @error('type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Body</label>
            <textarea name="body" id="body" rows="5" required class="mt-2 w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">{{ old('body') }}</textarea>
            @error('body')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" name="send" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Send</button>
    </form>
@endsection
