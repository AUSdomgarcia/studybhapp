<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Inquiry;
use App\InquiryResponse;

use Redirect;
use Validator;
use Mail;
use Session;
use Auth;

class UserInquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

        $return = Mail::send('emails.ask_belo.thank_you', ['web_settings'=>['key'=>'value']], function ($message) use($request) {
            $message->from('noreply@example.com', 'noreply@example.com');
            $message->to($request->input('email'))->subject('Thank You');
        });

        /*

        //get web content here
        $data = $this->get_mail_content();
        //thank you email here
        $return = Mail::send('emails.ask_belo.thank_you', ['web_settings'=>$data], function ($message) use($request) {
            $message->from('noreply@belo.ph', 'noreply@belo.ph');
            $message->to($request->input('email'))->subject('Thank You');
            // $message->to('aarontolentino123@gmail.com')->subject('Thank You');
        });
        //send to assigned recipient
        $mail_recipient = array_filter(explode(";",$data['mail-default-recipient']['content']));
        $return_1 = Mail::send('emails.ask_belo.inquiry', ['web_settings'=>$data,'data'=>$request->all()], function ($message) use($mail_recipient) {
            $message->from('noreply@belo.ph', 'noreply@belo.ph');
            $message->to($mail_recipient)->subject('Inquiry');
            // $message->to('aarontolentino123@gmail.com')->subject('Thank You');
        });
        //save in inquiry here
        $inquiry = new Inquiry;
        $inquiry->full_name = $request->input('fullname');
        $inquiry->email =$request->input('email');
        $inquiry->birthdate =$request->input('birthday');
        $inquiry->address =$request->input('address');
        $inquiry->question = $request->input('questions');
        $inquiry->is_active = 1;
        $inquiry->save();

        //set success var here for toastr

        if($return == 1 && $return_1 == count($mail_recipient)){
            Session::flash('send_success', '1');
        }
        */
        return Redirect::back();
    }

    public function render_mailer(){
        return view('cms.pages.user.mailer');   
    }
}
