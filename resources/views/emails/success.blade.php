@extends('layouts.app')

@section('content')
    <div
        class="max-w-xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-xl text-gray-800 dark:text-gray-200">
        <h1 class="text-2xl font-bold mb-4 text-green-600 dark:text-green-400">Email sent successfully! 🎉</h1>


        <p class="mb-4"><strong>Identifier:</strong> {{ $email->uuid }}</p>


        <h2 class="text-xl font-semibold mb-2">Message Details</h2>
        <ul class="space-y-2 mb-4">
            <li><strong>Sender (From):</strong> {{ $email->from_address }}</li>
            <li><strong>Recipient (To):</strong> {{ $email->to_address }}</li>
            @if ($email->cc_address)
                <li><strong>Copy (CC):</strong> {{ $email->cc_address }}</li>
            @endif
            <li><strong>Body Type (Type):</strong> {{ $email->type }}</li>
        </ul>


        <h3 class="text-lg font-medium mb-2">Email Body</h3>
        <div class="w-full h-72 border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
            @if($email->type === 'text')
               <iframe
                  srcdoc="{{htmlentities($email->body)}}"
                    class="w-full h-full"
                    style="border: none; color:gray;">
                </iframe>
            @else
                <iframe
                  srcdoc="<?php echo htmlspecialchars($email->body, ENT_QUOTES); ?>"
                    class="w-full h-full"
                    style="border: none; color:gray;">
                </iframe>
            @endif
        </div>



    </div>
@endsection
