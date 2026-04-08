<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket {{ $ticket->ticket_number }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root { --primary: #E53935; --dark: #121212; --gray: #666; --light: #f8f9fa; }
        body { font-family: 'Inter', sans-serif; background: #f5f7fa; min-height: 100vh; padding: 40px 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
        
        .header { background: var(--dark); color: white; padding: 25px 30px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 1.5rem; margin-bottom: 5px; }
        .header p { color: #aaa; font-size: 0.9rem; margin: 0; }
        .btn-back { color: white; text-decoration: none; opacity: 0.8; }
        
        .chat-container { padding: 30px; display: flex; flex-direction: column; gap: 20px; max-height: 60vh; overflow-y: auto; background: #fafafa; }
        .message { max-width: 80%; padding: 15px 20px; border-radius: 12px; position: relative; }
        
        .msg-user { align-self: flex-end; background: var(--primary); color: white; border-bottom-right-radius: 2px; }
        .msg-user .msg-time { color: rgba(255,255,255,0.7); }
        
        .msg-admin { align-self: flex-start; background: white; color: var(--dark); border: 1px solid #e2e8f0; border-bottom-left-radius: 2px; }
        .msg-admin .msg-author { font-weight: 700; color: #2196F3; font-size: 0.85rem; margin-bottom: 5px; }
        .msg-admin .msg-time { color: #94a3b8; }
        
        .msg-text { line-height: 1.5; font-size: 0.95rem; }
        .msg-time { font-size: 0.75rem; margin-top: 8px; display: block; text-align: right; }

        .reply-box { padding: 20px 30px; background: white; border-top: 1px solid #e2e8f0; }
        .reply-box textarea { width: 100%; border: 2px solid #e2e8f0; border-radius: 8px; padding: 15px; font-family: inherit; font-size: 0.95rem; resize: vertical; margin-bottom: 10px; }
        .reply-box textarea:focus { border-color: var(--primary); outline: none; }
        
        .btn-reply { background: var(--primary); color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: 700; cursor: pointer; float: right; transition: 0.3s; }
        .btn-reply:hover { background: var(--primary-dark); }
        
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; background: rgba(255,255,255,0.2); }

        @media (max-width: 768px) {
            .header { flex-direction: column; align-items: flex-start; gap: 15px; padding: 20px; }
            .status-badge { align-self: flex-start; }
            .message { max-width: 95%; padding: 12px; }
            .chat-container { padding: 15px; }
            .reply-box { padding: 15px; }
            .btn-reply { width: 100%; float: none; text-align: center; justify-content: center; display: block; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <a href="{{ route('tickets.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h1 style="margin-top: 15px;">{{ $ticket->subject }}</h1>
                <p>Kategori: {{ ucfirst($ticket->category) }}</p>
            </div>
            <div class="status-badge">
                {{ str_replace('_', ' ', $ticket->status) }}
            </div>
        </div>

        <div class="chat-container" id="chatContainer">
            @foreach($ticket->replies as $reply)
                <div class="message {{ $reply->user_id == Auth::id() ? 'msg-user' : 'msg-admin' }}">
                    @if($reply->user_id != Auth::id())
                        <div class="msg-author"><i class="fa-solid fa-user-shield"></i> {{ $reply->user->name }} (Admin/Support)</div>
                    @endif
                    <div class="msg-text">{!! nl2br(e($reply->message)) !!}</div>
                    <span class="msg-time">{{ $reply->created_at->format('d M, H:i') }}</span>
                </div>
            @endforeach
        </div>

        @if($ticket->status != 'closed')
        <div class="reply-box">
            <form action="{{ route('tickets.reply', $ticket->id) }}" method="POST" id="replyForm">
                @csrf
                <textarea name="message" id="replyMessage" rows="3" placeholder="Balas pesan di sini..." required></textarea>
                <div style="overflow: hidden;">
                    <button type="submit" id="submitBtn" class="btn-reply">Kirim Balasan <i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
        @else
        <div style="padding: 20px; background: #fef2f2; color: #dc2626; text-align: center; font-weight: 600;">
            <i class="fa-solid fa-lock"></i> Tiket ini telah ditutup.
        </div>
        @endif
    </div>

    <script>
        const currentUserId = {{ Auth::id() }};
        const ticketId = {{ $ticket->id }};
        const chatContainer = document.getElementById('chatContainer');
        const replyForm = document.getElementById('replyForm');
        const replyMessage = document.getElementById('replyMessage');
        const submitBtn = document.getElementById('submitBtn');
        let lastReplyCount = {{ $ticket->replies->count() }};

        // Scroll to bottom on load
        chatContainer.scrollTop = chatContainer.scrollHeight;

        // Handle AJAX Form Submission
        if (replyForm) {
            replyForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const message = replyMessage.value.trim();
                if (!message) return;

                // Disable button
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Mengirim... <i class="fa-solid fa-spinner fa-spin"></i>';

                const formData = new FormData(replyForm);
                
                fetch(replyForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        replyMessage.value = '';
                        fetchReplies(); // Refresh immediately
                    }
                })
                .catch(error => console.error('Error:', error))
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Kirim Balasan <i class="fa-solid fa-paper-plane"></i>';
                });
            });
        }

        // Fetch Replies Automatically
        function fetchReplies() {
            fetch(`{{ route('tickets.replies', $ticket->id) }}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.replies.length > lastReplyCount) {
                    renderReplies(data.replies);
                    lastReplyCount = data.replies.length;
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            })
            .catch(error => console.error('Error fetching replies:', error));
        }

        function renderReplies(replies) {
            chatContainer.innerHTML = '';
            replies.forEach(reply => {
                const isMe = reply.user_id == currentUserId;
                const date = new Date(reply.created_at);
                const timeString = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' }) + ', ' + 
                                 date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${isMe ? 'msg-user' : 'msg-admin'}`;
                
                let html = '';
                if (!isMe) {
                    html += `<div class="msg-author"><i class="fa-solid fa-user-shield"></i> ${reply.user.name} (Admin/Support)</div>`;
                }
                const escapedMessage = reply.message
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");

                html += `<div class="msg-text">${escapedMessage.replace(/\n/g, '<br>')}</div>`;
                html += `<span class="msg-time">${timeString}</span>`;
                
                messageDiv.innerHTML = html;
                chatContainer.appendChild(messageDiv);
            });
        }

        // Start polling
        setInterval(fetchReplies, 3000);
    </script>
</body>
</html>
