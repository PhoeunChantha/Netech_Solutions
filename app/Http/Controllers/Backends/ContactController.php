<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\AdminReplyContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $contacts = ContactMessage::latest('id')->paginate(10);
        $contacts = Contact::when($request->start_date && $request->end_date, function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date);
        })->latest('id')->paginate(10);

        return view('backends.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    public function replycustomer(Request $request)
    {
        // try {
        //     // $data["title"] = 'Reply from ' . Auth::guard('admin')->user()->name;
        //     $data["title"] = 'Reply Message ';
        //     $data['message'] = $request->replymessage;
        //     $data['email'] = $request->customerEmail;

        //     Mail::send([], [], function ($message) use ($data) {
        //         $message->to($data['email'])
        //             ->subject($data["title"])
        //             ->html($data["message"]);
        //     });

        //     $output = [
        //         'success' => 1,
        //         'msg' => __('Your message has been sent!')
        //     ];
        // } catch (\Exception $e) {
        //     dd($e);
        //     $output = [
        //         'success' => 0,
        //         'msg' => __('Something went wrong')
        //     ];
        // }
        try {
            // Prepare the email template data
            $template = [
                'title' => 'Reply Message',
                'message' => $request->replymessage,
                'email' => $request->customerEmail,
            ];

            // Use the AdminReplyContact mailable class
            Mail::to($template['email'])->send(new AdminReplyContact($template));

            $output = [
                'success' => 1,
                'msg' => __('Your message has been sent!')
            ];
        } catch (\Exception $e) {
            // Debugging
            dd($e);

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('admin.contact.index')->with($output);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        if ($contact->isRead == 0) {
            $contact->isRead = 1;
            $contact->save();
        }
        return view('backends.contact.replysms', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $contact = Contact::findOrFail($id);
            $contact->delete();
            $contacts = Contact::latest('id')->paginate(10);
            $view = view('backends.contact._table', compact('contacts'))->render();


            DB::commit();
            $output = [
                'status' => 1,
                'view' => $view,
                'msg' => __('Deleted successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'status' => 0,
                'msg' => __('Something went wrong')
            ];
        }
        return response()->json($output);
    }


    public function replysms()
    {
        return view('backends.contact.replysms');
    }
}
