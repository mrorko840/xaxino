<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Deposit;
use App\Models\GameLog;
use App\Models\Withdrawal;
use App\Traits\SupportTicketManager;

class TicketController extends Controller
{
    use SupportTicketManager;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'frontend';

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            if ($this->user) {
                $this->layout = 'master';
            }
            return $next($request);
        });

        $this->redirectLink = 'ticket.view';
        $this->userType     = 'user';
        $this->column       = 'user_id';
    }
    public function openSupportTicket()
    {
        if (!Auth::user()) {
            abort(404);
        }
        $pageTitle                 = 'Support Tickets';
        $user                      = auth()->user();
        $widget['total_balance']   = $user->balance;
        $widget['total_deposit']   = Deposit::successful()->where('user_id', $user->id)->sum('amount');
        $widget['total_withdrawn'] = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');

        $widget['total_invest'] = GameLog::where('user_id', $user->id)->sum('invest');
        $widget['total_win']    = GameLog::win()->where('user_id', $user->id)->sum('invest');
        $widget['total_loss']   = GameLog::loss()->where('user_id', $user->id)->sum('invest');
        return view($this->activeTemplate . 'user.support.create', compact('pageTitle', 'widget', 'user'));
    }


}
