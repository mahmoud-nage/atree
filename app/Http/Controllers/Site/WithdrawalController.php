<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Auth;
use App\Models\Order;
use App\Models\Income;
use App\Models\Withdrawals;
use App\Models\UserPoint;
use App\Models\BankAccount;
use Carbon\Carbon;
use App\Http\Requests\Site\StoreWithdrawalRequest;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $can_withdrawal = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '<=', Carbon::today())->sum('amount');
        $can_not_withdrawal = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '>', Carbon::today())->sum('amount');
        $withdrawals = Withdrawals::where('user_id', Auth::id())->latest()->get();
        return view('site.withdrawals', compact('withdrawals', 'can_withdrawal', 'can_not_withdrawal'));
    }


    public function statistics()
    {
        $orders_count = Order::where('user_id', Auth::id())->count();
        $total_incomes = Income::where('user_id', Auth::id())->sum('amount');
        $total_incomes_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 1)->sum('amount');
        $total_incomes_not_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 0)->sum('amount');

        $total_points = UserPoint::where('user_id', Auth::id())->sum('points');
        return view('site.statistics', compact('orders_count', 'total_incomes_not_withdrawald', 'total_incomes', 'total_incomes_withdrawald', 'total_points'));
    }

    public function create()
    {
        $withdrawals = Withdrawals::where('user_id', Auth::id())->where('status', 2)->count();
        if ($withdrawals) {
            return redirect()->back()->with('error', 'لا يمكن عمل طلب سحب اخر فى الوقت الحالى');
        }

        $total_incomes_not_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '<=', Carbon::today())->sum('amount');
        return view('site.create_withdrawal', compact('total_incomes_not_withdrawald'));
    }

    public function store(StoreWithdrawalRequest $request)
    {
        $withdrawals = Withdrawals::where('user_id', Auth::id())->whereIn('status', [1,2])->count();
        if ($withdrawals) {
            return redirect()->back()->with('error', 'لا يمكن عمل طلب سحب اخر فى الوقت الحالى');
        }
        $total_incomes_not_withdrawal = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '<=', Carbon::today())->sum('amount');
        $total_incomes_not_withdrawal_ids = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '<=', Carbon::today())->pluck('id')->toarray();
        if ($request->payment_method == 2) {
            if ($request->bank_account_id) {
                $bank_account_id = $request->bank_account_id;
            } else {
                $bank_account = new BankAccount;
                $bank_account->bank_name = $request->bank_name;
                $bank_account->name = $request->name;
                $bank_account->account_number = $request->account_number;
                $bank_account->user_id = Auth::id();
                $bank_account->iban = $request->iban;
                $bank_account->save();
                $bank_account_id = $bank_account->id;
            }
        }

        $withdrawal = new Withdrawals;
        $withdrawal->user_id = Auth::id();
        $withdrawal->amount = $total_incomes_not_withdrawal;
        $withdrawal->number = time();
        $withdrawal->phone = $request->phone;
        $withdrawal->status = 1;
        $withdrawal->payment_method = $request->payment_method;
        $withdrawal->income_ids = json_encode($total_incomes_not_withdrawal_ids);
        if ($request->payment_method == 2) {
            $withdrawal->bank_account_id = $bank_account_id;
        }
        $withdrawal->save();
        return redirect(route('withdrawals.index'))->with('success', 'تم انشاء الطلب بنجاح');
    }

    public function show(Withdrawals $withdrawal)
    {
        return view('site.withdrawal', compact('withdrawal'));
    }
}
