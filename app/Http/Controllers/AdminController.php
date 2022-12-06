<?php

namespace App\Http\Controllers;

use App\Exports\ReceiptExport;
use App\Models\Award;
use App\Models\File;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = Receipt::where('declined',null)
        ->get();
        return view('dashboard',compact(['receipts']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getApproved()
    {
        $receipts = DB::table('receipts')
        ->leftJoin('files', 'receipts.file_id', '=', 'files.id')
        ->where('declined',0)
        ->where('award_id',null)//it was null
        ->get();
        return $receipts;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDeclined()
    {
        $receipts = DB::table('receipts')
        ->leftJoin('files', 'receipts.file_id', '=', 'files.id')
        ->where('declined',1)->get();
        return $receipts;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAwarded()
    {
        $awarded = DB::table('receipts')
        ->leftJoin('files', 'receipts.file_id', '=', 'files.id')
        ->where('declined',0)
        ->where('award_id','>',0)
        ->get();
        return $awarded;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function giveAward()
    {
        $winner = DB::table('receipts')
        ->leftJoin('files', 'receipts.file_id', '=', 'files.id')
        ->where('declined',0)
        ->where('award_id',null)//it was null
        ->inRandomOrder()
        ->first();
        $awards = Award::where('quantity','>',0)->get(); 
        return [$winner,$awards];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function approve(Request $request)
    {
        $id = $request->approveId;
        $receipt = Receipt::find($id);
        $receipt->declined = 0; //approved
        if($receipt->save())
        {
            $data['success'] = 1;
        }
        return response()->json($data);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function notification(Request $request)
    {
        $id = $request->receiptId;
        $awardId = $request->reward;
        $awd = Award::find($awardId);
        $awd->decrement('quantity',1);
        $receipt = Receipt::find($id);
        $receipt->award_id = $awardId; //award given
        $name = $receipt->file->email;
        if($receipt->save() && $awd->save())
        {
            $data['success'] = 1;

            $details = [
                'title' => 'Congradulation, you are a winner.',
                'body' => 'Dear '.$name.', you have won a one of a kind jegermaister - '.$awd->type.', by being loyal stag and entering our game. You can get hold of your prize in the nearest jegermaister office - every work day from 08.00 - 16.00 h.'
            ];
           
            Mail::to($name)->send(new \App\Mail\JegermaisterMail($details));
        }
        else
        {
            $data['success'] = 0; 
        }
        return response()->json($data);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function decline(Request $request)
    {
        $id = $request->declineId;
        $receipt = Receipt::find($id);
        $receipt->declined = 1; //decline
        if($receipt->save())
        {
            $data['success'] = 1;
        }
        else
        {
            $data['success'] = 0; 
        }
        return response()->json($data);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function declineApprove(Request $request)
    {
        $id = intval($request->declAppId);
        $receipt=Receipt::find($id);
        $receipt->declined = 0; //approve
        $receipt->save();
        if($receipt->save())
        {
            $data['success'] = 1;
        }
        else
        {
            $data['success'] = 0; 
        }
        return response()->json($data);
    }


    public function export() 
    {
        return Excel::download(new ReceiptExport, 'receipts.xlsx');
    }
}
