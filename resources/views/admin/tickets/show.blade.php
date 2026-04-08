@extends('layouts.admin')

@section('title', 'Tinjau Tiket Bantuan')
@section('page-title', 'Detail Tiket #' . $ticket->ticket_number)

@push('styles')
<style>
    .chat-container { display: flex; flex-direction: column; gap: 20px; background: white; padding: 30px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); margin-bottom: 24px; min-height: 400px; max-height: 500px; overflow-y: auto; }
    
    .message { max-width: 75%; padding: 15px 20px; border-radius: 15px; position: relative; }
    .msg-client { align-self: flex-start; background: #f1f5f9; color: var(--text-main); border: 1px solid #e2e8f0; border-bottom-left-radius: 2px; }
    .msg-admin { align-self: flex-end; background: var(--primary); color: white; border-bottom-right-radius: 2px; }
    
    .msg-author { font-weight: 700; font-size: 13px; margin-bottom: 5px; opacity: 0.8; }
    .msg-text { font-size: 15px; line-height: 1.5; }
    .msg-time { font-size: 11px; margin-top: 8px; display: block; text-align: right; opacity: 0.7; }
    
    .control-panel { background: white; padding: 25px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); }
    .ticket-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start; }
    
    @media (max-width: 768px) {
        .ticket-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <a href="{{ route('admin.tickets.index') }}" class="btn-action" style="background: white; border: 1px solid #ddd; margin-bottom: 20px; color: var(--text-main);">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Tiket
    </a>

    <div class="ticket-grid">
        <div>
            <!-- Chat Box -->
            <div class="chat-container" id="adminChatContainer">
                <div style="text-align: center; margin-bottom: 20px; color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                    Topik: {{ $ticket->subject }} &middot; Dibuat {{ $ticket->created_at->format('d M Y') }}
                </div>

                @foreach($ticket->replies as $reply)
                    <div class="message {{ $reply->user->role == 'user' ? 'msg-client' : 'msg-admin' }}">
                        <div class="msg-author">{{ $reply->user->name }} {{ $reply->user->id == $ticket->user_id ? '(Client)' : '(Staff)' }}</div>
                        <div class="msg-text">{!! nl2br(e($reply->message)) !!}</div>
                        <span class="msg-time">{{ $reply->created_at->format('H:i, d M Y') }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Balas Box -->
            @if($ticket->status != 'closed')
            <div class="control-panel">
                <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST" id="adminReplyForm">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: 700; display: block; margin-bottom: 10px;">Balas Ke Pelanggan</label>
                        <textarea name="message" id="adminReplyMessage" rows="4" style="width: 100%; border: 2px solid #e2e8f0; border-radius: 8px; padding: 15px; font-family: inherit;" required placeholder="Ketik balasan Anda memberikan solusi..."></textarea>
                    </div>
                    <button type="submit" id="adminSubmitBtn" style="background: var(--primary); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 700; cursor: pointer;">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Jawaban
                    </button>
                </form>
            </div>
            @else
            <div style="background: #fef2f2; color: #dc2626; padding: 20px; text-align: center; border-radius: 12px; font-weight: 600; border: 1px dashed #f87171;">
                <i class="fa-solid fa-lock"></i> Kasus tiket telah ditutup. Tidak dapat membalas.
            </div>
            @endif
        </div>

        <div>
            <!-- Status Control -->
            <div class="control-panel" style="margin-bottom: 20px;">
                <h3 style="margin-bottom: 15px; font-size: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">Ubah Status Tiket</h3>
                <form action="{{ route('admin.tickets.update-status', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 15px;">
                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open (Baru)</option>
                        <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress (Sedang Ditangani)</option>
                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed (Selesai)</option>
                    </select>
                    <button type="submit" style="width: 100%; padding: 10px; background: var(--dark); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Delete Danger -->
            <div class="control-panel" style="background: #fff5f5; border: 1px solid #fed7d7;">
                <h3 style="margin-bottom: 15px; font-size: 16px; color: #c53030;">Aksi Berbahaya</h3>
                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus seluruh jejak chat tiket ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="width: 100%; padding: 10px; background: transparent; color: #c53030; border: 2px solid #c53030; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-trash"></i> Hapus Permanen Tiket
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const ticketId = {{ $ticket->id }};
    const ticketUserId = {{ $ticket->user_id }};
    const chatContainer = document.getElementById('adminChatContainer');
    const replyForm = document.getElementById('adminReplyForm');
    const replyMessage = document.getElementById('adminReplyMessage');
    const submitBtn = document.getElementById('adminSubmitBtn');
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
                submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Kirim Jawaban';
            });
        });
    }

    // Fetch Replies Automatically
    function fetchReplies() {
        fetch(`{{ route('admin.tickets.replies', $ticket->id) }}`, {
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
        // Keep the topic header
        const topicHeader = chatContainer.querySelector('div:first-child');
        chatContainer.innerHTML = '';
        chatContainer.appendChild(topicHeader);

        replies.forEach(reply => {
            const isClient = reply.user.role === 'user';
            const date = new Date(reply.created_at);
            const timeString = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ', ' + 
                             date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });

            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${isClient ? 'msg-client' : 'msg-admin'}`;
            
            const authorRole = reply.user.id === ticketUserId ? '(Client)' : '(Staff)';
            
            const escapedMessage = reply.message
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");

            let html = '';
            html += `<div class="msg-author">${reply.user.name} ${authorRole}</div>`;
            html += `<div class="msg-text">${escapedMessage.replace(/\n/g, '<br>')}</div>`;
            html += `<span class="msg-time">${timeString}</span>`;
            
            messageDiv.innerHTML = html;
            chatContainer.appendChild(messageDiv);
        });
    }

    // Start polling
    setInterval(fetchReplies, 3000);
</script>
@endpush
