<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\ProgramType;
use App\Models\Beneficiary;
use App\Models\FocalPerson;
use App\Models\TransactionHistory;
use App\Models\Payroll;
use App\Models\User;

class ProgramController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function create(Request $request) {

        foreach(User::get() as $get) {
            if($get->email == $request->email)
                return response()->json(['Error' => 1, 'Message' => 'Email is already taken']);
        }

        $person = FocalPerson::create([
            'name' => $request->full_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number
        ]);

        User::create([
            'userid' => $person->id,
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => 2
        ]);

        Program::create([
            'program' => $request->program,
            'description' => $request->description,
            'focal_person' => $person->id
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Program Created Successfully']); 
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function read() {

        $aics = ProgramType::where(['program' => 1])->where(['status' => 1])->count();
        $eccd = ProgramType::where(['program' => 2])->where(['status' => 1])->count();
        $sc = ProgramType::where(['program' => 3])->where(['status' => 1])->count();
        $sp = ProgramType::where(['program' => 4])->where(['status' => 1])->count();
        $pwd = ProgramType::where(['program' => 5])->where(['status' => 1])->count();

        if(Auth::user()->type == 1) {
            $programs = Program::orderBy('program', 'ASC')->get();
        }

        if(Auth::user()->type == 2) {
            $programs = Program::where(['id' => Auth::user()->Program->id])->orderBy('program', 'ASC')->get();
        }

        if(Auth::user()->type == 3) {
            $programs = ProgramType::where(['userid' => Auth::user()->userid])->orderBy('program', 'ASC')->get();
        }

        return view('pages.programs', compact('programs', 'aics', 'eccd', 'sc', 'sp', 'pwd'));
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function update(Request $request) {

        foreach(User::where('userid', '!=', $request->focalpersonid)->get() as $get) {
            if($get->email == $request->email) {
                return response()->json(['Error' => 1, 'Message' => 'Email is already taken']);
            }
        }

        FocalPerson::where(['id' => $request->focalpersonid])->update([
            'name' => $request->full_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number
        ]);
        
        User::where(['userid' => $request->focalpersonid])->update([
            'email' => $request->email,
            'name' => $request->full_name
        ]);

        if(!empty($request->password)) {
            User::where(['userid' => $request->focalpersonid])->update([
                'password' => Hash::make($request->password)
            ]);
        }

        Program::where(['id' => $request->programid])->update([
            'program' => $request->program,
            'description' => $request->description
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Program Updated Successfully']); 
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function delete(Request $request) {

        FocalPerson::where(['id' => $request->focalpersonid])->delete();

        Program::where(['id' => $request->programid])->delete();

        return response()->json(['Error' => 0, 'Message'=> 'Program Deleted Successfully']); 
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function viewProgram(Request $request) {

        if($request->program == true) {

            $programs = Program::orderBy('program', 'ASC')->get();
            $aics = ProgramType::where(['program' => 1])->where(['status' => 1])->count();
            $eccd = ProgramType::where(['program' => 2])->where(['status' => 1])->count();
            $sc = ProgramType::where(['program' => 3])->where(['status' => 1])->count();
            $sp = ProgramType::where(['program' => 4])->where(['status' => 1])->count();
            $pwd = ProgramType::where(['program' => 5])->where(['status' => 1])->count();
            $table = true;
            return view('pages.tables.view-program-table', compact('programs', 'aics', 'eccd', 'sc', 'sp', 'pwd', 'table'));

        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function viewFocalPerson(Request $request) {

        if($request->program == true) {

            $programs = Program::orderBy('program', 'ASC')->get();
            $focal_person = FocalPerson::get();
            $table = true;
            return view('pages.tables.view-focal-person-table', compact('programs', 'focal_person', 'table'));

        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function viewProgramProfile(Request $request) {

        $payroll_list = Payroll::where(['program' => $request->program_type])->orderBy('created_at', 'DESC')->get();
        $transaction_history = TransactionHistory::where(['program' => $request->program_type])->orderBy('created_at', 'DESC')->get();

        foreach(Program::where(['id' => $request->program_type])->get() as $get) {
            $program_name = $get->program;
        }
        return view('pages.program-profile', compact('payroll_list', 'program_name', 'transaction_history'));
    }
}
