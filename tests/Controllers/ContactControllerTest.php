<?php


class ContactControllerTest extends BrowserKitTestCase
{
    /**
     *@test
     */
    public function an_email_is_sent_off_on_a_successful_post_to_contact_endpoint()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $this->post('/contact', [
            'name' => 'Bob Soap',
            'email' => 'bob@example.com',
            'enquiry' => 'How goes it Bob?'
        ]);

        Mail::assertSent(\App\Mail\ContactMessage::class, function($mail) {
            return $mail->hasTo(config('mail.receiver_address'));
        });
    }
}