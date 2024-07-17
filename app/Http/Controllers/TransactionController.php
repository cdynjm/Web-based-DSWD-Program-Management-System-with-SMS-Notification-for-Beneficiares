<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\ProgramType;
use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Payroll;
use App\Models\Event;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function read(Request $request) {

        date_default_timezone_set("Asia/Singapore");
        $year = date('Y');

        $programs = Program::orderBy('program', 'ASC')->get();

        $barangay = Barangay::orderBy('brgy', 'ASC')->get();

        if(Auth::user()->type == 1) {
            $transaction_history = TransactionHistory::orderBy('created_at', 'DESC')->get();
            $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();
            $request->session()->put('program', 0);
        }

        if(Auth::user()->type == 2) {
            $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->orderBy('created_at', 'DESC')->get();
            $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();
            $request->session()->put('program', Auth::user()->Program->id);
        }

        if(Auth::user()->type == 3) {
            $transaction_history = TransactionHistory::where(['userid' => Auth::user()->userid])->orderBy('created_at', 'DESC')->get();
            $event = Event::where(['status' => 1])->get();
            $request->session()->put('program', 0);
        }

        $request->session()->put('brgy', 0);

        $request->session()->put('transaction', 0);

        $request->session()->put('month', 0);

        $request->session()->put('event', 0);

        $request->session()->put('year', $year);

        return view('pages.transaction-history', compact('programs', 'barangay', 'transaction_history', 'event'));
        
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchTransaction(Request $request) {

        $programs = Program::orderBy('program', 'ASC')->get();

        $barangay = Barangay::orderBy('brgy', 'ASC')->get();

        if($request->event != 0) {

            if($request->month != 0) {

                if(Auth::user()->type == 1) {

                    $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', Auth::user()->Program->id);
                }   
            }
            else {
                if(Auth::user()->type == 1) {

                    $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();
                    
                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', Auth::user()->Program->id);
                }   
            }
        }

        else {

            if($request->month != 0) {

                if(Auth::user()->type == 1) {

                    $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', Auth::user()->Program->id);
                }   
            }
            else {
                if(Auth::user()->type == 1) {

                    $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();
                    
                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where(['program' => Auth::user()->Program->id])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', Auth::user()->Program->id);
                }   
            }
        }

        $request->session()->put('transaction', 1);
        $request->session()->put('brgy', $request->barangay);
        $request->session()->put('month', $request->month);
        $request->session()->put('year', $request->year);
        $request->session()->put('event', $request->event);

        $default = 0;

        return view('pages.transaction-history', compact('programs', 'barangay', 'default', 'transaction_history', 'event'));

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function delete(Request $request) {

        foreach($request->transaction_id as $key => $value) {
            TransactionHistory::where(['id' => $value])->delete();
        }

        return response()->json(['Error' => 0, 'Message'=> 'Payment transaction history deleted successfully.']);

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchKeyup(Request $request) {

        $search = $request->search_transaction;
        
        if($request->event != 0) {

            if($request->month != 0) {

                if(Auth::user()->type == 1) {

                    if($request->barangay == 0) {

                        if($request->program == 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }
            }

            else {

                if(Auth::user()->type == 1) {

                    if($request->barangay == 0) {

                        if($request->program == 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }
            }
        }
        else {

            if($request->month != 0) {

                if(Auth::user()->type == 1) {

                    if($request->barangay == 0) {

                        if($request->program == 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }
            }

            else {

                if(Auth::user()->type == 1) {

                    if($request->barangay == 0) {

                        if($request->program == 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $transaction_history = TransactionHistory::where('created_at', 'like', '%'.$request->year.'%')->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }
            }
        }

        return view('pages.tables.transaction-table', compact('transaction_history'));
    }

    public function printTransaction() {

        if(Auth::user()->type == 1 || Auth::user()->type == 2) {
            
            $program = Session::get('program');
            $brgy = Session::get('brgy');
            $year = Session::get('year');
            $month = Session::get('month');


            $name = Program::where(['id' => $program])->first();
            $barangay = Barangay::where(['id' => $brgy])->first();
            $count = Barangay::where(['id' => $brgy])->count();
            $event = Event::where(['id' => Session::get('event')])->first();
            
            if(Session::get('event') != 0) {
                if($month != 0) {
                    if($brgy != 0) {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where(['month' => $month])
                            ->where(['event' => Session::get('event')])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->where(['address' => $brgy])
                            ->get();
                    }
                    else {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where(['month' => $month])
                            ->where(['event' => Session::get('event')])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->get();
                    }
                }
                else {
                    if($brgy != 0) {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where(['event' => Session::get('event')])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->where(['address' => $brgy])
                            ->get();
                    }
                    else {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where(['event' => Session::get('event')])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->get();
                    }
                }
            }
            else {
                if($month != 0) {
                    if($brgy != 0) {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where(['month' => $month])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->where(['address' => $brgy])
                            ->get();
                    }
                    else {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where(['month' => $month])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->get();
                    }
                }
                else {
                    if($brgy != 0) {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->where(['address' => $brgy])
                            ->get();
                    }
                    else {
                        $transaction = TransactionHistory::where(['program' => $program])
                            ->where('created_at', 'like', '%'.$year.'%')
                            ->get();
                    }
                }
            }

            return view('pages.print.transactions', compact('name', 'transaction', 'count', 'year', 'barangay', 'event'));
        }
        else {
            return abort(404);
        }
    }
}
