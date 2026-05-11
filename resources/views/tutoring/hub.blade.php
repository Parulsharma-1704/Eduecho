<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoring Hub — EduEcho</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <style>
        :root {
            --teal: #0D9488; --teal-b: #10B981; --teal-l: #CCFBF1; --teal-ll: #F0FDFA; --teal-d: #0F766E; --teal-dd: #134E4A;
            --indigo: #4F46E5; --indigo-l: #E0E7FF; --indigo-d: #312E81;
            --violet: #6D28D9; --violet-b: #7C3AED; --violet-l: #EDE9FE; --violet-ll: #F5F3FF; --violet-d: #4C1D95; --violet-m: #C4B5FD;
            --navy: #1E1B4B; --white: #ffffff; --gray: #6B7280; --gray-l: #F9FAFB; --gray-b: #E5E7EB; --page: #F0FDFA;
            --slate: #64748B; --slate-l: #F1F5F9; --slate-ll: #F8FAFC; --slate-d: #334155;
            --amber: #D97706; --al: #FEF3C7; --ad: #92400E;
            --rose: #BE185D; --rl: #FCE7F3; --rd: #9D174D;
            --green: #16A34A; --gl: #DCFCE7; --gd: #166534;
            --blue: #2563EB; --bl: #EFF6FF; --bd: #1E40AF;
            --lavender: #E9D5FF; --indigo-700: #4F46E5;
            --font-head: 'Plus Jakarta Sans', sans-serif; --font-body: 'DM Sans', sans-serif;
            --r-sm: 8px; --r-md: 12px; --r-lg: 16px; --r-xl: 20px; --r-2xl: 24px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html,body{height:100%;overflow:hidden}
        body{font-family:var(--font-body);background:var(--page);color:var(--navy);font-size:14px}
        button{cursor:pointer;font-family:var(--font-body)}
        a{text-decoration:none;color:inherit}
        
        .container{display:flex;height:100vh;overflow:hidden}
        
        /* HEADER */
        .header{height:64px;background:var(--white);border-bottom:2px solid var(--teal-l);display:flex;align-items:center;justify-content:space-between;padding:0 24px;flex-shrink:0}
        .header-logo{display:flex;align-items:center;gap:12px;font-family:var(--font-head);font-size:18px;font-weight:800;color:var(--navy)}
        .header-logo img{height:36px}
        .header-logo em{color:var(--teal-b)}
        .header-right{display:flex;align-items:center;gap:12px}
        .header-user{display:flex;align-items:center;gap:10px;padding:8px 12px;background:var(--teal-ll);border:2px solid var(--teal-l);border-radius:var(--r-md);cursor:pointer}
        .header-user-av{width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--indigo),var(--teal));color:white;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center}
        .header-user span{font-size:12px;font-weight:700;color:var(--teal-d)}
        
        /* MAIN */
        .main{display:flex;flex:1;overflow:hidden}
        
        /* SIDEBAR */
        .sidebar{width:280px;background:var(--navy);display:flex;flex-direction:column;border-right:2px solid var(--navy);overflow:hidden;flex-shrink:0}
        .sidebar-header{padding:16px;border-bottom:1px solid rgba(255,255,255,.1)}
        .sidebar-header h3{color:var(--white);font-family:var(--font-head);font-size:14px;font-weight:700;margin:0}
        .sidebar-list{flex:1;overflow-y:auto;padding:8px}
        .sidebar-list::-webkit-scrollbar{width:4px}
        .sidebar-list::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:4px}
        .contact-item{display:block;padding:12px;margin:4px 0;border-radius:var(--r-lg);color:rgba(255,255,255,.6);transition:all .2s;border:2px solid transparent}
        .contact-item:hover{background:rgba(255,255,255,.08);color:var(--white)}
        .contact-item.active{background:var(--teal);color:var(--white);border-color:var(--teal-b)}
        .contact-item-inner{display:flex;align-items:center;gap:10px}
        .contact-av{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--indigo),var(--teal));color:var(--white);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .contact-name{font-size:13px;font-weight:600;color:inherit}
        .sidebar-empty{color:rgba(255,255,255,.5);padding:16px;text-align:center;font-size:12px}
        .sidebar-empty a{color:var(--teal-b);text-decoration:underline}
        
        /* CHAT AREA */
        .chat-area{flex:1;display:flex;flex-direction:column;background:var(--page);overflow:hidden}
        .chat-header{height:64px;background:var(--white);border-bottom:2px solid var(--teal-l);padding:0 24px;display:flex;align-items:center;gap:12px;flex-shrink:0}
        .chat-header-av{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--indigo),var(--teal));color:var(--white);font-size:13px;font-weight:800;display:flex;align-items:center;justify-content:center}
        .chat-header-info h2{font-family:var(--font-head);font-size:15px;font-weight:800;color:var(--navy);margin:0}
        .chat-messages{flex:1;overflow-y:auto;padding:20px 24px;display:flex;flex-direction:column;gap:12px}
        .chat-messages::-webkit-scrollbar{width:6px}
        .chat-messages::-webkit-scrollbar-thumb{background:var(--teal-l);border-radius:6px}
        .message{display:flex;gap:8px;animation:slideIn .3s ease}
        .message.mine{justify-content:flex-end}
        .message-bubble{max-width:60%;padding:12px 16px;border-radius:var(--r-2xl);font-size:13px;line-height:1.5}
        .message.mine .message-bubble{background:linear-gradient(135deg,var(--indigo-700),var(--teal));color:var(--white);border-radius:var(--r-2xl) var(--r-2xl) var(--r-sm) var(--r-2xl)}
        .message.theirs .message-bubble{background:var(--white);color:var(--navy);border:2px solid var(--lavender);border-radius:var(--r-2xl) var(--r-2xl) var(--r-2xl) var(--r-sm)}
        .chat-empty{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;color:var(--slate)}
        .chat-empty-icon{font-size:48px;color:var(--teal-l);margin-bottom:12px}
        .chat-empty p{font-size:14px;font-weight:600}
        .chat-input-area{padding:16px 24px;background:var(--white);border-top:2px solid var(--teal-l);flex-shrink:0}
        .chat-input-form{display:flex;gap:10px;align-items:center}
        .chat-input{flex:1;padding:12px 16px;border:2px solid var(--lavender);border-radius:var(--r-2xl);font-size:13px;font-family:var(--font-body);color:var(--navy);transition:all .2s}
        .chat-input:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px var(--teal-ll)}
        .chat-input::placeholder{color:var(--slate)}
        .chat-send{padding:10px 24px;background:linear-gradient(135deg,var(--indigo-700),var(--teal));color:var(--white);border:none;border-radius:var(--r-2xl);font-weight:600;font-size:13px;cursor:pointer;transition:opacity .2s}
        .chat-send:hover{opacity:.9}
        .chat-send:disabled{opacity:.5;cursor:not-allowed}
        
        @keyframes slideIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
        
        @media(max-width:768px){
            .sidebar{display:none}
            .chat-area{width:100%}
        }
    </style>
</head>
<body>

<div class="container">
    <!-- HEADER -->
    <div style="position:fixed;top:0;left:0;right:0;z-index:100">
        <div class="header">
            <div class="header-logo">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48'%3E%3Crect fill='%230D9488' width='48' height='48' rx='8'/%3E%3Ctext x='24' y='32' font-size='24' font-weight='bold' fill='white' text-anchor='middle' font-family='system-ui'%3E📚%3C/text%3E%3C/svg%3E" alt="EduEcho">
                <span>Edu<em>Echo</em></span>
            </div>
            <div class="header-right">
                <div class="header-user">
                    <div class="header-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <span>{{ explode(' ', Auth::user()->name)[0] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT (offset for header) -->
    <div class="main" style="margin-top:64px">
        
        <!-- SIDEBAR / CONTACTS -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i class="ti ti-message-circle" style="margin-right:8px"></i>Conversations</h3>
            </div>
            <div class="sidebar-list">
                @if($contacts->isEmpty())
                    <div class="sidebar-empty">
                        <p style="margin-bottom:8px">No connections yet</p>
                        @if($user->hasRole('special_educator'))
                            <a href="{{ route('tutoring.matching') }}">Find Students</a>
                        @endif
                    </div>
                @else
                    @foreach($contacts as $contact)
                        <a href="{{ route('tutoring.hub', ['contact' => $contact->id]) }}" 
                           class="contact-item {{ $activeContact && $activeContact->id == $contact->id ? 'active' : '' }}">
                            <div class="contact-item-inner">
                                <div class="contact-av">{{ substr($contact->name, 0, 1) }}</div>
                                <div class="contact-name">{{ $contact->name }}</div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- CHAT AREA -->
        <div class="chat-area">
            @if($activeContact)
                <!-- CHAT HEADER -->
                <div class="chat-header">
                    <div class="chat-header-av">{{ substr($activeContact->name, 0, 1) }}</div>
                    <div class="chat-header-info">
                        <h2>{{ $activeContact->name }}</h2>
                    </div>
                </div>

                <!-- MESSAGES -->
                <div id="messages-container" class="chat-messages">
                    <div style="text-align:center;color:var(--slate);font-size:13px;margin:auto">Loading messages...</div>
                </div>

                <!-- INPUT -->
                <div class="chat-input-area">
                    <form id="chat-form" class="chat-input-form">
                        <input type="text" id="message-input" autocomplete="off" class="chat-input" placeholder="Type a message...">
                        <button type="submit" class="chat-send">Send</button>
                    </form>
                </div>
            @else
                <!-- EMPTY STATE -->
                <div class="chat-empty">
                    <div class="chat-empty-icon"><i class="ti ti-message-circle-2"></i></div>
                    <p>Select a conversation to start chatting</p>
                </div>
            @endif
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
                wrapper.className = `message ${isMine ? 'mine' : 'theirs'}`;
                
                const bubble = document.createElement('div');
                bubble.className = 'message-bubble';
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
                            messagesContainer.innerHTML = '<div style="text-align:center;color:var(--slate);font-size:13px;margin:auto">Start the conversation!</div>';
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

            // Poll every 3 seconds
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
</body>
</html>
