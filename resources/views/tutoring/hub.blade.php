<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tutoring Hub (Messages)') }}
        </h2>
    </x-slot>

    <div class="py-12 h-[calc(100vh-64px)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full flex flex-col md:flex-row">
                
                <!-- Sidebar / Contacts List -->
                <div class="w-full md:w-1/3 border-r border-gray-200 flex flex-col h-full bg-gray-50">
                    <div class="p-4 border-b bg-white">
                        <h3 class="font-bold text-gray-700">Conversations</h3>
                    </div>
                    <div class="overflow-y-auto flex-1 p-2">
                        @if($contacts->isEmpty())
                            <p class="text-sm text-gray-500 p-4">No connections yet.</p>
                            @if($user->hasRole('special_educator'))
                                <a href="{{ route('tutoring.matching') }}" class="ml-4 text-sm text-indigo-600 hover:text-indigo-900">Find Students</a>
                            @endif
                        @else
                            @foreach($contacts as $contact)
                                <a href="{{ route('tutoring.hub', ['contact' => $contact->id]) }}" 
                                   class="block p-4 rounded-lg mb-2 transition {{ $activeContact && $activeContact->id == $contact->id ? 'bg-indigo-50 border-indigo-200 border' : 'hover:bg-gray-100 border border-transparent' }}">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                                            {{ substr($contact->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $contact->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="w-full md:w-2/3 flex flex-col h-[600px] md:h-auto bg-white">
                    @if($activeContact)
                        <!-- Chat Header -->
                        <div class="p-4 border-b flex items-center justify-between bg-white shadow-sm z-10">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                                    {{ substr($activeContact->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $activeContact->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Messages Container -->
                        <div id="messages-container" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 flex flex-col">
                            <!-- Messages will be loaded here via JS -->
                            <div class="text-center text-sm text-gray-500 mt-4">Loading messages...</div>
                        </div>

                        <!-- Input Area -->
                        <div class="p-4 border-t bg-white">
                            <form id="chat-form" class="flex gap-2">
                                <input type="text" id="message-input" autocomplete="off" class="flex-1 rounded-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Type a message...">
                                <button type="submit" class="rounded-full bg-indigo-600 px-6 py-2 text-white font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                                    Send
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center text-gray-500 p-8 text-center bg-gray-50">
                            <svg class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <p class="text-lg font-medium">Select a conversation to start chatting</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    @if($activeContact)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactId = {{ $activeContact->id }};
            const currentUserId = {{ Auth::id() }};
            const messagesContainer = document.getElementById('messages-container');
            const chatForm = document.getElementById('chat-form');
            const messageInput = document.getElementById('message-input');
            
            // Function to render a single message bubble
            function renderMessage(msg) {
                const isMine = msg.sender_id === currentUserId;
                const wrapper = document.createElement('div');
                wrapper.className = `flex w-full ${isMine ? 'justify-end' : 'justify-start'}`;
                
                const bubble = document.createElement('div');
                bubble.className = `max-w-[75%] rounded-2xl px-5 py-3 ${isMine ? 'bg-indigo-600 text-white rounded-tr-none' : 'bg-white border border-gray-200 text-gray-900 shadow-sm rounded-tl-none'}`;
                
                bubble.textContent = msg.content;
                wrapper.appendChild(bubble);
                return wrapper;
            }

            // Function to load messages
            function fetchMessages() {
                fetch(`/tutoring/api/messages/${contactId}`)
                    .then(response => response.json())
                    .then(messages => {
                        messagesContainer.innerHTML = '';
                        if(messages.length === 0) {
                            messagesContainer.innerHTML = '<div class="text-center text-sm text-gray-500 mt-4">Start the conversation!</div>';
                        } else {
                            messages.forEach(msg => {
                                messagesContainer.appendChild(renderMessage(msg));
                            });
                            // Scroll to bottom
                            messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        }
                    })
                    .catch(error => console.error('Error fetching messages:', error));
            }

            // Initial fetch
            fetchMessages();

            // Poll every 3 seconds for simple "real-time" feel without websockets overhead right now
            setInterval(fetchMessages, 3000);

            // Send message
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const content = messageInput.value.trim();
                if (!content) return;

                messageInput.disabled = true;

                fetch(`/tutoring/api/messages/${contactId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ content: content })
                })
                .then(response => response.json())
                .then(msg => {
                    messageInput.value = '';
                    messageInput.disabled = false;
                    messageInput.focus();
                    
                    // Optimistically append the message if it's the first one, else it will be picked up by polling
                    if(messagesContainer.innerHTML.includes('Start the conversation!')) {
                        messagesContainer.innerHTML = '';
                    }
                    messagesContainer.appendChild(renderMessage(msg));
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    messageInput.disabled = false;
                });
            });
        });
    </script>
    @endif
</x-app-layout>
