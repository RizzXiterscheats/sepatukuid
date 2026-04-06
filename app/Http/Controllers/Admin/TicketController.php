<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tickets = $query->paginate(20);
        
        $openTicketsCount = Ticket::where('status', 'open')->count();
        $inProgressCount = Ticket::where('status', 'in_progress')->count();

        return view('admin.tickets.index', compact('tickets', 'openTicketsCount', 'inProgressCount'));
    }

    public function show($id)
    {
        $ticket = Ticket::with(['user', 'replies.user'])->findOrFail($id);
        
        // Auto mark as in_progress if it was open and an admin views it
        if ($ticket->status === 'open') {
            $ticket->update(['status' => 'in_progress']);
        }

        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($id);
        
        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Balasan terkirim ke pelanggan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => $validated['status']]);

        return back()->with('success', 'Status tiket berhasil diubah!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket bantuan berhasil dihapus.');
    }
}
