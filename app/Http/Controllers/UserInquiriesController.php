<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Inquiry;
use App\InquiryResponse;
use App\WebSetting;

use Redirect;
use Validator;
use Mail;
use Session;
use Auth;
use App\helpers\DatatableHandler;

class UserInquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.pages.inquiry');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }

    public function send_inquiry(Request $request){
        //validation here
        $rule = [
            "fullname" => "required",
            "email" => "required|email",
            "birthday" => "required|before:today",
            "address" => "max:1000",
            "questions" => "required|max:1000"
        ];

        $validator = Validator::make($request->all(),$rule);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        $mailer_thankyou = Mail::send('emails.pages.inquiry_thank_you', [ 'web_settings'=> [ 'thank-you-content' => '<h3>Thank you view.</h3>' ] ], 
            function ($message) use($request) {
                $message->from('noreply@domain.ph', 'Domz Garcia');
                $message->to($request->input('email'))->subject('Thank you');
            });
        
        $hasRecipient = false;
        $recipients = 'dom.garcia@nuworks.ph;domgarciad@yahoo.com';
        
        if($hasRecipient){
            $mail_recipient = array_filter( explode( ";", $recipients ) );
            $data = $request->all();
            
            $with_recipient_email = Mail::send('emails.pages.inquiry_content', compact('data'), 
                function ($message) use($mail_recipient) {
                    $message->from('noreply@domain.ph', 'Domz Garcia');
                    $message->to($mail_recipient)->subject('New Inquiry Content');
                });
        }
        
        $inquiry = new Inquiry();
        $inquiry->full_name = $request->input('fullname');
        $inquiry->email =$request->input('email');
        $inquiry->birthdate =$request->input('birthday');
        $inquiry->address =$request->input('address');
        $inquiry->question = $request->input('questions');
        $inquiry->is_active = 1;
        $inquiry->save();
        
        Session::flash('inquiry_sent', '1');
        return Redirect::back();
    }

    public function render_mailer()
    {
        return view('cms.pages.user.mailer');   
    }

    public function get_inbox(Request $request)
    {
        $customDataTable = new DatatableHandler($request, "inquiries");
        $data = $customDataTable->make();
        return $data;
    }

    public function get_thread($id)
    {
        $inquiry_response = InquiryResponse::where('inquiry_id', '=', $id)->with('user')->get();
        return $inquiry_response;
    }

    public function get_message($id)
    {
        $inquiry = Inquiry::where('id', '=', $id)->first();
        return $inquiry;
    }

    public function edit_content(){
        $email_settings = WebSetting::where('group', '=', 'email')->get();
        $data = array();
        foreach($email_settings as $key => $setting){
            $data[(string)$setting['key']] = $setting;
        }
        // example: dd($data['default-recipient']['content']);
        return view('cms.pages.moderator_editor', compact('data'));
    }

    public function update_reply(Request $request)
    {
        $rule = [
            "mail-reply-id" => "required",
            "default-reply-message" => "required|max:1000"
        ];
        $friendly_names = [
            "mail-reply-id" => "id",
            "default-reply-message" => "body"
        ];
        $validator = Validator::make($request->all(), $rule);
        $validator->setAttributeNames($friendly_names);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }
    }

    public function update_thankyou(Request $request)
    {
        $rule = [
            "mail-thankyou-id" => "required",
            "default-thankyou-message" => "required|max:1000"
        ];
        $friendly_names = [
            "mail-thankyou-id" => "id",
            "default-thankyou-message" => "body"
        ];
        $validator = Validator::make($request->all(), $rule);
        $validator->setAttributeNames($friendly_names);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }
    }

    public function post_reply(Request $request)
    {
        $rule = [
            "mail-inquiry-id" => "required",
            "mail-inquiry-title" => "required",
            "mail-inquiry-body" => "required|max:1000"
        ];
     
        $friendly_names = [
            "mail-inquiry-id" => "id",
            "mail-inquiry-title" => "title",
            "mail-inquiry-body" => "body"
        ];
     
        $validator = Validator::make($request->all(), $rule);
        $validator->setAttributeNames($friendly_names);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }
        
        $inquiry_user = Inquiry::select('full_name')
                    ->where('id','=', $request->input('mail-inquiry-id'))->first();

        $moderator = array(
                        "message" => "{$request->input('mail-inquiry-body')}",
                        "full_name" => $inquiry_user->full_name,
                    );

        $isReplied = Mail::send('emails.pages.inquiry_response_message', compact('moderator'), 
            function ($message) use($request) {
                $message->from('noreply@domain.ph', 'Domz Garcia');
                $message->to($request->input('mail-inquiry-email'))
                        ->subject($request->input('mail-inquiry-title'));
            });

        $inquiry_response = new InquiryResponse;
        $inquiry_response->inquiry_id = $request->input('mail-inquiry-id');
        $inquiry_response->title =$request->input('mail-inquiry-title');
        $inquiry_response->message = $request->input('mail-inquiry-body');
        $inquiry_response->user_id = Auth::user()->id;
        $inquiry_response->save();

        Session::flash('reply_sent', '1');
        return Redirect::back();
    }
}
