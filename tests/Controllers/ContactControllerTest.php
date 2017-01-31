<?php


class ContactControllerTest extends TestCase
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

        Mail::assertSentTo(config('mail.receiver_address'), \App\Mail\ContactMessage::class);
    }
}