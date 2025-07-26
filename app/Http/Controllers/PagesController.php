<?php

namespace App\Http\Controllers;

use App\Entities\Article;
use App\Entities\Files\FilesRepository;
use App\Entities\Video;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use InvalidArgumentException;
use ReCaptcha\ReCaptcha;
use Response;
use Storage;


class PagesController extends Controller
{
    protected $dataRepo;


    /**
     * PagesController constructor.
     * @param FilesRepository $dataRepo
     */
    public function __construct(FilesRepository $dataRepo)
    {
        $this->dataRepo = $dataRepo;
    }

    public function privacyPolicy()
    {
        $file_url = $this->dataRepo->findByKey('privacy-policy')->permalink;
        return view('oxygen::pages.privacy', ['title' => 'Privacy Policy'], compact('file_url'));
    }

    public function aboutUs()
    {
        $file_url = $this->dataRepo->findByKey('about-us')->permalink;
        return view('oxygen::pages.about', ['title' => 'About Us'], compact('file_url'));
    }

    public function termsConditions()
    {
        $file_url = $this->dataRepo->findByKey('terms-conditions')->permalink;
        return view('oxygen::pages.terms', ['title' => 'Terms & Conditions'], compact('file_url'));
    }

    public function faqs()
    {
        $file_url = $this->dataRepo->findByKey('faq')->permalink;
        return view('oxygen::pages.faqs', ['title' => 'Frequently Asked Questions'], compact('file_url'));
    }

    public function articles()
    {
        $articles = Article::where('status', 1)->get();
        return view('oxygen::pages.articles', ['title' => 'Articles'], compact('articles'));
    }

    public function testimonials()
    {
        $testimonials = $this->dataRepo->findByKey('testimonials ')->permalink;
        return view('oxygen::pages.testimonials', ['title' => 'Testimonials'], compact('testimonials'));
    }

    /**
     *
     * Show Contact Us Page
     *
     * @return Factory|View
     */
    public function contactUs()
    {
        return view('oxygen::pages.contact-us', ['title' => 'Contact Us']);
    }

    /**
     *
     * Submit Contact Us Page
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function postContactUs(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'userMessage' => 'required'
        ]);

        $data = $request->only('name', 'email', 'phone', 'userMessage');

        // recaptcha validation
        if (config('features.security.recaptcha_enabled')) {
            $secret = env('RECAPTCHA_SECRET_KEY');
            $recaptcha = new ReCaptcha($secret);
            $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
            if ($response->isSuccess()) {
                // Verified!
                // do nothing, proceed forward
            } else {
                $errors = $response->getErrorCodes();

                if (count($errors)) {
                    return redirect()->route('contact-us')
                        ->with('error', 'Captcha validation failed. Try again or email us for support.')
                        ->withInput($data);
                }
            }
        }

        $data['timestamp'] = Carbon::now()->format('d/m/Y h:i:sA');
        $data['userIp'] = request()->ip();
        $data['sender_email'] = $request->get('email');

        $webmaster = env('WEBMASTER_EMAIL');
        if (empty($webmaster)) throw new InvalidArgumentException("Email receiver email has not been set.");
        $receiverEmails = [$webmaster];

        Mail::send(['text' => 'oxygen::emails.text.contact-us'], $data, function ($mailMessage) use ($data, $receiverEmails) {
            $mailMessage->to($receiverEmails)
                ->replyTo($data['sender_email'])
                ->subject(config('app.name') . ' - Contact Us - Message Received');
        });

        return redirect()->back()->with('success', 'Your message has been sent.');
    }

    /**
     * @return Factory|View
     */
    public function videos()
    {
        $videos = Video::where('status', 1)->orderBy('id', 'desc')->get();
        return view('oxygen::pages.videos', ['title' => 'Videos'], compact('videos'));
    }
}
