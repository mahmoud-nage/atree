<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CheckCodeRequest;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;
use App\Http\Requests\Site\SendCodeRequest;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Models\PhoneVerificationCode;
use App\Models\User;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\Income;
use App\Models\Withdrawals;
use App\Models\UserPoint;
use App\Models\BankAccount;
use App\Http\Requests\Site\UpdateUserRequest;
use Carbon\Carbon;
use App\Http\Requests\Site\StoreWithdrawalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['password' => $request->password, 'phone' => $request->phone], true)) {
            $accessToken = \auth()->user()->createToken('mobile_app')->plainTextToken;
            $data = [
                'token' => $accessToken
            ];
            return self::makeSuccess(Response::HTTP_OK, '', $data);
        }
        return self::makeError(Response::HTTP_OK, __('messages.wrong'));
    }

    public function register(RegisterRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $validated = $request->validated();
        unset($validated['image']);
        $user = User::create($validated + [
                'type' => 3
            ]);
        if ($request->hasFile('image')) {
            $image = basename($request->file('image')->store('users'));
            $user->update(['image' => $image]);
        }
        Auth::login($user);
        $accessToken = \auth()->user()->createToken('mobile_app')->plainTextToken;
        $data = [
            'token' => $accessToken
        ];
        return self::makeSuccess(Response::HTTP_OK, '', $data);
    }

    /**
     * @param SendCodeRequest $request
     * @return JsonResponse
     */
    public function sendCode(SendCodeRequest $request): JsonResponse
    {
        dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
        return self::makeSuccess(Response::HTTP_OK, __('messages.success'));
    }

    /**
     * @param CheckCodeRequest $request
     * @return JsonResponse
     */
    public function checkCode(CheckCodeRequest $request): JsonResponse
    {
        PhoneVerificationCode::where('phone', $request->phone)
            ->where('code', $request->code)->firstOrFail();
        return self::makeSuccess(Response::HTTP_OK, __('messages.success'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return self::makeSuccess(Response::HTTP_OK, '', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function updateProfile(UpdateUserRequest $request): JsonResponse
    {
        auth()->user()->update($request->validated());
        return self::makeSuccess(Response::HTTP_OK, __('messages.updated_successfully'), auth()->user());
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();
        return self::makeSuccess(Response::HTTP_OK, __('messages.logout_successfully'));
    }

    public function store_return(Request $request, Order $order)
    {
        for ($i = 0; $i < count($request->products); $i++) {
            $return = new OrderReturn;
            $return->order_id = $order->id;
            $return->user_id = Auth::id();
            $return->product_id = $request->products[$i];
            $return->return_reason = $request->return_reason[$i];
            $return->save();
        }
        return redirect()->back()->with('success', 'تم تقديم طلب الارجاع بنجاح');
    }

    public function withdrawals()
    {
        $can_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '<=', Carbon::today())->sum('amount');

        $can_not_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '>', Carbon::today())->sum('amount');
        $withdrawals = Withdrawals::where('user_id', Auth::id())->latest()->get();
        return view('site.withdrawals', compact('withdrawals', 'can_withdrawald', 'can_not_withdrawald'));
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

    public function create_withdrawal()
    {
        $withdrawals = Withdrawals::where('user_id', Auth::id())->where('status', 2)->count();
        if ($withdrawals) {
            return redirect()->back()->with('error', 'لا يمكن عمل طلب سحب اخر ى الوقت الحالى');
        }
        $total_incomes_not_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '<=', Carbon::today())->sum('amount');
        return view('site.create_withdrawal', compact('total_incomes_not_withdrawald'));
    }


    public function store_withdrawal(StoreWithdrawalRequest $request)
    {
        $total_incomes_not_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 0)->whereDate('can_withdrawal_when', '<=', Carbon::today())->sum('amount');
        if ($request->payment_method == 2) {
            $bank_account = new BankAccount;
            $bank_account->bank_name = $request->bank_name;
            $bank_account->name = $request->name;
            $bank_account->account_number = $request->account_number;
            $bank_account->user_id = Auth::id();
            $bank_account->iban = $request->iban;
            $bank_account->save();
        }
        $withdrawal = new Withdrawals;
        $withdrawal->user_id = Auth::id();
        $withdrawal->amount = $total_incomes_not_withdrawald;
        $withdrawal->number = time();
        $withdrawal->phone = $request->phone;
        $withdrawal->status = 2;
        $withdrawal->payment_method = $request->payment_method;
        if ($request->payment_method == 2) {
            $withdrawal->bank_account_id = $bank_account->id;
        }
        $withdrawal->save();
        return redirect(route('site.withdrawals'))->with('success', 'تم انشاء الطلب بنجاح');
    }

    public function withdrawal(Withdrawals $withdrawal)
    {
        return view('site.withdrawal', compact('withdrawal'));
    }


    public function wallet()
    {
        $total_incomes_withdrawald = Income::where('user_id', Auth::id())->where('withdrawn', 0)->sum('amount');
        return view('site.wallet', compact('total_incomes_withdrawald'));

    }

}
