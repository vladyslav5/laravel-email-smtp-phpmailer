<?php

namespace Tests\Unit;

use App\Http\Controllers\EmailController;
use App\Http\Requests\StoreEmailRequest;
use App\Jobs\SendEmailJob;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Mockery;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;

class EmailSendTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     */


    use RefreshDatabase;

    protected array $validData = [
        'from' => 'sender@test.com',
        'to' => 'recipient@test.com',
        'cc' => 'cc@test.com',
        'subject' => 'Тестовий лист Laravel',
        'type' => 'html',
        'body' => '<h1 style="color:red">test</h1>',
    ];


    public function validation_test(): void
    {
        $mockRequest = Mockery::mock(StoreEmailRequest::class);
        $mockRequest->shouldReceive('validated')
            ->once()
            ->andReturn($this->validData);

        $mockRequest->shouldReceive('route')
            ->with('email.success', Mockery::any())
            ->once()
            ->andReturn('email.success');

        $response = (new EmailController())->store($mockRequest);

        $this->assertEquals('email.success', $response->getTargetUrl());
    }
    public function it_stores_email_and_dispatches_job()
    {
        Bus::fake();



        // Mock the request
        $request = Mockery::mock(StoreEmailRequest::class);
        $request->shouldReceive('validated')->andReturn($this->validData);
        $request->shouldReceive('ip')->andReturn('127.0.0.1');
        $request->shouldReceive('userAgent')->andReturn('Mozilla/5.0');

        $emailMock = new Email();
        $emailMock->uuid = '123-uuid-456';

        // Intercept Email::create()
        Email::shouldReceive('create')
            ->once()
            ->with(array_merge($this->validData,[
                'ip_address'   => '127.0.0.1',
                'user_agent'   => 'Mozilla/5.0',
            ]))
            ->andReturn($emailMock);

        $controller = new EmailController();
        $response = $controller->send($request);

        Bus::assertDispatched(SendEmailJob::class, function ($job) use ($emailMock) {
            return $job->email->uuid === $emailMock->uuid;
        });

        $this->assertEquals(
            route('email.success', ['email' => $emailMock->uuid]),
            $response->getTargetUrl()
        );
    }
}
