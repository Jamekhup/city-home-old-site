<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\subscriber;

class SendMailToSub implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $mail_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->mail_data = $mail_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = subscriber::where('token','=','')->where('email_verify','!=',null)->get();
        $input['subject'] = $this->mail_data['subject'];

        $sentTo = [
            'saleRent' => $this->mail_data['saleRent'],
            'category' => $this->mail_data['category'],
            'township' => $this->mail_data['township'],
            'bedrooms' => $this->mail_data['bedrooms'],
            'bathrooms' => $this->mail_data['bathrooms'],
            'floor' => $this->mail_data['floor'],
            'square_feet' => $this->mail_data['square_feet'],
            'price' => $this->mail_data['price'],
            'money' => $this->mail_data['money'],
            'fileName' => $this->mail_data['fileName'],
        ];

        foreach ($users as $key => $value) {
            $input['email'] = $value->email;
            $input['name'] = $value->name;

            \Mail::send('email.send-to-sub', ['toGet' => $sentTo], function ($message) use ($input) {
                $message->to($input['email'], $input['name'])
                    ->subject($input['subject']);
            });
        }
    }
}
