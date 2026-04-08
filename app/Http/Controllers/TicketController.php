<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        return view('user.tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string',
            'message' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'ticket_number' => 'TKT-' . strtoupper(uniqid()),
            'subject' => $validated['subject'],
            'category' => $validated['category'],
            'status' => 'open',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Tiket bantuan berhasil dibuat! Kami akan segera merespons.');
    }

    public function show($id)
    {
        $ticket = Ticket::where('user_id', Auth::id())->with(['replies.user'])->findOrFail($id);
        return view('user.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Ticket::where('user_id', Auth::id())->findOrFail($id);
        
        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        // If user replies, ensure ticket is open or in_progress so admin sees it's active
        if ($ticket->status === 'closed') {
            $ticket->update(['status' => 'open']);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Balasan berhasil dikirim!'
            ]);
        }

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function getReplies($id)
    {
        $ticket = Ticket::where('user_id', Auth::id())->with(['replies.user'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'replies' => $ticket->replies
        ]);
    }

    public function storeAjax(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'ticket_number' => 'TKT-' . strtoupper(uniqid()),
            'subject' => \Illuminate\Support\Str::words($validated['message'], 5, '...'), // Auto-generate subject
            'category' => 'lainnya',
            'status' => 'open',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim ke Admin. Kami akan membalas di menu Ticket Bantuan.'
        ]);
    }
}
