<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\Event;
use App\Models\ProgramType;
use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Payroll;
use App\Models\TransactionHistory;
use App\Models\Notify;
use App\Models\SMSToken;

class PayrollController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function read(Request $request) {

        $programs = Program::orderBy('program', 'ASC')->get();

        $barangay = Barangay::orderBy('brgy', 'ASC')->get();

        date_default_timezone_set("Asia/Singapore");
        $year = date('Y');

        if(Auth::user()->type == 1) {
            $payroll_list = ProgramType::get();
            $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();
            $payroll_event = Event::where('date', '>=', date('Y-m-d'))->get();
        }

        if(Auth::user()->type == 2) {
            $payroll_list = ProgramType::where(['program' => Auth::user()->Program->id])->get();
            $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();
            $payroll_event = Event::where('date', '>=', date('Y-m-d'))->get();
        }

        $request->session()->put('program', 0);

        $request->session()->put('brgy', 0);

        $request->session()->put('payroll', 0);

        $request->session()->put('month', 0);

        $request->session()->put('event', 0);

        $request->session()->put('year', $year);

        $default = 0;

        return view('pages.payroll', compact('programs', 'barangay', 'default', 'payroll_list', 'event', 'payroll_event'));

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function search(Request $request) {

        if(Auth::user()->type == 1) {
            if($request->address != 0) {
                $beneficiary = ProgramType::where(['address' => $request->address])->orderBy('control_number', 'ASC')->get();
            }
            if($request->address == 0) {
                $beneficiary = ProgramType::orderBy('control_number', 'ASC')->get();
            }
        }

        if(Auth::user()->type == 2) {
            if($request->address != 0) {
                $beneficiary = ProgramType::where(['address' => $request->address])->where(['status' => 1])->where(['program' => Auth::user()->Program->id])->orderBy('control_number', 'ASC')->get();
            }
            if($request->address == 0) {
                $beneficiary = ProgramType::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('control_number', 'ASC')->get();
            }
        }
        
        $default = 1;

        return view('pages.tables.payroll-beneficiary-table', compact('beneficiary', 'default'));

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchPayroll(Request $request) {

        $programs = Program::orderBy('program', 'ASC')->get();

        $barangay = Barangay::orderBy('brgy', 'ASC')->get();

        $payroll_event = Event::where('date', '>=', date('Y-m-d'))->get();

        if($request->event != 0) {

            if($request->month != 0) {

                if(Auth::user()->type == 1) {

                    $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', Auth::user()->Program->id);
                }   
            }
            else {
                if(Auth::user()->type == 1) {

                    $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();
                    
                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where(['event' => $request->event])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
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
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where(['month' => $request->month])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', Auth::user()->Program->id);
                }   
            }
            else {
                if(Auth::user()->type == 1) {

                    $event = Event::where(['status' => 1])->orderBy('date', 'DESC')->get();

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => $request->program_type])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', $request->program_type);

                }
                
                if(Auth::user()->type == 2) {

                    $event = Event::where(['program' => Auth::user()->Program->id])->where(['status' => 1])->orderBy('date', 'DESC')->get();
                    
                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where('created_at', 'like', '%'.$request->year.'%')->get();
                    }
                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where(['program' => Auth::user()->Program->id])->where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->get();
                    }

                    $request->session()->put('program', Auth::user()->Program->id);
                }   
            }
        }
        
        $request->session()->put('payroll', 1);
        $request->session()->put('brgy', $request->barangay);
        $request->session()->put('month', $request->month);
        $request->session()->put('year', $request->year);
        $request->session()->put('event', $request->event);

        $default = 0;

        return view('pages.payroll', compact('programs', 'barangay', 'default', 'payroll_list', 'event', 'payroll_event'));
        
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function create(Request $request) {

        $smstoken = SMSToken::get();

        date_default_timezone_set("Asia/Singapore");

        foreach($request->userid as $key => $id) {

            $get = Beneficiary::where(['id' => $id])->first();

            $programtype = ProgramType::where(['userid' => $id])->where(['program' => Auth::user()->Program->id])->first();

            Payroll::create([
                'userid' => $id,
                'balance' => $request->cash,
                'month' => date('m'),
                'event' => $request->event,
                'programtype_id' => $programtype->id,
                'program' => Auth::user()->Program->id
            ]);

                foreach($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }

                $addresses = $get->contact_number; // mobile number to send text to
                $sms = 'Hi Good Day! This is MSWDO Bontoc ('.Auth::user()->Program->program.') \nYou have received ₱'.number_format($request->cash, 2).'.Please login to your account for more information.';
                $ch = curl_init();
                foreach($smstoken as $st) {
                    curl_setopt($ch, CURLOPT_URL, $st->url);
                }
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"data\":{\"addresses\":[\"$addresses\"],\"message\":\"$sms\",\"target_device_iden\":\"$mobile_iden\"}}");

                $headers = [];
                $headers[] = 'Access-Token: '.$mobile_token;
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }

            Notify::create([
                'userid' => $id,
                'program_id' => Auth::user()->Program->id,
                'cash' => $request->cash,
                'title' => 'Cash Received',
                'status' => 1,
                'type' => 2
            ]);
        }

        return response()->json(['Error' => 0, 'Message'=> 'Payroll Updated Successfully']); 

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function update(Request $request) {

        date_default_timezone_set("Asia/Manila");

        foreach($request->payroll_id as $key => $id) {

            $payroll = Payroll::where(['id' => $id])->get();

            foreach($payroll as $pr) {
                
                TransactionHistory::create([
                    'userid' => $pr->userid,
                    'program' => $pr->program,
                    'programtype_id' => $pr->programtype_id,
                    'cash' => $pr->balance,
                    'month' => date('m'),
                    'event' => $pr->event,
                    'address' => $pr->Beneficiary->address
                ]);

            }

            Payroll::where(['id' => $id])->delete();

        }

        return response()->json(['Error' => 0, 'Message'=> 'Cash Released Successfully']);

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function delete(Request $request) {

        foreach($request->payroll_id as $key => $value) {
            Payroll::where(['id' => $value])->update(['balance' => 0.00, 'status' => 0]);
        }

        return response()->json(['Error' => 0, 'Message'=> 'Balance was successfully reset to ₱0.00']);

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchKeyup(Request $request) {

        $search = $request->search_payroll;
        
        if($request->event != 0) {

            if($request->month != 0) {

                if(Auth::user()->type == 1) {

                    if($request->barangay == 0) {

                        if($request->program == 0) {
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }
            }

            else {

                if(Auth::user()->type == 1) {

                    if($request->barangay == 0) {

                        if($request->program == 0) {
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['event' => $request->event])->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
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
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['month' => $request->month])->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }
            }

            else {

                if(Auth::user()->type == 1) {

                    if($request->barangay == 0) {

                        if($request->program == 0) {
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                        if($request->program != 0) {
                            $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['program' => $request->program])->whereHas('Beneficiary', function ($query) use ($search) {
                                $query->where('name', 'like', '%'.$search.'%');
                            })->get();
                        }
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }

                if(Auth::user()->type == 2) {

                    if($request->barangay == 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['program' => Auth::user()->Program->id])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                    if($request->barangay != 0) {
                        $payroll_list = Payroll::where('created_at', 'like', '%'.$request->year.'%')->where(['program' => Auth::user()->Program->id])->where(['address' => $request->barangay])->whereHas('Beneficiary', function ($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                        })->get();
                    }

                }
            }
        }

        return view('pages.tables.payroll-table', compact('payroll_list'));
    }
}
